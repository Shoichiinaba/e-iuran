<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function callback() {
        header('Content-Type: application/json; charset=utf-8');

        // Membaca input JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Memeriksa apakah JSON valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
            return;
        }

        // Mengambil data dari JSON
        $device  = isset($data['device']) ? $data['device'] : null;
        $id      = isset($data['id']) ? $data['id'] : null;
        $stateid = isset($data['stateid']) ? $data['stateid'] : null;
        $status  = isset($data['status']) ? $data['status'] : null;
        $state   = isset($data['state']) ? $data['state'] : null;

        // Update status dan state di database
        $this->db->trans_start();
        if (isset($id) && isset($stateid)) {
            $updateData = [
                'status' => $status,
                'state' => $state,
                'stateid' => $stateid
            ];
            $this->db->where('id', $id);
            $success = $this->db->update('report', $updateData);
        } elseif (isset($id) && !isset($stateid)) {
            $updateData = ['status' => $status];
            $this->db->where('id', $id);
            $success = $this->db->update('report', $updateData);
        } elseif (!isset($id) && isset($stateid)) {
            $updateData = ['state' => $state];
            $this->db->where('stateid', $stateid);
            $success = $this->db->update('report', $updateData);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
            return;
        }
        $this->db->trans_complete();

        // Mengirimkan respons berdasarkan hasil update
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update database']);
        } else {
            echo json_encode(['status' => 'success']);
        }
    }
}