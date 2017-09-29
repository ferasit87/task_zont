<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:23 AM
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function set_user($name)                     //add new user
    {
        $data = array("name" => $name);
        $this->db->insert('users', $data);
        $data['id'] =  $this->db->insert_id();          // return new user id
        return $data ;
    }
    public function set_users($data)                     //add new users
    {
        foreach ($data as $item)
        {
            $this->db->insert('users', array("name" => $item));
        }
    }
    public function get_by_name($name = '')             // get user by name
    {
        if ($name === '')                               // return all users if not name
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('name' => $name));
        return $query->row_array();
    }
}
?>