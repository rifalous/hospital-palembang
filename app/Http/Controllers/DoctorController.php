<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use DataTables;
use Excel;
use DB;
use Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $doctors= Doctor::get();
            return response()->json($doctors);
        }
        return view('pages.doctor');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getCodeDoctor = Doctor::getCodeDoctor();

        return view('pages.doctor.create',compact(['getCodeDoctor']));
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

            $doctor                 = new Doctor;
            $doctor->code           = $request->code;
            $doctor->nip            = $request->nip;
            $doctor->name           = $request->name;
            $doctor->address        = $request->address;
            $doctor->phone          = $request->phone;

            $doctor->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('doctor')
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
        $doctor = Doctor::find($id);
        return view('pages.doctor.show', compact(['doctor']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor          = Doctor::find($id);
        
        return view('pages.doctor.edit', compact(['doctor']));
        
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
            $doctor                 = Doctor::find($id);
            $doctor->code           = $request->code;
            $doctor->nip            = $request->nip;
            $doctor->name           = $request->name;
            $doctor->address        = $request->address;
            $doctor->phone          = $request->phone;

            $doctor->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('doctor')
                    ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id){

            $doctor = Doctor::find($id);
            $doctor->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil sihapus!'
                ];

        return redirect('doctor')
                    ->with($res);
    }

    public function export() 
    {
        $doctors = Doctor::get();

       return Excel::create('Data Dokter', function($excel) use ($doctors){
             $excel->sheet('Data Dokter', function($sheet) use ($doctors){
                 $sheet->fromArray($doctors);
             });

        })->download('csv');

    }

    public function getData(Request $request)
    {
        $doctors = Doctor::get();

        return DataTables::of($doctors)

        ->rawColumns(['options'])

        ->addColumn('options', function($doctor){
            return '
                <a href="'.route('doctor.edit', $doctor->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$doctor->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('doctor.destroy', $doctor->id).'" method="POST" id="form-delete-'.$doctor->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }
}
