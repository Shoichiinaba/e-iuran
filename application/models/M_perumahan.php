<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perumahan extends CI_Model
{

    public function get_perumahan()
    {
            $this->db->select('*');
            $this->db->from('perumahan');
            $query = $this->db->get();
            return $query->result();
    }

    public function get_perum()
    {

            $this->db->select('*');
            $this->db->from('perumahan');
            $query = $this->db->get();
            return $query->result();
    }

    public function get_code($id)
    {
            $this->db->select('*');
            $this->db->from('perumahan');
            $this->db->where('id_perumahan', $id);
            $query = $this->db->get();
            return $query->result();
    }

    function hapus_perum($params ='')
    {
        $sql = "DELETE  FROM perumahan WHERE id_perumahan = ? ";
        return $this->db->query($sql, $params);
    }

    public function insert_perumahan($data)
    {
        $this->db->insert_batch('perumahan', $data);
        return $this->db->affected_rows();
    }

    function edit($id_perumahan,$troop_)
    {
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->update('perumahan', $troop_);
    }

    // function model rt-rw

    public function get_rtrw()
    {
        $this->db->select('rt-rw.*, perumahan.nama as nama_perumahan');
        $this->db->from('rt-rw');
        $this->db->join('perumahan', 'perumahan.id_perumahan = rt-rw.id_perum');
        $this->db->order_by('id_perum');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_rtrw($data)
    {
        $this->db->insert_batch('rt-rw', $data);
        return $this->db->affected_rows();
    }

    function edit_rtrw($id_rtrw,$troop_)
    {
        $this->db->where('id_rtrw', $id_rtrw);
        $this->db->update('rt-rw', $troop_);
    }

    function hapus_rtrw($params ='')
    {
        $sql = "DELETE  FROM `rt-rw` WHERE id_rtrw = ? ";
        return $this->db->query($sql, $params);
    }

}