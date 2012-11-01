<?php
Class Invites extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function invites_total($uid) {
        $query = $this->db->query("select * from tbl_invitations a, tbl_users b where a.usr_id=".$uid." and a.inv_user=b.usr_id");
        return $query->num_rows();
    }


    public function fetch_invites($limit,$offset,$uid) {
        $data =array();
        //$this->db->limit($limit, $start);
        $query = $this->db->query("select * from tbl_invitations a, tbl_users b where a.usr_id=".$uid." and a.inv_user=b.usr_id order by b.usr_reg_date desc LIMIT $limit OFFSET $offset");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return;
    }
}
?>
