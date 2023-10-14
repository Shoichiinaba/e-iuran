<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_iuran extends CI_Model
{

    public function get_iuran($id_rtrw, $role)
    {
        if ($role == 'Admin') {
            $this->db->select('*, nama_iuran.nama');
            $this->db->from('iuran');
            $this->db->join('nama_iuran', 'nama_iuran.id_iuran = iuran.id_iuran');
            $query = $this->db->get();
            return $query->result();

        } else if ($role == 'RT') {

            $this->db->select('*, nama_iuran.nama');
            $this->db->from('iuran');
            $this->db->join('nama_iuran', 'nama_iuran.id_iuran = iuran.id_iuran');
            $this->db->where('id_rtrw', $id_rtrw);
            $query = $this->db->get();
            return $query->result();
        }


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

    public function get_nama_iuran()
    {
        $this->db->select('*');
        $this->db->from('nama_iuran');
        $query = $this->db->get();
        return $query->result();

    }

    public function insert_nama($data)
    {
        $this->db->insert_batch('nama_iuran', $data);
        return $this->db->affected_rows();
    }

    function hapus_nama($params ='')
    {
        $sql = "DELETE  FROM nama_iuran WHERE id_iuran = ? ";
        return $this->db->query($sql, $params);
    }

    function edit_nama($id_iuran,$troop_)
    {
        $this->db->where('id_iuran', $id_iuran);
        $this->db->update('nama_iuran', $troop_);
    }

}