<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inpatient;
use Carbon\Carbon;
use App\PatientExits;
use App\Level;
use App\Room;
use App\Pasien;
use App\InpatientPayment;
use DB;
use DataTables;
use Storage;
use PDF;

class InpatientDayController extends Controller
{
    public $array_dummy = [['id' => '', 'text' => '']];
    
    public function index()
    {

        return view('pages.report.inpatient_day');
    }    

    public function getData(Request $request){

        $data = InpatientPayment::select(
                                            'examination_inpatient_id',
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
                                            'examination_inpatient'
                                ])
                            ->whereDate('tgl_bayar', $request->tgl_bayar)
                            ->orderBy('pasien_id')
                            ->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'details'])
            
            ->addColumn('inpatient.no_registrasi', function($data){
                return $data->examination_inpatient->inpatient['no_registrasi'];
            })
            
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

                $inpatient_day = InpatientPayment::select(
                                            'examination_inpatient_id',
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
                                            'examination_inpatient'
                                ])
                            ->whereDate('tgl_bayar', $request->tgl_bayar)
                            
                            ->orderBy('tgl_bayar')
                            ->get();

        // $hospitalisationday = Payment::with(['pasien'])->get();

        if (!$inpatient_day->isEmpty()) {
        $pdf = PDF::loadView('pdf.inpatient_day', compact('inpatient_day'));
        return $pdf->setPaper('a4', 'potrait')
           ->stream('Laporan Pembayaran Rawat Inap.pdf');
        } else {

        $pdf = PDF::loadHTML('<center><h5>'.'Tidak ada data'.'</h5></center>');
        return $pdf->stream();

      }


    }

    public function getInpatient(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $inpatient = Inpatient::select('id', 'no_registrasi as text')
                    ->get();
        
        return response()->json(array_merge($array, $inpatient->toArray()));


    }
}
