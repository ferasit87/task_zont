<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:21 AM
 */

class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function get_top_n($n = 5)
    {
        $query = $this->db->query("SELECT * FROM posts ORDER BY vote_sum DESC limit $n") ; // Query for get top n voted post
        return  $query->result_array();
    }
    public function set_post($data)                                                         // add new post with needed data
    {
        $data['user_id'] = $data['user']['id'];
        unset($data['user']);
        $data['post_user_ip'] = $_SERVER['REMOTE_ADDR'];
        $this->db->insert('posts', $data);
        $data['id'] =  $this->db->insert_id();
        return $data ;
    }
    public function update_post_with_vote($datavote)                            //  update votes post after voting
    {
        $data = $this->get_post($datavote['id_post']);                          //get previous data
        $data['vote_count'] += 1;                                               //update votes count
        $data['vote_sum'] += $datavote['value'];                                //update votes sum
        $this->db->where('id', $datavote['id_post']);
        $this->db->update('posts', $data);                                      // updating
        return  (intval($data['vote_sum']/$data['vote_count']));            //get average
    }
    public function get_post($id)                                               // get post by id
    {
        $query = $this->db->get_where('posts', array('id' => $id));
        return $query->row_array();

    }



}