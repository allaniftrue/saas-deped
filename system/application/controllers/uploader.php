<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->config->load('uploading_script');
		$this->load->view('uploader');
	}
}