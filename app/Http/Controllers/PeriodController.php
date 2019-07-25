<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use DB;
use DataTables;

class PeriodController extends Controller
{
public function index(Request $request)
    {
        $period = Period::get();

        if ($request->wantsJson()) {
            return response()->json($period, 200);
        }

        return view('pages.period');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $period = new Period;
        $period->name = $request->name;
        $period->value = $request->value;
        $period->save();

        if ($request->wantsJson()) {
            return response()->json($type);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect()
                ->route('period.index')
                ->with($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Park  $park
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $period = Period::find($id);
        if (empty($period)) {
            return response()->json('period not found', 500);
        }
        return response()->json($period, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $period = Period::find($id);

        if (empty($period)) {
            return response()->json('period not found', 500);
        }

        $period->name = $request->name;
        $period->value = $request->value;
        $period->save();

        if ($request->wantsJson()) {
            return response()->json($type);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('period.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $period = Period::find($id);

        if (empty($period)) {
            return response()->json('period not found', 500);
        }

        $period->delete();

        if ($request->wantsJson()) {
            return response()->json('period deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('period.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $period = Period::get();
        return DataTables::of($period)
        ->rawColumns(['options'])

        ->addColumn('options', function($period){
            return '
                <a href="'.route('period.edit', $period->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$period->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('period.destroy', $period->id).'" method="POST" id="form-delete-'.$period->id .'" style="display:none">
                    '.csrf_field().'
                    <input period="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.period.create');
    }

    public function edit($id)
    {
        $period = Period::find($id);
        return view('pages.period.edit', compact(['period']));
    }
}
