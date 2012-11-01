<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Account extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('General_queries'); 
        $this->load->library('encrypt');
        $this->General_queries->protect_acct();  
    }
    
    private function _prep_password($date,$password) {
        return hash('sha512', md5($date.$password));
    }

    public function index() {
        $this->General_queries->is_teacher_registrar();  
        $udata = $this->General_queries->teacher_data($this->session->userdata('uid'));
        
        if(empty($udata[0]->inf_surname) || empty($udata[0]->inf_firstname)) {
            
            $this->session->set_userdata('email', $udata[0]->usr_email);
            $data['uname'] = $udata[0]->usr_email;
            
        }  else {
            //print_r($udata);
            $array = array('surname'=>$udata[0]->inf_surname, 'firstname'=>$udata[0]->inf_firstname);
            $this->session->set_userdata($array);
            $data['uname'] = $udata[0]->inf_surname . ', ' . $udata[0]->inf_firstname;
        }
        
        $this->session->set_userdata('uname',$data['uname']);
        
        $this->db->where('inf_id', $this->session->userdata('uid'));
        $profile = $this->db->get('tbl_teacher_info');
        $data['profile'] = $profile->result();
        
    $this->load->view('registrar/personal_settings_view', $data);
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
            
            $this->db->select('inf_photo');
            $sql = $this->db->get_where('tbl_teacher_info',array('inf_id'=>$this->session->userdata('uid')));
            $result = $sql->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                if(file_exists($path.$result[0]->inf_photo) && file_exists($path.str_replace('_thumb', '', $result[0]->inf_photo))):
                    unlink($path.$result[0]->inf_photo);
                    unlink($path.str_replace('_thumb', '', $result[0]->inf_photo));
                endif;
            }
            
            $data = array('inf_photo'=> $filename.'_thumb.'.$ext);
            $this->db->where('inf_id', $this->session->userdata('uid'));
            $stat_prof = $this->db->update('tbl_teacher_info', $data); 
            
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
    
    public function personal() {
        $this->General_queries->is_teacher_registrar();  
        $lastname = $this->input->post('lastname');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $extension = $this->input->post('extension');
        $birthdate = $this->input->post('birthdate');
        $pob = $this->input->post('pob');
        $sex = $this->input->post('sex');
        $civilstatus = $this->input->post('civilstatus');
        $citizenship = $this->input->post('citizenship');
        $weight = $this->input->post('weight');
        $height = $this->input->post('height');
        $bloodtype = $this->input->post('bloodtype');
        $gsis = $this->input->post('gsis');
        $pagibig = $this->input->post('pagibig');
        $philhealth = $this->input->post('philhealth');
        $sss=$this->input->post('sss');
        $residential = $this->input->post('residential');
        $zipresidential = $this->input->post('zipresidential');
        $telephoneres = $this->input->post('telephoneres');
        $permanent = $this->input->post('permanent');
        $zippermanent = $this->input->post('zippermanent');
        $telephonepermanent = $this->input->post('telephonepermanent');
        $cellphone = $this->input->post('cellphone');
        $agency = $this->input->post('agency');
        $tin = $this->input->post('tin');
        $infoagree = $this->input->post('infoagree');
        
        if(isset($infoagree)) { 
            $data = array(
                'inf_surname'=>$lastname,
                'inf_firstname'=>$firstname,
                'inf_middlename'=>$middlename,
                'inf_name_ext'=>$extension,
                'inf_dob'=>$birthdate,
                'inf_pob'=>$pob,
                'inf_sex'=>$sex,
                'inf_civil_status'=>$civilstatus,
                'inf_citizenship'=>$citizenship,
                'inf_height'=>$height,
                'inf_weight'=>$weight,
                'inf_blood_type'=> $bloodtype,
                'inf_gsis_id'=> $gsis,
                'inf_pagibig'=> $pagibig,
                'inf_philhealth'=> $philhealth,
                'inf_sss'=> $sss,
                'inf_res_address'=> $residential,
                'inf_res_zip_code'=> $zipresidential,
                'inf_telno'=> $telephoneres,
                'inf_perm_address'=> $permanent,
                'inf_perm_zip_code'=> $zippermanent,
                'inf_contact_num'=> $telephonepermanent,
                'inf_mobile_number'=>$cellphone,
                'inf_agency_emp_no'=> $agency,
                'inf_tin'=>$tin
            );
            
            $this->db->where('inf_id', $this->session->userdata('uid'));
            $inf_update = $this->db->update('tbl_teacher_info', $data); 
            
            if($inf_update > 0) {
                $data = array('title'=> $infoagree, 'message'=> 'Personal information updated.');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> 'Failed to save personal information.');
                echo json_encode($data);
            }
            
        } else {
            $data = array('title'=> 'Error', 'message'=> 'Agreement not checked.');
            echo json_encode($data);
        }
    }
    
    /*personal ends here*/
    public function family_background() {
        $this->General_queries->is_teacher_registrar();  
        $this->db->where('inf_id', $this->session->userdata('uid'));
        $query = $this->db->get('tbl_teacher_info');
        $data['inf'] = $query->result();
        
        $this->db->where('tch_inf_id', $this->session->userdata('uid'));
        $this->db->order_by("chl_dob", "asc");
        $q_children = $this->db->get('tbl_tch_children');
        $data['children'] = $q_children->result();        
        $data['uname'] = $this->session->userdata('uname');
        
    $this->load->view('registrar/family_settings_view', $data);
    }
    
    public function ufbg() {
        $this->General_queries->is_teacher_registrar();  
        $spousesurname = $this->input->post('spousesurname');
        $spousefirstname = $this->input->post('spousefirstname');
        $spousemiddlename = $this->input->post('spousemiddlename');
        $spouseoccupation = $this->input->post('spouseoccupation');
        $spouseemployer = $this->input->post('spouseemployer');
        $spouseemployeraddress = $this->input->post('spouseemployeraddress');
        $spouseemployertelno = $this->input->post('spouseemployertelno');
        $fathersurname = $this->input->post('fathersurname');
        $fatherfirstname = $this->input->post('fatherfirstname');
        $fathermiddlename = $this->input->post('fathermiddlename');
        $fatherextension = $this->input->post('fatherextension');
        $mothersurname = $this->input->post('mothersurname');
        $motherfirstname = $this->input->post('motherfirstname');
        $mothermiddlename = $this->input->post('mothermiddlename');
        $children = $this->input->post('children');
        $num_children = count($children);
       
        
        $data = array(
                        'inf_spouse_surname'=>$spousesurname,
                        'inf_spouse_fname'=>$spousefirstname,
                        'inf_spouse_middlename'=>$spousemiddlename,
                        'inf_spouse_occupation'=>$spouseoccupation,
                        'inf_spouse_employer_name'=>$spouseemployer,
                        'inf_spouse_business_add'=>$spouseemployeraddress,
                        'inf_spouse_buss_telno'=>$spouseemployertelno,
                        'inf_father_lname'=>$fathersurname,
                        'inf_father_fname'=>$fatherfirstname,
                        'inf_father_mname'=>$fathermiddlename,
                        'inf_father_name_ext'=>$fatherextension,
                        'inf_mother_lname'=>$mothersurname,
                        'inf_mother_fname'=>$motherfirstname,
                        'inf_mother_mname'=>$mothermiddlename
                );

        $this->db->where('inf_id', $this->session->userdata('uid'));
        $affected_rows = $this->db->update('tbl_teacher_info', $data); 
        
        if($num_children > 0) {
            
            if($affected_rows > 0) {     
                $info_stats = TRUE;
            } else {
                $info_stats = FALSE;
            }

            $del_cur_record = $this->db->delete('tbl_tch_children', array('tch_inf_id' => $this->session->userdata('uid'))); 

            if($del_cur_record > 0) {

                $insert_counter = 0;
                $num_children = count($children);
                for($x=0; $x<$num_children; $x++) {
                    
                        if(!empty($children[$x][0]) && !empty($children[$x][1])) {
                            $data = array(
                                                'tch_inf_id' => $this->session->userdata('uid'),
                                                'chl_fullname' => $children[$x][0] ,
                                                'chl_dob' => $children[$x][1]
                                    );

                            $children_info_stats = $this->db->insert('tbl_tch_children', $data);

                            if(($children_info_stats > 0 && $info_stats == TRUE)) {
                                $insert_counter++;
                            }

                        }
                        
                        if((empty($children[$x][0]) && empty($children[$x][1]))) { $insert_counter++; }
                        
                } //end of forloop
 
                if($insert_counter == $num_children) {
                    $data = array('title'=> 'Success', 'message'=> 'Family information saved!');
                    echo json_encode($data);
                } else {
                    $data = array('title'=> 'Failed', 'message'=> 'Failed to save family information child info '.$num_children);
                    echo json_encode($data);
                }
            } else {
                $data = array('title'=> 'Failed', 'message'=> 'Failed to save child information!');
                echo json_encode($data);
            }
            
        }else {
            if($affected_rows > 0) {
                $data = array('title'=> 'Success', 'message'=> 'Family information saved!');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> 'Failed to save family information!');
                echo json_encode($data);
            }
        }
        
            /* LOG INFORMATION */
           $this->General_queries->log_session('', $this->input->ip_address(), $this->input->user_agent(), 
                                                'Session updated user information');
    }
    
    public function educational_background() {

        /* fetching data */
        $this->General_queries->is_teacher_registrar();  
        /*elementary info */
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("elem_graduated", "asc");
        $q_elementary = $this->db->get('tbl_tch_elementary');
        $data['elementary'] = $q_elementary->result();
        
        /*secondary info */
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("sec_graduated", "asc");
        $q_secondary = $this->db->get('tbl_tch_secondary');
        $data['secondary'] = $q_secondary->result();
        
        /*vocational info */
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("voc_graduated", "asc");
        $q_vocational = $this->db->get('tbl_tch_vocational');
        $data['vocational'] = $q_vocational->result();
        
        /*college info*/
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("col_graduated", "asc");
        $q_college = $this->db->get('tbl_tch_college');
        $data['college'] = $q_college->result();
        
        /*graduate studies info*/
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("grad_graduated", "asc");
        $q_graduate = $this->db->get('tbl_tch_graduate');
        $data['graduate'] = $q_graduate->result();
        
        
        
        if($this->session->userdata('stat') == TRUE) {
            $data['stat'] = TRUE;
            $data['stat_msg'] = $this->session->userdata('stat_msg');
            $data['stat_title'] = $this->session->userdata('stat_title');
        } else {
            $data['stat'] = false;
        }
        
        $array_items = array(
            'stat'=>'',
            'stat_msg'=>'',
            'stat_title'=>''
        );
        
        $this->session->unset_userdata($array_items);
        
        $data['uname'] = $this->session->userdata('uname');
    $this->load->view('registrar/educational_settings_view', $data);
    }
    
    public function ueduc_elem() {
        $this->General_queries->is_teacher_registrar();  
        $elementary = $this->input->post('elementary');
        $not_saved = 0;
        $saved = 0;
        $num_data = count($elementary);
        
        $del_cur_record = $this->db->delete('tbl_tch_elementary', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
        
            for($i=0; $i<$num_data; $i++) {
                if(!empty($elementary[$i][0]) && !empty($elementary[$i][1]) && !empty($elementary[$i][2]) && !empty($elementary[$i][3])) {

                    $data = array(
                        'tch_id' => $this->session->userdata('uid'),
                        'elem_name'=> $elementary[$i][0],
                        'elem_from'=>$elementary[$i][1],
                        'elem_to'=>$elementary[$i][2],
                        'elem_graduated'=>$elementary[$i][3],
                        'elem_awards'=>$elementary[$i][4]
                    ); 
                    
                    $insert_stat = $this->db->insert('tbl_tch_elementary', $data);
                    
                    if($insert_stat > 0) {
                        $saved++;
                    } else {
                        $not_saved++;
                    }

                } else {
                    $not_saved++;
                }
            }
            
            if($saved == $num_data) {
                $data = array('title'=> 'Success', 'message'=> 'Elementary information saved');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> $num_data . ' elementary information was not saved');
                echo json_encode($data);
            }
     
        } else {
            $data = array('title'=> 'Failed', 'message'=> 'All of your elementary information was not saved');
            echo json_encode($data);
        }
    }
    
    public function ueduc_elem_rm() {
        $this->General_queries->is_teacher_registrar();  
        $skul_info_id = $this->input->post('curID');
        $del_cur_record = $this->db->delete('tbl_tch_elementary', array('elem_id'=> $skul_info_id, 'tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
             $data = array('title'=> 'Success', 'message'=> 'Information was successfully removed.', 'status'=>1);
             echo json_encode($data);
        } else {
             $data = array('title'=> 'Error', 'message'=> 'Elementary information was not not removed from your record', 'status'=>0);
             echo json_encode($data);
        }
    }
    /* elemntary ends here */
    
    /* secondary starts here */
    public function ueduc_sec() {
        $this->General_queries->is_teacher_registrar();  
        $secondary = $this->input->post('secondary');
        $not_saved = 0;
        $saved = 0;
        $num_data = count($secondary);
        
        $del_cur_record = $this->db->delete('tbl_tch_secondary', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
        
            for($i=0; $i<$num_data; $i++) {
                
                if(!empty($secondary[$i][0]) && !empty($secondary[$i][1]) && !empty($secondary[$i][2]) && !empty($secondary[$i][3])) {

                    $data = array(
                        'tch_id' => $this->session->userdata('uid'),
                        'sec_name'=> $secondary[$i][0],
                        'sec_from'=>$secondary[$i][1],
                        'sec_to'=>$secondary[$i][2],
                        'sec_graduated'=>$secondary[$i][3],
                        'sec_awards'=>$secondary[$i][4]
                    ); 
                    
                    $insert_stat = $this->db->insert('tbl_tch_secondary', $data);
                    
                    if($insert_stat > 0) {
                        $saved++;
                    } else {
                        $not_saved++;
                    }

                } else {
                    $not_saved++;
                }
            }
            
            if($saved == $num_data) {
                $data = array('title'=> 'Success', 'message'=> 'Secondary information saved');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> $num_data . ' secondary information was not saved');
                echo json_encode($data);
            }
     
        } else {
            $data = array('title'=> 'Failed', 'message'=> 'All of your secondary information was not saved');
            echo json_encode($data);
        }
    }
    
    public function ueduc_sec_rm() {
        $this->General_queries->is_teacher_registrar();  
        $skul_info_id = $this->input->post('curID');
        $del_cur_record = $this->db->delete('tbl_tch_secondary', array('sec_id'=> $skul_info_id, 'tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
             $data = array('title'=> 'Success', 'message'=> 'Information was successfully removed.', 'status'=>1);
             echo json_encode($data);
        } else {
             $data = array('title'=> 'Error', 'message'=> 'Secondary information was not not removed from your record', 'status'=>0);
             echo json_encode($data);
        }
    }
    
    
    /* vocational starts here */
    public function ueduc_voc() {
        $this->General_queries->is_teacher_registrar();  
        $vocational = $this->input->post('vocational');
        $not_saved = 0;
        $saved = 0;
        $num_data = count($vocational);
        
        $del_cur_record = $this->db->delete('tbl_tch_vocational', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
        
            for($i=0; $i<$num_data; $i++) {
                
                if(!empty($vocational[$i][0]) && !empty($vocational[$i][1]) && !empty($vocational[$i][2]) && !empty($vocational[$i][3])) {

                    $data = array(
                        'tch_id' => $this->session->userdata('uid'),
                        'voc_name'=> $vocational[$i][0],
                        'voc_course'=> $vocational[$i][1],
                        'voc_from'=>$vocational[$i][2],
                        'voc_to'=>$vocational[$i][3],
                        'voc_graduated'=>$vocational[$i][4],
                        'voc_highest_grade'=>$vocational[$i][5],
                        'voc_awards'=>$vocational[$i][6]
                    ); 
                    
                    $insert_stat = $this->db->insert('tbl_tch_vocational', $data);
                    
                    if($insert_stat > 0) {
                        $saved++;
                    } else {
                        $not_saved++;
                    }

                } else {
                    $not_saved++;
                }
            }
            
            if($saved == $num_data) {
                $data = array('title'=> 'Success', 'message'=> 'Vocational information saved');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> $num_data . ' vocational information was not saved');
                echo json_encode($data);
            }
     
        } else {
            $data = array('title'=> 'Failed', 'message'=> 'All of your vocational information was not saved');
            echo json_encode($data);
        }
    }
    
    public function ueduc_voc_rm() {
        $this->General_queries->is_teacher_registrar();  
        $skul_info_id = $this->input->post('curID');
        $del_cur_record = $this->db->delete('tbl_tch_vocational', array('voc_id'=> $skul_info_id, 'tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
             $data = array('title'=> 'Success', 'message'=> 'Information was successfully removed.', 'status'=>1);
             echo json_encode($data);
        } else {
             $data = array('title'=> 'Error', 'message'=> 'Vocational information was not not removed from your record', 'status'=>0);
             echo json_encode($data);
        }
    }
    
    
    /* college */
    public function ueduc_col() {
        $this->General_queries->is_teacher_registrar();  
        $college = $this->input->post('college');
        $not_saved = 0;
        $saved = 0;
        $num_data = count($college);
        
        $del_cur_record = $this->db->delete('tbl_tch_college', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
        
            for($i=0; $i<$num_data; $i++) {
                
                if(!empty($college[$i][0]) && !empty($college[$i][1]) && !empty($college[$i][2]) && !empty($college[$i][3])) {

                    $data = array(
                        'tch_id' => $this->session->userdata('uid'),
                        'col_name'=> $college[$i][0],
                        'col_course'=> $college[$i][1],
                        'col_from'=>$college[$i][2],
                        'col_to'=>$college[$i][3],
                        'col_graduated'=>$college[$i][4],
                        'col_units'=>$college[$i][5],
                        'col_awards'=>$college[$i][6]
                    ); 
                    
                    $insert_stat = $this->db->insert('tbl_tch_college', $data);
                    
                    if($insert_stat > 0) {
                        $saved++;
                    } else {
                        $not_saved++;
                    }

                } else {
                    $not_saved++;
                }
            }
            
            if($saved == $num_data) {
                $data = array('title'=> 'Success', 'message'=> 'College information saved');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> $num_data . ' college information was not saved');
                echo json_encode($data);
            }
     
        } else {
            $data = array('title'=> 'Failed', 'message'=> 'All of your college information was not saved');
            echo json_encode($data);
        }
    }
    
    public function ueduc_col_rm() {
        $this->General_queries->is_teacher_registrar();  
        $skul_info_id = $this->input->post('curID');
        $del_cur_record = $this->db->delete('tbl_tch_college', array('col_id'=> $skul_info_id, 'tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
             $data = array('title'=> 'Success', 'message'=> 'Information was successfully removed.', 'status'=>1);
             echo json_encode($data);
        } else {
             $data = array('title'=> 'Error', 'message'=> 'College information was not not removed from your record', 'status'=>0);
             echo json_encode($data);
        }
    }
    
    /* graduate studies */
    public function ueduc_grad() {
        $this->General_queries->is_teacher_registrar();        
        $graduate = $this->input->post('graduate');
        $not_saved = 0;
        $saved = 0;
        $num_data = count($graduate);
        
        $del_cur_record = $this->db->delete('tbl_tch_graduate', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
        
            for($i=0; $i<$num_data; $i++) {
                
                if(!empty($graduate[$i][0]) && !empty($graduate[$i][1]) && !empty($graduate[$i][2]) && !empty($graduate[$i][3])) {

                    $data = array(
                        'tch_id' => $this->session->userdata('uid'),
                        'grad_name'=> $graduate[$i][0],
                        'grad_course'=> $graduate[$i][1],
                        'grad_from'=>$graduate[$i][2],
                        'grad_to'=>$graduate[$i][3],
                        'grad_graduated'=>$graduate[$i][4],
                        'grad_units'=>$graduate[$i][5],
                        'grad_awards'=>$graduate[$i][6]
                    ); 
                    
                    $insert_stat = $this->db->insert('tbl_tch_graduate', $data);
                    
                    if($insert_stat > 0) {
                        $saved++;
                    } else {
                        $not_saved++;
                    }

                } else {
                    $not_saved++;
                }
            }
            
            if($saved == $num_data) {
                $data = array('title'=> 'Success', 'message'=> 'Graduate information saved');
                echo json_encode($data);
            } else {
                $data = array('title'=> 'Failed', 'message'=> $num_data . ' graduate studies information was not saved');
                echo json_encode($data);
            }
     
        } else {
            $data = array('title'=> 'Failed', 'message'=> 'All of your graduate information was not saved');
            echo json_encode($data);
        }
    }
    
    public function ueduc_gra_rm() {
        $this->General_queries->is_teacher_registrar();  
        $skul_info_id = $this->input->post('curID');
        $del_cur_record = $this->db->delete('tbl_tch_graduate', array('grad_id'=> $skul_info_id, 'tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0) {
             $data = array('title'=> 'Success', 'message'=> 'Information was successfully removed.', 'status'=>1);
             echo json_encode($data);
        } else {
             $data = array('title'=> 'Error', 'message'=> 'Graduate Studies information was not not removed from your record', 'status'=>0);
             echo json_encode($data);
        }
    }
    
    
    public function civil_srv_elegibility() {
        $this->General_queries->is_teacher_registrar();  
        /*civil service info*/
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("cvl_date_conferment", "asc");
        $q = $this->db->get('tbl_civil_srv');
        $data['civil_srv'] = $q->result();

        $data['uname'] = $this->session->userdata('uname');
        
    $this->load->view('registrar/civil_srv_elegibility_view', $data);
    }
    
    /*civil service*/
    public function civil_srv_data() {
        $this->General_queries->is_teacher_registrar();  
        $cvl_data = $this->input->post('civilSrv');
        $num_srv = count($cvl_data);
        $counter = 0;
        
        $del_cur_record = $this->db->delete('tbl_civil_srv', array('tch_id' => $this->session->userdata('uid'))); 
        
        if($del_cur_record > 0 ) {
        
            for($i=0; $i<$num_srv; $i++) {

                $data = array(
                            'tch_id'=> $this->session->userdata('uid'),
                            'cvl_career_service'=>$cvl_data[$i][0],
                            'cvl_rating'=>$cvl_data[$i][1],
                            'cvl_date_conferment'=>$cvl_data[$i][2],
                            'cvl_place_conferment'=>$cvl_data[$i][3],
                            'cvl_number'=>$cvl_data[$i][4],
                            'cvl_date_release'=>$cvl_data[$i][5]
                );

                $stat = $this->db->insert('tbl_civil_srv', $data);

                if($stat > 0) { 
                    $counter++;
                }

            }

            if($counter == $num_srv) {
                $title = 'Success';
                $message = 'Civil service elegibility saved.';
            } else {
                $title = 'Failed';
                $message = ($num_srv-$counter) .'Civil service elegibility data was not saved.';
            }
        } else {
            $title = 'Error';
            $message = 'All civil service elegibility was not saved.';
        }
        
        $json = array('title'=> $title, 'message'=> $message);
        echo json_encode($json);
        
    }
    
     public function civil_srv_data_rm() {
         $this->General_queries->is_teacher_registrar();  
         $id = $this->input->post('boxid');
         
         $del_cur_record = $this->db->delete('tbl_civil_srv', array('tch_id' => $this->session->userdata('uid'), 'cvl_id'=>$id)); 
         
         if($del_cur_record > 0) {
             $json = array('title'=> 'Success', 'message'=> 'Information successfully removed');
             echo json_encode($json);
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'The information was not successfully removed');
            echo json_encode($json);
         }
     }
     
     /* work experience*/
     public function work_experience() {
         
        $this->General_queries->is_teacher_registrar();  
        /*civil service info*/
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("wrk_to", "desc");
        $q = $this->db->get('tbl_work_exp');
        $data['work'] = $q->result();
        
        $data['uname'] = $this->session->userdata('uname');
        
     $this->load->view('registrar/work_experience_view', $data);
     }
     
     public function work_data() {
         
         $arr_work = $this->input->post('workdata');
         $num_work = count($arr_work);
         $up_counter=0;
         $down_counter=0;
         
         $del_cur_record = $this->db->delete('tbl_work_exp', array('tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
         
            for($i=0; $i<$num_work; $i++) {

                $data = array(
                    'tch_id'=>$this->session->userdata('uid'),
                    'wrk_from'=>$arr_work[$i][0],
                    'wrk_to'=>$arr_work[$i][1],
                    'wrk_position'=>$arr_work[$i][2],
                    'wrk_department'=>$arr_work[$i][3],
                    'wrk_salary'=>$arr_work[$i][4],
                    'wrk_salary_grade'=>$arr_work[$i][5],
                    'wrk_stat_appoint'=>$arr_work[$i][6],
                    'wrk_gov_srv'=>$arr_work[$i][7]
                );

                $insert_stat = $this->db->insert('tbl_work_exp', $data);

                if($insert_stat>0) {
                    $up_counter++;
                } else {
                    $down_counter++;
                }
            }


            if($num_work == $up_counter) {
                $json = array('title'=> 'Success', 'message'=> 'Information successfully saved');
                echo json_encode($json);
            } else {
                $json = array('title'=> 'Failed', 'message'=> $down_counter .' Information was not saved');
                echo json_encode($json);   
            }
         
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'All information was not saved');
             echo json_encode($json);
         }
     }
     
     public function work_data_rm() {
         $this->General_queries->is_teacher_registrar();  
         $cur_id = $this->input->post('boxid');
  
         $del_cur_record = $this->db->delete('tbl_work_exp', array('wrk_id'=>$cur_id,'tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
             $json = array('title'=> 'Succcess', 'message'=> 'Information successfully removed');
             echo json_encode($json);
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'Information was not removed');
            echo json_encode($json);
         }
     }
     
     
     /* voluntary work here */
     public function voluntary_work() {
         $this->General_queries->is_teacher_registrar();  
        /*voluntary works*/
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("vol_to", "desc");
        $q = $this->db->get('tbl_work_volunteer');
        $data['voluntary'] = $q->result();
 
        $data['uname'] = $this->session->userdata('uname');
        
     $this->load->view('registrar/voluntary_work_view', $data);
     }
     
     public function voluntary_work_data() {
         $this->General_queries->is_teacher_registrar();  
         $arr_voluntary=$this->input->post('voluntarydata');
         
         $num_work = count($arr_voluntary);
         $up_counter=0;
         $down_counter=0;
         
         $del_cur_record = $this->db->delete('tbl_work_volunteer', array('tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
         
            for($i=0; $i<$num_work; $i++) {

                $data = array(
                    'tch_id'=>$this->session->userdata('uid'),
                    'vol_organization'=>$arr_voluntary[$i][0],
                    'vol_address'=>$arr_voluntary[$i][1],
                    'vol_from'=>$arr_voluntary[$i][2],
                    'vol_to'=>$arr_voluntary[$i][3],
                    'vol_hours'=>$arr_voluntary[$i][4],
                    'vol_position'=>$arr_voluntary[$i][5]
                );

                $insert_stat = $this->db->insert('tbl_work_volunteer', $data);

                if($insert_stat>0) {
                    $up_counter++;
                } else {
                    $down_counter++;
                }
            }


            if($num_work == $up_counter) {
                $json = array('title'=> 'Success', 'message'=> 'Information successfully saved');
                echo json_encode($json);
            } else {
                $json = array('title'=> 'Failed', 'message'=> $down_counter .' Information was not saved');
                echo json_encode($json);   
            }
         
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'All information was not saved');
             echo json_encode($json);
         }
     }
     
     public function vol_data_rm() {
         $this->General_queries->is_teacher_registrar();  
         $cur_id = $this->input->post('boxid');
         $del_cur_record = $this->db->delete('tbl_work_volunteer', array('vol_id'=>$cur_id,'tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
             $json = array('title'=> 'Succcess', 'message'=> 'Information successfully removed');
             echo json_encode($json);
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'Information was not removed');
            echo json_encode($json);
         }
     }
     
     public function training_programs() {
        $this->General_queries->is_teacher_registrar();  
        $this->db->where('tch_id', $this->session->userdata('uid'));
        $this->db->order_by("tra_to", "desc");
        $q = $this->db->get('tbl_seminars');
        $data['seminars'] = $q->result();
        
         $data['uname'] = $this->session->userdata('uname');
         
     $this->load->view('registrar/training_programs_view',$data);
     }
     
     public function training_data() {
         $this->General_queries->is_teacher_registrar();  
         $training_data = $this->input->post('seminarsdata');

         $num_work = count($training_data);
         $up_counter=0;
         $down_counter=0;
         
         $del_cur_record = $this->db->delete('tbl_seminars', array('tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
         
            for($i=0; $i<$num_work; $i++) {

                $data = array(
                    'tch_id'=>$this->session->userdata('uid'),
                    'tra_title'=>$training_data[$i][0],
                    'tra_from'=>$training_data[$i][1],
                    'tra_to'=>$training_data[$i][2],
                    'tra_hours'=>$training_data[$i][3],
                    'tra_sponsor'=>$training_data[$i][4]
                );

                $insert_stat = $this->db->insert('tbl_seminars', $data);

                if($insert_stat>0) {
                    $up_counter++;
                } else {
                    $down_counter++;
                }
            }


            if($num_work == $up_counter) {
                $json = array('title'=> 'Success', 'message'=> 'Information successfully saved');
                echo json_encode($json);
            } else {
                $json = array('title'=> 'Failed', 'message'=> $down_counter .' Information was not saved');
                echo json_encode($json);   
            }
         
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'All information was not saved');
             echo json_encode($json);
         }
     }
     
     
     public function seminar_rm() {
         $this->General_queries->is_teacher_registrar();  
         $cur_id = $this->input->post('boxid');
         $del_cur_record = $this->db->delete('tbl_seminars', array('tra_id'=>$cur_id,'tch_id' => $this->session->userdata('uid'))); 
         
         if($del_cur_record > 0) {
             $json = array('title'=> 'Succcess', 'message'=> 'Information successfully removed');
             echo json_encode($json);
         } else {
             $json = array('title'=> 'Failed', 'message'=> 'Information was not removed');
            echo json_encode($json);
         }
     }
     
     public function other_info() {
        $this->General_queries->is_teacher_registrar();  
        $this->db->select('inf_skills, inf_recognition, inf_association,inf_q1,inf_q2,inf_q3,inf_q4,inf_q5,,inf_q6,inf_q7,inf_q8,inf_q9,inf_q10,inf_q11,inf_cedula,inf_cedula_place,inf_cedula_date,inf_ref_name1,inf_ref_address1,inf_ref_contact1,inf_ref_name2,inf_ref_address2,inf_ref_contact2,inf_ref_name3,inf_ref_address3,inf_ref_contact3');
        $this->db->where('inf_id', $this->session->userdata('uid'));
        $q = $this->db->get('tbl_teacher_info');
        $data['teacher_info'] = $q->result();
         
        $data['uname'] = $this->session->userdata('uname');
         
     $this->load->view('registrar/other_info_view',$data);
     }
     
     public function other_info_skills() {
         $this->General_queries->is_teacher_registrar();  
         $skills = trim($this->input->post('skills'));
         
         if(! empty($skills)) {
         
            $array = array(
                'inf_skills'=>ucwords($skills)
            );
            
            $this->db->where('inf_id', $this->session->userdata('uid'));
            $stat = $this->db->update('tbl_teacher_info', $array); 
            
            if($stat > 0) {
                $json = array('title'=> 'Success', 'message'=> 'Skills information saved.');
                echo json_encode($json);
            } else {
                $json = array('title'=> 'Failed', 'message'=> 'Skills information was not saved');
                echo json_encode($json);
            }
            
         } else {
                $json = array('title'=> 'Failed', 'message'=> 'Skills field empty');
                echo json_encode($json);
         }
         
     }
     
     
     public function other_info_data() {
         $this->General_queries->is_teacher_registrar();  
         $skills = $this->input->post('skills_str');
         $recognition = $this->input->post('recognition_str');
         $association = $this->input->post('association_str');
         $q1 = $this->input->post('q1_str');
         $q2 = $this->input->post('q2_str');
         $q3 = $this->input->post('q3_str');
         $q4 = $this->input->post('q4_str');
         $q5 = $this->input->post('q5_str');
         $q6 = $this->input->post('q6_str');
         $q7 = $this->input->post('q7_str');
         $q8 = $this->input->post('q8_str');
         $q9 = $this->input->post('q9_str');
         $q10 = $this->input->post('q10_str');
         $q11 = $this->input->post('q11_str');
         $name1 = $this->input->post('name1_str');
         $name2 = $this->input->post('name2_str');
         $name3 = $this->input->post('name3_str');
         $address1 = $this->input->post('address1_str');
         $address2 = $this->input->post('address2_str');
         $address3 = $this->input->post('address3_str');
         $contact1 = $this->input->post('contact1_str');
         $contact2 = $this->input->post('contact2_str');
         $contact3 = $this->input->post('contact3_str');
         $cedula = $this->input->post('cedula_str');
         $cedula_address = $this->input->post('cedula_address');
         $cedula_issue_date = $this->input->post('cedula_date');
         $msg = '';

         if(! is_numeric($contact1) && ! empty($contact1)) {
             $msg .= 'Failed to save the contact number of '. $name1 . "\n";
         }
         
         if(! is_numeric($contact2) && ! empty($contact2)) {
             $msg .= 'Failed to save the contact number of '. $name2. "\n";
         }
         
         if(! is_numeric($contact3) && ! empty($contact3)) {
             $msg .= 'Failed to save the contact number of '. $name3. "\n";
         }
         
         if(! empty($q1) && ! empty($q2) && ! empty($q3) && ! empty($q4) && ! empty($q5) && ! empty($q6) && ! empty($q7) /*&& ! empty($q8)*/ && ! empty($q9) && ! empty($q10) && ! empty($q11)) {
             
             $array = array(
                 'inf_skills'=>$skills,
                 'inf_recognition'=>$recognition,
                 'inf_association'=>$association,
                 'inf_q1'=> $q1,
                 'inf_q2'=> $q2,
                 'inf_q3'=> $q3,
                 'inf_q4'=> $q4,
                 'inf_q5'=> $q5,
                 'inf_q6'=> $q6,
                 'inf_q7'=> $q7,
//                 'inf_q8'=> $q8,
                 'inf_q9'=> $q9,
                 'inf_q10'=> $q10,
                 'inf_q11'=> $q11,
                 'inf_cedula'=>$cedula,
                 'inf_cedula_place'=>$cedula_address,
                 'inf_cedula_date'=>$cedula_issue_date,
                 'inf_ref_name1'=>$name1,
                 'inf_ref_address1'=>$address1,
                 'inf_ref_contact1'=>$contact1,
                 'inf_ref_name2'=>$name2,
                 'inf_ref_address2'=>$address2,
                 'inf_ref_contact2'=>$contact2,
                 'inf_ref_name3'=>$name3,
                 'inf_ref_address3'=>$address3,
                 'inf_ref_contact3'=>$contact3
             );
             
             $this->db->where('inf_id', $this->session->userdata('uid'));
             $stat = $this->db->update('tbl_teacher_info', $array); 
             
             if($stat > 0) {
                 $json = array('title'=> 'Success', 'message'=> $msg . ' Information successfully saved');
                 echo json_encode($json);
                 //echo ;
             } else {
                 $json = array('title'=> 'Failed', 'message'=> $msg . ' Information not saved');
                 echo json_encode($json);
             }
             
         } else {
             $json = array('title'=> 'Error', 'message'=> 'Some information are not found');
                 echo json_encode($json);
         }        
     }
     
     public function login() {
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/login_info_view',$data);
     }
     
     public function login_data() {
         
         $old_password = $this->input->post('oldpass');
         $new_password = $this->input->post('newpass');
         
         $this->db->select('usr_password,usr_reg_date');
         $query = $this->db->get_where('tbl_users', array('usr_id' => $this->session->userdata('uid')),1);
         
         $info = $query->result();
         
         
         if($info[0]->usr_password == $this->_prep_password($info[0]->usr_reg_date, $old_password)) {
            
            $array = array(
               'usr_password' => $this->_prep_password($info[0]->usr_reg_date,$new_password)
            );
            
            $this->db->where('usr_id', $this->session->userdata('uid'));
            $stat = $this->db->update('tbl_users', $array); 
            
            if($stat > 0) {
                $this->General_queries->log_session($this->session->userdata('uid'), $this->input->ip_address(), $this->input->user_agent(),'Password successfully changed');
                $json = array('title'=> 'Success', 'message'=> 'New password saved');
                    echo json_encode($json);
            } else {
                $json = array('title'=> 'Error', 'message'=> 'Password change failed');
                 echo json_encode($json);
            }
            
         } else {
             $this->General_queries->log_session($this->session->userdata('uid'), $this->input->ip_address(), $this->input->user_agent(),'Password change attempt');
             $json = array('title'=> 'Error', 'message'=>'Wrong information');
             echo json_encode($json);

         }
     }
 
}