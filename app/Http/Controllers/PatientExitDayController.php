<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inpatient;
use App\PatientExits;
use App\Room;
use App\Level;
use App\Pasien;
use App\System;
use DB;
use DataTables;
use Storage;

class PatientExitDayController extends Controller
{
    public function index()
    {
        return view('pages.report.pasien_exit_day');
        
    }

    public function getData(Request $request){
        
        $data = PatientExits::with(['room','pasien'])
                            ->whereDate('tgl_keluar', $request->start_date)
                            ->get();

        return DataTables::of($data)

            ->rawColumns(['option', 'details'])

            ->addColumn('pasien_name', function($data){
                return $data->pasien->name;
            })

            ->addColumn('pasien_gender', function($data){
                return $data->pasien->details->gender;
            })

            ->addColumn('pasien_address', function($data){
                return $data->pasien->details->address;
            })

            ->addColumn('pasien_age', function($data){
                return $data->pasien->details->age;
            })
            
            ->addColumn('room_name', function($data){
                return $data->room->name;
            })

            ->addColumn('room_class', function($data){
                return $data->room->level->class;
            })

            ->make(true);
    }

    public function download(Request $request)  
    {

            $pasien_exit= PatientExits::with(['room','pasien'])
                            ->whereDate('tgl_keluar', $request->start_date)
                            ->get();

        // $hospitalisationperiode = Payment::with(['pasien'])->get();

        if (!$pasien_exit->isEmpty()) {
        $pdf = PDF::loadView('pdf.pasien_exit', compact('pasien_exit'));
        return $pdf->setPaper('a4', 'potrait')
           ->stream('Laporan Pasien Keluar Perhari.pdf');
        } else {

        $pdf = PDF::loadHTML('<center><h5>'.'Tidak ada data'.'</h5></center>');
        return $pdf->stream();

      }


    }
}
