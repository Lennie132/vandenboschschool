<?php

  /**
   * Description of bestandenmodule
   *
   * @author Lennart Veringmeier
   */
  class bestandenmodule {

    private $group;     // Group id van de pagina
    private $useLogin;  // true als er ingelogt moet worden, false als het open is voor alle bezoekers
    private $moduleID;  // Module id, halen uit "Modules beheren"

    public function __construct($moduleID = '', $group = 0, $useLogin = true) {
      $this->setModuleID($moduleID);
      $this->setGroup($group);
      $this->setUseLogin($useLogin);
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
     * @param int $limit
     * @return array
     */
    public function getFolders($limit = 0) {
      $folders = artikelen::get_artikel_groepen_arr($this->getGroup(), 'g.gewicht ASC', $this->getModuleID(), $limit);
      return $folders;
    }

    /**
     * Stuurt alle artikelen van een groep op (bestanden/files)
     * @param int $limit
     * @return array
     */
    public function getFiles($limit = 0) {
      $files = artikelen::get_artikelen_arr('art_bestandenmodule', $this->getGroup(), 'a.gewicht ASC', 0, $limit);
      return $files;
    }

    /**
     * Geeft het totaal aantal bestanden (voor paginatie)
     * @return int
     */
    function getFilesCount() {
      $files = artikelen::get_artikelen_arr('art_bestandenmodule', $this->getGroup(), 'a.gewicht ASC', 0);
      $amount = count($files);
      return $amount;
    }

    /**
     * Stuurt het juiste pad terug van passende icoon bij bestandsextensie
     * @param string $extension
     * @return string
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
     * @param int $file_id
     * @return string
     */
    public function downloadFile($file_id) {
      if ($this->checkLogin()) {
        $file = artikelen::get_artikelen_arr('art_bestandenmodule', '*', 'a.gewicht ASC', $file_id);
        $file_path = get_art_file_path($file['bestand']['DATA'], $file_id, 0, true);
        //die($file_path);
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
          return '<div class="alert alert-warning">404 - Not Found: Bestand niet gevonden.</div>';
        }
      } else {
        return '<div class="alert alert-warning">401 - Unauthorised. Log in om dit bestand te downloaden.</div>';
      }
    }

    public function doLogin($username = '', $password = '') {
      $query = "SELECT * FROM `users` WHERE `user_name` = '" . mysql_real_escape_string($username) . "' && `user_pass` = '" . md5($password) . "'";
      $result = sql::get_data_arr($query);
      if (is_array($result) && count($result) > 0 && $result[0]['user_id'] > 0) {
        $_SESSION['LCMS']['lang'] = 'NL';
        $_SESSION['LCMS']['username'] = $result[0]['user_name'];
        $_SESSION['LCMS']['password'] = $result[0]['user_pass'];
        $_SESSION['LCMS']['user_full'] = $result[0]['user_full'];
      }
      return $result[0];
    }

    /**
     * Checkt of de gebruiker toegang heeft, true voor toegang, false voor geen toegang
     * @return boolean
     */
    public function checkLogin() {
      if ($this->getUseLogin()) {
        if (is_array($_SESSION['LCMS']) && count($_SESSION['LCMS']) > 0) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    }

  }
  