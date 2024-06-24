<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_warga extends CI_Model
{

    // datatables warga untuk menampilkan data warga
    // start datatables
    var $column_order = array(null, 'nama', 'rt', 'rw');
    var $column_search = array( 'warga.nama','no_rumah', 'no_hp', 'rt', 'rw', 'keterangan');
    var $order = array('id_warga' => 'ASC');

    private function _get_datatables_query($id, $role) {
        if ($role == 'Admin') {

            $this->db->select('warga.id_warga, warga.nama, warga.no_rumah, warga.no_hp, warga.keterangan, rt-rw.rt, rt-rw.rw, rt-rw.id_rtrw, perumahan.nama as perum');
            $this->db->from('warga');
            $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');

        } else if ($role == 'RT') {

            $this->db->select('warga.id_warga, warga.nama, warga.no_rumah, warga.no_hp, warga.keterangan, rt-rw.rt, rt-rw.rw, rt-rw.id_rtrw, perumahan.nama as perum');
            $this->db->from('warga');
            $this->db->join('rt-rw', 'rt-rw.id_rtrw = warga.id_rtrw');
            $this->db->join('perumahan', 'perumahan.id_perumahan = warga.id_perum');
            $this->db->where('rt-rw.id_rtrw', $id);

            $i = 0;
            foreach ($this->column_search as $warga) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($warga, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($warga, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }

    function get_datatables($id, $role) {
        $this->_get_datatables_query($id, $role);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($id,$role) {
        $this->_get_datatables_query($id, $role);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($id,$role) {
        $this->_get_datatables_query($id, $role);
        return $this->db->count_all_results();
    }
    // end datatables
    // akhir datatables warga untuk menampilkan data warga


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
                'username' => $row['username'],
                'password' => $row['password'],
                'kapling_gabungan' => $row['kapling_gabungan'],
                'role' => $row['role'],
                'foto' => $row['foto'],
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