<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Regtools extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->General_queries->protect_acct();
        $this->load->helper('freq');
    }
    
    public function sy() {
        $this->General_queries->is_registrar();
        $data['uname'] = $this->session->userdata('uname');
        $this->db->order_by('sy_to','DESC');
        $query = $this->db->get('tbl_sy');
        $data['sys'] = $query->result();
        
        $this->load->view('registrar/sy_view',$data);
    }
    
    public function syadd() {
        $this->General_queries->is_registrar();
        $from = $this->input->post('dfrom');
        $to = $this->input->post('dto');
        
        $from_y = date('Y',  strtotime($from));
        $to_y = date('Y',  strtotime($to));
        
        if($from_y === $to_y) {
            $array = array('msg'=>'Invalid school year dates');
            echo json_encode($array);
        } else {
        
            $sql = $this->db->get_where('tbl_sy',array('YEAR(sy_from)'=>$from,'YEAR(sy_to)'=>$to));
            $num_res = count($sql->result());

            if($num_res > 0) {
                $array = array('msg'=>'School year already exist');
                echo json_encode($array);
            } else {
                
                $data = array(
                                'sy_from' => $from,
                                'sy_to' => $to
                );

                $this->db->insert('tbl_sy', $data); 
                $num_rows = $this->db->affected_rows();

                if($num_rows > 0) {
                    $array = array('msg'=>'School year successfully added');
                    echo json_encode($array);
                } else {
                    $array = array('msg'=>'Failed to add school year, please enter a valid date in this format yyyy-mm-dd');
                    echo json_encode($array);
                }
            }
        }
    }
    
    public function syupdate() {
        $this->General_queries->is_registrar();
        $did = $this->input->post('did');
        $from = $this->input->post('dfrom');
        $to = $this->input->post('dto');
        
        if(! empty($did) && ! empty($from) && ! empty($to)) {
            
            $sql = $this->db->get_where('tbl_sy',array('YEAR(sy_from)'=>$from,'YEAR(sy_to)'=>$to));
            $result = $sql->result();
            $num_res = count($result);
            #if the year already exist get the ID & compare it to the existing ID
            if($num_res > 0) {
                
                if($result[0]->sy_id === $did) {
                    $array = array(
                                    'sy_from'=>$from,
                                    'sy_to'=>$to
                    );
                    $this->db->where('sy_id',$did);
                    $this->db->update('tbl_sy',$array);
                    $aff_row = $this->db->affected_rows();
                    
                    if($aff_row > 0) {
                        $array = array('status'=>1,'msg'=>'School year successfully updated');
                        echo json_encode($array);
                    } else {
                        $array = array('status'=>0,'msg'=>'Failed to update the current school year');
                        echo json_encode($array);
                    }
                    
                } else {
                    $array = array('status'=>0,'msg'=>'School year already exist');
                    echo json_encode($array);
                }

            } else {
            
            }
        } else {
            $array = array('status'=>0,'msg'=>'Failed to add school year, please enter a valid date in this format yyyy-mm-dd');
            echo json_encode($array);
        }
    } 
    #End of school year
    
    public function gradelvl() {
        $this->General_queries->is_registrar();
        $this->db->order_by('sy_to','DESC');
        $query = $this->db->get('tbl_sy');
        $data['sys'] = $query->result();
        
        
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/gradelvl_view', $data);
    }
    
    public function fetchlvls() {
        $this->General_queries->is_registrar();
        $did = $this->input->post('did');
        
        if(empty($did)) {
            $this->db->order_by('sy_to', 'DESC');
            $sql = $this->db->get_where('tbl_sy');
            $res = $sql->result();
            
            $did = $res[0]->sy_id;
            $sy = "<strong>SY ". date('Y',  strtotime($res[0]->sy_from)) . '-' . date('Y',  strtotime($res[0]->sy_to)) . "</strong>";
        }
        
        $this->db->select('*');
        $this->db->from('tbl_sy');
        $this->db->where('tbl_sy.sy_id',$did);
        $this->db->join('tbl_grade_lvl', 'tbl_sy.sy_id=tbl_grade_lvl.sy_id');
        $this->db->order_by('(tbl_grade_lvl.grd_year)+0','ASC');
        $query = $this->db->get();
        $result = $query->result();
        $num_res = count($result);
        $tbl_content='';

        if($num_res > 0) {
            for($x=0; $x<$num_res; $x++) {
                $tbl_content .= '
                    <tr id="'.$result[$x]->grd_id.'">
                        <td>'.$result[$x]->grd_year.'</td>
                        <td>
                             <div class="btn-group">
                                <button class="btn" data-toggle="dropdown">Actions</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0);" id="remove" data-id="'.$result[$x]->grd_id.'">
                                            <i class="icon-trash"></i> Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                ';
            }
        } else {
            $tbl_content .= "
                    <tr>
                        <td colspan=\"2\"><em>No data found</em></td>
                    </tr>
                ";
        }
        
        
        if(! empty($did) && $num_res >0) {
            #print_r($result);
            $sy = "<strong>SY ". date('Y',  strtotime($result[0]->sy_from)) . ' - ' . date('Y',  strtotime($result[0]->sy_to)) . "</strong>";
        } elseif($num_res == 0 && ! empty($did)) {
            $sy = '';
        }
      

        $array=array(
                        'tbl'=>$tbl_content,
                        'sy'=>$sy,
                        'sid'=>$did
        );

        echo json_encode($array);
        
    }
    
    public function lvladd() {
        $this->General_queries->is_registrar();
        $lvls = $this->input->post('lvls');
        $sy_id = $this->input->post('sid');
        $indi_lvls = explode(',', $lvls);
        $msg = '';
        
        $num_lvls = count($indi_lvls); 
        
        for($x=0; $x<$num_lvls; $x++) {
            $lvl = trim($indi_lvls[$x]);
            
            if(! empty($lvl)) {
                
                $this->db->where('sy_id',$sy_id);
                $this->db->where('grd_year',$lvl);
                $this->db->from('tbl_grade_lvl');
                $num = $this->db->count_all_results();
                
                if($num > 0) {
                   $msg .= '<strong>Grade '.$lvl.'</strong> &mdash; already exist <br />';
                } else {
                    $this->db->insert('tbl_grade_lvl',array('sy_id'=>$sy_id,'grd_year'=>$lvl));
                    $aff_rows=$this->db->affected_rows();

                    if($aff_rows > 0) {
                        $msg .= '<strong>Grade '.$lvl.'</strong> &mdash; Successfully added<br />';
                    } else {
                        $msg .= '<strong>Grade '.$lvl.'</strong> &mdash; Failed to be added<br />';
                    }
                }
            }
        }
        
       $array = array(
                        'msg'=>$msg
       ); 
       echo json_encode($array);
        
    }
    
    public function rmlvl() {
        $this->General_queries->is_registrar();
        $did = $this->input->post('did');
        
        if(! empty($did)) {
            
            $this->db->delete('tbl_grade_lvl', array('grd_id' => $did)); 
            $num_rows = $this->db->affected_rows();
            
            if($num_rows > 0) {
                $array = array(
                                'status'=>1,
                                'msg'=>'Successfull removed the grade level'
                );
                echo json_encode($array);
            } else {
                $array = array(
                                'status'=>0,
                                'msg'=>'Failed to remove the grade level'
                );
                echo json_encode($array);
            }
            
        } else {
                $array = array(
                                'status'=>0,
                                'msg'=>"Can't determine which grade level you are trying to remove"
                );
                echo json_encode($array);
        }
    }
    #End of Grade Level
    
    private function __fetch_curr_sy() {
        
        $this->db->limit(1);
        $this->db->order_by('sy_to','desc');
        $query = $this->db->get('tbl_sy');
        $result=$query->result();
        
        return $result;
        
    }
    
    private function __fetch_sys() {
        
        $this->db->order_by('sy_to','desc');
        $query = $this->db->get('tbl_sy');
        $result=$query->result();
        
        return $result;
    }
    
    private function __isfirst($sid,$gid) {
        
        $this->db->where('sy_id',$sid);
        $this->db->where('grd_id',$gid);
        $this->db->from('tbl_sections');
        $num = $this->db->count_all_results();
        
        if($num == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    public function sections() {
        $this->General_queries->is_registrar();
        $curr_sy = $this->__fetch_curr_sy();
        $num_curr_sy = count($curr_sy);
        
        if($num_curr_sy > 0) {
            
            $this->db->where('sy_id',$curr_sy[0]->sy_id);
            $this->db->order_by('(grd_year)+0','ASC');
            $query = $this->db->get('tbl_grade_lvl');
            $grd_lvls = $query->result();
            
            $this->db->where('sy_id',$curr_sy[0]->sy_id);
            $this->db->where('grd_id',$grd_lvls[0]->grd_id);
            $this->db->order_by('sec_name', 'ASC');
            $query = $this->db->get('tbl_sections');
             
            $data['sections'] = $query->result();
            $data['lvls'] = $grd_lvls;
            $data['cursy'] = $curr_sy;
            $data['sys'] = $this->__fetch_sys();
        } else {
            #No School Year Present
        }

        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/sections_view',$data);
    }
    
    public function fetchselectedlvl() {
        $this->General_queries->is_registrar();
        $sid = $this->input->post('sid');
        #$gid = $this->input->post('gid');
        
        if(! empty($sid)) {
            $this->db->order_by('(grd_year)+0','ASC');
            $query = $this->db->get_where('tbl_grade_lvl',array('sy_id'=>$sid));
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                $array = array('result'=>$result);
                echo json_encode($array);
            } else {
                $array= array();
                echo json_encode($array);
            }
            
        } else {
            $array= array();
            echo json_encode($array);
        }
    }
    
    public function __fetchsections($sid='',$gid='') {
        
        $this->General_queries->is_registrar();
        
        if(! empty($sid) && ! empty($gid)) {
            
            $this->db->where('sy_id',$sid);
            $this->db->where('grd_id',$gid);
            $this->db->order_by('sec_name', 'ASC');
            $query = $this->db->get('tbl_sections');
            $result = $query->result();
            
            $array = array(
                            'sid'=>$sid,
                            'gid'=>$gid,
                            'curr_sy'=>$this->__fetch_curr_sy(),
                            'sections'=>$result
            );
            return $result;
            
        } else {
            #SID or GID is empty
        }
    }
    
    public function fetchsections() {
        $this->General_queries->is_registrar();
        $sid = $this->input->post('sid');
        $gid = $this->input->post('gid');
        
        if(! empty($sid) && ! empty($gid)) {
            
            $this->db->where('sy_id',$sid);
            $this->db->where('grd_id',$gid);
            $this->db->order_by('sec_name', 'ASC');
            $query = $this->db->get('tbl_sections');
            $result = $query->result();
            
            $array = array(
                            'sid'=>$sid,
                            'gid'=>$gid,
                            'curr_sy'=>$this->__fetch_curr_sy(),
                            'sections'=>$result
            );
            echo json_encode($array);
            
        } else {
            #SID or GID is empty
        }
    }
    
    public function addsections() {
        $this->General_queries->is_registrar();
        $sid = $this->input->post('sid');
        $gid = $this->input->post('gid');
        $section_names = $this->input->post('secNames');
        $msg = '';
        $tb_data='';
        
        $indiv_sec_names=explode("\n",$section_names);
        $num_sec_names = count($indiv_sec_names);
        $x=0;
        
        $is_first = ($this->__isfirst($sid, $gid)) ? 1 : '';
        
        while($x != $num_sec_names) {
            $cur_name = ucwords(strtolower($indiv_sec_names[$x]));
            
            $array_data = array(
                                    'sec_name'=>$cur_name,
                                    'sy_id'=>$sid,
                                    'grd_id'=>$gid
            );
           
            $query = $this->db->get_where('tbl_sections',$array_data);
            $num_res = count($query->result());
            
            if($num_res > 0) {
                $msg .= $indiv_sec_names[$x]." &mdash; Was not added because it already exist <br />";
            } else {
                if(! empty($indiv_sec_names[$x])) {
                    
                    $arr_data = array(
                                        'sy_id'=>$sid,
                                        'grd_id'=>$gid,
                                        'sec_name'=>$cur_name
                    );
                    $this->db->insert('tbl_sections',$arr_data);
                    $num_res = $this->db->affected_rows();
                    $cur_id = $this->db->insert_id();
                    if($num_res > 0) {
                        $msg .= $indiv_sec_names[$x]." &mdash; Successfully added<br />";
                        $tb_data .= "
                            <tr id=\"tr".$cur_id."\">
                                <td>".$indiv_sec_names[$x].'</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn" data-toggle="dropdown">Actions</button>
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                           
                                            <li><a href="javascript:void(0);" data-id="'.$cur_id.'" id="remove"><i class="icon-trash"></i> Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        ';
                    } else {
                        $msg .= $indiv_sec_names[$x]." &mdash; Was not successfully added<br />";
                    }
                }
                
            }
            $x++;
        }
        
        $table = (! empty($tb_data)) ? $tb_data : '';
        $array = array(
                        'msg'=>$msg,
                        'tb_data'=>$table,
                        'is_first'=>$is_first
        );
        
        echo json_encode($array);
    }
    
    public function rmsection(){
        $this->General_queries->is_registrar();
        $sid = $this->input->post('sid');
        if(! empty($sid)) {
            $this->db->where('sec_id', $sid);
            $this->db->delete('tbl_sections');
            $aff_row = $this->db->affected_rows();
            
            if($aff_row > 0) {
                $array = array(
                    'status'=>1
                );
                
                echo json_encode($array);
                
            } else {
                $array = array(
                    'status'=>0
                );
                
                echo json_encode($array);
            }
        } else {
            $array = array(
                    'status'=>0
                );
            echo json_encode($array);
        }
    }
    
    public function enrolledstudents() { #Will list all enrolled students
        $this->General_queries->is_registrar();
        $syid = $this->input->get('sy');
        $sec_id = $this->input->get('secd');
        $sess = $this->input->get('sess');
        $al = $this->input->get('al');
     
        if(! empty($sec_id) && ! empty($syid) && ! empty($sess) && !empty($al)) {
            
            #Fetch student info
            $sql = $this->db->query("
                                    SELECT * FROM tbl_student_info a, tbl_sy b,tbl_sections c,tbl_enrollment d
                                    WHERE b.sy_id=$syid AND c.sec_id=$sec_id AND d.sec_id=$sec_id AND d.std_id=a.std_id AND d.sy_id=$syid
                                    ORDER BY a.std_lastname ASC
            ");
            $data['result'] = $sql->result();   
          
            $sql_cur_sec = $this->db->query("
                                                SELECT * from tbl_sections 
                                                WHERE 
                                                grd_id=(
                                                        SELECT grd_id FROM tbl_sections 
                                                        WHERE 
                                                        sec_id=$sec_id
                                                )
           ");
           $data['same_sections'] = $sql_cur_sec->result();
           
           
           $sql_sy = $this->db->query("
                                        SELECT * FROM tbl_sy
                                        WHERE
                                        sy_id=(
                                                SELECT sy_id FROM tbl_sections
                                                WHERE
                                                sec_id=$sec_id
                                        )
           ");
           $data['sy'] = $sql_sy->result();
           
           $sql_secname = $this->db->get_where('tbl_sections', array('sec_id'=>$sec_id));
           $data['secname'] = $sql_secname->result();
           
        } else {
            
        }
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/enrolledstudents_view',$data);
    }
    #End of Sections
    
    
    #Start of subjects
    public function subjects() {
        $this->General_queries->is_registrar();
        $curr_sy = $this->__fetch_curr_sy();
    
        #FETCH GRADE LEVELS FOR CURRENT SCHOOL YEAR
        $this->db->where('sy_id',$curr_sy[0]->sy_id);
        $this->db->order_by('(grd_year)+0','ASC');
        $query = $this->db->get('tbl_grade_lvl');
        $grd_lvls = $query->result();
        
        $data['sections'] = $this->__fetchsections($curr_sy[0]->sy_id, $grd_lvls[0]->grd_id);
        
        #Get exisiting sections
        $this->db->order_by('sub_name', 'ASC');
        $query = $this->db->get_where('tbl_subjects',array('sy_id'=>$curr_sy[0]->sy_id,'grd_id'=>$grd_lvls[0]->grd_id,'sec_id'=>$data['sections'][0]->sec_id));
        $data['subjects'] = $query->result();
        
        $data['sys'] = $this->__fetch_sys();
        $data['cursy'] = $curr_sy;
        $data['lvls'] = $grd_lvls;
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/subjects_view',$data);
    }
    
    public function sv_subjects() {
        $this->General_queries->is_registrar();
        $sid = $this->input->post('syid');
        $gid = $this->input->post('grid');
        $secid = $this->input->post('seid');
        $subjects = $this->input->post('subjects');
        $stack =array();
        $sub_arr =array();
        
        $ind_subjects_arr = explode("\n", $subjects);
        $clean_array = array_unique($ind_subjects_arr);
        
        $query = $this->db->get_where('tbl_subjects',array('sy_id'=>$sid,'grd_id'=>$gid,'sec_id'=>$secid));
        $result = $query->result();
        $num_res = $query->num_rows();
        
        for($x=0; $x < $num_res; $x++) {
            array_push($sub_arr, strtolower($result[$x]->sub_name));
        }
        
        #print_r($array);
       
        foreach($clean_array as $content) {
            $content = trim($content);
            $to_lower = strtolower($content);
            if(! in_array($to_lower, $sub_arr)){
                $d_array = array(
                    'sy_id'=>$sid,
                    'grd_id'=>$gid,
                    'sec_id'=>$secid,
                    'sub_name'=>$content
                );
                $this->db->insert('tbl_subjects',$d_array);
                $aff_rows = $this->db->affected_rows();
                if($aff_rows > 0) {
                    array_push($stack, "<strong>". $content . '</strong> - <span style="color:#468847">Successfully added</span>');
                } else {
                    array_push($stack,  "<strong>".$content . '</strong> - <span style="color:#B94A48">Was not added</span>');
                }
            } else {
                array_push($stack,  "<strong>".$content . '</strong> - <span style="color:#B94A48">Already exist</span>');
            }
        }
        echo implode('<br />', $stack);
    }
    
    public function fetch_subjects() {
        $this->General_queries->is_registrar();
        $sid = $this->input->post('syid');
        $gid = $this->input->post('grid');
        $secid = $this->input->post('seid');
        
        $this->db->select('sub_id as uid, sub_name as subject');
        $this->db->order_by('sub_name', 'ASC');
        $query = $this->db->get_where('tbl_subjects',array('sy_id'=>$sid,'grd_id'=>$gid,'sec_id'=>$secid));
        
        echo json_encode($query->result());
    }
    
    public function rmsubj() {
        $this->General_queries->is_registrar();
        $id = $this->input->post('subjid');
        
        if(! empty($id) && is_numeric($id)) {
            $this->db->where('sub_id', $id);
            $this->db->delete('tbl_subjects');
            $aff_rows = $this->db->affected_rows();
            
            if($aff_rows > 0) {
                echo json_encode(array('status'=>1));
            } else {
                echo json_encode(array('status'=>0));
            }
            
        } else {
            echo json_encode(array('status'=>0));
        }
    }


    #End of subjects
    public function enrollment() {
        $this->General_queries->is_registrar();
        $curr_sy = $this->__fetch_curr_sy();
    
        #FETCH GRADE LEVELS FOR CURRENT SCHOOL YEAR
        $this->db->where('sy_id',$curr_sy[0]->sy_id);
        $this->db->order_by('(grd_year)+0','ASC');
        $query = $this->db->get('tbl_grade_lvl');
        $grd_lvls = $query->result();
        
        $data['sections'] = $this->__fetchsections($curr_sy[0]->sy_id, $grd_lvls[0]->grd_id);
        
        #FETCH NUMBER OF STUDENTS ENROLLED T DEFAULT SECTION
        $array = array(
                        'sy_id'=>$curr_sy[0]->sy_id,
                        'grd_id'=>$grd_lvls[0]->grd_id,
                        'sec_id'=>$data['sections'][0]->sec_id,
        );
        $this->db->where('sy_id',$curr_sy[0]->sy_id);
        $this->db->where('grd_id',$grd_lvls[0]->grd_id);
        $this->db->where('sec_id',$data['sections'][0]->sec_id);
        $total = $this->db->count_all_results('tbl_enrollment');
        
        $data['num_stds'] = $total;
        $data['cursy'] = $curr_sy;
        $data['lvls'] = $grd_lvls;
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/enrollment_view',$data);
    }
    
    /*Fetch Individual Data */
    public function fetch_num_enrolled(){
        $this->General_queries->is_registrar();
        $sy_data = $this->__fetch_curr_sy();
        $num_res = count($sy_data);
        
        $gid = $this->input->post('gid');
        $secid = $this->input->post('secid');
        
        if($num_res > 0 && ! empty($gid) && ! empty($secid)) {
            
            $array = array(
                        'sy_id'=>$sy_data[0]->sy_id,
                        'grd_id'=>$gid,
                        'sec_id'=>$secid,
            );
            $this->db->where('sy_id',$sy_data[0]->sy_id);
            $this->db->where('grd_id',$gid);
            $this->db->where('sec_id',$secid);
            $total = $this->db->count_all_results('tbl_enrollment');
            echo json_encode(array('num'=>$total));
           
        } else {
            #NO SY SELECTED
        }
        
    }
    
    public function fetch_idnumber() {
        $this->General_queries->is_registrar();
        $this->db->limit(5);
        $idnumber = $this->input->post('query');
        
        if(isset($idnumber)) {
            
            $array = array();
            $this->db->like('std_sch_id', $idnumber); 
            $query = $this->db->get('tbl_student_info');
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                for($x=0; $x<$num_res; $x++) {
                    $array[]=$result[$x]->std_sch_id;
                }
            } 
            echo json_encode($array);
        }
    }
    
    public function fetch_lastname() {
        $this->General_queries->is_registrar();
        $lastname = $this->input->post('query');
        
        if(isset($lastname)) {
            
            $array = array();
            $this->db->limit(5);
            $this->db->like('std_lastname', $lastname); 
            $query = $this->db->get('tbl_student_info');
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                for($x=0; $x<$num_res; $x++) {
                    $array[]=$result[$x]->std_lastname;
                }
            } 
            echo json_encode($array);
        }
    }
    
    public function fetch_middlename() {
        $this->General_queries->is_registrar();
        $middlename = $this->input->post('query');
        
        if(isset($middlename)) {
            
            $array = array();
            $this->db->limit(5);
            $this->db->like('std_middlename', $middlename); 
            $query = $this->db->get('tbl_student_info');
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                for($x=0; $x<$num_res; $x++) {
                    $array[]=$result[$x]->std_middlename;
                }
            } 
            echo json_encode($array);
        }
    }
    
    public function fetch_firstname() {
        $this->General_queries->is_registrar();
        $firstname = $this->input->post('query');
        
        if(isset($firstname)) {
            
            $array = array();
            $this->db->limit(5);
            $this->db->like('std_firstname', $firstname); 
            $query = $this->db->get('tbl_student_info');
            $result = $query->result();
            $num_res = count($result);
            
            if($num_res > 0) {
                for($x=0; $x<$num_res; $x++) {
                    $array[]=$result[$x]->std_firstname;
                }
            } 
            echo json_encode($array);
        }
    }
    
    public function fetch_student_info() {
        $this->General_queries->is_registrar();
        $id = $this->input->post('query');
        
        if(isset($id)) {
            $query = $this->db->get_where('tbl_student_info',array('std_sch_id'=>$id));
            $result = $query->result();
            $num_res = count($result);
            if($num_res > 0) {
                echo json_encode($result);
            }
        }
    }
    
    private function __check_id($std_id) {
        $query = $this->db->get_where('tbl_student_info',array('std_sch_id'=>$std_id));
        $num_res = $query->num_rows();
        
        if($num_res > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
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
    
    private function __is_enrolled($grd_id, $sec_id, $std_id) {
        
        $sy = $this->__fetch_curr_sy();
        $curr_sy = $sy[0]->sy_id;
        $query = $this->db->get_where('tbl_enrollment', array('sy_id'=>$curr_sy,'std_id'=>$std_id));
        $num_res= $query->num_rows();
        
        if($num_res > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
                
    }
    
    public function enroll_student() {
        $this->General_queries->is_registrar();
        $this->load->library('ciqrcode');
        
        $gid = $this->input->post('gid');
        $secid = $this->input->post('secid');
        $idnumber = $this->input->post('idnumber');
        $lastname = $this->input->post('lastname');
        $name_ext = $this->input->post('namext');
        $middlename = $this->input->post('middlename');
        $firstname = $this->input->post('firstname');
        #$email = $this->input->post('email');
        $address = $this->input->post('address');
        $sy = $this->__fetch_curr_sy();
        
        #CHECK IF STD ID IS ALREADY EXISITING
        if($this->__check_id($idnumber)) {
            
            $std_info = $this->__fetch_std_info($idnumber);
            
            #CHECK IF STD IS ENROLLED
            if($this->__is_enrolled($gid, $secid, $std_info[0]->std_id)) {
                echo json_encode(array('msg'=>'Student is already enrolled.'));
            } else {
                
                $filename = hash('sha512', $idnumber).".pdf";
                $data = array(
                                'sy_id'=>$sy[0]->sy_id,
                                'grd_id'=>$gid,
                                'sec_id'=>$secid,
                                'std_id'=>$std_info[0]->std_id,
                                'enr_form'=>$filename,
                                'enr_date'=>date('Y-m-d')
                );
                $this->db->insert('tbl_enrollment',$data);
                $href = '?mc=regtools&m=fetch_enrolled_now&i='.$this->db->insert_id().'&k'.random_string('alnum', 64).'&k='.random_string('alnum', 32);
                $aff_rows = $this->db->affected_rows();
                
                if($aff_rows > 0) {
                    #Student is already existing
                    $query = $this->db->query("SELECT * from tbl_grade_lvl a, tbl_sections b 
                                                WHERE b.grd_id=a.grd_id and b.sec_id='$secid'
                    ");
                    $result = $query->result();
                    
                    $params['data'] = 'Website:'.base_url()."\nUsername :".$idnumber ."\nPassword:";
                    $form = '
                        <p align="center"><strong>Enrollment Form for School Year '.
                            date('Y',strtotime($sy[0]->sy_from)).' - '.date('Y',strtotime($sy[0]->sy_to)).'</strong>
                        </p>
                        <p><strong>Name: </strong>'.$firstname.' '.$middlename.' '.$lastname.' '.$name_ext.'<br />
                        <strong>Address: </strong>'.$address.'<br />
                        <strong>Grade Level & Section: </strong>'.$result[0]->grd_year.' - '.$result[0]->sec_name.'
                        <br /><br />
                        
                        <h3>Privacy Policy</h3>
                
                        <p align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at vehicula velit. Sed feugiat erat nec metus condimentum vitae dapibus turpis gravida. Nulla quis tristique libero. Ut leo sapien, cursus vel eleifend eu, lobortis faucibus elit. Donec tincidunt, nisi ut dapibus tempor, urna mauris pharetra mauris, lobortis molestie nisl nisl et massa. Etiam eget tellus ante. Nunc sem sem, iaculis vitae euismod eget, scelerisque sed magna. Suspendisse vulputate faucibus mollis.</p>

                        <p align="justify">Aenean vitae est nec dui mattis rhoncus id nec quam. Ut pretium massa quis risus tristique at vehicula risus tempus. Nulla porta, justo aliquet adipiscing commodo, tellus lacus tincidunt nunc, id aliquet ipsum lectus non leo. Etiam at mauris a tortor tempus mollis. Quisque sit amet velit id ipsum consectetur bibendum nec et ligula. Pellentesque non mauris sit amet augue volutpat congue sed nec risus. Suspendisse potenti. Nulla sed eros metus, nec congue magna.</p>

                        <p align="justify">Nulla facilisi. Nulla facilisi. Aliquam posuere, massa nec ornare vehicula, lacus mauris vehicula tellus, eget dignissim elit quam ac sem. Pellentesque imperdiet lorem nec nunc dignissim ac interdum purus auctor. Morbi tellus lectus, bibendum eget laoreet vitae, facilisis vel lorem. Sed consectetur sem nec nisi porta id malesuada lacus tristique. Ut fermentum lobortis arcu vel tempus. Vivamus magna tortor, faucibus viverra ornare sit amet, ultrices nec purus. Mauris pulvinar eros non ligula commodo id feugiat nunc placerat. Etiam dolor augue, accumsan sed vulputate vitae, vehicula sit amet libero. Morbi eget tortor ac nisi suscipit dapibus et at metus. Nunc non neque quis urna pulvinar pulvinar ac et risus. Vestibulum convallis erat tincidunt nibh venenatis viverra sit amet vitae orci. Sed semper varius eros nec rhoncus. Quisque porta malesuada lacus, vitae euismod justo dignissim vulputate. Donec quis enim enim, id tempor sem.</p><br /><br /><p>___________________<br />&nbsp;&nbsp;&nbsp;&nbsp;Registrar</p>';
                    
                    $qr_name = uniqid(); 
                    $params['size'] = 2;
                    $params['savename'] = './qrcodes/'.$qr_name.'.jpg';
                    
                    $this->ciqrcode->generate($params);
                    
                    $form .= '<p align="center"><img src="'.base_url().'/qrcodes/'.$qr_name.'.jpg" /></p>';
                    echo json_encode(array('msg'=>'Student successfully enrolled.','enrolled'=>1,'href'=>$href));
                } else {
                    echo json_encode(array('msg'=>'Failed to enroll student.','enrolled'=>0)); 
                }
            }
          
        } else {
            #CREATE AN ACCOUNT FOR THE STUDENT AND ADD HIM/HER TO THE ENROLLED LIST
            $std_password = uniqid();
            $date = date('Y-m-d H:i:s');
            
            $user_data = array(
                                'curr_std_id'=>$idnumber,
                                'curr_std_password'=>$std_password
            );
            $this->session->set_userdata($user_data);
            
            $data = array(
                            'usr_email'=>$idnumber,
                            'usr_password'=>hash('sha512', md5($date.$std_password)),
                            'usr_token'=>random_string('unique'),
                            'usr_user_type'=>'student',
                            'usr_status'=>'verified',
                            'usr_reg_date'=>mdate('%Y-%m-%d %h:%i:%s', time())
            );
            
            $this->db->insert('tbl_users', $data);
            $last_id = $this->db->insert_id();
            $aff_rows = $this->db->affected_rows();
            
            if($aff_rows > 0) {
                
                #ADD STD BASIC INFO
                $data = array(
                                'std_id'=>$last_id,
                                'std_lastname'=>$lastname,
                                'std_middlename'=>$middlename,
                                'std_firstname'=>$firstname,
                                'std_extname'=>$name_ext,
                                'std_sch_id'=>$idnumber,
                                'std_address'=>$address,
                );
                
                $this->db->insert('tbl_student_info',$data);
                $aff_rows = $this->db->affected_rows();
                
                if($aff_rows > 0) {
                    
                    $query = $this->db->query("SELECT * from tbl_grade_lvl a, tbl_sections b 
                                                WHERE b.grd_id=a.grd_id and b.sec_id='$secid'
                             ");
                    $result = $query->result();
                    
                    #ADD STD TO ENROLLED LIST
                    $filename = hash('sha512', $idnumber).".pdf";
                    $data = array(
                                    'sy_id'=>$sy[0]->sy_id,
                                    'grd_id'=>$gid,
                                    'sec_id'=>$secid,
                                    'std_id'=>$last_id,
                                    'enr_form'=>$filename,
                                    'enr_date'=>date('Y-m-d')
                    );
                    $this->db->insert('tbl_enrollment',$data);
                    $href = '?mc=regtools&m=fetch_enrolled_now&i='.$this->db->insert_id().'&k'.random_string('alnum', 64).'&k='.random_string('alnum', 32);
                    $aff_rows = $this->db->affected_rows();
                    
                    if($aff_rows > 0) {
                        
                        #Gen Form
                        $params['data'] = 'Website: '.base_url()."\nUsername :".$idnumber ."\nPassword: ".$std_password;
                        $form = '
                                <p align="center"><strong>Enrollment Form for School Year '.
                                    date('Y',strtotime($sy[0]->sy_from)).' - '.date('Y',strtotime($sy[0]->sy_to)).'</strong>
                                </p>
                                <p><strong>Name: </strong>'.$firstname.' '.$middlename.' '.$lastname.' '.$name_ext.'<br />
                                <strong>Address: </strong>'.$address.'<br />
                                <strong>Grade Level & Section: </strong>'.$result[0]->grd_year.' - '.$result[0]->sec_name.'
                                <br /><br />

                                <h3>Privacy Policy</h3>

                                <p align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at vehicula velit. Sed feugiat erat nec metus condimentum vitae dapibus turpis gravida. Nulla quis tristique libero. Ut leo sapien, cursus vel eleifend eu, lobortis faucibus elit. Donec tincidunt, nisi ut dapibus tempor, urna mauris pharetra mauris, lobortis molestie nisl nisl et massa. Etiam eget tellus ante. Nunc sem sem, iaculis vitae euismod eget, scelerisque sed magna. Suspendisse vulputate faucibus mollis.</p>

                                <p align="justify">Aenean vitae est nec dui mattis rhoncus id nec quam. Ut pretium massa quis risus tristique at vehicula risus tempus. Nulla porta, justo aliquet adipiscing commodo, tellus lacus tincidunt nunc, id aliquet ipsum lectus non leo. Etiam at mauris a tortor tempus mollis. Quisque sit amet velit id ipsum consectetur bibendum nec et ligula. Pellentesque non mauris sit amet augue volutpat congue sed nec risus. Suspendisse potenti. Nulla sed eros metus, nec congue magna.</p>

                                <p align="justify">Nulla facilisi. Nulla facilisi. Aliquam posuere, massa nec ornare vehicula, lacus mauris vehicula tellus, eget dignissim elit quam ac sem. Pellentesque imperdiet lorem nec nunc dignissim ac interdum purus auctor. Morbi tellus lectus, bibendum eget laoreet vitae, facilisis vel lorem. Sed consectetur sem nec nisi porta id malesuada lacus tristique. Ut fermentum lobortis arcu vel tempus. Vivamus magna tortor, faucibus viverra ornare sit amet, ultrices nec purus. Mauris pulvinar eros non ligula commodo id feugiat nunc placerat. Etiam dolor augue, accumsan sed vulputate vitae, vehicula sit amet libero. Morbi eget tortor ac nisi suscipit dapibus et at metus. Nunc non neque quis urna pulvinar pulvinar ac et risus. Vestibulum convallis erat tincidunt nibh venenatis viverra sit amet vitae orci. Sed semper varius eros nec rhoncus. Quisque porta malesuada lacus, vitae euismod justo dignissim vulputate. Donec quis enim enim, id tempor sem.</p><br /><br /><p>___________________<br />&nbsp;&nbsp;&nbsp;&nbsp;Registrar</p>';

                        $qr_name = uniqid();
                        $params['size'] = 2;
                        $params['savename'] = './qrcodes/'.$qr_name.'.jpg';
                        $this->ciqrcode->generate($params);
                        $form .= '<p align="center"><img src="'.base_url().'/qrcodes/'.$qr_name.'.jpg" /></p>';
                                                
                        echo json_encode(array('msg'=>'Student is now enrolled.','enrolled'=>1,'href'=>$href));
                    } else {
                        echo json_encode(array('msg'=>'Failed to enroll student but an account was created and basic information was added.','enrolled'=>0));
                    }
                    
                } else {
                    echo json_encode(array('msg'=>'Failed to enroll student but an account was created.'));
                }
            } else {
                echo json_encode(array('msg'=>'Failed to enroll student.'));
            }
        }
        if(!empty($form))
            toPDF($form, FCPATH.'enrollmentforms/'.$filename);
    }
    
    public function fetch_enrolled_now() {
        $this->General_queries->is_registrar();
        $this->load->helper('download');
        $id=  $this->input->get('i');
        
        if(is_numeric($id) && ! empty($id)) {
        
            $sql = $this->db->query("
                                SELECT a.enr_form,b.std_sch_id 
                                FROM tbl_enrollment a, tbl_student_info b
                                WHERE
                                a.std_id=b.std_id AND a.enr_id=$id
            ");

            $result = $sql->result();

            $data = file_get_contents(FCPATH.'enrollmentforms/'.$result[0]->enr_form); // Read the file's contents
            $name = $result[0]->std_sch_id.".pdf";

            force_download($name, $data);
            return false;
        }
       
    }
    
    #Fetch Student Profile / Enrolled Students
    public function profile() {
        $this->General_queries->is_registrar();
        $cur_id = $this->input->post('proid');
        if(! empty($cur_id) && is_numeric($cur_id)) {
            $sql = $this->db->get_where('tbl_student_info',array('std_id'=>$cur_id));
            echo json_encode($sql->result());
        }
    }
    
    public function rmenrolled() {
        $this->General_queries->is_registrar();
        $cur_id = $this->input->post('id');
        
        if(! empty($cur_id) &&is_numeric($cur_id)) {
            $this->db->delete('tbl_enrollment',array('enr_id'=>$cur_id));
            $num_res = $this->db->affected_rows();
            if($num_res > 0) {
                echo json_encode(array('stats'=>1));
            } else {
                echo json_encode(array('stats'=>0));
            }
            
        } else {
            echo json_encode(array('stats'=>0));
        }
    }
    
    #Comple profile
    public function complete_info() {
        
        $this->General_queries->is_teacher_registrar();
        
        $id = $this->input->get('stdid');
        
        $sql_educ_history = $this->db->query("
                                                SELECT * FROM tbl_sy a, tbl_grade_lvl b, tbl_sections c, tbl_enrollment d
                                                WHERE 
                                                a.sy_id=d.sy_id AND b.grd_id=d.grd_id AND c.sec_id=d.sec_id AND d.std_id=$id
                                                ORDER BY d.enr_date DESC
        ");
        
        $data['educ_history'] = $sql_educ_history->result();
        $data['std_info'] = $this->__fetch_std_info($id, FALSE);
        $data['cursy']= $this->__fetch_curr_sy();
        $data['uname'] = $this->session->userdata('uname');
        $this->load->view('registrar/student/profile_view',$data);
    }
}