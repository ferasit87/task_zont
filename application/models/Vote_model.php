<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:22 AM
 */

class Vote_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function set_vote($data)                     //add new vote
    {
        $err = $this->db->insert('votes', $data);
        if ($err)
            return array('error'=>$err['message']);
        $data['id'] =  $this->db->insert_id();          // return new vote id
        return $data ;
    }
}?>