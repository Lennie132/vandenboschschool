<?php
  //print_pre($DATA);

  $ongeveer_een_jaar = 31449600; // seconden
  $tabelnaam = $thisconfig['art_bezoekers'];
  $gebruikersnaam_kolom = $thisconfig['Gebruikersnaam'];
  $wachtwoord_kolom = $thisconfig['Wachtwoord'];

  /**
   * VUL HIER HET EMAILADRES KOLOM IN
   */
  $emailKolom = 'email';


  $pwMsg = '';
  if (!empty($DATA['requestPassword']) && $DATA['requestPassword'] == 'true') {
    $pRequestObj = new BezoekerPassRequest($DATA['username']);
    $user_check = $pRequestObj->checkIfAccountExists($tabelnaam, $emailKolom, $DATA['username']);
    if ($user_check) {
      $pRequestObj->sendRequest('Uw wachtwoordaanvraag voor ' . lcms::thisconfig('titel_prefix'), $DATA['page']);
      $pwMsg = '<div class="alert alert-success">Er is een email verzonden naar ' . $DATA['username'] . '</div>';
    } else {
      $pwMsg = '<div class="alert alert-warning">Dit account is niet bekend bij ons.</div>';
    }
  }

  if (isset($DATA['passwordReset']) && $DATA['passwordReset'] == 'complete') {
    $pwMsg = '<div class="alert alert-success">Uw wachtwoord is succesvol aangepast. U kunt nu inloggen</div>';
  }


  if (isset($DATA['editPassword']) && trim($DATA['passwordToken']) != '') {
    $pRequestObj = new BezoekerPassRequest();
    $pRequestObj->decipherToken($DATA['passwordToken']);

    if ($DATA['password'] == $DATA['password_repeat']) {
      $pRequestObj->savePassword($tabelnaam, $emailKolom, $wachtwoord_kolom, $DATA['password'], $DATA['passwordToken']);
      redirect(link::c($DATA['page'])->extra('passwordReset=complete')->return_absolute());
    } else {
      $pwMsg = '<div class="alert alert-warning">De opgegeven wachtwoorden komen niet overeen</div>';
    }
  }


//Post actie
  if (!empty($DATA['login_submit'])) {


    //Pak tabelnaam
    //$tabelnaam = get_data_arr("SELECT tabel_naam FROM {$thisconfig['T_art_type']} WHERE module_id='{$thisconfig['bezoekers_module_id']}'");
    //$tabelnaam = $tabelnaam[0]['tabel_naam'];
    //$wwtype = get_data_arr("SELECT type FROM {$thisconfig['T_art_type_items']} ati LEFT JOIN {$thisconfig['T_art_type']} at ON ati.type_id=at.type_id WHERE at.module_id='{$thisconfig['bezoekers_module_id']}' AND ati.item_name='{$wachtwoord_kolom}' LIMIT 1;");
    //$wwoord = $DATA['password'];
    //if ($wwtype[0]['type'] == 29) { //encrypted
    $wwoord = md5($DATA['password']);
    //}

    if (!empty($tabelnaam) && !empty($DATA['username']) && str_replace(" ", "", $DATA['username']) !== "" && !empty($wwoord) && str_replace(" ", "", $wwoord) !== "") {
      //--- algemene loginblokker waarmee je maximaal 6 keer verkeerd kan inloggen en daarna word je account geblokkeerd.
      $loginblokker = new LoginBlock($DATA['username'], 'pagina');
      if ($loginblokker->checkToLogin()) {
        //--- Inlog is nog niet geblokeerd voor deze gebruiker.
        //Pak gebruiker gegevens
        $user_check = get_data_arr("SELECT * FROM `{$tabelnaam}` WHERE `{$gebruikersnaam_kolom}` ='{$DATA['username']}' AND `{$wachtwoord_kolom}` = '{$wwoord}'");
        if (!empty($user_check)) {
          $resume = true;
          if ($thisconfig['bezoekers_type_tabelnaam'] != '' and $thisconfig['bezoekers_tabel_type'] != '') { //bezoekers types is ingeschakeld
            $resume = false;
            $bezoekerstype = $user_check[0][$thisconfig['bezoekers_tabel_type']];
            $paginatypes = get_data_arr("SELECT pagina_id,bezoekertypes FROM {$thisconfig['T_pagina']} WHERE pagina_id='{$DATA['page']}'");
            if ($paginatypes[0]['bezoekertypes'] == '') {
              $resume = true;
            } else {
              $btypes = explode(',', $paginatypes[0]['bezoekertypes']);
              if (in_array($bezoekerstype, $btypes)) {
                $resume = true;
              }
            }
          }
          if ($resume) {
            if (!empty($DATA['koekie'])) {
              //setcookie("userid", $user_check[0]['artikel_data_id'], time()+$ongeveer_een_jaar);
              setcookie("username", $DATA['username'], time() + $ongeveer_een_jaar, '/');
              setcookie("password", $DATA['password'], time() + $ongeveer_een_jaar, '/');
            }
            //Snor, ingelogd.
            $_SESSION['gebruiker'] = $user_check[0];
            $_SESSION['ingelogd'] = 1;

            $loginblokker->setGelukt();
            //javascript refresh, zodat hij nu de echte pagina te zien krijgt.
            echo '<script language="javascript">window.location=window.location;</script>';
          }
        } elseif ($globals['linkerbalk'] !== 1) {
          //Fout 
          $loginblokker->setMislukt();
          echo '<b>Verkeerde combinatie.</b><br/>';
        }
      } else {
        echo '<b>6 maal verkeerd ingelogd, je bent voor 10 minuten geblokkeerd.</b><br/>';
      }
    }
  }
