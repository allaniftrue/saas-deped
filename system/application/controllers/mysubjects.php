<?php
Class Mysubjects Extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('General_queries'); 
        $this->General_queries->protect_acct();
        $this->General_queries->is_teacher();
    }
    
    public function index() {
       
         $this->db->order_by("sy_to", "DESC");
         $sql_sy = $this->db->get("tbl_sy");
         $data['sys'] = $sql_sy->result();
         $this->session->set_userdata('cursy',$data['sys']);
         $sql = $this->db->query("
                                    SELECT * FROM tbl_subjects a, tbl_teachers_subjects b, tbl_sections c, tbl_grade_lvl d
                                    WHERE
                                    a.sy_id=".$data['sys'][0]->sy_id." AND b.sy_id=".$data['sys'][0]->sy_id." AND a.sub_id=b.sub_id 
                                    AND b.tch_id=".$this->session->userdata('uid')." AND c.sec_id=b.sec_id AND d.grd_id=c.grd_id 
                                    AND d.grd_id=b.grd_id AND d.grd_id=a.grd_id ORDER BY a.sub_name ASC
        ");
         $data['mysubjects']=$sql->result();
         $data['uname'] = $this->session->userdata('uname');
         $this->load->view('teacher/mysubjects_view',$data);
    }
    
    public function mysubjectsonsy() {
        $sysid = $this->input->post('syid');
        $cursys = $this->session->userdata('cursy');
        $res = array();
        if(! empty($sysid) && is_numeric($sysid)) {
           $sql = $this->db->query("
                                        SELECT * FROM tbl_subjects a, tbl_teachers_subjects b, tbl_sections c, tbl_grade_lvl d
                                        WHERE
                                        a.sy_id=".$sysid." AND b.sy_id=".$sysid." AND a.sub_id=b.sub_id 
                                        AND b.tch_id=".$this->session->userdata('uid')." AND c.sec_id=b.sec_id AND d.grd_id=c.grd_id 
                                        AND d.grd_id=b.grd_id AND d.grd_id=a.grd_id ORDER BY a.sub_name ASC
           ");
           
           $result = $sql->result();
           $num_rows = $sql->num_rows();
           
           if($num_rows > 0) {
               foreach($result as $cont) {
                   $res[]=array(
                                    'sub_name'=>$cont->sub_name,
                                    'grd_year'=>$cont->grd_year,
                                    'sec_name'=>$cont->sec_name,
                                    'tcs_id'=>$cont->tcs_id,
                                    'url'=> rand(1,9999).'&sess='.random_string('alnum', 64).'&tcs='.$cont->sub_id.'&k='.random_string('alnum', 32)
                   );
               }
           }
           
           if($cursys[0]->sy_id === $sysid) {
               echo json_encode(array('result'=>$res, 'status'=>1));
           } else {
               echo json_encode(array('result'=>$res, 'status'=>0));
           }
        }
    }
    
    public function withdraw() {
        $id = $this->input->post('dataid');
        
        if(!empty($id) && is_numeric($id)) {
            $this->db->where('tcs_id',$id);
            $this->db->delete('tbl_teachers_subjects');
            $num_res = $this->db->affected_rows();
            if($num_res > 0) {
                echo json_encode(array('status'=>1));
            } else {
                echo json_encode(array('status'=>0));
            }
        } else {
            echo json_encode(array('status'=>0));
        }
    }
    
    public function studlist(){
        
        $sess = $this->input->get('sess');
        $t = $this->input->get('t');
        $k = $this->input->get('k');
        $tcs = $this->input->get('tcs');
        
        $sess = !empty($sess) ? $sess : '';
        $t = !empty($t) ? $t : '';
        $k = !empty($k) ? $k : '';
        
        #Subject ID
        $tcs = !empty($tcs) ? $tcs : '';
        
        if(!empty($sess) && !empty($t) && !empty($k) && !empty($tcs)) {
            
            #Fetch Subject Information
            $sql = $this->db->query("
                                        SELECT * FROM tbl_sy a, tbl_grade_lvl b, tbl_sections c, tbl_subjects d
                                        WHERE
                                        b.sy_id=a.sy_id AND c.sy_id=a.sy_id AND d.sy_id=a.sy_id AND c.grd_id=b.grd_id AND d.grd_id=b.grd_id
                                        AND d.sec_id=c.sec_id AND d.sub_id=$tcs
            ");            
//            $sql = $this->db->get_where('tbl_subjects',array('sub_id'=>$tcs));
            $result = $sql->result();
            $num_res = $sql->num_rows();
            
            $data['subject_info'] = $result;
            
            $sql_sy = $this->db->get_where('tbl_sy',array('sy_id'=>$result[0]->sy_id));
            $data['sys'] = $sql_sy->result();
            
            if($num_res > 0) {
                $sql_studlist = $this->db->query("
                                                    SELECT * FROM tbl_enrollment a, tbl_student_info b
                                                    WHERE
                                                    a.std_id=b.std_id AND a.sy_id=".$result[0]->sy_id." ORDER BY b.std_lastname ASC
                ");
                $data['list'] = $sql_studlist->result();
                
            } else {
               
            }
            
        } else {
            #echo json_encode(array('status'=>0));
        }
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('teacher/studlist_view',$data);
    }
    
    public function studgrade() {
        $syid = $this->input->post('syid');
        $grd_id = $this->input->post('gid');
        $secid = $this->input->post('secid');
        $subid =  $this->input->post('subid');
        $std_id = $this->input->post('dataid');
        
        if(!empty($syid) && !empty($grd_id) && !empty($secid) && !empty($subid) && !empty($std_id)) {
            $sql = $this->db->query("
                                        SELECT * FROM tbl_student_info a, tbl_grades b 
                                        WHERE
                                        a.std_id=$std_id AND a.std_id=b.std_id AND b.sy_id=$syid AND b.grd_id=$grd_id AND b.sec_id=$secid 
                                            AND b.sub_id=$subid AND b.std_id=$std_id AND a.std_id=b.std_id
            ");
            
            $this->db->select('std_id,std_lastname,std_firstname,std_middlename,std_extname,std_sch_id');
            $sql_student = $this->db->get_where('tbl_student_info',array('std_id'=>$std_id));
            
            $sql_info = $this->db->query("
                                            SELECT YEAR(a.sy_from) as schfrom,YEAR(a.sy_to) as schto,b.*,c.*,d.* FROM tbl_sy a, tbl_grade_lvl b, tbl_sections c, tbl_subjects d
                                            WHERE
                                            a.sy_id=$syid AND b.sy_id=$syid AND c.sy_id=$syid AND d.sy_id=$syid
                                            AND b.grd_id=$grd_id AND c.grd_id=$grd_id AND d.grd_id=$grd_id
                                            AND c.sec_id=$secid AND d.sec_id=$secid
                                            AND d.sub_id=$subid
            ");
            
            
            
            echo json_encode(array('result'=>$sql->result(),'student'=>$sql_student->result(),'info'=>$sql_info->result()));
        } else {
            #failed
        }
    }
    
    public function savesubject() {
        $syid =  $this->input->post('syid');
        $gid = $this->input->post('gid');
        $secid = $this->input->post('secid');
        $subid = $this->input->post('subid');
        $stdid = $this->input->post('stdid');
        $firstgrade = $this->input->post('firstgrade');
        $firstremark = $this->input->post('firstremark');
        $secondgrade = $this->input->post('secondgrade');
        $secondremark = $this->input->post('secondremark');
        $thirdgrade = $this->input->post('thirdgrade');
        $thirdremark = $this->input->post('thirdremark');
        $fourthgrade = $this->input->post('fourthgrade');
        $fourthremark = $this->input->post('fourthremark');
        $cur_id = $this->input->post('cur_Id');
        
        if(!empty($syid) && !empty($gid) && !empty($secid) && !empty($subid) && !empty($stdid)) {

            $array = array(
                            'sy_id'=>$syid,
                            'grd_id'=>$gid,
                            'sec_id'=>$secid,
                            'sub_id'=>$subid,
                            'std_id'=>$stdid,
            );
            $check = $this->db->get_where('tbl_grades', $array);
            $check_res = $check->result();
            $num_res = $check->num_rows();

            if($num_res > 0) {

                if($check_res[0]->gra_1st == $firstgrade && $check_res[0]->gra_1st_remarks == $firstremark) {
                    $firstdate =  $check_res[0]->gra_1st_date;
                } else {
                    $firstdate = date('Y-m-d');
                }

                if($check_res[0]->gra_2nd == $secondgrade && $check_res[0]->gra_2nd_remarks == $secondremark) {
                    $seconddate =  $check_res[0]->gra_2nd_date;
                } else {
                    $seconddate = date('Y-m-d');
                }

                if($check_res[0]->gra_3rd == $thirdgrade  && $check_res[0]->gra_3rd_remarks == $thirdremark) {
                    $thirddate =  $check_res[0]->gra_3rd_date;
                } else {
                    $thirddate = date('Y-m-d');
                }

                if($check_res[0]->gra_4th == $fourthgrade && $check_res[0]->gra_4th_remarks == $fourthremark) {
                    $fourthdate =  $check_res[0]->gra_4th_date;
                } else {
                    $fourthdate = date('Y-m-d');
                }


                $array = array(
                            'tch_id'=>$this->session->userdata('uid'),
                            'gra_1st'=>$firstgrade,
                            'gra_1st_remarks'=>$firstremark,
                            'gra_1st_date'=>$firstdate,
                            'gra_2nd'=>$secondgrade,
                            'gra_2nd_remarks'=>$secondremark,
                            'gra_2nd_date'=>$seconddate,
                            'gra_3rd'=>$thirdgrade,
                            'gra_3rd_remarks'=>$thirdremark,
                            'gra_3rd_date'=>$thirddate,
                            'gra_4th'=>$fourthgrade,
                            'gra_4th_remarks'=>$fourthremark,
                            'gra_4th_date'=>$fourthdate
                );

                $this->db->where('gra_id', $check_res[0]->gra_id);
                $this->db->update('tbl_grades', $array);
                $aff_row = $this->db->affected_rows();

                if($aff_row > 0) {
                    echo json_encode(array('status'=>1));
                } else {
                    echo json_encode(array('status'=>0));
                }

            } else {
                $array = array(
                            'sy_id'=>$syid,
                            'grd_id'=>$gid,
                            'sec_id'=>$secid,
                            'sub_id'=>$subid,
                            'std_id'=>$stdid,
                            'tch_id'=>$this->session->userdata('uid'),
                            'gra_1st'=>$firstgrade,
                            'gra_1st_remarks'=>$firstremark,
                            'gra_1st_date'=>date('Y-m-d'),
                            'gra_2nd'=>$secondgrade,
                            'gra_2nd_remarks'=>$secondremark,
                            'gra_2nd_date'=>date('Y-m-d'),
                            'gra_3rd'=>$thirdgrade,
                            'gra_3rd_remarks'=>$thirdremark,
                            'gra_3rd_date'=>date('Y-m-d'),
                            'gra_4th'=>$fourthgrade,
                            'gra_4th_remarks'=>$fourthremark,
                            'gra_4th_date'=>date('Y-m-d')
                );

                $this->db->insert('tbl_grades',$array);
                $aff_rows = $this->db->affected_rows();

                if($aff_rows > 0) {
                    echo json_encode(array('status'=>1));
                } else {
                    echo json_encode(array('status'=>0));
                }
            }
        } else {
            #Failed
        }
    }
}