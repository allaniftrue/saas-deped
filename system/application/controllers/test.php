<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Test Extends CI_Controller {
    
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $time = time();
        $check_date = mdate('%Y-%m-%d %H:%i:%s', time());
            
        echo $check_date;
//        $this->load->library('ciqrcode');
//        $this->load->helper('directory');
//        
////        $map = directory_map('./qrcodes', 1);
////        print_r($map);
////        
////         
//        $params['data'] = 'This is a text to encode become QR Code';
//        $params['level'] = 'H';
//        $params['size'] = 10;
//        $params['savename'] = './qrcodes/'.  uniqid().'.jpg';
//        $this->ciqrcode->generate($params);
//
//        echo '<img src="'.base_url().'qrcodes/test.png" />';
    }
}
?>
