<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->helper('string');
    }
    
    private function _prep_password($date,$password) {
        return hash('sha512', md5($date.$password));
    }
    
    public function index() {
        
        $is_login = $this->session->userdata('is_login');
        $user_type = $this->session->userdata('usertype');
        
        if($is_login === TRUE) {
            if($user_type === 'registrar'){
                redirect(base_url().'?mc=main_registrar&r='.rand().'&sess='.random_string('alnum',8));
            } elseif($user_type === 'teacher') {
                redirect(base_url().'?mc=main_teacher&t='.rand().'&sess='.random_string('alnum',8));
            } elseif($user_type === 'student') {
                redirect(base_url().'?mc=student_main&s='.rand().'&sess='.random_string('alnum',8));
            } elseif($user_type === 'parent') {
                redirect(base_url().'?mc=parent_main&p='.rand().'&sess='.random_string('alnum',8));
            } elseif($user_type === 'deped') {
                redirect(base_url().'?mc=deped_main&d='.rand().'&sess='.random_string('alnum',8));
            }else {
                $this->load->view('login/login_view');
            }
        } else {
            $this->load->view('login/login_view');
        }
    }
    
    public function register() {
       
       $email = trim($this->input->post('mail'));
       $mobile = trim($this->input->post('mob'));
       $password = $this->_prep_password($this->input->post('passwd'));
       $token =  random_string('unique');

       if($this->General_queries->is_exist('tbl_users', 'usr_email', $email) == TRUE || 
               $this->General_queries->is_exist('tbl_teacher_info', 'inf_contact_num', $mobile) == TRUE) {
           
           /* LOG INFORMATION */
           $this->General_queries->log_session('', $this->input->ip_address(), $this->input->user_agent(), 
                                                'Session is trying to register an existing email:' . $email);
          
           $data = array('title'=> 'Error', 'message'=>'Information is already in use.');
           echo json_encode($data);
           
       } else {

            $db_data = array(
                            'usr_email'=> $email,
                            'usr_password'=> $password,
                            'usr_user_type'=> 'teacher',
                            'usr_token'=> $token,
                            'usr_status'=>'unverified',
            );
            
            $this->db->set('usr_reg_date', 'NOW()', FALSE); 
            $this->db->limit(1);
            $this->db->insert('tbl_users', $db_data);
            $last_id = $this->db->insert_id();
            $num_rows = $this->db->affected_rows();
         
            if($num_rows > 0) {

                $db_data = array (
                                    'inf_id'=> $last_id,
                                    'inf_contact_num'=> $mobile
                );
                
                $this->db->limit(1);
                $this->db->insert('tbl_teacher_info', $db_data);
                $num_rows = $this->db->affected_rows();
              
                if($num_rows > 0) {
                    
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from('no-reply@saas.ph', 'SaaS Administrator');
                    $this->email->to($email); 
                  
                    $this->email->subject('Account Activation');
                    $this->email->message('
                    <p>Hello,</p>

                    <p>Click this <a href="'.  base_url() .'?mc=login&m=activate&al='.random_string('alnum', 32).'&key='.$token.'&q='.random_string('alnum', 12).'">link</a> to activate your account or refer to the links below provided. </p>
                        
                    <p>If you are not a teacher of any Basic Education Public Schools in the Philippines, you are not allowed to have this account.
                    You should <a href="'. base_url() .'?mc=login&m=deactivate&al='.random_string('alnum', 32).'&key='.$token.'&q='.random_string('alnum', 8).'">deactivate</a> this account now.  Unauthorized access to the system is a crime punishable by law.</p>
                        
                    <p>Open the url below on your browser to activate your account: <br /> 
                    Activation Link:  '.  base_url() .'?mc=login&m=activate&al='.random_string('alnum', 32).'&key='.$token.'&q='.random_string('alnum', 12).' <br /><br />        Deactivation Link: '. base_url() .'?mc=login&m=deactivate&al='.random_string('alnum', 32).'&key='.$token.'&q='.random_string('alnum', 18).'
                        
                    <p>&mdash; SaaS Administrator </p>

                    ');	

                    if(!$this->email->send()) {
                        $data = array('title'=> 'Error', 'message'=> 'Email Not sent.');
                        echo json_encode($data);
                    } else {
                        $data = array('title'=> 'Success', 'message'=> 'Please check you email for the activation link.');
                        echo json_encode($data);
                    }
                    
                    
                } else {
                    $data = array('title'=> 'Error', 'message'=>'Failed to add user.');
                    echo json_encode($data);
                }
            } else {
                $data = array('title'=> 'Error', 'message'=>'Acount was not added.');
                echo json_encode($data);
            }
       }
    }
    
    public function activate() {
        
       $token = $this->input->get('key');
       
       
       if($this->General_queries->activate($token) == TRUE) {
           
            $data = array(
                            'usr_status'=> 'verified'
            );
           
            $this->db->where('usr_token', $token);
            $this->db->limit(1);
            $this->db->update('tbl_users', $data);
            
            if($this->db->affected_rows() > 0) {
                $data['message'] = 'Account successfully verified, you may now login.';
                $data['title'] = 'Success';
                $this->load->view('login/login_success_view', $data);
            } else {
                $data['message'] = 'Failed to activate account.';
                $this->load->view('login/login_fail_view', $data);
            }
           
       } else {
           $data['message'] = 'Account already verified.';
           $this->load->view('login/login_fail_view', $data);
       }      
    }
    
    function auth() {
        
        $uname = $this->input->post('username');
        $password = $this->input->post('password');
        
        $this->db->select('usr_reg_date');
        $query = $this->db->get_where('tbl_users', array('usr_email' => $uname,'usr_status'=>'verified'));
        $result = $query->result();
        $num_res = count($result);
     
        if($num_res > 0) {
            
            $password = $this->_prep_password($result[0]->usr_reg_date,$password); 
            $query = $this->db->get_where('tbl_users', array('usr_email'=>$uname,'usr_password'=>$password,'usr_status'=>'verified'));            
            $result = $query->result();
            $num_res = count($result);

                if($num_res > 0) {
                    
                    $array = array(
                                    'uid'=>$result[0]->usr_id,
                                    'usertype'=>$result[0]->usr_user_type,
                                    'is_login'=> TRUE,
                                    'email'=>$result[0]->usr_email
                    );
                    
                    $this->session->set_userdata($array);
                    if($result[0]->usr_user_type === 'registrar'){
                        redirect(base_url().'?mc=main_registrar&r='.rand().'&token='.random_string('alnum', 8));
                    } elseif($result[0]->usr_user_type === 'teacher') {
                        redirect(base_url().'?mc=main_teacher&t='.rand().'&token='.random_string('alnum', 8));
                    } elseif($result[0]->usr_user_type === 'student') {
                        redirect(base_url().'?mc=student_main&s='.rand().'&token='.random_string('alnum', 8));
                    } elseif($result[0]->usr_user_type === 'parent') {
                        redirect(base_url().'?mc=parent_main&p='.rand().'&token='.random_string('alnum', 8));
                    } elseif($result[0]->usr_user_type === 'deped') {
                        redirect(base_url().'?mc=deped_main&d='.rand().'&token='.random_string('alnum', 8));
                    }
                    
            } else{
                 $data['message'] = 'Wrong username or password';
            $this->load->view('login/login_view', $data);
            }
        } else {
            $data['message'] = 'Wrong username or password';
            $this->load->view('login/login_view', $data);
        }

    }
}