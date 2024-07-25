<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function formReportPembelian()
    {
        $title = 'Laporan Pembelian';
        return view('pages.report.pembelian');
    }

    public function formReportPenjualan()
    {
        $title = 'Laporan Penjualan';
        return view('pages.report.penjualan');
    }

    public function reportPembelian(Request $request)
    {

        $title = 'Laporan Pembelian';
        $from  = $request->from;
        $to    = $request->to;

        $report = new Pembelian();

        $data = $report->reportPembelian($from, $to);

        return view('pages.report.print-pembelian', compact('title', 'data', 'from', 'to'));
    }

    public function reportPenjualan(Request $request)
    {
        $title = 'Laporan Penjualan';
        $from  = $request->from;
        $to    = $request->to;

        $report = new Penjualan();

        $data = $report->reportPenjualan($from, $to);

        return view('pages.report.print-penjualan', compact('title', 'data', 'from', 'to'));
    }
}
