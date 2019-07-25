<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Excel;
use Storage;

use DataTables;

class CustomerController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = Customer::get();

        if ($request->wantsJson()) {
            return response()->json($customer, 200);
        }

        return view('pages.customer');
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
            'customer_code' => 'required',
            'customer_name' => 'required'
        ]);

        $customer = new Customer;
        $customer->customer_code = $request->customer_code;
        $customer->customer_name = $request->customer_name;
        $customer->customer_address = $request->customer_address;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_email = $request->customer_email;
        $customer->customer_website = $request->customer_website;
        $customer->customer_pic_name = $request->customer_pic_name;
        $customer->customer_pic_phone = $request->customer_pic_phone;
        $customer->customer_pic_email = $request->customer_pic_email;
        $customer->save();

        if ($request->wantsJson()) {
            return response()->json($customer);
        }

        $res = [
                    'title' => 'Succses',
                    'type' => 'success',
                    'message' => 'Data Saved Success!'
                ];

        return redirect()
                ->route('customer.index')
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
        $customer = Customer::find($id);
        if (empty($customer)) {
            return response()->json('Type not found', 500);
        }
        return response()->json($customer, 200);
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
            'customer_code' => 'required',
            'customer_name' => 'required'
        ]);

        $customer = Customer::find($id);

        if (empty($customer)) {
            return response()->json('Type not found', 500);
        }

        $customer->customer_code = $request->customer_code;
        $customer->customer_name = $request->customer_name;
        $customer->customer_address = $request->customer_address;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_email = $request->customer_email;
        $customer->customer_website = $request->customer_website;
        $customer->customer_pic_name = $request->customer_pic_name;
        $customer->customer_pic_phone = $request->customer_pic_phone;
        $customer->customer_pic_email = $request->customer_pic_email;
        $customer->save();

        if ($request->wantsJson()) {
            return response()->json($customer);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('customer.index')
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
        $customer = Customer::find($id);

        if (empty($customer)) {
            return response()->json('Type not found', 500);
        }

        $customer->delete();

        if ($request->wantsJson()) {
            return response()->json('Type deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data Deleted Success!'
                ];

        return redirect()
                ->route('customer.index')
                ->with($res);

    }

    public function getData(Request $request)
    {
        $customer = Customer::get();
        return DataTables::of($customer)
        ->rawColumns(['options'])

        ->addColumn('options', function($customer){
            return '
                <a href="'.route('customer.edit', $customer->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$customer->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('customer.destroy', $customer->id).'" method="POST" id="form-delete-'.$customer->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.customer.create');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.edit', compact(['customer']));
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

                        $customer   = Customer::firstOrNew(['customer_code' => $data->customer_code]);
                        $customer->customer_code        = $data->customer_code;
                        $customer->customer_name        = $data->customer_name;
                        $customer->customer_address     = $data->customer_address;
                        $customer->customer_phone       = $data->customer_phone;
                        $customer->customer_email       = $data->customer_email;
                        $customer->customer_website     = $data->customer_website;
                        $customer->customer_pic_name    = $data->customer_pic_name;
                        $customer->customer_pic_phone   = $data->customer_pic_phone;
                        $customer->customer_pic_email   = $data->customer_pic_email;
                        $customer->save();                  
                    }  

                    $res = [
                                'title'             => 'Sukses',
                                'type'              => 'success',
                                'message'           => 'Upload Data Success!'
                            ];
                    Storage::delete('public/uploads/'.$name); 
                    return redirect()
                            ->route('customer.index')
                            ->with($res);
        }
    }

    public function template_customer() 
    {
       return Excel::create('Template Customer', function($excel){
            $excel->sheet('mysheet', function($sheet){
                $sheet->cell('A1', function($cell) {$cell->setValue('customer_code');});
                $sheet->cell('B1', function($cell) {$cell->setValue('customer_name');});
                $sheet->cell('C1', function($cell) {$cell->setValue('customer_address');});
                $sheet->cell('D1', function($cell) {$cell->setValue('customer_phone');});
                $sheet->cell('E1', function($cell) {$cell->setValue('customer_email');});
                $sheet->cell('F1', function($cell) {$cell->setValue('customer_website');});
                $sheet->cell('G1', function($cell) {$cell->setValue('customer_pic_name');});
                $sheet->cell('H1', function($cell) {$cell->setValue('customer_pic_phone');});
                $sheet->cell('I1', function($cell) {$cell->setValue('customer_pic_email');});
            });

        })->download('csv');
    } 

}
