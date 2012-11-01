<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm_Invitations extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('email');
    }
    
    private function _prep_password($date,$password) {
        return hash('sha512', md5($date.$password));
    }
    
    public function index(){
        
        $key = $this->input->get('k');
        $al = strlen($this->input->get('al'));
        $q = strlen($this->input->get('q'));
        $data =array();
        
        $sql = $this->db->query("select * from tbl_users where usr_token='$key' and usr_status='unverified' and usr_reg_date <= DATE_ADD(NOW(),INTERVAL 1 DAY)");

        $result = $sql->result();
        $num_res = count($result);

        if($num_res > 0) {
            
            $time = time();
            $check_date = mdate('%Y-%m-%d %h:%i:%s', $time);
            $base_date = mdate('%Y-%m-%d %H:%i:%s',strtotime($result[0]->usr_reg_date . '+24 hours'));
            $email = $result[0]->usr_email;
            
            if($check_date <= $base_date) {
                $rand = uniqid();
                $password = $this->_prep_password($result[0]->usr_reg_date, $rand);
                
                $data = array(
                    'usr_password' => $password,
                    'usr_status' => 'verified'
                );
                
                $this->db->where('usr_id', $result[0]->usr_id);
                $this->db->update('tbl_users', $data); 
                $aff_row = $this->db->affected_rows();
                
                $t_data = array(
                    'inf_id'=>$result[0]->usr_id
                );
                
                $this->db->insert('tbl_teacher_info',$t_data);
                $num_row = $this->db->affected_rows();
                
                
                if($aff_row > 0 && $num_row > 0) {
                    
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from('no-reply@saas.ph', 'SaaS Administrator');
                        $this->email->to($email); 

                        $this->email->subject('Login Password');
                        $this->email->message('
                        <p>Greetings,</p>

                        <p>Your new password: '.$rand.'</p>

                        <p>Regards, <br /> SaaS Administrator </p>

                        ');	

                        if($this->email->send()) {
                            $data['msg_stat'] = array('stat'=> 1, 'msg'=> 'Account activated.  Check your email for the password');
                        } else {
                            $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Password not sent');
                        }
                    
                } else {
                    $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Failed to verifiy invitation link');
                }


            } else {
                $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Invalid link');
            }
            
        } else {
            $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Invalid link or expired link');
        }
     $this->load->view('confirmation/index_view',$data);
    }
    
    public function deactivate() {
        $key = $this->input->get('k');
        $al = strlen($this->input->get('al'));
        $q = strlen($this->input->get('q'));
        
        if(!empty($key) && !empty($al) && !empty($q)) {
            
            $query = $this->db->get_where('tbl_users',array('usr_token'=>$key,'usr_status'=>'unverified'));
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                $this->db->delete('tbl_users', array('usr_token' => $key)); 
                $aff_row=$this->db->affected_rows();
                
                if($aff_row > 0) {
                    $data['msg_stat'] = array('stat'=> 1, 'msg'=> 'Thank you for deactivating the account');
                } else {
                    $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Invalide link');
                }
            } else {
                $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Invalid link');
            }
        } else {
            $data['msg_stat'] = array('stat'=> 0, 'msg'=> 'Invalid link');
        }
      $this->load->view('confirmation/index_view',$data);
    }
    
    
}