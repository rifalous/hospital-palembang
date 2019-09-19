<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MedicalRecordsController extends Controller
{
    public function index()
    {
        $data = DB::table('pasiens')
                ->join('inpatients', 'inpatients.pasien_id', '=', 'pasiens.id')
                ->join('outpatients', 'outpatients.pasien_id', '=', 'pasiens.id')
                ->select('pasiens.no_rm', 'pasiens.name', 'inpatients.no_registrasi AS inpatients_noregist', 'inpatients.tgl_masuk', 'inpatients.disease AS inpatients_disease', 'outpatients.no_registrasi AS outpatients_noregist', 'outpatients.tgl_periksa', 'outpatients.disease AS outpatients_disease')
                ->get();

        return view('pages.medical_records', compact('data'));
    }
}
