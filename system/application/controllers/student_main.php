<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Student_main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->General_queries->is_student_parent();
    }
    
    public function index() {
        /*
         * TODO - get all teachers (2 teachers in 1 subj of the same sy)
         */
        $udata = $this->General_queries->student_data($this->session->userdata('uid'));
        if(empty($udata[0]->std_lastname) || empty($udata[0]->std_firstname)) {
            $this->session->set_userdata('email', $udata[0]->usr_email);
            $data['uname'] = $udata[0]->usr_email;
        }  else {
            $array = array('surname'=>$udata[0]->std_lastname, 'firstname'=>$udata[0]->std_firstname);
            $this->session->set_userdata($array);
            $data['uname'] = $udata[0]->std_lastname . ', ' . $udata[0]->std_firstname;
        }
        
        $enrolled_sys = $this->db->query("
                                            SELECT * FROM tbl_sy a, tbl_enrollment b, tbl_grade_lvl c, tbl_sections d
                                            WHERE
                                            a.sy_id=b.sy_id and b.std_id=".$this->session->userdata('uid')." AND a.sy_id=c.sy_id AND
                                            b.grd_id=c.grd_id AND a.sy_id=d.sy_id AND d.grd_id=c.grd_id AND b.sec_id=d.sec_id
                                            ORDER BY a.sy_from DESC
        ");
        $data['mysys'] = $enrolled_sys->result();
        
        /* FETCH SUBJECTS & GRADES*/
        $sql_grades = $this->db->query("
                                            SELECT a.*,b.*,c.inf_id,c.inf_surname,c.inf_firstname FROM tbl_subjects a, tbl_grades b, tbl_teacher_info c
                                            WHERE
                                            a.sy_id=".$data['mysys'][0]->sy_id." AND a.grd_id=".$data['mysys'][0]->grd_id." AND
                                            a.sec_id=".$data['mysys'][0]->sec_id." AND a.sub_id=b.sub_id AND b.std_id=".
                                            $this->session->userdata('uid')." AND b.tch_id=c.inf_id
        ");
        
        
        $data['sublist'] = $sql_grades->result();
        $this->session->set_userdata('uname',$data['uname']);
        $this->load->view('student/main_view', $data);
    }
    
    public function get_grades() {
        
        $sid = $this->input->post('sid');
        
        if($this->session->userdata('usertype') === 'parent') {
            $id = $this->input->post('id');
            $is_allowed = $this->db->get_where('tbl_gaurdian',array('std_id'=>$id,'usr_id'=>$this->session->userdata('uid')));
            $num_res = $is_allowed->num_rows();
            
            if($num_res > 0) {
                #Do nothing?
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'You are not allowed to do this')));
            }
            
        } else {
            $id = $this->session->userdata('uid');
        }
        
        $enrolled_sys = $this->db->query("
                                            SELECT * FROM tbl_sy a, tbl_enrollment b, tbl_grade_lvl c, tbl_sections d
                                            WHERE
                                            a.sy_id=".$sid." AND b.sy_id=".$sid." AND b.std_id=".$id." 
                                            AND a.sy_id=c.sy_id AND b.grd_id=c.grd_id AND a.sy_id=d.sy_id AND d.grd_id=c.grd_id AND b.sec_id=d.sec_id
                                            ORDER BY a.sy_from DESC
        ");
        $mysys = $enrolled_sys->result();
        
        /* FETCH SUBJECTS & GRADES*/
        $sql_grades = $this->db->query("
                                            SELECT a.*,b.*,c.inf_id,c.inf_surname,c.inf_firstname,d.usr_email FROM tbl_subjects a, tbl_grades b, tbl_teacher_info c, tbl_users d
                                            WHERE
                                            a.sy_id=".$sid." AND a.grd_id=".$mysys[0]->grd_id." AND a.sec_id=".$mysys[0]->sec_id." 
                                            AND a.sub_id=b.sub_id AND b.std_id=".$id." AND b.tch_id=c.inf_id AND d.usr_id=c.inf_id
        ");
        
        echo json_encode($sql_grades->result()); 
    }
}
?>
