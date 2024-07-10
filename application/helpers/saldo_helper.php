<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function calculate_saldo($saldo)
{
    $totalDPP = 0;

    foreach ($saldo as $s) {
        $tax = $s->periode * $s->taxs;
        $DPP = $s->jumlah - $tax;
        $totalDPP += $DPP;
    }

    return $totalDPP;
}

function cash_saldo($saldo)
{
    $totalDPP = 0;

    foreach ($saldo as $s) {
        $tax = $s->periode * $s->taxs;
        $DPP = $s->jumlah;
        $totalDPP += $DPP;
    }

    return $totalDPP;
}

function calculate_saldo_segel($saldo_segel)
{
    $totalsaldo = 0;

    foreach ($saldo_segel as $s) {
        $totalsaldo += $s->nominal;
    }

    return $totalsaldo;
}

function depo_saldo($saldo_deposit)
{
    $totalDPP = 0;

    foreach ($saldo_deposit as $s) {
        $DPP = $s->nominal;
        $totalDPP += $DPP;
    }

    return $totalDPP;
}
