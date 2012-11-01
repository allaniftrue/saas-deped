<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Deped extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_deped();
    }
    
    public function index() {
        redirect(base_url(),'location');
    }
    
    public function tlist() {
        
        $sql = $this->db->query("
                                    SELECT a.usr_email,a.usr_user_type, b.* FROM tbl_users a, tbl_teacher_info b
                                    WHERE
                                    a.usr_id=b.inf_id
        ");
        
        $data['teachers'] = $sql->result();
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('deped/tlist_view',$data);
    }
    
    public function tprofile() {
        
        $this->load->library('memcached_library');
        
        $what = $this->input->get('shw');
        $id= $this->input->get('id');
        $data['id'] = $id;
        
        if(is_numeric($id) && !empty($id)) {
            
            $data['uname'] = $this->session->userdata('uname');

            switch ($what):
                case 'personal':
                    
                    $this->db->select('tbl_users.usr_email,tbl_teacher_info.*');
                    $this->db->from('tbl_users');
                    $this->db->where('tbl_users.usr_id',$id);
                    $this->db->join('tbl_teacher_info', 'tbl_teacher_info.inf_id = tbl_users.usr_id');
                    $sql = $this->db->get();
                    $data['inf'] = $sql->result();
                    $this->load->view('deped/teacher/teacher_profile_view',$data);
                    
                    $results = $this->memcached_library->get('info'.$id);
                    
                    if(! $results) {
                        $this->memcached_library->add('info'.$id, $data['inf']);
                    }
                    
                break;
            
                case 'family':
                    
                    $this->db->order_by('chl_dob','ASC');
                    $sql = $this->db->get_where('tbl_tch_children', array('tch_inf_id'=>$id));
                    $num_res = $sql->num_rows();
                    
                    if($num_res > 0) {
                        $data['child'] = $sql->result();
                        $data['num_child'] = $num_res;
                    } else {
                        $data['num_child'] = 0;
                    }
                    
                    /* previous info */
                    $results = $this->memcached_library->get('info'.$id);
                    
                    if(! $results){
                        
                        $this->db->select('tbl_users.usr_email,tbl_teacher_info.*');
                        $this->db->from('tbl_users');
                        $this->db->where('tbl_users.usr_id',$id);
                        $this->db->join('tbl_teacher_info', 'tbl_teacher_info.inf_id = tbl_users.usr_id');
                        $sql = $this->db->get();
                        $result = $sql->result();
                        $num_res = $sql->num_rows();
                        
                        if($num_res > 0) {
                            $data['inf'] = $result[0];
                        }
                        
                        $this->load->view('deped/teacher/teacher_family_view',$data);
                        $this->memcached_library->add('info', $data['inf']);
                        
                    } else {
                        $data['inf'] = $results[0];
                        $this->load->view('deped/teacher/teacher_family_view',$data);
                    }
                    
                break;
                
                case 'education':
                    $this->db->order_by('elem_to','DESC');
                    $sql_elem = $this->db->get_where('tbl_tch_elementary',array('tch_id'=>$id));
                    $data['elem'] = $sql_elem->result();
                    
                    $this->db->order_by('sec_to','DESC');
                    $sql_sec = $this->db->get_where('tbl_tch_secondary',array('tch_id'=>$id));
                    $data['sec'] = $sql_sec->result();
                    
                    $this->db->order_by('voc_to','DESC');
                    $sql_voc = $this->db->get_where('tbl_tch_vocational',array('tch_id'=>$id));
                    $data['voc'] = $sql_voc->result();
                    
                    $this->db->order_by('col_to','DESC');
                    $sql_college = $this->db->get_where('tbl_tch_college',array('tch_id'=>$id));
                    $data['college'] = $sql_college->result();
                    
                    $this->db->order_by('grad_to','DESC');
                    $sql_graduate = $this->db->get_where('tbl_tch_graduate',array('tch_id'=>$id));
                    $data['graduate'] = $sql_graduate->result();
                    
                    $this->load->view('deped/teacher/teacher_education_view',$data);
                break;
            
                case 'civil-service':
                    $this->db->order_by('cvl_date_release','DESC');
                    $sql = $this->db->get_where('tbl_civil_srv',array('tch_id'=>$id));
                    $data['civil_service'] = $sql->result();
                    
                    $this->load->view('deped/teacher/teacher_civil_service_view',$data);
                break;
            
                case 'work-experience':
                    $this->db->order_by('wrk_to','DESC');
                    $sql = $this->db->get_where('tbl_work_exp',array('tch_id'=>$id));
                    $data['experience'] = $sql->result();
                    
                    $this->load->view('deped/teacher/teacher_work_experience_view',$data);
                break;
            
                case 'voluntary-work':
                    $this->db->order_by('vol_to','DESC');
                    $sql = $this->db->get_where('tbl_work_volunteer',array('tch_id'=>$id));
                    $data['voluntary'] = $sql->result();
                    
                    $this->load->view('deped/teacher/teacher_voluntary_work_view',$data);
                break;
                    
                case 'training-programs':
                    $this->db->order_by('tra_to','DESC');
                    $sql = $this->db->get_where('tbl_seminars',array('tch_id'=>$id));
                    $data['training'] = $sql->result();
                    
                    $this->load->view('deped/teacher/teacher_seminars_view',$data);
                break;
                    
                case 'other-info':
                    
                    $sql = $this->db->get_where('tbl_recognition',array('tch_id'=>$id));
                    $data['recognition'] = $sql->result();
                    
                    $sql = $this->db->get_where('tbl_organizations',array('tch_id'=>$id));
                    $data['organizations'] = $sql->result();
                    
                    /* previous info */
                    $results = $this->memcached_library->get('info'.$id);
                    if(! $results){
                        
                        $this->db->select('tbl_users.usr_email,tbl_teacher_info.*');
                        $this->db->from('tbl_users');
                        $this->db->where('tbl_users.usr_id',$id);
                        $this->db->join('tbl_teacher_info', 'tbl_teacher_info.inf_id = tbl_users.usr_id');
                        $sql = $this->db->get();
                        $result = $sql->result();
                        $num_res = $sql->num_rows();
                        
                        if($num_res > 0) {
                            $data['inf'] = $result[0];
                        }
                        
                        $this->load->view('deped/teacher/teacher_other_info_view',$data);
                        $this->memcached_library->add('info', $data['inf']);
                        
                    } else {
                        $data['inf'] = $results[0];
                        $this->load->view('deped/teacher/teacher_other_info_view',$data);
                    }
                    
                    
                break;
                    
                default: 
                    redirect(base_url().'?mc=deped&m=tlist', 'location');
            endswitch;
        } else {
            #empty/invalid ID
        }
    }
    
    
    public function wload() { #teacher's work load
        $id = $this->input->get('id');
        
        if(!empty($id) && is_numeric($id)) {
            
            
            #Fetch Teacher Info
            $this->db->select('inf_surname,inf_firstname,inf_middlename,inf_name_ext');
            $sql = $this->db->get_where('tbl_teacher_info',array('inf_id'=>$id));
            $data['current_teacher'] = $sql->result();
            
            #Fetch School Year
            $this->db->order_by("sy_to", "DESC");
            $sql_sy = $this->db->get("tbl_sy");
            $data['sys'] = $sql_sy->result(); #school year
            
            $this->session->set_userdata('cursy',$data['sys']);
            
            #Fetch subjects handled teacher
            $sql = $this->db->query("
                                       SELECT * FROM tbl_subjects a, tbl_teachers_subjects b, tbl_sections c, tbl_grade_lvl d
                                       WHERE
                                       a.sy_id=".$data['sys'][0]->sy_id." AND b.sy_id=".$data['sys'][0]->sy_id." AND a.sub_id=b.sub_id AND b.tch_id=".$id." AND 
                                       c.sec_id=b.sec_id AND d.grd_id=c.grd_id AND d.grd_id=b.grd_id AND d.grd_id=a.grd_id 
                                       ORDER BY a.sub_name ASC
           ");
            $subjects = $sql->result_array();
            $num_res = $sql->num_rows();
            
            
            #Get enrolled students
            $sql = $this->db->get_where('tbl_enrollment',array('sy_id'=>$data['sys'][0]->sy_id));
            $enrolled_info = $sql->result();
            $num_enrolled = $sql->num_rows();
            
            for($x=0; $x<$num_res; $x++) {
                $counter=0;
                for($y=0; $y<$num_enrolled; $y++) {
                    if($subjects[$x]['sec_id'] === $enrolled_info[$y]->sec_id) {
                        $counter++;
                    }
                }
                array_push($subjects[$x], $counter);
            }
            
            $data['subjects'] = $subjects;
            
            $data['uname'] = $this->session->userdata('uname');
            $this->load->view('deped/teacher/work_load_view',$data);
            
            
        } else {
            #invalid id
        }
    }
}