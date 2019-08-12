<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use DataTables;
use Indonesia;
use App\Division;
use Excel;
use DB;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $division = Division::get();
        if ($request->wantsJson()) {
            $Companies= Company::with(['division'])->get();
            return response()->json($Companies);
        }
        return view('pages.company', compact(['division']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities          = Indonesia::allCities();
        $division        = Division::get();

        return view('pages.company.create', compact(['cities','division']));
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

            $company                 = new Company;
            $company->code           = $request->code;
            $company->name           = $request->name;
            $company->address        = $request->address;
            $company->city           = $request->city;
            $company->division_id    = $request->division_id;

            $company->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('company')
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
        $company = Company::find($id);
        return view('pages.company.show', compact(['company']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities          = Indonesia::allCities();
        $division        = Division::get();
        $company          = Company::find($id);
        
        return view('pages.company.edit', compact(['company','division','cities']));
        
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
            $company                 = Company::find($id);
            $company->code           = $request->code;
            $company->name           = $request->name;
            $company->address        = $request->address;
            $company->city           = $request->city;
            $company->division_id    = $request->division_id;

            $company->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('company')
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

            $company = Company::find($id);
            $company->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect('company')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $company = Company::with(['division'])->get();

        return DataTables::of($company)

        ->rawColumns(['options'])

        ->addColumn('options', function($company){
            return '
                <a href="'.route('company.edit', $company->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$company->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('company.destroy', $company->id).'" method="POST" id="form-delete-'.$company->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function export() 
    {
        $Companys = Company::get();

       return Excel::create('Data Perusahaan', function($excel) use ($Companys){
             $excel->sheet('mysheet', function($sheet) use ($Companys){
                 $sheet->fromArray($Companys);
             });

        })->download('csv');

    }
}
