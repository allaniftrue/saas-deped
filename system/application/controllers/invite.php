<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invite extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->helper('date');
        $this->load->model('Invites');
        $this->General_queries->protect_acct();
        $this->General_queries->is_teacher_registrar();
    }

    public function index() {
       
        $data['uname'] = $this->session->userdata('uname');
        $user_type = $this->session->userdata('usertype');
        $type = $this->input->get('act'); 
        
        if($type === 'deped' && $user_type !== 'registrar') { 
            redirect(base_url(),'refresh');
        }
        
        if($user_type == 'teacher' || $user_type == 'registrar') {
            $this->load->view('registrar/invite_view',$data);
        }
    }
    
    public function send_invites() {
        
        $email = trim($this->input->post('email'));
        $cur_utype = $this->session->userdata('usertype');
        $type = $this->input->post('utype');
        $isTeacher = FALSE;
            
        if($type === 'deped' && $cur_utype === 'registrar') {
            $acct_type = 'deped';
        } elseif($type === 'teacher' && ($cur_utype === 'teacher' || $cur_utype === 'registrar')) {
            $acct_type = 'teacher';
        } elseif($cur_utype != 'registrar' && $type === 'deped') {
             $data = array('status'=>0, 'msg'=>'Invitation not allowed');
             echo json_encode($data);
        }
        
       
        if(! empty($email) && ($cur_utype === 'teacher' || $cur_utype === 'registrar')) {
            
            $sql = $this->db->get_where('tbl_users', array('usr_email'=>$email));
            $result = $sql->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                $time = time();
                $db_max = mdate('%Y-%m-%d %H:%i:%s',strtotime($result[0]->usr_reg_date . '+24 hours'));
                $cur_time = mdate('%Y-%m-%d %h:%i:%s', $time);
                
                #Resends inviation if user already exist
                if($result[0]->usr_status === 'unverified' && $cur_time > $db_max) {
                   
                    $uid = $result[0]->usr_id;
                    $token =  random_string('unique');
                    
                    $db_data = array(
                                    'usr_email'=> $email,
                                    'usr_user_type'=> $acct_type,
                                    'usr_token'=> $token,
                                    'usr_status'=>'unverified',
                    );
                    
                    $this->db->set('usr_reg_date', 'NOW()', FALSE); 
                    $this->db->where('usr_id', $uid);
                    $this->db->update('tbl_users', $db_data); 
                    $aff_row = $this->db->affected_rows();
                    
                    if($aff_row > 0) {
                        
                        $actv= base_url() .'?mc=confirm_invitations&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                        $deact = base_url() .'?mc=confirm_invitations&m=deactivate&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from('no-reply@saas.gov.ph', 'SaaS Administrator');
                        $this->email->to($email); 

                        $this->email->subject('Invitation');
                        $this->email->message('
                        <p>Hello,</p>

                        <p>Click this <a href="'.$actv.'">link</a> to activate your account or refer to the links provided below.</p>

                        <p>If you are not a teacher of any Basic Education Public Schools in the Philippines, you are not allowed to have this account.
                        You should <a href="'.$deact.'">deactivate</a> this account now.  Unauthorized access to the system is a crime punishable by law.</p>

                        <p>Open the url below to activate your account: <br /> 
                        Activation Link:'.$actv.'</p>
                        <p>To deactivate open this link: <br />
                        Remove account: '.$deact.'    
                        </p>

                        <p>Regards, <br /> SaaS Administrator </p>

                        ');	

                        if($this->email->send()) {
                            $array = array('status'=>1, 'msg'=>'<strong>'.$email.'</strong> re-invited');
                            echo json_encode($array);
                        } else {
                            $data = array('status'=>0, 'msg'=>'<strong>'.$email.'</strong> added but failed to send the activation link.  Please view your list of invited teacher(s) and on the actions menu resend the invitation');
                            echo json_encode($data);
                        }
                        
                    } else {
                        $array = array('status'=>0, 'msg'=>'<strong>'.$email.'</strong> already exist');
                        echo json_encode($array);
                    }
                        
                    
                } else {
                    $array = array('status'=>0, 'msg'=>'<span>User already exist</span><br />');
                    echo json_encode($array);
                }
                
            } else {

                $token =  random_string('unique');
                $db_data = array(
                                    'usr_email'=>$email,
                                    'usr_user_type'=>$acct_type,
                                    'usr_token'=> $token,
                                    'usr_status'=>'unverified',
                );
                $this->db->set('usr_reg_date', 'NOW()', FALSE); 
                $this->db->limit(1);
                $this->db->insert('tbl_users', $db_data);
                $last_id = $this->db->insert_id();
                $num_rows = $this->db->affected_rows();
                
                $db_data = array(
                                    'usr_id'=>$this->session->userdata('uid'),
                                    'inv_user'=>$last_id
                );  
                $this->db->limit(1);
                $this->db->insert('tbl_invitations', $db_data);
                
                if($acct_type === 'teacher') {
                    $isTeacher = TRUE;
                    $db_data = array(
                                        'inf_id'=>$last_id
                    );
                    $this->db->insert('tbl_teacher_info', $db_data);
                }
                
                
                $aff_row = $this->db->affected_rows();
                
                if($num_rows > 0 && $aff_row > 0) {
                    $actv= base_url() .'?mc=confirm_invitations&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                    $deact = base_url() .'?mc=confirm_invitations&m=deactivate&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                    
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from('no-reply@saas.ph', 'SaaS Administrator');
                    $this->email->to($email); 
                    
                    $this->email->subject('Invitation');
                    $this->email->message('
                    <p>Hello,</p>

                    <p>Click this <a href="'.$actv.'">link</a> to activate your account or refer to the links provided below.</p>

                    <p>If you are not a teacher of any Basic Education Public Schools in the Philippines, you are not allowed to have this account.
                    You should <a href="'.$deact.'">deactivate</a> this account now.  Unauthorized access to the system is a crime punishable by law.</p>

                    <p>Open the url below to activate your account: <br /> <br />        
                    Activation Link:  '.$actv.' </p>
                    Deactivation Link: '.$deact.'

                    <p>Regards, <br /> SaaS Administrator </p>

                    ');	

                    if($this->email->send()) {
                        $array = array('status'=>1, 'msg'=>'<strong>'.$email.'</strong> invited');
                        echo json_encode($array);
                    } else {
                        $data = array('status'=>0, 'msg'=>'<strong>'.$email.'</strong> added but failed to send the activation link.  Please view your list of invited teacher and resend the link');
                        echo json_encode($data);
                    }
                } else {
                    $array = array('status'=>0, 'msg'=>'<strong>'.$email.'</strong> already exist');
                    echo json_encode($array);
                }
                
            }
        } else {
            $array = array('status'=>0, 'msg'=>'The email address is needed to send invites');
            echo json_encode($array);
        }
        //End of checking usertype
    }
    
    public function myinvites() {

        $config=array();
        $config['base_url'] = base_url().'?mc=invite&m=myinvites';
        $config['total_rows'] = $this->Invites->invites_total($this->session->userdata('uid'));
        $config['per_page'] = 25; 
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        
        
        $this->pagination->initialize($config); 
        $get_page =$this->input->get('per_page');
        
        $page = (! empty($get_page)) ? $get_page : 0;
        
        $data['list'] = $this->Invites->fetch_invites($config['per_page'],$page,$this->session->userdata('uid'));
        $data['pagination'] = $this->pagination->create_links();
        $data['uname'] = $this->session->userdata('uname');
        
       
        $this->load->view('registrar/myinvites_view',$data);
    }
    
    public function rm() {
        $id = $this->input->post('did');
        
        $query = $this->db->get_where('tbl_invitations', array('inv_user'=>$id));
        $num_res = $query->num_rows();
        
        if($num_res > 0) {
            $result = $query->result();
            if($result[0]->usr_id === $this->session->userdata('uid')) {
                //Start
                $query = $this->db->get_where('tbl_users', array('usr_id'=>$id));
                $num_res = $query->num_rows();

                if($num_res > 0) {
                    $result = $query->result();            
                    if($result[0]->usr_user_type === 'registrar' || $result[0]->usr_user_type === 'teacher') { 

                        $this->db->where('inf_id', $id);
                        $this->db->delete('tbl_teacher_info'); 

                    } 

                } else {

                    $this->db->where('inv_id', $id);
                    $stat_inv = $this->db->delete('tbl_invitations'); 

                    if($stat_inv > 0) 
                        $array = array('status'=>1,'msg'=>'Invitation removed.');
                        exit(json_encode($array));

                }

                $this->db->where('inv_id', $id);
                $stat_inv = $this->db->delete('tbl_invitations'); 

                $this->db->where('usr_id', $id);
                $stat_usr = $this->db->delete('tbl_users'); 

                if($stat_usr > 0 && $stat_inv > 0) {
                   $array = array('status'=>1,'msg'=>'Invitation removed.');
                   echo json_encode($array);
                } else {
                   $array = array('status'=>0,'msg'=>'Failed to remove the invitation.');
                   echo json_encode($array);
                }
                
                //End
            } else {
                $array = array('status'=>1,'msg'=>'You are not allowed to remove the user.');
                exit(json_encode($array));
            }   
        } else {
            $array = array('status'=>1,'msg'=>'Unable to find the user.');
            exit(json_encode($array));
        }
    }
    
    public function resend() {
        
        $id = $this->input->post('did'); 
        
        $query = $this->db->get_where('tbl_users', array('usr_id' => $id,'usr_status'=>'unverified'));
        $result = $query->result();
        $num_res = count($result);
        
        if($num_res > 0) {
           
            $email = $result[0]->usr_email;
            $token = uniqid();
            $now = mdate('%Y-%m-%d %h:%i:%s', time()); 
            $db_data = array(
                                'usr_token'=>$token,
                                'usr_reg_date'=> $now
            );
            $this->db->where('usr_id', $result[0]->usr_id);
            $this->db->update('tbl_users',$db_data);
            $aff_row = $this->db->affected_rows();
            
            if($aff_row > 0) {
                
                $actv= base_url() .'?mc=confirm_invitations&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                $deact = base_url() .'?mc=confirm_invitations&m=deactivate&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('no-reply@saas.ph', 'SaaS Administrator');
                $this->email->to($email); 

                $this->email->subject('Invitation');
                $this->email->message('
                <p>Hello,</p>

                <p>Click this <a href="'.$actv.'">link</a> to activate your account or refer to the links provided below.</p>

                <p>If you are not a teacher of any Basic Education Public Schools in the Philippines, you are not allowed to have this account.
                You should <a href="'.$deact.'">deactivate</a> this account now.  Unauthorized access to the system is a crime punishable by law.</p>

                <p>Open the url below to activate your account: <br /> <br />     
                Activation Link:  '.$actv.'</p> <br />
                Deactivation Link: '.$deact.'

                <p>Regards, <br /> SaaS Administrator </p>

                ');	

                if($this->email->send()) {

                    $array = array('status'=>1, 'msg'=>'An invitation link was sent to '.$email);
                    echo json_encode($array);

                } else {

                    $data = array('status'=>0, 'msg'=>'Failed to send the confirmation link.  Please file a report on this error');
                    echo json_encode($data);

                }
            } else {
                 $data = array('status'=>0, 'msg'=>'Failed to update and re-send the confirmation link.  Please file a report on this error');
                 echo json_encode($data);
            }
        } else {
             $data = array('status'=>0, 'msg'=>'Failed to update and re-send the confirmation link.  Please file a report on this error');
             echo json_encode($data);
        }
    }
    
    public function report() {
        
        $id = $this->input->post('id');
        $details = $this->input->post('detail');
        
        if(! empty($id) && ! empty($details)) {
             $data = array('status'=>1, 'msg'=>'Report sent to SaaS administrator.');
             echo json_encode($data);
        } else {
             $data = array('status'=>0, 'msg'=>'A more detailed report is needed.');
             echo json_encode($data);
        }
    }
}