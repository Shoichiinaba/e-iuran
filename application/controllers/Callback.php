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
            $_paymentDestination = $request['payment_destination'];
            // sesion
            $userData = $this->session->userdata('userdata');
            $id_rtrw = $userData->id_rtrw;

            $status = '1';
            if ($_status == 'PAID') {
                $status = '2';

                $date_convert = Carbon::parse($_paidAt);

                $date = $date_convert->format('d-m-Y');
                $time = $date_convert->format('H:i:s');

                $this->db->set('status', $status)
                         ->where('code_tagihan', $_externalId)
                         ->update('tagihan');

                $transfer_exists   = $this->db->get_where('transaksi', [
                    'code_tagihan' => $_externalId
                ])->num_rows();

                if ($transfer_exists === 0) {
                    $this->db->insert('transaksi', [
                        'code_tagihan' => $_externalId,
                        'foto_bukti'   => $_paymentChannel,
                        'tgl_byr'      => $date,
                    ]);

                    // Update saldo pengguna
                    $this->updateUserSaldo($id_rtrw, $_paidAmount);

                } else {
                    $this->db->set('foto_bukti', $_paymentChannel)
                             ->set('tgl_byr', $_paidAt)
                             ->where('code_tagihan', $_externalId)
                             ->update('transaksi');
                    }

            } else if ($_status == 'EXPIRED') {
                $status = '0';
                $this->db->set('status', $status)
                         ->where(['code_tagihan' => $_externalId])
                         ->update('tagihan');
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

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

    private function updateUserSaldo($id_rtrw, $amount) {
        $currentSaldo = $this->db->get_where('saldo', ['id_rtrw' => $id_rtrw])->row()->saldo;

        // Hitung saldo baru
        $newSaldo = $currentSaldo + $amount;

        // Update saldo pengguna di database
        $this->db->set('saldo', $newSaldo)
            ->where('id_rtrw', $id_rtrw)
            ->update('saldo');
    }

}