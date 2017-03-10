<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Rbac
{
  private $ci_obj;
  public function __construct()
  {
     $this->ci_obj=&get_instance();
     $this->ci_obj->load->config('rbac');
     $this->ci_obj->load->helper(array('rbac','url'));
     if(isset($this->ci_obj->view_override))
     {
     	  //默认重写视图
          $this->ci_obj->view_override=TRUE;
     }
  }
  
  /**
   * Rbac权限认证
   */
  public function rbac_auth()
  {
     //获取当前的目录.控制器.方法
     $directory=$this->ci_obj->router->fetch_directory();
     //获取当前URL的控制器
     $controller=$this->ci_obj->router->fetch_class();
     //获取当期URL的方法
     $function=$this->ci_obj->router->fetch_method();
     //echo $directory.$controller.'/'.$function;
      //UURI(MD5)
     $this->ci_obj->uuri = md5($directory.$controller.$function);
     //非主目录
     if($directory!="")
     {
       //读取rbac配置文件，是否开启了权限验证
       if($this->ci_obj->config->item('rbac_auth_on'))
       {
       	  //如果当前的控制器/方法 不在不需要验证的目录控制器/方法列表中
          if(!in_array($directory,$this->ci_obj->config->item('rbac_notauth_dirc')))
          {
             //验证是否登录
             if(!rbac_conf(array('INFO','id')))
             {
                 error_redirct($this->ci_obj->config->item('rbac_auth_gateway'),"请先登录！");
			     die();
             }
          }
       }
     }
     
     
  }
  
  
  
}