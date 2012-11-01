<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Deped_main extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_deped();
    }
    
    public function index(){
        
        $cur_user = $this->session->userdata('uname');
        
        if(empty($cur_user)) {
            $udata = $this->General_queries->deped_data($this->session->userdata('uid'));
            $this->session->set_userdata('uname', $udata[0]->usr_email);
        }
        
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('deped/main_view',$data);
    }
    
    
}