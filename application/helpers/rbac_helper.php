<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//MEMCAHED 唯一ID
if(!function_exists('mem_id'))
{
    function mem_id()
    {
        return $_SERVER['HTTP_HOST']."|".md5('SCRIPT_NAME').session_id();
    }
}

//MEMCACHED调用方法
if(!function_exists('mem_inst'))
{
   function mem_inst()
   {
     $ci_obj=&get_instance();
     $ci_obj->config->load('memcached',TRUE);
     //echo $ci_obj->config->item('flag','memcached').'这啥';
     if($ci_obj->config->item('flag','memcached')===FALSE) return FALSE;
     $ci_obj->load->library('memcached');
     static $static_memc;
     if($static_memc) return $static_memc;
     $memc=new Memcached($ci_obj->config->item('config','memcached'));
     $static_memc=$memc;
     return $static_memc;
     
   }
}

//获取&设置rbac数据 基于[基于SESSION|MEMCACHED]
if(!function_exists('rbac_conf'))
{
    function rbac_conf($arr_key,$value=NULL)
    {
       $ci_obj=&get_instance();
       //获取
       if(mem_inst())
       {
          if(!$config=mem_inst()->get(mem_id()))
          {
             $config=$_SESSION[$ci_obj->config->item('rbac_auth_key')];
          }
          else 
          {
             $config=@$_SESSION[$ci_obj->config->item('rbac_auth_key')];
          }
       }
       $conf[-1]=&$config;
       foreach ($arr_key as $k=>$ar)
       {
          $conf[$k]=&$conf[$k-1][$ar];
       }
       if($value!==NULL)
       {
          $conf[count($arr_key)-1]=$value;
       }
       //设置
       if(mem_inst())
       {
         if(!mem_inst()->set(mem_id(),$config))
         {
            $_SESSION[$ci_obj->config->item('rabc_auth_key')]=$config;
         }
       }
       else
       {
            $_SESSION[$ci_obj->config->item('rbac_auth_key')]=$config;
       }
       return isset($conf[count($arr_key)-1])?$conf[count($arr_key)-1]:FALSE;
    }
}

if(!function_exists('error_redirct'))
{
   function error_redirct($url="",$contents="操作失败",$time=3)
   {
      $ci_obj=&get_instance();
      if($url!="")
      {
         $url=base_url("index.php/".$url);
      }
      else
      {
         $url=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:site_url();
      }
      $data['url']=$url;
      $data['time']=$time;
      $data['type']='error';
      $data['contents']=$contents;
      $ci_obj->load->view('redirect',$data);
      $ci_obj->output->_display($ci_obj->output->get_output());
      die();
   }
}




