<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Account_guardian extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_parent();
    }
    
    public function index() {
        
        $udata = $this->General_queries->guardian_data($this->session->userdata('uid'));
        $data['uname'] = $udata[0]->usr_email;
        $this->load->view('parent/account_view',$data);
    }
}