<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use DataTables;
use DB;
use Excel;
use App\Supplier;
use App\System;
use Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            
            $materials= Material::with(['supplier'])->get();
            
            return response()->json($materials);

        }
        return view('pages.material');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers  = Supplier::get();
        $types      = System::configmultiply('type');
        $groups     = System::configmultiply('group');

        return view('pages.material.create',compact(['suppliers','types','groups']));

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

            $material                 = new Material;
            $material->code           = $request->code;
            $material->name           = $request->name;
            $material->packaging      = $request->packaging;
            $material->fill_in        = $request->fill_in;
            $material->unit           = $request->unit;
            $material->minimum_stock  = $request->minimum_stock;
            $material->group          = $request->group;
            $material->type           = $request->type;
            $material->supplier_id    = $request->supplier_id;
            $material->purchase_price = $request->purchase_price;
            $material->selling_price  = $request->selling_price;
            $material->recipe_prices  = $request->recipe_prices;
            $material->profit         = $request->profit;
            $material->profit_persen  = $request->profit_persen;
            $material->expire_date    = $request->expire_date;
            // $material->last_update    = $request->last_update;
            // $material->update_by      = $request->update_by;

            $material->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('material')
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
        $suppliers  = Supplier::get();
        $types      = System::configmultiply('type');
        $groups     = System::configmultiply('group');
        $material  = Material::find($id);
        return view('pages.material.show', compact(['material','suppliers','types','groups']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers  = Supplier::get();
        $types      = System::configmultiply('type');
        $groups     = System::configmultiply('group');
        $material   = Material::find($id);
        return view('pages.material.edit', compact(['material','suppliers','types','groups']));
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

            $material                 = Material::find($id);
            $material->code           = $request->code;
            $material->name           = $request->name;
            $material->packaging      = $request->packaging;
            $material->fill_in        = $request->fill_in;
            $material->unit           = $request->unit;
            $material->minimum_stock  = $request->minimum_stock;
            $material->group          = $request->group;
            $material->type           = $request->type;
            $material->supplier_id    = $request->supplier_id;
            $material->purchase_price = $request->purchase_price;
            $material->selling_price  = $request->selling_price;
            $material->recipe_prices  = $request->recipe_prices;
            $material->profit         = $request->profit;
            $material->profit_persen  = $request->profit_persen;
            $material->expire_date    = $request->expire_date;
            // $material->last_update    = $request->last_update;
            // $material->update_by      = $request->update_by;

            $material->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('material')
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

            $material = Material::find($id);
            $material->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil sihapus!'
                ];

        return redirect('material')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $materials = Material::with(['supplier'])->get();

        return DataTables::of($materials)

        ->rawColumns(['options'])

        ->addColumn('options', function($material){
            return '
                <a href="'.route('material.edit', $material->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$material->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('material.destroy', $material->id).'" method="POST" id="form-delete-'.$material->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function export() 
    {
        $materials = Material::select('code','name','packaging','fill_in','unit','minimum_stock','group','type','suppliers.supplier_code','suppliers.supplier_name','purchase_price','selling_price','recipe_prices','profit','profit_persen','expire_date')
                    ->join('suppliers', 'materials.supplier_id', '=', 'suppliers.id')
                    ->get();

       return Excel::create('Data Bahan Dan Obat', function($excel) use ($materials){
             $excel->sheet('mysheet', function($sheet) use ($materials){
                 $sheet->fromArray($materials);
             });

        })->download('csv');

    }
}
