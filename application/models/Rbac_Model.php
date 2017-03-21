<?php
class Rbac_Model extends CI_Model{

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function get_acl($role_id)
   {
      $query=$this->db->query("select id,dirc,cont,func from `rbac_node` where id in (select node_id from `rbac_auth` where role_id=".$role_id.")");
      $role_data=$query->result();
      foreach ($role_data as $ro)
      {
         $Tmp_role[$ro->dirc][$ro->cont][$ro->func]=TRUE;
      }
      rbac_conf(array('ACL'),$Tmp_role);
   }
   
   public function check_user($username,$password)
   {
      $query=$this->db->query("select id,password,nickname,email,role_id,status from `rbac_user` where username='".$username."' LIMIT 1");
      $data=$query->row_array();
      if($data)
      {
         if($data['status']==1)
         {
            if($data['password']==$password)
            {
               rbac_conf(array('INFO','id'),$data['id']);
               rbac_conf(array('INFO','role_id'),$data['role_id']);
               rbac_conf(array('INFO','email'),$data['email']);
               rbac_conf(array('INFO','nickname'),$data['nickname']);
               $this->get_acl($data['role_id']);
               return true;
            }
            else 
            {
              return "账户密码错误!";
            }
         }
         else 
         {
            return "该<font color='green'>".$username."</font>已禁用,请联系管理人员.";
         }
      }
      else
      {
         return "该<font color='green'>".$username."</font>用户不错在!";
      }
   }
   
}