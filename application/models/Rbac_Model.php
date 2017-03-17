<?php
class Rbac_Model extends CI_Model{

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }
   
   public function check_user($username,$password)
   {
      
   }
   
}