<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratoria;
use Excel;
use DataTables;
use DB;
use Storage;


class LaboratoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $laboratorias= Laboratoria::get();
            return response()->json($laboratorias);
        }
        return view('pages.laboratoria');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.laboratoria.create');
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

            $laboratoria                = new Laboratoria;
            $laboratoria->keterangan    = $request->keterangan;
            $laboratoria->harga         = $request->harga;

            $laboratoria->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('laboratoria')
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
        $laboratoria = Laboratoria::find($id);
        return view('pages.laboratoria.show',compact(['laboratoria']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laboratoria = Laboratoria::find($id);
        return view('pages.laboratoria.edit',compact(['laboratoria']));   
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
       DB::transaction(function() use ($request,$id){

            $laboratoria                = Laboratoria::find($id);
            $laboratoria->keterangan    = $request->keterangan;
            $laboratoria->harga         = $request->harga;

            $laboratoria->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('laboratoria')
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

            $laboratoria = Laboratoria::find($id);
            $laboratoria->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('action')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $laboratoria = Laboratoria::get();

        return DataTables::of($laboratoria)

        ->rawColumns(['options'])

        ->addColumn('options', function($laboratoria){
            return '
                <a href="'.route('laboratoria.edit', $laboratoria->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$laboratoria->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('laboratoria.destroy', $laboratoria->id).'" method="POST" id="form-delete-'.$laboratoria->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }
}
