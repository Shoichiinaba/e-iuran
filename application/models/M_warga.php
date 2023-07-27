<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_warga extends CI_Model
{
    public function get_total_warga($id,$role)
    {
        if ($role == 'Admin') {

            return $this->db->count_all_results('warga');

        } else if ($role == 'RT') {

            $this->db->where('id_rtrw', $id);
            $total_warga = $this->db->count_all_results('warga');
            return $total_warga;
        }

    }

    public function get_filtered_warga($limit, $offset, $order_column, $order_dir, $id, $role)
    {

        if ($role == 'Admin') {
            $this->db->select('warga.id_warga, warga.nama, warga.no_rumah, warga.no_hp, warga.keterangan, rt-rw.rt, rt-rw.rw, rt-rw.id_rtrw, perumahan.nama as perum');
            $this->db->from('warga');
            $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
            $this->db->order_by($order_column, $order_dir);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query->result();

            } else if ($role == 'RT') {

                $this->db->select('warga.id_warga, warga.nama, warga.no_rumah, warga.no_hp, warga.keterangan, rt-rw.rt, rt-rw.rw, rt-rw.id_rtrw, perumahan.nama as perum');
                $this->db->from('warga');
                $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
                $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
                $this->db->where('rt-rw.id_rtrw', $id);
                $this->db->order_by($order_column, $order_dir);
                $this->db->limit($limit, $offset);
                $query = $this->db->get();
                return $query->result();
            }

    }

    public function hapus_warga($id)
    {
        $this->db->where('id_warga', $id);
        $this->db->delete('warga');
    }

    public function insert_warga($data)
    {
        $tabel_warga = 'warga';

        $inserted_rows = 0;

        foreach ($data as $row) {
            $insert_data = array(
                'id_perum' => $row['id_perum'],
                'id_rtrw' => $row['id_rtrw'],
                'nama' => $row['nama'],
                'no_rumah' => $row['no_rumah'],
                'no_hp' => $row['no_hp'],
                'keterangan' => $row['keterangan'],
            );

            $this->db->insert($tabel_warga, $insert_data);
            $inserted_rows += $this->db->affected_rows();
        }

        return $inserted_rows;
    }

    public function get_warga()
    {
        $this->db->select('warga.id_warga, warga.id_perum, warga.nama, warga.no_rumah, warga.no_hp, warga.keterangan, rt-rw.rt, rt-rw.rw, rt-rw.id_rtrw, perumahan.nama as perum');
            $this->db->from('warga');
            $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
            $query = $this->db->get();
            return $query->result();
    }

    public function edit_warga($id_warga, $data_warga)
    {
        $this->db->where('id_warga', $id_warga);
        $this->db->update('warga', $data_warga);
    }

}