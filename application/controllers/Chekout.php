<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Chekout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
        // $this->load->model('m_chekout');
        // $this->load->model('m_favorit');
        // $this->load->model('m_olah_data');

        // $this->load->library('form_validation');
        // $this->load->helper('form');
    }

    function show_saldo(){
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }

    function callback_invoice(){
        xendit_loaded();
        $this->db->trans_begin();
        try{
            $rawRequest = file_get_contents("php://input");
            $request = json_decode($rawRequest, true);

            $_id = $request['id'];
            $_externalId = $request['external_id'];
            $_userId = $request['user_id'];
            $_status = $request['status'];
            $_paidAmount = $request['paid_amount'];
            $_paidAt = $request['paid_at'];
            $_paymentChannel = $request['payment_channel'];
            $_paymentDestination = $request['payment_destination'];

            $status = 'Belum Bayar';
            if($_status == 'PAID'){
                $status = 'Sudah Bayar';
                $date_convert = Carbon::parse($_paidAt);

                $date = $date_convert->format('m-d-Y');
                $time = $date_convert->format('H:i:s');

                $this->db
                ->set('mode_pembayaran', $_paymentChannel)
                ->set('total_pembayaran', $_paidAmount)
                ->set('status_pembayaran', $status)
                ->where([
                    'kode_cart' => $_externalId
                ])
                ->update('cart');

                $transfer_exists = $this->db->get_where('bukti_transfer', [
                    'kode_pesanan' => $_externalId
                ])->num_rows();

                if($transfer_exists == 0){

                    $user = $this->db->select("cart.etd, cart.cart_user, user.nm_user")
                    ->from('cart')
                    ->join('user', 'cart.cart_user = user.id_user')
                    ->where('cart.kode_cart', $_externalId)
                    ->get()->result()[0];

                    $this->db->insert('bukti_transfer', [
                        'kode_pesanan' => $_externalId,
                        'an_pengirim' => $user->nm_user,
                        'nominal' => $_paidAmount,
                        'tgl_byr' => $date,
                        'etd_kirim' => $user->etd,
                    ]);

                }


            }else if($_status == 'EXPIRED'){
                $status = 'Sudah Kadaluarsa';
                $this->db->set('status_pembayaran', $status)
                ->where(['kode_cart' => $_externalId])
                ->update('cart');
            }
            if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
            }else{
                    $this->db->trans_commit();
            }
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'message' => 'Get Request Active',
                'detail' => $request,
            ]));
        }catch(Exception $e) {
            $this->db->trans_rollback();
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'errors' => [
                    'message' => $e->getMessage(),
                    'type' => 'input',
                ],
                'detail' => [],
            ]));
        }

    }

    function create_invoice(){
        xendit_loaded();
        $this->db->trans_begin();
        try {
            $action = $this->input->post('action');
            $data_user = $this->session->userdata("id_user");
            $name_user = $this->session->userdata('nm_user');
            $mail_user = $this->session->userdata('gmail');
            $kontak = $this->session->userdata('kontak');

            $id_favorit = $this->input->post('id');
            $kode_chekout = 'invoice_'.$data_user.Carbon::now()->format('YmdHis');

            $data_favorit = array(
                'user' => $this->session->userdata("id_user"),
                'produk' => $this->input->post('id_produk'),
                'foto_favorit' => $this->input->post('id_foto'),
                'size' => $this->input->post('size'),
                'hrg_favorit' => $this->input->post('id_hrg'),
                'qty' => $this->input->post('qty'),
                'kode_chekout' => $kode_chekout,
                'status_favorit' => 'chekout',

            );
            $data_cart = array(
                'kode_cart' => $kode_chekout,
                'cart_user' => $data_user,
                'tgl_pembayaran' => $this->input->post('tgl_bayar'),
                'jam_pembayaran' => $this->input->post('jam_bayar'),
                'mode_pembayaran' => $this->input->post('nm_bayar'),
                'no_pembayaran' => $this->input->post('no_bayar'),
                'total_produk' => $this->input->post('total_produk'),
                'total_barang' => $this->input->post('total_barang'),
                'berat' => $this->input->post('berat'),
                'kurir' => $this->input->post('kurir'),
                'pelayanan' => $this->input->post('pelayanan'),
                'etd' => $this->input->post('etd'),
                'ongkir' => $this->input->post('ongkir'),
                'subtotal' => $this->input->post('subtotal'),
                'total_pembayaran' => $this->input->post('total_bayar'),
                'status_pembayaran' => 'Belum Bayar',
            );

            $param_invoice = [
                'external_id' => $kode_chekout,
                'amount' => $data_cart['total_pembayaran'],
                'description' => 'Invoice',
                'invoice_duration' => 86400,
                'customer' => [
                    'given_names' => $name_user,
                    'email' => $mail_user,
                    'mobile_number' => $kontak,
                ],
            ];

            $createInvoice = Invoice::create($param_invoice);

            $dateConvert = Carbon::parse($createInvoice['expiry_date']);

            $data_cart['no_pembayaran'] = $createInvoice['id'];
            $data_cart['tgl_pembayaran'] = $dateConvert->format('m-d-Y');
            $data_cart['jam_pembayaran'] = $dateConvert->format('H:i:s');
            $data_cart['mode_pembayaran'] = null;
            $data_cart['url_invoice'] = $createInvoice['invoice_url'];

            $this->m_chekout->m_simpan_pesanan($id_favorit, $kode_chekout, $data_cart, $action, $data_favorit);

            if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
            }else{
                    $this->db->trans_commit();
            }

            return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'message' => 'Pesanan berhasil dibuat',
                'detail' => $createInvoice,
            ]));

        } catch (\Xendit\Exceptions\ApiException $e) {
            $this->db->trans_rollback();
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'errors' => [
                    'message' => $e->getMessage(),
                    'type' => 'xendit',
                ],
                'detail' => [],
            ]));
        }catch(Exception $e) {
            $this->db->trans_rollback();
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'errors' => [
                    'message' => $e->getMessage(),
                    'type' => 'input',
                ],
                'detail' => [],
            ]));
        }

    }

    function cek_ongkir()
    {
        $data['_view'] = 'cek_ongkir/cek_ongkir';
        $data['_script'] = 'cek_ongkir/cek_ongkir_js';
        $this->load->view('cek_ongkir/cek_ongkir', $data);
    }
    function data_addtocart_detail()
    {
        $data['_view'] = 'layout/data_modal/addtocart_detail';
        $this->load->view('layout/data_modal/addtocart_detail', $data);
    }
    function data_addtocart_favorit()
    {
        $data['_view'] = 'layout/data_modal/addtocart_favorit';
        $data['foto_produk'] = $this->m_olah_data->m_list_foto_produk();
        $data['data_favorit'] = $this->m_favorit->m_data_favorit();
        // $this->load->view('layout/modal/favorit/data_favorit', $data);
        $this->load->view('layout/data_modal/addtocart_favorit', $data);
    }

    function addtocart()
    {
        $action = $this->input->post('action');
        $data_user = $this->session->userdata("id_user");
        $id_favorit = $this->input->post('id');
        $kode_chekout = $data_user . $this->input->post('kode_chekout');
        // echo $action;
        $data_favorit = array(
            'user' => $this->session->userdata("id_user"),
            'produk' => $this->input->post('id_produk'),
            'foto_favorit' => $this->input->post('id_foto'),
            'size' => $this->input->post('size'),
            'hrg_favorit' => $this->input->post('id_hrg'),
            'qty' => $this->input->post('qty'),
            'kode_chekout' => $kode_chekout,
            'status_favorit' => 'chekout',

        );
        $data_cart = array(
            'kode_cart' => $kode_chekout,
            'cart_user' => $data_user,
            'tgl_pembayaran' => $this->input->post('tgl_bayar'),
            'jam_pembayaran' => $this->input->post('jam_bayar'),
            'mode_pembayaran' => $this->input->post('nm_bayar'),
            'no_pembayaran' => $this->input->post('no_bayar'),
            'total_produk' => $this->input->post('total_produk'),
            'total_barang' => $this->input->post('total_barang'),
            'berat' => $this->input->post('berat'),
            'kurir' => $this->input->post('kurir'),
            'pelayanan' => $this->input->post('pelayanan'),
            'etd' => $this->input->post('etd'),
            'ongkir' => $this->input->post('ongkir'),
            'subtotal' => $this->input->post('subtotal'),
            'total_pembayaran' => $this->input->post('total_bayar'),
            'status_pembayaran' => 'Belum Bayar',
        );

        $this->m_chekout->m_simpan_pesanan($id_favorit, $kode_chekout, $data_cart, $action, $data_favorit);
        // $this->m_chekout->m_simpan_pesanan($action);

        // echo 1;
        exit;
    }

    function vali_pesanan()
    {
        $data['_view'] = 'olah_data/vali_pesanan';
        $data['vali_pesanan'] = $this->m_chekout->m_vali_pesanan();
        $this->load->view('olah_data/vali_pesanan', $data);
    }
    function detail_vali_pesanan()
    {
        $data['_view'] = 'olah_data/detail_vali_pesanan';
        $this->load->view('olah_data/detail_vali_pesanan', $data);
    }

    function acc_pesanan()
    {
        $kode_cart = $this->input->post('kode-cart');
        $jam_kirim = $this->input->post('jam-kirim');
        $etd_kirim = $this->input->post('etd-kirim');
        $no_resi = $this->input->post('no-resi');
        $ket_tolak = $this->input->post('ket-tolak');
        $status_pembayaran = $this->input->post('status-pembayaran');
        $this->m_chekout->m_acc_pesanan($kode_cart, $status_pembayaran, $jam_kirim, $etd_kirim, $no_resi, $ket_tolak);
    }
    function hapus_data_pesanan()
    {
        $kode_pesanan = $this->input->post('kode-pesanan');
        $foto_bukti = $this->input->post('foto-bukti');
		unlink('./upload/bukti_transfer/' . $foto_bukti);
        $this->m_chekout->m_hapus_data_pesanan($kode_pesanan);
    }

    function notif_vali_pesanan()
    {
        $sql = "SELECT * FROM cart WHERE status_pembayaran = 'Sudah Bayar' OR status_pembayaran = 'Dikemas'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        } else {
        }
        echo json_encode($query->num_rows());
