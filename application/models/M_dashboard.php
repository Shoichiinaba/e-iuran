<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function jumlah_blm( $id, $role)
	{
		if ($role == 'Admin') {
			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 0);
			return $this->db->count_all_results();

		} else if ($role == 'RT') {

			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 0);
			$this->db->where('id_rtrw', $id);
			return $this->db->count_all_results();
		}

	}

    public function jumlah_app( $id, $role)
	{
		if ($role == 'Admin') {

			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 1);
			return $this->db->count_all_results();

		} else if ($role == 'RT') {

			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 1);
			$this->db->where('id_rtrw', $id);
			return $this->db->count_all_results();
		}

	}

    public function jumlah_lnas( $id, $role)
	{
		if ($role == 'Admin') {

			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 2);
			return $this->db->count_all_results();

		} else if ($role == 'RT') {

			$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('tagihan.status', 2);
			$this->db->where('id_rtrw', $id);
			return $this->db->count_all_results();

		}
	}

	public function jumlah_tag( $id, $role)
	{
		if ($role == 'Admin') {

			$this->db->select('tagihan.id_tagihan, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$englishMonth = date('F', strtotime('now'));

			$monthTranslations = array(
				'January' => 'Januari',
				'February' => 'Februari',
				'March' => 'Maret',
				'April' => 'April',
				'May' => 'Mei',
				'June' => 'Juni',
				'July' => 'Juli',
				'August' => 'Agustus',
				'September' => 'September',
				'October' => 'Oktober',
				'November' => 'November',
				'December' => 'Desember'
			);

			$bulanSekarang = $monthTranslations[$englishMonth];
			$this->db->where('bln_tagihan', $bulanSekarang);
			return $this->db->count_all_results();

		} else if ($role == 'RT') {

			$this->db->select('tagihan.id_tagihan, COUNT(*) as jumlah_record');
			$this->db->from('tagihan');
			$this->db->where('id_rtrw', $id);

			$englishMonth = date('F', strtotime('now'));

			$monthTranslations = array(
				'January' => 'Januari',
				'February' => 'Februari',
				'March' => 'Maret',
				'April' => 'April',
				'May' => 'Mei',
				'June' => 'Juni',
				'July' => 'Juli',
				'August' => 'Agustus',
				'September' => 'September',
				'October' => 'Oktober',
				'November' => 'November',
				'December' => 'Desember'
			);

			$bulanSekarang = $monthTranslations[$englishMonth];
			$this->db->where('bln_tagihan', $bulanSekarang);

			return $this->db->count_all_results();
		}

	}

    public function jumlah_warga( $id, $role)
	{
		if ($role == 'Admin') {

			$this->db->select('warga.id_warga, COUNT(*) as jumlah_record');
			$this->db->from('warga');
			return $this->db->count_all_results();

		} else if ($role == 'RT') {

			$this->db->select('warga.id_warga, COUNT(*) as jumlah_record');
			$this->db->from('warga');
			$this->db->where('id_rtrw', $id);
			return $this->db->count_all_results();
		}

	}

	public function saldo($id)
	{
		$this->db->select('*');
		$this->db->from('saldo');
        $this->db->where('id_rtrw', $id);
		$query = $this->db->get();
        return $query->result();
	}

// notif warga sudah melakukan upload bukti tf
	public function jumlah_byr( $id_rtrw)
	{
		$this->db->select('tagihan.status, COUNT(*) as jumlah_record');
		$this->db->from('tagihan');
		$this->db->where('tagihan.status', 1);
        $this->db->where('id_rtrw', $id_rtrw);
    	return $this->db->count_all_results();
	}
// notif warga sudah melakukan upload bukti tf

}