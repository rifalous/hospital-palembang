<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Excel;
use Storage;

use DataTables;

class SupplierController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Supplier = Supplier::get();

        if ($request->wantsJson()) {
            return response()->json($supplier, 200);
        }

        return view('pages.supplier');
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
            'supplier_code' => 'required',
            'supplier_name' => 'required'
        ]);

        $supplier = new Supplier;
        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->supplier_phone = $request->supplier_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->supplier_website = $request->supplier_website;
        $supplier->supplier_pic_name = $request->supplier_pic_name;
        $supplier->supplier_pic_phone = $request->supplier_pic_phone;
        $supplier->supplier_pic_email = $request->supplier_pic_email;
        $supplier->save();

        if ($request->wantsJson()) {
            return response()->json($supplier);
        }

        $res = [
                    'title' => 'Succses',
                    'type' => 'success',
                    'message' => 'Data Saved Success!'
                ];

        return redirect()
                ->route('supplier.index')
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
        $supplier = Supplier::find($id);
        if (empty($supplier)) {
            return response()->json('Type not found', 500);
        }
        return response()->json($supplier, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_code' => 'required',
            'supplier_name' => 'required'
        ]);

        $supplier = Supplier::find($id);

        if (empty($supplier)) {
            return response()->json('Type not found', 500);
        }

        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->supplier_phone = $request->supplier_phone;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->supplier_website = $request->supplier_website;
        $supplier->supplier_pic_name = $request->supplier_pic_name;
        $supplier->supplier_pic_phone = $request->supplier_pic_phone;
        $supplier->supplier_pic_email = $request->supplier_pic_email;
        $supplier->save();

        if ($request->wantsJson()) {
            return response()->json($supplier);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('supplier.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if (empty($supplier)) {
            return response()->json('Supplier not found', 500);
        }

        $supplier->delete();

        if ($request->wantsJson()) {
            return response()->json('Supplier deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('supplier.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $supplier = Supplier::get();
        return DataTables::of($supplier)
        ->rawColumns(['options'])

        ->addColumn('options', function($supplier){
            return '
                <a href="'.route('supplier.edit', $supplier->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$supplier->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('supplier.destroy', $supplier->id).'" method="POST" id="form-delete-'.$supplier->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('pages.supplier.edit', compact(['supplier']));
    }

    public function export() 
    {
        $suplliers = Supplier::get();

       return Excel::create('Data Supplier', function($excel) use ($suplliers){
             $excel->sheet('mysheet', function($sheet) use ($suplliers){
                 $sheet->fromArray($suplliers);
             });

        })->download('csv');

    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads', $name);
        $data = [];
        if ($request->hasFile('file')) {
            $datas = Excel::load(public_path('storage/uploads/'.$name), function($reader){})->get();

                    foreach ($datas as $data) {

                        $supplier   = Supplier::firstOrNew(['supplier_code' => $data->supplier_code]);
                        $supplier->supplier_code        = $data->supplier_code;
                        $supplier->supplier_name        = $data->supplier_name;
                        $supplier->supplier_address     = $data->supplier_address;
                        $supplier->supplier_phone       = $data->supplier_phone;
                        $supplier->supplier_email       = $data->supplier_email;
                        $supplier->supplier_website     = $data->supplier_website;
                        $supplier->supplier_pic_name    = $data->supplier_pic_name;
                        $supplier->supplier_pic_phone   = $data->supplier_pic_phone;
                        $supplier->supplier_pic_email   = $data->supplier_pic_email;
                        $supplier->save();                  
                    }  

                    $res = [
                                'title'             => 'Sukses',
                                'type'              => 'success',
                                'message'           => 'Upload Data Success!'
                            ];
                    Storage::delete('public/uploads/'.$name); 
                    return redirect()
                            ->route('supplier.index')
                            ->with($res);
        }
    }

    public function template_supplier() 
    {
       return Excel::create('Template Supplier', function($excel){
            $excel->sheet('mysheet', function($sheet){
                $sheet->cell('A1', function($cell) {$cell->setValue('supplier_code');});
                $sheet->cell('B1', function($cell) {$cell->setValue('supplier_name');});
                $sheet->cell('C1', function($cell) {$cell->setValue('supplier_address');});
                $sheet->cell('D1', function($cell) {$cell->setValue('supplier_phone');});
                $sheet->cell('E1', function($cell) {$cell->setValue('supplier_email');});
                $sheet->cell('F1', function($cell) {$cell->setValue('supplier_website');});
                $sheet->cell('G1', function($cell) {$cell->setValue('supplier_pic_name');});
                $sheet->cell('H1', function($cell) {$cell->setValue('supplier_pic_phone');});
                $sheet->cell('I1', function($cell) {$cell->setValue('supplier_pic_email');});
            });

        })->download('csv');
    } 
}
    
