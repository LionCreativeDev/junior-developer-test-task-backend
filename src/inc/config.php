<?php

namespace src\inc;

class config {
    // Properties
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $databasename = "scandiweb";
  
    // Methods
    function get_host() {
      return $this->host;
    }
    function get_username() {
      return $this->username;
    }
    function get_password() {
        return $this->password;
    }
    function get_databasename() {
        return $this->databasename;
    }
  }
?>