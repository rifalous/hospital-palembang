<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inpatient;
use App\PatientExits;
use App\Level;
use App\Room;
use App\Pasien;
use App\InpatientPayment;
use App\System;
use DB;
use DataTables;
use Storage;

class InpatientPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {

            $payments= InpatientPayment::with(['room','pasien','patient_exits'])->get();

            return response()->json($payments);
        }
        return view('pages.inpatient_payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::get();
        $pasiens = Pasien::get();
        $inpatients = Inpatient::get();
        $payments = System::configMultiply('payment');
        $discounts = System::configMultiply('discount');

        return view('pages.inpatient_payment.create', compact(['rooms','pasiens','inpatients','payments','discounts']));
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

            $payment                    = new InpatientPayment;
            //$payment->no_registrasi     = $request->no_registrasi;
            $payment->pasien_id         = $request->pasien_id;
            $payment->room_id           = $request->room_id;
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

        return redirect('inpatient_payment')
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
        $rooms = Room::get();
        $pasiens = Pasien::get();
        $inpatients = Inpatient::get();
        $payments = System::configMultiply('payment');
        $discounts = System::configMultiply('discount');
        $payment = InpatientPayment::find($id);

        return view('pages.inpatient_payment.edit', compact(['rooms','payment','pasiens','inpatients','payments','discounts']));
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

            $payment                    = InpatientPayment::find($id);
            $payment->no_registrasi     = $request->no_registrasi;
            $payment->pasien_id         = $request->pasien_id;
            $payment->room_id           = $request->room_id;
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

        return redirect('inpatient_payment')
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
        $vocation = InpatientPayment::whereIn('id', $request->id)->delete();
        $res = [  
                'title' => 'Berhasil',
                'type' => 'success',
                'message' => count($request->id). ' Data Berhasil Di Hapus'
                ];

        return response()->json($res);
    }

    public function getData(){
       
        $data = InpatientPayment::with(['room','pasien','patient_exits'])->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'details'])

            ->addColumn('option', function($data) {

                return '<div class="checkbox">
                            <input type="checkbox" name="rowcheck[]" value="'.$data->id.'">
                            <label></label>
                        </div>';

            })
            
            ->addColumn('room_name', function($data){
                return $data->room['name'];
            })

            ->addColumn('pasien_name', function($data){
                return $data->pasien['name'];
            })
            
            ->addColumn('pasien_name', function($data){
                return $data->pasien['name'];
            })

            ->addColumn('pasien_gender', function($data){
                return $data->pasien->details['gender'];
            })

            ->addColumn('pasien_age', function($data){
                return $data->pasien->details['age'];
            })

            ->addColumn('disease', function($data){
                return $data->patient_exits['disease'];
            })
            

            ->make(true);
    }


    
}
