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
        $query = $this->db->query("SELECT id, title , ( vote_sum / vote_count ) as avg , user_id 
                                    FROM posts where vote_count > 0 ORDER BY avg DESC limit $n") ; // Query for get top n voted post
        $data = $query->result_array();
        if (count($data) == 0) return array('error'=>"there no top n ");
        foreach ($data as $k=>$item){
            $data[$k]['avg'] = intval($item['avg']) ;
        }
        return  $data ;
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
    public function set_posts($data)
    {
        foreach ($data as $item)
        {
            $this->db->insert('posts', $item);
        }
    }
    public function update_post_with_vote($datavote)                            //  update votes post after voting
    {
        $query = $this->db->query("
        WITH upd AS  (UPDATE posts SET vote_count = vote_count+1, vote_sum = vote_sum+".$datavote['value']."
        WHERE id = ".$datavote['id_post']."
        RETURNING vote_count, vote_sum) 
        SELECT * FROM upd;
        ");
        $data = $query->row_array();
        return  (round($data['vote_sum']/$data['vote_count']));            //return round  average
    }
    public function get_post($id)                                               // get post by id
    {
        $query = $this->db->get_where('posts', array('id' => $id));
        return $query->row_array();

    }
    public function get_multiuser_ip ()
    {
        $query = $this->db->query("
        WITH upd AS (select post_user_ip , user_id   from posts group by post_user_ip , user_id) 
        select post_user_ip , user_id , users.name  
        from  upd
        inner join users on users.id = upd.user_id 
        where post_user_ip in 
             (select post_user_ip
              from upd
              group by post_user_ip  
              HAVING count(post_user_ip) > 1)  
        ");
        $data = $query->result_array();
        $merrgeddata = array();
        foreach ($data as $key=>$value)
        {
            $merrgeddata[$value['post_user_ip']][]= array("name"=> $value["name"], "id" => $value["user_id"]);
        }
        return $merrgeddata ;
    }


}