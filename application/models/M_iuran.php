<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_iuran extends CI_Model
{

    public function get_iuran($id)
    {
        $this->db->select('*');
        $this->db->from('iuran');
        $this->db->where('id_rtrw', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function hapus_iuran($params ='')
    {
        $sql = "DELETE  FROM iuran WHERE id_iuran = ? ";
        return $this->db->query($sql, $params);
    }

    public function insert_iuran($data)
    {
        $this->db->insert_batch('iuran', $data);
        return $this->db->affected_rows();
    }

    function edit_iuran($id_iuran,$troop_)
    {
        $this->db->where('id_iuran', $id_iuran);
        $this->db->update('iuran', $troop_);
    }

}