<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Main_Teacher extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_teacher();
    }
    
    public function index() {
        $udata = $this->General_queries->teacher_data($this->session->userdata('uid'));

        if(empty($udata[0]->inf_surname) || empty($udata[0]->inf_firstname)) {
            
            $this->session->set_userdata('email', $udata[0]->usr_email);
            $data['uname'] = $udata[0]->usr_email;
            
        }  else {
            
            $array = array('surname'=>$udata[0]->inf_surname, 'firstname'=>$udata[0]->inf_firstname);
            $this->session->set_userdata($array);
            $data['uname'] = $udata[0]->inf_surname . ', ' . $udata[0]->inf_firstname;
        }
        
        $this->session->set_userdata('uname',$data['uname']);

        $this->load->view('teacher/main_view', $data);
    }
}