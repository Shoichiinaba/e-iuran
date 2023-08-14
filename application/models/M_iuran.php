<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_iuran extends CI_Model
{

    public function get_iuran($id_rtrw)
    {
        $this->db->select('*, nama_iuran.nama');
        $this->db->from('iuran');
        $this->db->join('nama_iuran', 'nama_iuran.id_iuran = iuran.id_iuran');
        $this->db->where('id_rtrw', $id_rtrw);
        $query = $this->db->get();
        return $query->result();

    }

    public function get_nama()
    {
        $this->db->select('*');
        $this->db->from('nama_iuran');
        $query = $this->db->get();
        return $query->result();

    }


    function hapus_iuran($params ='')
    {
        $sql = "DELETE  FROM iuran WHERE id = ? ";
        return $this->db->query($sql, $params);
    }

    public function insert_iuran($data)
    {
        $this->db->insert_batch('iuran', $data);
        return $this->db->affected_rows();
    }

    function edit_iuran($id,$troop_)
    {
        $this->db->where('id', $id);
        $this->db->update('iuran', $troop_);
    }

}