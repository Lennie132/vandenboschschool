<?php

  /**
   * Deze module heeft minimaal de tabellen:
   *  - art_bestandenmodule
   *  - art_bestandenmodule_eigenschappen
   *  - art_kleuren (Kleuren voor mappen/groepen)
   * 
   * Deze lcms variabelen zijn er nodig:
   *  - page_bestandenmodule (pagina_id waar deze module wordt gebruikt)
   *  - bestandenmodule_gebruik_login (true of false)
   * 
   * De bezoekersmodule kan gebruikt worden voor deze module,
   * vink hiervoor op de pagina zichtbaar->login aan, en zet de variabele 'bestandenmodule_gebruik_login' op true.
   * 
   * @author Lennart Veringmeier
   * @date 13-12-2016
   */
  class bestandenmodule {

    private $group;     // Group id van de pagina
    private $useLogin;  // true als er ingelogt moet worden, false als het open is voor alle bezoekers
    private $moduleID;  // Module id, halen uit "Modules beheren"

    /**
     * Je hebt een moduleID nodig, de group kan je ophalen uit $DATA['group'] en uselogin is een lcms-variabele.
     * 
     * @param int $moduleID De module id, zie lcms->modules->beheren
     * @param int $group LCMS $DATA['group']
     * @param boolean $useLogin LCMS variabele 'bestandenmodule_gebruik_login'
     * @return \bestandenmodule
     */

    public function __construct($moduleID = null, $group = 0, $useLogin = true) {
      $this->setModuleID($moduleID);
      $this->setGroup($group);
      $this->setUseLogin($bool = filter_var($useLogin, FILTER_VALIDATE_BOOLEAN));
      return $this;
    }

    function getModuleID() {
      return $this->moduleID;
    }

    function setModuleID($moduleID) {
      $this->moduleID = $moduleID;
      return $this;
    }

    function getGroup() {
      return $this->group;
    }

    function setGroup($group) {
      $this->group = $group;
      return $this;
    }

    function getUseLogin() {
      return $this->useLogin;
    }

    function setUseLogin($useLogin) {
      $this->useLogin = $useLogin;
      return $this;
    }

    /**
     * Stuurt alle groepen binnen een groep terug (mappen/folders)
     * @param int $limit Aantal mappen
     * @return array mappen/folders
     */
    public function getFolders($limit = 0) {
      $folders = artikelen::get_artikel_groepen_arr($this->getGroup(), 'g.gewicht ASC', $this->getModuleID(), $limit);
      return $folders;
    }

    /**
     * Stuurt alle artikelen van een groep op (bestanden/files)
     * @param int $limit Aantal bestanden
     * @return array bestanden/files
     */
    public function getFiles($limit = 0) {
      $files = artikelen::get_artikelen_arr('art_bestandenmodule', $this->getGroup(), 'a.gewicht ASC', 0, $limit);
      return $files;
    }

    /**
     * Geeft het totaal aantal bestanden (voor paginatie)
     * @return int Aantal bestanden
     */
    function getFilesCount() {
      $files = artikelen::get_artikelen_arr('art_bestandenmodule', $this->getGroup(), 'a.gewicht ASC', 0);
      $amount = count($files);
      return $amount;
    }

    /**
     * Stuurt het juiste pad terug van passende icoon bij bestandsextensie
     * @param string $extension extensie van bestand
     * @return string bestandsnaam van icoon
     */
    public static function getFileIcon($extension) {
      $icon = '';
      switch ($extension) {
        case 'doc':
        case 'docx':
          $icon = 'word.png';
          break;
        case 'txt':
        case 'gdoc':
          $icon = 'text-gdocs.png';
          break;
        case 'pdf':
          $icon = 'pdf.png';
          break;
        case 'jpg':
        case 'png':
          $icon = 'image.png';
          break;
        case 'xls':
        case 'xlsx':
          $icon = 'exel.png';
          break;
        case 'gsheet':
          $icon = 'gsheets.png';
          break;
        case 'ppt':
        case 'pptx':
          $icon = 'powerpoint.png';
          break;
        case 'gslides':
          $icon = 'gslides.png';
          break;
        case 'mp3':
          $icon = 'sound.png';
          break;
        case 'mp4':
        case 'avi':
          $icon = 'video.png';
          break;
        default:
          $icon = '';
          break;
      }
      return $icon;
    }

    /**
     * Aan de hand van een artikel_id stuurt dit een download door of melding als er een probleem is
     * @param int $file_id Een bestand_id
     * @return string Melding bij fouten
     */
    public function downloadFile($file_id) {
      if ($this->checkLogin()) {
        $file = artikelen::get_artikelen_arr('art_bestandenmodule', '*', 'a.gewicht ASC', $file_id);
        $file_path = get_art_file_path($file['bestand']['DATA'], $file_id, 0, true);
        if (file_exists($file_path)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($file_path));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file_path));
          ob_clean();
          flush();
          readfile($file_path);
          exit();
        } else {
          return '404 - Not Found: Bestand niet gevonden.';
        }
      } else {
        return '401 - Unauthorised. Log in om dit bestand te downloaden.';
      }
    }

    /**
     * Checkt of de gebruiker toegang heeft, true voor toegang, false voor geen toegang
     * @return boolean toegang?
     */
    public function checkLogin() {
      if ($this->getUseLogin()) {
        if (is_array($_SESSION['gebruiker']) && count($_SESSION['gebruiker']) > 0 && $_SESSION['ingelogd'] == 1) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    }

  }
  