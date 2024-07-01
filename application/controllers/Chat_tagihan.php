<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Xendit\Invoice;

class Chat_tagihan extends AUTH_Controller
{
    var $template = 'templates/index';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_chat');
        $this->load->model('M_dashboard');

    }

    // xendit
    function show_saldo(){
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $id_rtrw = $this->session->userdata('userdata')->id_rtrw;
        // $id_wrga = $this->session->userdata('userdata')->id_warga;
        $id_warga = $this->input->get('id');

        $data['menunggu']       = $this->M_dashboard->jumlah_byr($id_rtrw);
        $data['harus_segel']    = $this->M_chat->data_segel($id_rtrw);
        $data['tersegel']       = $this->M_chat->data_tersegel($id_rtrw);
        $data['buka_segel']     = $this->M_chat->data_buka($id_rtrw);
        $data['content']        = 'page/chat_tagihan';
        $this->load->view($this->template, $data);
    }


    function get_datachat() {
        $id = $this->session->userdata('userdata')->id_rtrw;
        $filter_segel = $this->input->post('status_segel');

        $list = $this->M_chat->get_datatablest($id, $filter_segel);
        $data = array();
        $no = @$_POST['start'];
        $totalNominal = 0;


        foreach ($list as $trx) {

            $status = ($trx->status == 0) ? '<td class="font-weight-medium"><div class="badge badge-danger">Belum Bayar</div></td>' : ($trx->status == 2 ? '<td class="font-weight-medium"><div class="badge badge-success">Lunas</div></td>' : '<td class="font-weight-medium"><div class="badge badge-info">Status Lain</div></td>');
            $periode_tagihan = $this->M_chat->count_tagihan_by_warga($trx->id_warga, $id);
            $nominal_tagihan = $this->M_chat->count_tagihan_nominal($trx->id_warga, $id);
            $Rp_total = 'Rp. ' . number_format($nominal_tagihan, 0, ',', '.');

            $tagihan_by_bulan = $this->M_chat->count_tagihan_bulan($trx->id_warga, $id);
            $bulan_array = array_keys($tagihan_by_bulan);
            $bulan = implode(", ", $bulan_array);

            // tombol WA
            $whatsappUrl = 'https://api.whatsapp.com/send?phone=' . $trx->no_hp . '&text=Halo%20Pak / Ibu %20' . $trx->nama . ',%20Mohon maaf Kami dari pengelola Bukit Permai%20'.',%20Memberitahukan Bahwa Bapak/Ibu%20'.',%20Memiliki Tagihan Iuran Sebanyak%20' . $periode_tagihan . '%20Bulan%20' .'%20Yaitu di Bulan%20'. $bulan . '%20Sebesar %20'.$Rp_total .',%20Silahkan melakukan pembayaran melalui link dibawah ini%3F%0A'.'https://hi-care.id/.' . '%0AMeteran akan di Blokir jika tunggakan pembayaran melebihi 2 Bulan%3F%0A'.'%20 Trimakasih%3F%0A';
            $whatsappButton = '<a href="' . $whatsappUrl . '" class="btn btn-xs rounded-4 pr-1" data-bs-toggle="tooltip" title="Chat via WhatsApp" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="30px" clip-rule="evenodd"><path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98 c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"/><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636 C5.389,30.63,4.526,27.33,4.528,23.98C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713 c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589 C4.953,43.798,4.911,43.803,4.868,43.803z"/><path fill="#c1f5ea" d="M24.014,42.974L24.014,42.974L24.014,42.974 M24.014,42.974L24.014,42.974L24.014,42.974 M24.014,4 L24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622L3.903,43.04 c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54 c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135 C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"/><path fill="#00b569" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774 c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006 c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"/><path fill="#c1f5ea" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82 c-0.277-0.012-0.593-0.011-0.909-0.011s-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956s1.7,4.59,1.937,4.906 s3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255 c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543 c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119 c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968 c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831 C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"/></svg></i></a>';

            // Tombol segel
            $segelButton = '<div class="col-md-4 col-sm-6 justify-content-center ml-0 pl-0 mt-1">';
                            if ($trx->status_segel == 0 && $periode_tagihan > 2) {
                                $segelButton .= '<button class="btn btn-outline-warning pt-1 pb-1 btn-segel" onclick="segel_meteran(' . $trx->id_warga . ')"><i class="fa fa-eye-slash"></i> Segel</button>';
                            } elseif ($trx->status_segel == 2) {
                                $segelButton .= '<button class="btn btn-outline-success btn-buka-custom" onclick="buka_segel(' . $trx->id_warga . ')"><Buka class="fa fa-unlock btn-icon-prepend"> Buka Segel</button>';
                            } elseif ($trx->status_segel == 1) {
                                $segelButton .= '<button class="btn btn-outline-danger pt-1 pb-1 btn-custom"><i class="fa fa-lock btn-icon-prepend"></i>Tersegel</button>';
                            }
            $segelButton .= '</div>';

            // status WA
            $status_wa = '<div class="col-md-12 col-lg-12 col-sm-12 justify-content-center ml-0 pl-0 mt-1">';
                            if ($trx->state == 'sent') {
                                $status_wa .= '<svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.53033 12.9697C4.23744 12.6768 3.76256 12.6768 3.46967 12.9697C3.17678 13.2626 3.17678 13.7374 3.46967 14.0303L7.96967 18.5303C8.26256 18.8232 8.73744 18.8232 9.03033 18.5303L20.0303 7.53033C20.3232 7.23744 20.3232 6.76256 20.0303 6.46967C19.7374 6.17678 19.2626 6.17678 18.9697 6.46967L8.5 16.9393L4.53033 12.9697Z" fill="#212121"/></svg> Sent';
                            } elseif ($trx->state == 'delivered') {
                                $status_wa .= '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><polyline points="465 127 241 384 149 292" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/><line x1="140" y1="385" x2="47" y2="292" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/><line x1="363" y1="127" x2="236" y2="273" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/></svg> Delivered';
                            } elseif ($trx->state == 'read') {
                                $status_wa .= '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512"><polyline points="465 127 241 384 149 292" style="fill:none;stroke:#00C3FF;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/><line x1="140" y1="385" x2="47" y2="292" style="fill:none;stroke:#00C3FF;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/><line x1="363" y1="127" x2="236" y2="273" style="fill:none;stroke:#00C3FF;stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px"/></svg> Read';
                            }
            $status_wa .= '</div>';

            $jml_chat = '<td class="pr-0 text-right">';
            $jml_chat .= '<div class="badge badge-pill badge-success">'.$trx->jumlah_chat.'<i class="ti-email ms-2"></i></div>';
            $jml_chat .= '</td>';


            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $trx->nama . ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info">' . $trx->no_rumah . '</div></td>';
            $row[] = $periode_tagihan . " Bulan";
            $row[] = $bulan;
            $row[] = $Rp_total;
            $row[] = $status;
            $row[] = '<div class="d-flex">' . $whatsappButton . $segelButton . '</div>';
            $row[] = $status_wa;
            $row[] = $jml_chat;

            $data[] = $row;

            $totalNominal += $nominal_tagihan;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($totalNominal, 0, ',', '.');

        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->M_chat->count_all_trx(),
                    "recordsFiltered" => $this->M_chat->count_filtereds($id, $filter_segel),
                    "data" => $data,
                    "totalNominal" => $totalNominalFormatted
                );

        echo json_encode($output);
    }

    public function updateSegelStatus()
    {
        $id_warga = $this->input->post('id_warga');
        $updated = $this->M_chat->segel($id_warga);

        if ($updated) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false);
        }
        echo json_encode($response);
    }

    public function bukaSegel()
    {
        $id_warga = $this->input->post('id_warga');
        $updated = $this->M_chat->buka_segel($id_warga);

        if ($updated) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false);
        }
        echo json_encode($response);
    }

    public function API_wa()
    {
        $token = "EzKKqF+#joMYXgdCJmEh";
        $id = $this->session->userdata('userdata')->id_rtrw;
        $data_warga = $this->M_chat->get_data_warga($id);

        $success_count = 0;
        $fail_count = 0;

        foreach ($data_warga as $trx) {
            $target = $trx->no_hp;
            $nama = $trx->nama;
            $no_rumah = $trx->no_rumah;
            $id_warga = $trx->id_warga;

            $periode_tagihan = $this->M_chat->count_tagihan_by_warga($id_warga, $id);
            $nominal_tagihan = $this->M_chat->count_tagihan_nominal($id_warga, $id);
            $Rp_total = 'Rp. ' . number_format($nominal_tagihan, 0, ',', '.');

            $tagihan_by_bulan = $this->M_chat->count_tagihan_bulan($id_warga, $id);
            $bulan_array = array_keys($tagihan_by_bulan);
            $bulan = implode(", ", $bulan_array);

            $message = "Assalamualaikum Bapak / Ibu $nama Di Blok $no_rumah, Mohon maaf Kami dari pengelola Bukit Permai (Hi-care), Memberitahukan Bahwa Bapak/Ibu Memiliki Tagihan Iuran Iuran Sebanyak $periode_tagihan Bulan, Yaitu di Bulan $bulan , sebesar $Rp_total .
            Silahkan melakukan pembayaran melalui link dibawah ini https://hi-care.id/. Meteran akan di Blokir jika tunggakan pembayaran melebihi 2 Bulan Trimakasih Atas Perhatiannya";

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => $message,
                    'delay' => '2',
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($response, true);

            if ($res && isset($res['id']) && is_array($res['id'])) {
                foreach ($res['id'] as $k => $v) {
                    $target = $res["target"][$k];
                    $status = $res["process"];

                    $existing_report = $this->db->get_where('report', ['target' => $target])->row();
                    if ($existing_report) {
                        $this->db->where('target', $target);
                        $this->db->update('report', [
                            'id' => $v,
                            'id_warga' => $id_warga,
                            'message' => $message,
                            'status' => $status,
                            'state' => '',
                            'jumlah_chat' => $existing_report->jumlah_chat + 1
                        ]);
                    } else {
                        $this->db->insert('report', [
                            'id' => $v,
                            'id_warga' => $id_warga,
                            'target' => $target,
                            'message' => $message,
                            'status' => $status,
                            'state' => '',
                            'jumlah_chat' => 1
                        ]);
                    }
                }
            }

            if (isset($res['status']) && $res['status'] == 'success') {
                $success_count++;
            } else {
                $fail_count++;
            }
        }

        if ($fail_count == 0) {
            echo json_encode(array('success' => true, 'message' => 'Broadcast berhasil ke semua penerima'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Broadcast gagal ke beberapa penerima'));
        }
    }


}