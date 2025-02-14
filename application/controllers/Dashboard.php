<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Dashboard extends AUTH_Controller
{
    var $template = 'templates/index';
    public $userdata;
    public $M_client;
    public $M_dashboard;
    public $session;
    public $input;
    public $output;
    public $upload;
    public $db;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_client');
        $this->load->model('M_dashboard');
        $this->load->model('M_transaksi');
        $this->load->helper('saldo_helper');
    }

    public function index()
    {
        $role = $this->session->userdata('userdata')->role;

        if ($role == 'Warga') {
            // LOAD PAGE DASHBOARD WARGA
            $status = 0;
            $id_warga = $this->session->userdata('userdata')->id_warga;
            $data['tagihan_air']      = $this->M_client->m_tagihan_air($id_warga, $status);
            $data['transaksi']        = $this->M_client->m_transaksi($id_warga, 1);
            // var_dump($id_warga);
            $data['biodata']          = $this->M_client->m_biodata($id_warga);
            $data['userdata']         = $this->userdata;
            $data['content']          = 'warga/dashboard';
            $this->load->view($this->template, $data);
        }elseif ($role == 'Finance') {

            // LOAD PAGE DASHBOARD FINANCE
            $status = 0;
            $id_warga                 = $this->input->get('id');

            $data['tagihan_air']      = $this->M_client->m_tagihan_air($id_warga, $status);
            $data['transaksi']        = $this->M_client->m_transaksi($id_warga, 1);
                // var_dump($id_warga);
            $data['biodata']          = $this->M_client->m_biodata($id_warga);
            $data['userdata']         = $this->userdata;
            $data['content']          = 'warga/dashboard';
            $this->load->view($this->template, $data);

        }else {
            // LOAD PAGE DASHBOARD ADMIN, RT
            $role = $this->session->userdata('userdata')->role;
            $id = $this->session->userdata('userdata')->id_rtrw;
            $id_perum = $this->session->userdata('userdata')->id_perum;
            $data['userdata']       = $this->userdata;
            $data['b_bayar']        = $this->M_dashboard->jumlah_blm($id, $role);
            $data['menunggu']       = $this->M_dashboard->jumlah_app($id, $role);
            $data['lunas']          = $this->M_dashboard->jumlah_lnas($id, $role);
            $data['jum_warga']      = $this->M_dashboard->jumlah_warga($id, $role);
            $data['tag_buat']      = $this->M_dashboard->jumlah_tag($id, $role);
            $data['get_saldo']      = $this->M_dashboard->saldo($id);

            // code saldo
            $saldo = $this->M_transaksi->get_saldo($id_perum, $id);
            $totalDPP = calculate_saldo($saldo);



            $Rp_saldo = 'Rp. ' . number_format($totalDPP, 0, ',', '.');
            $data['totalDPP'] = $Rp_saldo;
            // akhir code saldo
            $data['content']        = 'page/dashboard_v';
            $this->load->view($this->template, $data);
        }
    }

    function info()
    {
        $total = '0';
        $id_warga = $this->input->post('id_warga');

        $data['info_tunggakan'] = $this->M_client->m_info_tunggakan($id_warga);
        $data['info_konf_byr'] = $this->M_client->m_info_konf_byr($id_warga);

        foreach ($data['info_tunggakan'] as $row) {
            echo '<script>
                $(".info-tunggakan").text("' . $row->bulan . ' Bulan");
                $(".info-total-tagihan").text("Rp. ' . number_format($row->total, 0, ",", ".") . '");
            </script>';
        }

            foreach ($data['info_konf_byr'] as $row) {
                $date = $row->tgl_upload;
                // pendefinisian tanggal awal
                $tgl2 = date('d-m-Y h:i', strtotime('+1 days', strtotime($date)));
                // operasi penjumlahan tanggal sebanyak 1 hari
                echo '<input type="text" id="code-tagihan" value="' . $row->code_tagihan . '" hidden>';
                echo '<script>

                $(".info-konf-byr").text("' . $row->bulan . ' Bulan");
                $(".info-total-konf-byr").text("Rp. ' . number_format($row->total, 0, ",", ".") . '");
                if( $(".info-konf-byr").text() =="0 Bulan"){
                    tunggakan();
                    $(".count-tgl").attr("hidden", true);

                }else{
                    $(".count-tgl").removeAttr("hidden", true);
                    $(".btn-bayar").attr("data-bs-toggle", "modal").attr("data-bs-target", "#modal-bayar").val("");
                    konf_byr();
                    var end = new Date("' . preg_replace('/-/', '/', date('m-d-Y h:i', strtotime($tgl2))) . '");
                    var _second = 1000;
                    var _minute = _second * 60;
                    var _hour = _minute * 60;
                    var _day = _hour * 24;
                    var timer;
                    function showRemaining() {
                        var now = new Date();
                        var distance = end - now;
                        if (distance < 0) {
                            clearInterval(timer);
                            document.getElementById("countdown").innerHTML = "EXPIRED!";
                            // delete_tagihan();
                            return;
                        }
                        var days = Math.floor(distance / _day);
                        var hours = Math.floor((distance % _day) / _hour);
                        var minutes = Math.floor((distance % _hour) / _minute);
                        var seconds = Math.floor((distance % _minute) / _second);
                        // document.getElementById("countdown").innerHTML = days + "days ";
                        document.getElementById("countdown").innerHTML = hours + " Jam ";
                        document.getElementById("countdown").innerHTML += minutes + " Menit ";
                        document.getElementById("countdown").innerHTML += seconds + " Detik";
                    }
                    timer = setInterval(showRemaining, 1000);

                };

                </script>';
            }
    }

    function get_data_blm_bayar()
    {
        $action                = $this->input->post('action');
        $status                = $this->input->post('status');
        $id_warga              = $this->input->post('id_warga');
        $segel                 = $this->input->post('status_segel');
        $tagihan_air           = $this->M_client->m_bayar_tagihan_air($id_warga, $status);
        $no                    = 0;
        $count_air             = 0;
        $count_iuran           = 0;
        $jumlah                = 0;

        foreach ($tagihan_air['result'] as $row) {
            $id_tagihan = $row->id_tagihan;
            $ipl = $row->lain_lain;
            $no++;
            $count_air += $row->nominal;
            $count_iuran += $row->lain_lain;
            $jumlah = $row->lain_lain += $row->nominal;
            $data_jumlah = $jumlah += $row->taxs;

            echo '<tr style="background: #4b49ac;color: white;">';
            echo '    <td class="">Bulan</td>';
            echo '    <td class="">' . $row->bln_tagihan . ' / ' . $row->thn_tagihan . '</td>';
            echo '</tr>';
            echo '<tr class="tr-bg-' . $row->id_tagihan . '">';
            echo '    <td class="">IPL</td>';
            echo '    <td class="">Rp.' . number_format($ipl, 0, ',', '.') . '</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td colspan="2" class="text-center" style="background: aquamarine;font-weight: bold;color: cornflowerblue;">Rincian Penggunaan air</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td class="">Awal</td>';
            echo '    <td class="">' . $row->kubik1 . '</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td class="">Akhir</td>';
            echo '    <td class="">' . $row->kubik_in . '</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td class="">Pemakaian</td>';
            echo '    <td class="">' . $row->hasil_kubik . '</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td class="">Tarif</td>';
            echo '    <td class="">Rp.' . number_format($row->perkubik, 0, ',', '.') . '</td>';
            echo '</tr>';
            echo '<tr class="rinc-' . $row->id_tagihan . '" hidden>';
            echo '    <td class="">Abunamen</td>';
            echo '    <td class="">Rp.' . number_format($row->abunament, 0, ',', '.') . '</td>';
            echo '</tr>';
            echo '<tr class="tr-bg-' . $row->id_tagihan . '">';
            echo '    <td class="">Bayar air</td>';
            echo '    <td class="">Rp.' . number_format($row->nominal, 0, ',', '.') . ' | <a href="javascript:void(0)" type="button" class="lihat-rinc" data-id-tagihan="' . $row->id_tagihan . '">Lihat Rincian</a></td>';
            echo '</tr>';
            echo '<tr class="tr-bg-' . $row->id_tagihan . '">';
            echo '    <td class="">Biaya VA</td>';
            echo '    <td class="">Rp.' . number_format($row->taxs, 0, ',', '.') . '</td>';
            echo '</tr>';
            if ($action == 'tunggakan') {

                echo '<tr id="tr-ceklis-bayar-' . $id_tagihan . '">';
                echo '    <td class="">Jumlah </td>';
                echo '    <td class="">';
                echo '        <div class=" form-check form-check-success m-0">';
                echo '            <label class="form-check-label">';
                echo '                <input id="ceklis-bayar-' . $id_tagihan . '" type="checkbox" class="form-check-input cheklis-bayar" data-jumlah="' . $data_jumlah . '" data-segel="' . $segel . '" value="' . $row->id_tagihan . '">';
                echo '                Rp.' . number_format($data_jumlah, 0, ',', '.') . ' ';
                echo '                <i id="text-ceklis-bayar-' . $id_tagihan . '" class=" input-helper" style="color: #0090ff;cursor: pointer;">| Cheklis untuk bayar</i>';
                echo '            </label>';
                echo '        </div>';
                echo '    </td>';
                echo '</tr>';
            } elseif ($action == 'konf-byr') {
                echo '<tr>';
                echo '    <td class="">Jumlah</td>';
                echo '    <td class="">';
                echo '        <div class=" form-check form-check-success m-0">';
                echo '            <label class="form-check-label">';
                echo '                <input type="checkbox" class="form-check-input cheklis-bayar" data-jumlah="' . $data_jumlah . '" data-segel="' . $segel . '" value="' . $row->id_tagihan . '">';
                echo '                Rp.' . number_format($data_jumlah, 0, ',', '.') . '';
                echo '                <i class="input-helper" style="color: #0090ff;cursor: pointer;"></i>';
                echo '            </label>';
                echo '        </div>';
                echo '    </td>';
                echo '</tr>';
            }
        };

        if ($action == 'tunggakan') {
            if ($segel == '1') {
                $biaya_segel = '200000';
                $jumlah_tagihan        = 0;
                $total = 0;
                $counter = 0;
                $id_tagihan_ = [];
                $total_bulan = $tagihan_air['num_rows'] - 2;
                foreach ($tagihan_air['result'] as $row) {
                    $ipl = $row->lain_lain;
                    $total = $ipl += $row->taxs;
                    $jumlah_tagihan += $total;
                    $id_tagihan_[] = $row->id_tagihan;
                    if ($counter >= $total_bulan) {
                        break;
                    }

                    $total_tagihan = $jumlah_tagihan + $biaya_segel;

                    echo '<script>';
                    echo '$("#text-ceklis-bayar-' . $row->id_tagihan . '").text("");';
                    echo '$("#ceklis-bayar-' . $row->id_tagihan . '").prop("checked", true).attr("disabled", true);';
                    echo '$("#tr-ceklis-bayar-' . $row->id_tagihan . '").addClass("tr-ceklis-bayar");';
                    echo '$("#subtotal").val("' . $total_tagihan . '");';
                    echo '$("#id-tagihan").val("' . implode(',', $id_tagihan_) . '");';
                    echo '</script>';
                    $counter++;
                }
                echo '<script>';
                echo '$(".btn-bayar").attr("data-bs-toggle", "modal").attr("data-bs-target", "#modal-bayar").val("");';
                echo '</script>';
            } else {
                $total_bulan = '0';
                $total_tagihan = '0';
                echo '<script>';
                echo '$("#subtotal").val("' . $total_tagihan . '")';
                echo '</script>';
            }
        } elseif ($action == 'konf-byr') {
            $total_bulan = $no;
            $total_tagihan = number_format($count_iuran += $count_air += $row->taxs, 0, ',', '.');
            echo '<script>';
            echo '$("#code-tagihan").val("' . $row->code_tagihan . '");';
            echo '$(".cheklis-bayar").prop("checked", true).attr("disabled", true).addClass("tr-ceklis-bayar");';
            echo '</script>';
        }
        echo '<tr style="background: aliceblue; font-weight: bold;">';
        echo '    <td>Total bulan dibayar</td>';
        echo '    <td class="total-bulan">' . $total_bulan . ' Bulan</td>';
        echo '</tr>';
        if ($segel == '1') {
            echo '<tr style="background: orange; font-weight: bold;">';
            echo '    <td>Buka Segel</td>';
            echo '    <td class="segel">Rp.200.000</td>';
            echo '</tr>';
        } else {

        }

        echo '<tr style="background:#2196f345; font-weight: bold;">';
        echo '    <td>Total bayar</td>';
        echo '    <td class="total-tagihan">Rp.' . number_format($total_tagihan, 0, ',', '.') . '</td>';
        echo '</tr>';
    }

    // xendit tes saldo
    function show_saldo()
    {
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }


    function buat_pembayaran()
    {
        xendit_loaded();
        $this->db->trans_begin();

        try {

            $this->db->select("MAX(CAST(RIGHT(transaksi.code_tagihan, 4) AS UNSIGNED)) as max_kode", FALSE);
            $this->db->order_by('code_tagihan', 'DESC');
            $this->db->limit(1);

            $query_ = $this->db->get('transaksi');

            if ($query_->num_rows() > 0) {
                $data_ = $query_->row();
                $max_kode = intval($data_->max_kode) + 1;
            } else {
                $max_kode = 1;
            }

            // session
            $userData = $this->session->userdata('userdata');
            $id_warga = $userData->id_warga;
            $id_rtrw = $userData->id_rtrw;
            $id_perum = $userData->id_perum;
            $no_rumah = $userData->no_rumah;
            // akhir session

            $tgl_upload    = $this->input->post('tgl-upload');
            $tagihan       = $this->input->post('tagihan');
            $periode       = $this->input->post('periode');
            $status_segel  = $this->input->post('segel_status');
            $status        = '1';
            $tahun         = date("y");
            $bulan         = date("m");
            $id_tagihan    = explode(',', $this->input->post('id-tagihan'));

            $kode_max_ = str_pad($max_kode, 4, "0", STR_PAD_LEFT);
            $code_tagihan = sprintf("CT-%s/%s-%s-%s%s-%s", $id_perum, $id_rtrw, $no_rumah, $bulan, $tahun, $kode_max_);
            date_default_timezone_set('Asia/Jakarta');

            // var_dump($status_segel);
            // exit;


             // code xendit
            $successRedirectUrl = base_url('Dashboard/pay_success/') . $code_tagihan;
            $gagalRedirectUrl = base_url('Dashboard/pembayaran_gagal');

            $data_faktur = [
                "external_id"      => $code_tagihan,
                "description"      => "Pembayaran Tagihan $code_tagihan $userData->nama $userData->no_rumah",
                "amount"           => preg_replace('/[Rp. ]/', '', $tagihan),
                'invoice_duration' => 86400,
                // 'invoice_duration' => 120,
                'customer' => [
                    'given_names'  => $userData->nama,
                    'surname'      => $userData->no_rumah,
                    'mobile_number' => $userData->no_hp,
                ],

                'success_redirect_url' => $successRedirectUrl,
                'failure_redirect_url' => $gagalRedirectUrl,
            ];

            $createInvoice  = Invoice::create($data_faktur);
            $payment_url    = $createInvoice['invoice_url'];

            $date_convert = Carbon::parse($tgl_upload);
            $date = $date_convert->format('d-m-Y');

            $data = [
                'id_rtrw'      => $id_rtrw,
                'id_perum'     => $id_perum,
                'id_warga'     => $id_warga,
                'tgl_upload'   => $date,
                'code_tagihan' => $code_tagihan,
                'periode'      => $periode,
                'jumlah'       => preg_replace('/[Rp. ]/', '', $tagihan),
                'url_payment'  =>  $payment_url,

            ];

            $segel_saldo = [
                'code_tagihan'     => $code_tagihan,
                'nominal'          => 200000,
            ];


            $this->M_client->m_upload_transaksi($data);
            $this->M_client->m_update_tagihan($code_tagihan, $status, $id_tagihan);

            if ($status_segel == 1) {
                $segel_sal = $this->M_client->m_segel_saldo($segel_saldo);
            } else {
                $segel_sal = true;
            }

            $this->db->trans_commit();

            $response = [
                'status' => true,
                'errors' => [],
                'detail' => [
                    'redirect_url' => $payment_url,
                ],
            ];

        } catch (\Xendit\Exceptions\ApiException $e) {
            $this->db->trans_rollback();
            $response = [
                'status'       => false,
                'errors'       => [
                    'message'  => $e->getMessage(),
                    'type'     => 'xendit',
                ],
                'detail'       => [],
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = [
                'status' => false,
                'errors' => [
                    'message' => $e->getMessage(),
                    'type' => 'input',
                ],
                'detail' => [],
            ];
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function pembayaran_cash()
    {
        $this->db->select("MAX(CAST(RIGHT(transaksi.code_tagihan, 4) AS UNSIGNED)) as max_kode", FALSE);
        $this->db->order_by('code_tagihan', 'DESC');
        $this->db->limit(1);

            $query_ = $this->db->get('transaksi');

            if ($query_->num_rows() > 0) {
                $data_ = $query_->row();
                $max_kode = intval($data_->max_kode) + 1;
            } else {
                $max_kode = 1;
            }

            $tgl_byr       = $this->input->post('tgl_byr');
            $tgl_format    = date('d-m-Y', strtotime($tgl_byr));
            $tagihan       = $this->input->post('tagihan');
            $periode       = $this->input->post('periode');
            $id_warga      = $this->input->post('id_warga');
            $id_perum      = $this->input->post('id_perum');
            $id_rtrw       = $this->input->post('id_rtrw');
            $no_rumah      = $this->input->post('no_rumah');
            $status_segel  = $this->input->post('status_segel');
            $status        = '2';
            $status_saldo  = '1';
            $tahun         = date("y");
            $bulan         = date("m");
            $id_tagihan    = explode(',', $this->input->post('id-tagihan'));

            $kode_max_ = str_pad($max_kode, 4, "0", STR_PAD_LEFT);
            $code_tagihan = sprintf("CSH-%s/%s-%s-%s%s-%s", $id_perum, $id_rtrw, $no_rumah, $bulan, $tahun, $kode_max_);
            date_default_timezone_set('Asia/Jakarta');

            // var_dump($status_segel);
            // exit;

            $data = [
                'id_rtrw'      => $id_rtrw,
                'id_perum'     => $id_perum,
                'id_warga'     => $id_warga,
                'tgl_upload'   => date('d-m-Y'),
                'tgl_byr'      => $tgl_format,
                'code_tagihan' => $code_tagihan,
                'periode'      => $periode,
                'jumlah'       => preg_replace('/[Rp. ]/', '', $tagihan),
                'foto_bukti'   => 'CASH',
                'status_saldo' => $status_saldo,

            ];

            $segel_saldo = [
                'code_tagihan'          => $code_tagihan,
                'nominal'               => 200000,
                'status_saldo_segel'    => 1,
            ];

            $result_trx = $this->M_client->m_upload_transaksi($data);
            $result_tag = $this->M_client->m_update_tagihan($code_tagihan, $status, $id_tagihan);
            $result_seg = $this->M_client->m_status_segel($id_warga);

            if ($status_segel == 1) {
                $segel_sal = $this->M_client->m_segel_saldo($segel_saldo);
            } else {
                $segel_sal = true;
            }

            if ($result_trx && $result_tag && $result_seg && $segel_sal) {
                $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
            }

        echo json_encode($response);
        exit;
    }

    function batal_byr()
    {
        $id_warga = $this->session->userdata('userdata')->id_warga;
        $code_tagihan = $this->input->post('code-tagihan');
        $status = '0';
        $this->M_client->m_delete_transaksi($code_tagihan);
        $this->M_client->m_update_tagihan_batal_pembayaran($code_tagihan, $status);
    }

    // function Warga
    function upload_bukti()
    {
        $code_tagihan = $this->input->post('code-tagihan');
        $status = '1';
        $config['upload_path'] = "./assets/images/bukti_tf/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload("foto-bukti")) {
            $data = array('upload_data' => $this->upload->data());
            $foto_bukti = $data['upload_data']['file_name'];
            $uploadedImage = $this->upload->data();
            // echo $header_foto;

            $this->M_client->m_update_transaksi($code_tagihan, $foto_bukti);
            $this->M_client->m_update_tagihan_pembayaran($code_tagihan, $status);
        }
        exit;
    }

    public function pembayaran_gagal()
    {
        echo "Pembayaran Gagal";
    }

    public function pay_success()
    {
        $segment3 = $this->uri->segment(3);
        $segment4 = $this->uri->segment(4);

        $code_tagihan = $segment3 . '/' . $segment4;

        // $code_tagihan = 'CT-1/2-C7-1223-0120';
        // var_dump($code_tagihan);
        // exit;

        $data['transaksi']        = $this->M_client->m_pay($code_tagihan);
        $data['userdata']         = $this->userdata;
        $data['content']          = 'warga/status_sukses';
        $this->load->view($this->template, $data);
    }

    // END function Warga
}