?>
<script>
if (<?= $query->num_rows(); ?> == '0') {
    $('.notif-pesanan').text('');
} else {
    // $('.notif-pesanan').removeAttr('hidden', true);
}
</script>
<?php
    }
    function notif_pesanan_dikirim()
    {
        $sql = "SELECT * FROM cart WHERE status_pembayaran = 'Dikirim'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        } else {
        }
        echo json_encode($query->num_rows());
    ?>
<script>
if (<?= $query->num_rows(); ?> == '0') {
    $('.notif-pesanan_dikirim').text('');
} else {
    // $('.notif-pesanan').removeAttr('hidden', true);
}
</script>
<?php
    }
    function pesanan_dikirim()
    {
        $data['_view'] = 'olah_data/pesanan_dikirim';
        $data['pesanan_dikirim'] = $this->m_chekout->m_pesanan_dikirim();
        $this->load->view('olah_data/pesanan_dikirim', $data);
    }

    function selesai_dikirim()
    {
        $kode_pesanan = $this->input->post('kode-pesanan');
        $this->m_chekout->m_selesai_dikirim($kode_pesanan);
        exit;
    }
    function riwayat_pesanan()
    {
        $data['_view'] = 'olah_data/riwayat_pesanan';
        $data['riwayat_pesanan'] = $this->m_chekout->m_riwayat_pesanan();
        $this->load->view('olah_data/riwayat_pesanan', $data);
    }

    function jumlah_brg_terjual()
    {
        // $data_user = $this->session->userdata("id_user");

    }
}