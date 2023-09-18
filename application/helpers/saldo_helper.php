<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function calculate_saldo($saldo) {
    $totalDPP = 0;

    foreach ($saldo as $s) {
        $tax = $s->periode * $s->taxs;
        $DPP = $s->jumlah - $tax;
        $totalDPP += $DPP;
    }

    return $totalDPP;
}