<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Parent_main extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_parent();
    }
    
    public function index() {
        $cur_user = $this->session->userdata('uname');
        if(!isset($cur_user)) {
            $udata = $this->General_queries->guardian_data($this->session->userdata('uid'));
            $this->session->set_userdata('uname', $udata[0]->usr_email);
        }
        
        $data['uname'] = $this->session->userdata('uname');
        #Fetch students 
        $sql = $this->db->query('
                            SELECT * FROM tbl_gaurdian a, tbl_student_info b
                            WHERE
                            a.usr_id='.$this->session->userdata('uid').' AND a.std_id=b.std_id
        ');
        $data['students'] = $sql->result();
       
        $this->load->view('parent/main_view',$data);
    }
    
    private function __fetch_std_info($std_id,$is_sch=TRUE) {
        
        $this->db->select('*');
        $this->db->from('tbl_users');
        
        if($is_sch === TRUE):
            $this->db->where('tbl_student_info.std_sch_id',$std_id);
        else:
            $this->db->where('tbl_student_info.std_id',$std_id);
        endif; 
        $this->db->join('tbl_student_info', 'tbl_student_info.std_id=tbl_users.usr_id');
        $query =  $this->db->get();
        
        return $query->result();
    }
    
    
    public function student_info() {
        $id = $this->input->get('stdid');
        $sql = $this->db->query('
                                    SELECT * FROM tbl_gaurdian
                                    WHERE
                                    usr_id='.$this->session->userdata('uid').' AND std_id='.$id.'
        ');
        $num_res = $sql->num_rows();
        
        if($num_res > 0) {
            $sql_educ_history = $this->db->query("
                                                SELECT * FROM tbl_sy a, tbl_grade_lvl b, tbl_sections c, tbl_enrollment d
                                                WHERE 
                                                a.sy_id=d.sy_id AND b.grd_id=d.grd_id AND c.sec_id=d.sec_id AND d.std_id=$id
                                                ORDER BY d.enr_date DESC
            ");
            $data['educ_history'] = $sql_educ_history->result();
            
            #Student information
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('tbl_student_info.std_id',$id);
            $this->db->join('tbl_student_info', 'tbl_student_info.std_id=tbl_users.usr_id');
            $query =  $this->db->get();
            $data['std_info'] = $query->result();
            
        } else {
            #no allowed to view user
            $data['std_info'] = array();
            $data['educ_history'] = array();
        }
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('parent/student_profile_view',$data);
    }
    
    public function guardian_info() {
        $id = $this->input->get('id');
        
        if(! empty($id) && is_numeric($id)) {
            
            #Fetch student information 
            $query = $this->db->query("
                                        SELECT * FROM tbl_gaurdian a, tbl_student_info b 
                                        WHERE a.grd_id=$id  AND a.usr_id=".$this->session->userdata('uid')." AND a.std_id=b.std_id
            ");
            $num_res = $query->num_rows();
            
            if($num_res > 0) {
                $data['guardians'] = $query->result();
            } else {
                redirect(base_url(),'refresh');
            }
        } else {
            #invalid id
            redirect(base_url(),'refresh');
        }
        
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('parent/guardian_info_view', $data);
    }
    
    public function savestdguardian() {
        
        $lastname = $this->input->post('lastname');
        $firstname = $this->input->post('firstname');
        $mi = $this->input->post('mi');
        $namext = $this->input->post('namext');
        $sex = $this->input->post('sex');
        $address = $this->input->post('address');
        $contactnumber = $this->input->post('contactnumber');
        $relation = $this->input->post('relation');
        $id = $this->input->post('id');
        
        if(!empty($id) && is_numeric($id) &&!empty($lastname) && !empty($firstname) && !empty($mi) && !empty($sex) && !empty($address) && !empty($contactnumber) && !empty($relation)) {
            $array = array(
                        'grd_lastname'=>$lastname,
                        'grd_firstname'=>$firstname,
                        'grd_mid_init'=>$mi,
                        'grd_extname'=>$namext,
                        'grd_sex'=>$sex,
                        'grd_address'=>$address,
                        'grd_contact'=>$contactnumber,
                        'grd_relation'=>$relation
            );
            $this->db->where('grd_id',$id);
            $this->db->update('tbl_gaurdian',$array);
            $aff_rows = $this->db->affected_rows();

            if($aff_rows > 0) {
                echo json_encode(array('status'=>1, 'msg'=>''));
            } else {
                echo json_encode(array('status'=>0, 'msg'=>''));
            }
        } else {
            echo json_encode(array('status'=>0, 'msg'=>'Please check the information you have provided.'));
        }
        
    }
    
    public function grades() {
        
        $id = $this->input->get('id');
        
        if(!empty($id) && is_numeric($id)) {
            
            $is_allowed = $this->db->get_where('tbl_gaurdian',array('std_id'=>$id,'usr_id'=>$this->session->userdata('uid')));
            $num_res = $is_allowed->num_rows();
            
            if($num_res > 0) {
                
                $student_info = $this->db->get_where('tbl_student_info',array('std_id'=>$id));
                $data['student_info'] = $student_info->result();
                
                $enrolled_sys = $this->db->query("
                                            SELECT * FROM tbl_sy a, tbl_enrollment b, tbl_grade_lvl c, tbl_sections d
                                            WHERE
                                            a.sy_id=b.sy_id and b.std_id=".$id." AND a.sy_id=c.sy_id AND
                                            b.grd_id=c.grd_id AND a.sy_id=d.sy_id AND d.grd_id=c.grd_id AND b.sec_id=d.sec_id
                                            ORDER BY a.sy_from DESC
                ");
                $data['mysys'] = $enrolled_sys->result();

                /* FETCH SUBJECTS & GRADES*/
                $sql_grades = $this->db->query("
                                            SELECT a.*,b.*,c.inf_id,c.inf_surname,c.inf_firstname,d.usr_email FROM tbl_subjects a, tbl_grades b, tbl_teacher_info c, tbl_users d
                                            WHERE
                                            a.sy_id=".$data['mysys'][0]->sy_id." AND a.grd_id=".$data['mysys'][0]->grd_id." AND
                                            a.sec_id=".$data['mysys'][0]->sec_id." AND a.sub_id=b.sub_id AND b.std_id=".
                                            $id." AND b.tch_id=c.inf_id AND d.usr_id=c.inf_id
                ");
                $data['sublist'] = $sql_grades->result();
                $data['uname'] = $this->session->userdata('uname');
                $this->load->view('parent/student_grade_view',$data);
            } else {
                redirect(base_url(),'refresh');
            }
            
        } else {
            redirect(base_url(),'refresh');
        }
    }
}
