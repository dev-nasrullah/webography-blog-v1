<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_Model extends CI_Model
{
  public function getBlogs($id)
  {
    if ($id) {
      $this->db->where('bid', $id);
    }
    $q = $this->db->get('blogs');

    return $q->result();
  }
  public function createBlog($data)
  {
    $this->db->insert('blogs', $data);

    return $this->db->insert_id();
  }
  public function updateBlog($id, $data)
  {
    $this->db->where('bid', $id);
    $this->db->update('blogs', $data);
    return $this->db->affected_rows();
  }
  public function deleteBlog($id)
  {
    $this->db->where('bid', $id);
    $this->db->delete('blogs');
    return $this->db->affected_rows();
  }
}
