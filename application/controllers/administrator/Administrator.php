<?php
class Administrator extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
    }
    
    //进入后台主页视图
    public function index()
    {
      //判断是否有用户配置信息
      if(!rbac_conf(array('INFO','id')))
      {
      	 //没有，跳转到默认登录页面
         error_redirect($this->config->item('rbac_auth_gateway'),'请先登录！');
      }
      else
      {
         //已经登录过,
         success_redirect($this->config->item('rbac_default_index'),"你已经登录成功,正在跳转请稍后.",1);
      }
    }
    
    public function redirect()
    {
      $this->load->view('administrator/redirect');
    }
    
    public function login()
    {
      $this->load->model('rbac_model');
      $username=$this->input->post('username');
      $password=$this->input->post('password');
      //echo $username.'-----'.$password;
      if(!empty($username)&&!empty($password))
      {
         //检测用户状态
         $status=$this->rbac_model->check_user($username,md5($password));
         if($status==true)
         {
            success_redirect($this->config->item('rbac_default_index'),'登录成功！');
         }
         else 
         {
            error_redirect($this->config->item('rbac_auth_gateway'),$status);
            die();
         }
      }
      else
      {
         $this->load->view('administrator/login');
      }
    }
    
    
}