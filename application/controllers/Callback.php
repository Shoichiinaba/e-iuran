<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;
use Xendit\Invoice;

class Callback extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function callback_invoice() {

        xendit_loaded();
        $this->db->trans_begin();

        try {
            $rawRequest          = file_get_contents("php://input");
            $request             = json_decode($rawRequest, true);

            $_id                 = $request['id'];
            $_externalId         = $request['external_id'];
            $_userId             = $request['user_id'];
            $_status             = $request['status'];
            $_paidAmount         = $request['paid_amount'];
            $_paidAt             = $request['paid_at'];
            $_paymentChannel     = $request['payment_channel'];

        if (preg_match('/CT-\d+\/\d+-([A-Z]\d+)-\d+/', $_externalId, $matches)) {
            $code_rumah = $matches[1];
        } else {
            throw new Exception("Invalid external_id format");
        }

            // var_dump($id_warga);
            // exit;

            $status = '1';
            if ($_status == 'PAID') {
                $status = '2';
                $status_saldo = '1';
                $status_saldo_segel = '1';
                $status_segel = '2';
                $nominal = '200000';

                $date_convert = Carbon::parse($_paidAt);

                $date = $date_convert->format('d-m-Y');
                $time = $date_convert->format('H:i:s');

                $this->db->set('status', $status)
                         ->where('code_tagihan', $_externalId)
                         ->update('tagihan');

                $this->db->set('status_segel', $status_segel)
                            ->where('no_rumah',  $code_rumah)
                            ->where('status_segel',  '1')
                            ->update('warga');

                $this->db->set('status_saldo_segel', $status_saldo_segel)
                            ->where('code_tagihan',  $_externalId)
                            ->update('segel_meteran');

                $transfer_exists   = $this->db->get_where('transaksi', [
                    'code_tagihan' => $_externalId
                ])->num_rows();

                if ($transfer_exists === 0) {
                    $this->db->insert('transaksi', [
                        'code_tagihan' => $_externalId,
                        'foto_bukti'   => $_paymentChannel,
                        'tgl_byr'      => $date,
                        'status_saldo' => $status_saldo
                    ]);

                } else {
                    $this->db->set('foto_bukti', $_paymentChannel)
                             ->set('tgl_byr', $date)
                             ->set('status_saldo', $status_saldo)
                             ->where('code_tagihan', $_externalId)
                             ->update('transaksi');
                    }

            } else if ($_status == 'EXPIRED') {
                $status = '0';
                $this->db->where('code_tagihan', $_externalId)->delete('transaksi');
                $this->db->set('status', $status)
                         ->where(['code_tagihan' => $_externalId])
                         ->update('tagihan');
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            // var_dump($id_warga);
            // exit;

            $response = [
                'status'  => true,
                'message' => 'Permintaan Diterima',
                'detail'  => $request,
            ];

        } catch (Exception $e) {
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
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

}