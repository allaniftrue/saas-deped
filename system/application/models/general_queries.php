<?php
Class General_queries extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->__clear_cache();
    }
    
    private function __clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    
    private function session_setter($array=array()) {
        $this->session->set_userdata($array);
    }

    public function is_exist($table, $id, $value_to_check) {
        $this->db->where($id , $value_to_check);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function activate($token) {
        $this->db->where('usr_token' , $token);
        $query = $this->db->get('tbl_users');
        $row = $query->result();
        
        if($query->num_rows() > 0) {
           if($row[0]->usr_status == 'verified') {
               return FALSE;
           } else {
               return TRUE;
           }
        } else {
            return FALSE;
        }
    } 


    public function log_session($uid='', $ip, $user_agent, $activity) {
        
        if(empty($uid)) {$uid=0;}
        $data = array(
            'usr_id'=> $uid,
            'log_ip'=> $ip,
            'log_browser'=> $user_agent,
            'log_activity'=> $activity
        );
        
        $this->db->insert('tbl_logs', $data);
        
    }
    
    
    public function protect_acct() {
        
        $is_login = $this->session->userdata('is_login');
        
        if($is_login != TRUE) { 
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
            $this->output->set_header("Pragma: no-cache");
            redirect(base_url(), 'refresh');     
        }
        
    }
    
    public function teacher_data($uid) {
        
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('inf_id',$uid);
        $this->db->join('tbl_teacher_info', 'tbl_users.usr_id=tbl_teacher_info.inf_id');

        $query = $this->db->get();
        
        return $query->result();

    }
    
    public function teacher_data_adv() {
//        $sql = $this->db->query("
//                                SELECT a.usr_email,a.usr_user_type,b.*,c.*,d.*,e.*,f.*,g.*,h.*,i.*,j.*,k.*,l.* FROM tbl_users a, tbl_teacher_info b, tbl_tch_vocational c, tbl_tch_secondary d, 
//                                tbl_tch_graduate e, tbl_tch_elementary f, tbl_tch_college g, tbl_tch_children h, tbl_seminars i, tbl_recognition j, tbl_organizations k, tbl_civil_srv l
//                                WHERE
//                                
//                                
//        ");
    }
    
    public function student_data($uid) {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('std_id',$uid);
        $this->db->join('tbl_student_info', 'tbl_users.usr_id=tbl_student_info.std_id');

        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function guardian_data($uid) {
        
        $this->db->select('usr_email');
        $this->db->from('tbl_users');
        $this->db->where('usr_id',$uid);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function deped_data($uid) {
        
        $this->db->select('usr_email');
        $this->db->from('tbl_users');
        $this->db->where('usr_id',$uid);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function __fetch_curr_sy() {
        
        $this->db->limit(1);
        $this->db->order_by('sy_to','desc');
        $query = $this->db->get('tbl_sy');
        $result=$query->result();
        
        return $result;
        
    }
    
    public function is_registrar() {
        $allowed = array('registrar');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_teacher_registrar() {
        $allowed = array('teacher','registrar');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_registrar_teacher_guardian() {
         $allowed = array('teacher','registrar','parent');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_teacher() {
        $allowed = array('teacher');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_student() {
        $allowed = array('student');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_student_parent() {
        $allowed = array('student','parent');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_parent() {
        $allowed = array('parent');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
    
    public function is_deped() {
        $allowed = array('deped');
        if(! in_array($this->session->userdata('usertype'),$allowed)) {
            redirect(base_url(), 'location');
        } 
    }
}