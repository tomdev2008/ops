<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  

require_once APPPATH."/third_party/Requests-1.7.0/library/Requests.php";
class PHPrequests {
    public function __construct() {
       Requests::register_autoloader();
    }
}