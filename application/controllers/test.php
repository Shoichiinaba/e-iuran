<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceController extends CI_Controller {

    public function callback_invoice() {
        xendit_loaded();
        $this->db->trans_begin();

        try {
            require_once 'path_to_vendor/autoload.php'; // Sesuaikan path dengan lokasi autoload.php
            use Carbon\Carbon; // Impor kelas Carbon

            $rawRequest = file_get_contents("php://input");
            $request = json_decode($rawRequest, true);

            $_userId = $request['user_id'];
            $_status = $request['status'];
            $_paidAmount = $request['paid_amount'];
            $_paidAt = $request['paid_at'];
            $_paymentChannel = $request['payment_channel'];
            $_paymentDestination = $request['payment_destination'];

            $status = '1';
            if ($_status == 'PAID') {
                $status = '2';
                $date_convert = Carbon::parse($_paidAt);

                $date = $date_convert->format('m-d-Y');
                $time = $date_convert->format('H:i:s');

                $this->db->set('status', $status)
                    ->where('code_tagihan', $_externalId)
                    ->update('tagihan');

                $transfer_exists = $this->db->get_where('transaksi', [
                    'code_tagihan' => $_externalId
                ])->num_rows();

                if ($transfer_exists === 0) {
                    $this->db->insert('transaksi', [
                        'foto_bukti' => $_paymentChannel,
                        'tgl_byr' => $date,
                    ]);

                    // Update saldo pengguna
                    $this->updateUserSaldo($_userId, $_paidAmount);
                }
            } else if ($_status == 'EXPIRED') {
                $status = '3';
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
                'status' => true,
                'message' => 'Permintaan Diterima',
                'detail' => $request,
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

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    private function updateUserSaldo($userId, $amount) {
        // Ambil saldo pengguna saat ini dari database
        $currentSaldo = $this->db->get_where('saldo', ['user_id' => $userId])->row()->saldo;

        // Hitung saldo baru
        $newSaldo = $currentSaldo + $amount;

        // Update saldo pengguna di database
        $this->db->set('saldo', $newSaldo)
            ->where('user_id', $userId)
            ->update('saldo');
    }
}