?>
<div class="container" style="margin-top:30px">
  <div class="col-md-4 col-md-offset-4">
<?= $pwMsg; ?>
<?php
  if (isset($DATA['editPassword']) && $DATA['requestToken'] != '') {

    $pRequestObj = new BezoekerPassRequest();
    if ($pRequestObj->decipherToken($DATA['requestToken'])) {
      ?>
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Wijzig uw wachtwoord</strong></h3></div>
            <div class="panel-body">
              <form method="post" role="form">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="login-username" type="password" class="form-control" name="password" value="<?= $DATA['password'] ?>" placeholder="Uw nieuwe wachtwoord">                                        
                </div>

                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="login-password" type="password" class="form-control" name="password_repeat"  value=""  placeholder="Herhaal uw nieuwe wachtwoord">
                </div>

                <button type="submit" class="btn btn-success">Opslaan</button>
                <input type="hidden" value="<?= $DATA['requestToken'] ?>" name="passwordToken" />
                <input type="hidden" value="true" name="savePassword" />

              </form>
            </div>
          </div>
      <?php
    } else {
      echo '<div class="alert alert-warning">Deze token is verlopen of bestaat niet</div>';
    }
  } else {
    ?>
        <div class="panel panel-default">
          <div class="panel-heading"><h3 class="panel-title"><strong>Inloggen</strong></h3></div>
          <div class="panel-body">
            <form method="post" role="form">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="text" class="form-control" name="username" value="<?= $_COOKIE['username'] ?>" placeholder="username or email">                                        
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="login-password" type="password" class="form-control" name="password" value="<?= $_COOKIE['password'] ?>" placeholder="password">
              </div>

              <div class="input-group">
                <div class="checkbox">
                  <label>
                    <input id="login-remember" type="checkbox" value="cook" name="koekie"> Onthoud mijn gegevens
                  </label>
                </div>
              </div>

              <button type="submit" class="btn btn-success">Inloggen</button>

              <hr>

              <div class="form-group">

                <div style="font-size:85%">
                  <a onclick="$('.js-show-panel').toggle();" style="display:block;text-align: right;" href="javascript:void(0);">Wachtwoord vergeten?</a>
                </div>

              </div> 

              <input type="hidden" value="true" name="login_submit" />

            </form>
          </div>
        </div>



        <!-- FORGOT PW PANEL -->
        <div style="display: none;" class="js-show-panel panel panel-default">
          <div class="panel-heading"><h3 class="panel-title"><strong>Inloggen</strong></h3></div>

          <div class="panel-body">
            <form method="get" action="" role="form">
              <p style="font-size: 18px;line-height: 22px;">
                Bent u uw wachtwoord vergeten? <br />Vul dan onderstaand uw emailadres in. <br />
                Er wordt een mail naar u verstuurd met daarin een link. Via deze link kunt u uw wachtwoord opnieuw instellen.
              </p>

              <hr />

              <div style="margin-bottom: 12px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="email" class="form-control" name="username" value="<?= $_COOKIE['username'] ?>" placeholder="Uw emailadres">                                        
              </div>

              <input type="hidden" name="requestPassword" value="true" />

              <button type="submit" class="btn btn-success">Bevestigen</button>

            </form>
          </div>
        </div>
  <?php } ?>
  </div>
</div>