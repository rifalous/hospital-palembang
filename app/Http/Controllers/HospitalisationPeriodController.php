<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outpatient;
use Carbon\Carbon;
use App\PatientExits;
use App\Level;
use App\Room;
use App\Pasien;
use App\Payment;
use DB;
use DataTables;
use Storage;
use PDF;

class HospitalisationPeriodController extends Controller
{
    public $array_dummy = [['id' => '', 'text' => '']];
    
    public function index()
    {

        return view('pages.report.hospitalisationperiode');
    }    

    public function getData(Request $request){

        $data = Payment::select(
                                            'outpatient_id',
                                            'pasien_id',
                                            'total_biaya',
                                            'sisa_tagihan',
                                            'sisa_pembayaran',
                                            'payment',
                                            'tgl_bayar'
                            )
                            ->with([
                                            'pasien',
                                            'patient_exits',
                                            'ExaminationOutpatient',
                                            'outpatient',
                                ])
                            ->whereDate('tgl_bayar', '>=', $request->start_date)
                            ->whereDate('tgl_bayar', '<=', $request->end_date)
                            ->orderBy('pasien_id')
                            ->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'details'])
            
            ->addColumn('pasien_name', function($data){
                return $data->pasien['name'];
            })

            ->editColumn("total_biaya", function ($data) {
                    return 'Rp '.number_format($data->total_biaya);
            })

            ->editColumn("sisa_tagihan", function ($data) {
                        return 'Rp '.number_format($data->sisa_tagihan);
            })

            ->editColumn("sisa_pembayaran", function ($data) {
                        return 'Rp '.number_format($data->sisa_pembayaran);
            })

            ->make(true);
    }

    public function download(Request $request)  
    {

                $hospitalisationperiode = Payment::select(
                                            'outpatient_id',
                                            'pasien_id',
                                            'total_biaya',
                                            'sisa_tagihan',
                                            'sisa_pembayaran',
                                            'payment',
                                            'tgl_bayar'
                            )
                            ->with([
                                            'pasien',
                                            'patient_exits',
                                            'ExaminationOutpatient',
                                            'outpatient',
                                ])
                            ->whereDate('tgl_bayar','>=', $request->start_date)
                            ->whereDate('tgl_bayar','<=', $request->end_date)
                            ->orderBy('tgl_bayar')
                            ->get();

        // $hospitalisationperiode = Payment::with(['pasien'])->get();

        if (!$hospitalisationperiode->isEmpty()) {
        $pdf = PDF::loadView('pdf.hospitalisationperiode', compact('hospitalisationperiode'));
        return $pdf->setPaper('a4', 'potrait')
           ->stream('Laporan Pembayaran Rawat Jalan Periode.pdf');
        } else {

        $pdf = PDF::loadHTML('<center><h5>'.'Tidak ada data'.'</h5></center>');
        return $pdf->stream();

      }


    }

}
