<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $types = Setting::get();

            return DataTables::of($types)
            ->rawColumns(['options'])

            ->addColumn('options', function($settings){
                return '
                    <a href="'.route('settings.edit', $settings->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$settings->id.')"><i class="mdi mdi-close"></i></button>
                    <form action="'.route('settings.destroy', $settings->id).'" method="POST" id="form-delete-'.$settings->id .'" style="display:none">
                        '.csrf_field().'
                        <input settings="hidden" name="_method" value="DELETE">
                    </form>
                ';
            })

            ->toJson();

        }

        return view('pages.settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = new Setting;
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();

        $res = [
                'title' => 'Sukses',
                'type' => 'success',
                'message' => 'Data berhasil disimpan!'
            ];


        return redirect()->route('settings.index')
                ->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('pages.settings.edit', compact(['setting']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();

        $res = [
                'title' => 'Sukses',
                'type' => 'success',
                'message' => 'Data berhasil diubah!'
            ];


        return redirect()->route('settings.index')
                ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {

        $setting->delete();

        $res = [
                'title' => 'Sukses',
                'type' => 'success',
                'message' => 'Data berhasil diubah!'
            ];


        return redirect()->route('settings.index')
                ->with($res);
    }
}
