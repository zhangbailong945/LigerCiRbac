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
      $this->load->view('administrator/index');
    }
    
    
}