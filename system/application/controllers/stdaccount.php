<?php
Class Stdaccount extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->General_queries->protect_acct();
    }
    
    public function index() {
        $data['student_info'] = $this->General_queries->student_data($this->session->userdata('uid'));
        $data['uname']=$this->session->userdata('uname');
        $this->load->view('student/stdaccount_view', $data);
    }
    
    /* File Upload */    
    private function __get_size() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }
    
    private function __save($file_n_path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->__get_size()){            
            return false;
        }
        
      
        $target = fopen($file_n_path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    
    public function upload() {
        $path = $this->config->item('upload_dir');
        $the_file = $this->input->get('qqfile');
        
        $the_file = explode('.', $the_file);
        $the_file = array_filter($the_file, 'strlen');
        $total = count($the_file);
        $ext = $the_file[$total-1];
        
        $the_file[0] = $filename = sha1($the_file[0].uniqid());
        $the_file = $the_file[0].'.'.$ext;
        
 
        
        if($this->__save($path.$the_file)) {
            $config['image_library']    = 'gd2';
            $config['source_image']	= $path.$the_file;
            $config['create_thumb']     = TRUE;
            $config['width']            = 125;
            $config['height']           = 125;
            
            $this->load->library('image_lib', $config); 
            $this->image_lib->resize();
            
            $this->db->select('std_photo');
            $sql = $this->db->get_where('tbl_student_info',array('std_id'=>$this->session->userdata('uid')));
            $result = $sql->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                if(file_exists($path.$result[0]->std_photo) && file_exists($path.str_replace('_thumb', '', $result[0]->std_photo))):
                    unlink($path.$result[0]->std_photo);
                    unlink($path.str_replace('_thumb', '', $result[0]->std_photo));
                endif;
            }
            
            $data = array('std_photo'=> $filename.'_thumb.'.$ext);
            $this->db->where('std_id', $this->session->userdata('uid'));
            $stat_prof = $this->db->update('tbl_student_info', $data); 
            
            if($stat_prof > 0) {
                $json=array('status'=>'Success', 'issue'=> 'Photo updated', 
                        'filename'=> base_url().'uploads/'.$filename.'_thumb.'.$ext);	
                
            } else {
                $json=array('status'=>'Error', 'issue'=> 'Profile was not updated.', 'filename'=> '');	
            }
        } else {
            $json=array('status'=>'Error', 'issue'=> $this->upload->display_errors('',''));
        }
        echo json_encode($json);
    }
    
    public function saveinfo() {
        
        $religion = $this->input->post('religion');
        $lastname = $this->input->post('lastname');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $namext = $this->input->post('namext');
        $sex = $this->input->post('sex');
        $address = $this->input->post('address');
        $birthdate = $this->input->post('birthdate');
        $contactnumber = $this->input->post('contactnumber');
        $emailaddress = $this->input->post('emailaddress');
        
        if(!empty($religion) && ! empty($lastname) && ! empty($firstname) && ! empty($middlename) && ! empty($sex) && ! empty($address) && ! empty($birthdate) && ! empty($contactnumber)) {
            
            $array = array(
                            'std_lastname'=>$lastname,
                            'std_firstname'=>$firstname,
                            'std_middlename'=>$middlename,
                            'std_extname'=>$namext,
                            'std_sex'=>$sex,
                            'std_address'=>$address,
                            'std_dob'=>$birthdate,
                            'std_contact'=>$contactnumber,
                            'std_email'=>$emailaddress,
                            'std_religion'=>$religion
            );
            $this->db->where('std_id',  $this->session->userdata('uid'));
            $this->db->update('tbl_student_info',$array);
            $aff_row = $this->db->affected_rows();
            
            if($aff_row > 0) {
                echo json_encode(array('status'=>1));
            } else {
                echo json_encode(array('status'=>0));
            }
            
        } else {
            echo json_encode(array('status'=>0));
        }
        
    }
    
    
    /* GUARDIAN */
    public function guardian() {
        
        $this->db->order_by('grd_id', 'desc');
        $sql = $this->db->get_where('tbl_gaurdian',array('std_id'=>$this->session->userdata('uid')));
        
        $data['guardians'] = $sql->result();
        $data['uname']=$this->session->userdata('uname');
        $this->load->view('student/guardian_view',$data);
    }
    
    private function _prep_password($date,$password) {
        return hash('sha512', md5($date.$password));
    }
    
    public function savestdguardian() {
        
        $lastname = $this->input->post('lastname');
        $firstname = $this->input->post('firstname');
        $mi = $this->input->post('mi');
        $namext = $this->input->post('namext');
        $sex = $this->input->post('sex');
        $address = $this->input->post('address');
        $contactnumber = $this->input->post('contactnumber');
        $emailaddress = $this->input->post('emailaddress');
        $relation = $this->input->post('relation');
        
        if(!empty($lastname) && !empty($firstname) && !empty($mi) && !empty($sex) && !empty($address) && !empty($contactnumber) && !empty($relation) && !empty($emailaddress)) {
            
            $sql = $this->db->get_where('tbl_gaurdian', array('std_id'=>$this->session->userdata('uid')));
            $num_gaurdian = $sql->num_rows();
            
            if($num_gaurdian > 0) {
                
                #update guardian information
                $array = array(
                            'grd_lastname'=>$lastname,
                            'grd_firstname'=>$firstname,
                            'grd_mid_init'=>$mi,
                            'grd_extname'=>$namext,
                            'grd_sex'=>$sex,
                            'grd_address'=>$address,
                            'grd_contact'=>$contactnumber,
                            'grd_email'=>$emailaddress,
                            'grd_relation'=>$relation
                );
                
                $this->db->where('std_id',$this->session->userdata('uid'));
                $this->db->update('tbl_gaurdian',$array);
                $aff_rows = $this->db->affected_rows();
                
                if($aff_rows > 0) {
                    echo json_encode(array('status'=>1));
                } else {
                    echo json_encode(array('status'=>0));
                }
            
            } else {
                
                #Check if the user has already an account used by another student
                $this->db->where('grd_email',$emailaddress);
                $query = $this->db->get('tbl_gaurdian');
                $num_res = $query->num_rows();
                
                if($num_res > 0) {
                    
                    #gaurdian has already an account used by another student
                    $gaurdian_info = $query->result();
                    $array = array(
                            'usr_id'=>$gaurdian_info[0]->usr_id,
                            'std_id'=>$this->session->userdata('uid'),
                            'grd_lastname'=>$lastname,
                            'grd_firstname'=>$firstname,
                            'grd_mid_init'=>$mi,
                            'grd_extname'=>$namext,
                            'grd_sex'=>$sex,
                            'grd_address'=>$address,
                            'grd_contact'=>$contactnumber,
                            'grd_email'=>$emailaddress,
                            'grd_relation'=>$relation
                    ); 
                    
                    $this->db->insert('tbl_gaurdian',$array);
                    $aff_rows = $this->db->affected_rows();
                    
                    if($aff_rows > 0) {
                        echo json_encode(array('status'=>1));
                    } else {
                        echo json_encode(array('status'=>0));
                    }
                    
                } else {
                    #New Guardian
                    $token =  random_string('unique');
                    $now = mdate('%Y-%m-%d %H:%i:%s', time());
                    $password = uniqid();
//                  
                    #Create account
                    $array = array(
                                    'usr_email'=>$emailaddress,
                                    'usr_password'=>$this->_prep_password($now, $password),
                                    'usr_user_type'=>'parent',
                                    'usr_token'=>$token,
                                    'usr_status'=>'unverified',
                                    'usr_reg_date'=>$now
                    );
                    
                    $this->db->insert('tbl_users',$array);
                    $curr_id= $this->db->insert_id();
                    $aff_rows = $this->db->affected_rows();
                    
                    if($aff_rows > 0) {
                        #add guardian information
                        $array = array(
                            'usr_id'=>$curr_id,
                            'std_id'=>$this->session->userdata('uid'),
                            'grd_lastname'=>$lastname,
                            'grd_firstname'=>$firstname,
                            'grd_mid_init'=>$mi,
                            'grd_extname'=>$namext,
                            'grd_sex'=>$sex,
                            'grd_address'=>$address,
                            'grd_contact'=>$contactnumber,
                            'grd_email'=>$emailaddress,
                            'grd_relation'=>$relation
                        ); 
                        $this->db->insert('tbl_gaurdian', $array);
                        $aff_rows = $this->db->affected_rows();
                        
                        if($aff_rows > 0) {
                            #mail
                            
                            $this->db->select('std_firstname,std_lastname');
                            $sql = $this->db->get_where('tbl_student_info',array('std_id'=>$this->session->userdata('uid')));
                            $result = $sql->result();
                            
                            $actv= base_url() .'?mc=confirm_invitations&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                            $deact = base_url() .'?mc=confirm_invitations&m=deactivate&al='.random_string('alnum', 32).'&k='.$token.'&q='.random_string('alnum', 12);
                            $config['mailtype'] = 'html';
                            $this->email->initialize($config);
                            $this->email->from('no-reply@saas.ph', 'SaaS Administrator');
                            $this->email->to($emailaddress); 

                            $this->email->subject('Invitation');
                            $this->email->message('
                            <p>Hello,</p>

                            <p>Click this <a href="'.$actv.'">link</a> to activate your account or refer to the links provided below.</p>

                            <p>If you are not the guardian of '.$result[0]->std_firstname.' '.$result[0]->std_lastname.', you are not allowed to have this account.  You should <a href="'.$deact.'">deactivate</a> this account now.  Unauthorized access to the system is a crime punishable by law.</p>

                            <p>Open the url below to activate your account: <br /> <br />     
                            Activation Link:  '.$actv.'<br />
                            Deactivation Link: '.$deact.'</p>

                            <p>Regards, <br /> SaaS Administrator </p>

                            ');
                            if($this->email->send()) {
                                echo json_encode(array('status'=>1,'msg'=>'An email was sent to your guardian, it needs to be confirmed to be used.'));
                            } else {
                                echo json_encode(array('status'=>0, 'msg'=>'Failed to send an email, but the account was created.  Your guardian can use the forgot password link to regenerate a new random password'));
                                /*TODO:  Add the link to forgot password*/
                            }
                            
                        } else {
                            #failed to update profile
                            echo json_encode(array('status'=>0));
                        }
                        
                    } else {
                        #failed to create an account
                        echo json_encode(array('status'=>0));
                    }
                    
                }
                
            }
        } else {
            echo json_encode(array('status'=>0,'msg'=>'You missed some important information'));
        }
    }
    
    public function pwd() {
        $data['uname']=$this->session->userdata('uname');
        $this->load->view('student/stdlogin_view', $data);
    }
}
?>
