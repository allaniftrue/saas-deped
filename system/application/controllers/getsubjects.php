<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Getsubjects extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('General_queries'); 
        $this->General_queries->protect_acct();   
        $this->General_queries->is_teacher();
    }
    
    public function index() {
        $udata = $this->General_queries->teacher_data($this->session->userdata('uid'));
        if(empty($udata[0]->inf_surname) || empty($udata[0]->inf_firstname)) {
            
            $this->session->set_userdata('email', $udata[0]->usr_email);
            $data['uname'] = $udata[0]->usr_email;
            
        }  else {
            $array = array('surname'=>$udata[0]->inf_surname, 'firstname'=>$udata[0]->inf_firstname);
            $this->session->set_userdata($array);
            
            $data['uname'] = $udata[0]->inf_surname . ', ' . $udata[0]->inf_firstname;
        }
        #Current School Year
        $data['cursy'] = $this->General_queries->__fetch_curr_sy();
        $num_sy = count($data['cursy']);
        #Fetch Grade Levels
        if($num_sy > 0) {
            
            $this->db->order_by('(grd_year)+0','ASC');
            $sql_lvls = $this->db->get_where('tbl_grade_lvl',array('sy_id'=>$data['cursy'][0]->sy_id));
            $data['levels'] = $sql_lvls->result();
            $num_lvls = count($data['levels']);
            
            if($num_lvls > 0) {
                
                 #Fetch Sections
                $this->db->order_by('sec_name','ASC');
                $sql_sec = $this->db->get_where('tbl_sections',array('grd_id'=>$data['levels'][0]->grd_id));
                $data['sections'] = $sql_sec->result();
                $num_sec = $sql_sec->num_rows();
                
                if($num_sec > 0) {
                    #Fetch subjects
                    $sql_subjects = $this->db->query("
                                        SELECT * FROM tbl_subjects
                                        WHERE
                                        sy_id=".$data['cursy'][0]->sy_id." AND grd_id=".$data['levels'][0]->grd_id." AND sec_id=".$data['sections'][0]->sec_id." AND sub_id NOT IN (SELECT sub_id FROM tbl_teachers_subjects)
                    ");
                    $data['subjects']=$sql_subjects->result();
                    
                    /* ---------------------------------------------------------------------------*\
                     *  SUBJECTS ALREADY TAKEN 
                    \*----------------------------------------------------------------------------*/
                    $sql_taken_subjects = $this->db->query("
                                        SELECT * FROM tbl_subjects a, tbl_teacher_info b, tbl_teachers_subjects c
                                        WHERE
                                        a.sy_id=".$data['cursy'][0]->sy_id." AND a.grd_id=".$data['levels'][0]->grd_id." AND a.sec_id=".$data['sections'][0]->sec_id." AND c.sub_id=a.sub_id AND c.tch_id=b.inf_id
                    ");
                    $data['taken_subjects']=$sql_taken_subjects->result();
                }
            }
        }
        
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('teacher/getsubjects_view',$data);

    }
    
    public function save_subj() {
        $cur_sy = $this->General_queries->__fetch_curr_sy();
        $gid = $this->input->post('gid');
        $secid = $this->input->post('secid');
        $subid = $this->input->post('subid');
        
        if(!empty($gid) && !empty($secid) && !empty($cur_sy[0]->sy_id) && !empty($subid)) {
            $sql_check = $this->db->get_where('tbl_teachers_subjects',array('sy_id'=>$cur_sy[0]->sy_id,'grd_id'=>$gid,'sec_id'=>$secid,'sub_id'=>$subid));
            $result = $sql_check->result();
            if($sql_check->num_rows() > 0) {
                
                $this->db->select('inf_firstname, inf_surname');
                $sql = $this->db->get_where('tbl_teacher_info',array('inf_id'=>$result[0]->tch_id));
                $result = $sql->result();
               
                if(! empty($result[0]->inf_surname) || ! empty($result[0]->inf_firstname)) {
                    echo json_encode(array('status'=>0,'msg'=>'The subject is already assigned to <strong>'.$result[0]->inf_firstname.' '.$result[0]->inf_surname.'</strong>'));
                } else {
                    echo json_encode(array('status'=>0,'msg'=>'The subject is already assigned to another teacher'));
                }
                
                
            } else {
                $array = array(
                                'tch_id'=>$this->session->userdata('uid'),
                                'sy_id'=>$cur_sy[0]->sy_id,
                                'grd_id'=>$gid,
                                'sec_id'=>$secid,
                                'sub_id'=>$subid
                );
                $this->db->insert('tbl_teachers_subjects',$array);
                $aff_rows = $this->db->affected_rows();
                if($aff_rows > 0) {
                    echo json_encode(array('status'=>1,'msg'=>'Subject saved'));
                } else {
                    echo json_encode(array('status'=>0,'msg'=>'Failed to save the salected subject'));
                }
            }
        } else {
            $this->db->select('inf_surname,inf_firstname');
            $sql = $this->db->get_where('tbl_teacher_info',array('inf_id'=>$result[0]->tch_id));
            $result = $sql->result();
            echo json_encode(array('status'=>0,'msg'=>'The subject is already assigned to <strong>'.$result[0]->inf_firstname.' '.$result[0]->inf_surname.'</strong>'));
        }        
    }
    
    public function fetch_sections() {
        $cur_sy = $this->General_queries->__fetch_curr_sy();
        $gid = $this->input->post('gid');
        
        if(!empty($gid) && !empty($cur_sy[0]->sy_id)) {
            $sql = $this->db->get_where('tbl_sections',array('sy_id'=>$cur_sy[0]->sy_id, 'grd_id'=>$gid));
            echo json_encode($sql->result());
        }
    }
    
    public function fetch_subjects() {
        $cur_sy = $this->General_queries->__fetch_curr_sy();
        $gid = $this->input->post('gid');
        $secid = $this->input->post('secid');
        
        if(!empty($gid) && !empty($cur_sy[0]->sy_id) && ! empty($secid)) {
            $sql = $this->db->query("
                                        SELECT * FROM tbl_subjects
                                        WHERE
                                        sy_id=".$cur_sy[0]->sy_id." AND grd_id=".$gid." AND sec_id=".$secid." AND sub_id NOT IN (SELECT sub_id FROM tbl_teachers_subjects)
            ");
            /* ---------------------------------------------------------------------------*\
             *  SUBJECTS ALREADY TAKEN 
            \*----------------------------------------------------------------------------*/
            $sql2 = $this->db->query("
                                SELECT * FROM tbl_subjects a, tbl_teacher_info b, tbl_teachers_subjects c
                                WHERE
                                a.sy_id=".$cur_sy[0]->sy_id." AND a.grd_id=".$gid." AND a.sec_id=".$secid." AND c.sub_id=a.sub_id AND c.tch_id=b.inf_id
            ");
            
            echo json_encode(array('result1'=>$sql->result(), 'result2'=>$sql2->result()));
        }
    }
}