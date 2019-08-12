<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outpatient;
use App\PatientExits;
use App\Pasien;
use App\Payment;
use App\System;
use App\ExaminationOutpatient;
use App\ExaminationOutpatientData;
use App\ExaminationOutpatientDetail;
use DB;
use DataTables;
use Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->wantsJson()) {

        //     $payments= Payment::with(['room','pasien','patient_exits'])->get();

        //     return response()->json($payments);
        // }
        return view('pages.payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $rooms = Room::get();
        $pasiens = Pasien::get();
        // $inpatients = Inpatient::get();
        $payments = System::configMultiply('payment');
        $discounts = System::configMultiply('discount');

        return view('pages.payment.create', compact(['rooms','pasiens','inpatients','payments','discounts']));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function() use ($request){

            $payment                    = new Payment;
            $payment->outpatient_id     = $request->outpatient_id;
            $payment->pasien_id         = $request->pasien_id;
            $payment->total_biaya       = $request->total_biaya;
            $payment->sisa_tagihan      = $request->sisa_tagihan;
            $payment->jumlah_dibayar    = $request->jumlah_dibayar;
            $payment->tgl_bayar         = $request->tgl_bayar;
            $payment->diskon            = $request->diskon;
            $payment->discount          = $request->discount;
            $payment->sisa_pembayaran   = $request->sisa_pembayaran;
            $payment->payment           = $request->payment;
            $payment->address           = $request->address;
            $payment->ket               = $request->ket;
            $payment->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('payment')
                    ->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $rooms = Room::get();
        $pasiens = Pasien::get();
        $outpatients = Outpatient::get();
        $payments = System::configMultiply('payment');
        $discounts = System::configMultiply('discount');
        $payment = Payment::find($id);

        return view('pages.payment.edit', compact(['rooms','payment','pasiens','outpatients','payments','discounts']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){

            $payment                    = Payment::find($id);
            $payment->outpatient_id     = $request->outpatient_id;
            $payment->pasien_id         = $request->pasien_id;
            $payment->total_biaya       = $request->total_biaya;
            $payment->sisa_tagihan      = $request->sisa_tagihan;
            $payment->jumlah_dibayar    = $request->jumlah_dibayar;
            $payment->tgl_bayar         = $request->tgl_bayar;
            $payment->diskon            = $request->diskon;
            $payment->discount          = $request->discount;
            $payment->sisa_pembayaran   = $request->sisa_pembayaran;
            $payment->payment           = $request->payment;
            $payment->address           = $request->address;
            $payment->ket               = $request->ket;
            $payment->save();
            

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('payment')
                    ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //true
        $vocation = Payment::whereIn('id', $request->id)->delete();
        $res = [  
                'title' => 'Berhasil',
                'type' => 'success',
                'message' => count($request->id). 'Data berhasil dihapus!'
                ];

        return response()->json($res);
    }

    public function getData(){
       
        $data = Payment::select(
                                            'outpatient_id',
                                            'id',
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
                            // ->whereDate('tgl_bayar', '>=',$request->start_at)
                            ->orderBy('tgl_bayar')
                            ->get();
        return DataTables::of($data)

            ->rawColumns(['option', 'details']) 

            ->addColumn('option', function($data) {

                return '<div class="checkbox">
                            <input type="checkbox" name="rowcheck[]" value="'.$data->id.'">
                            <label></label>
                        </div>';

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

    public function getOutpatient(Request $request)
    {
        $array = [['id' => '', 'text' => '']];
        $outpatient = Outpatient::select('id', 'no_registrasi as text')
                    ->get();
        
        return response()->json(array_merge($array, $outpatient->toArray()));


    }

    public function getOutpatientId($outpatient_id) {
        $examination_outpatient = ExaminationOutpatient::with(['outpatient','pasien','doctor'])->findOrFail($outpatient_id);
        return response()->json($examination_outpatient);
    }


    
}
