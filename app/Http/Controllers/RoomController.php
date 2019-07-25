<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Room;
use DataTables;
use Excel;
use DB;
use Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            
            $rooms= Room::with(['level'])->get();
            
            return response()->json($rooms);

        }
        return view('pages.room');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels    = Level::get();

        return view('pages.room.create',compact(['levels']));
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

            $room                      = new Room;
            $room->code                = $request->code;
            $room->name                = $request->name;
            $room->level_id            = $request->level_id;
            $room->total_place_number  = $request->total_place_number;
            $room->place_resource      = $request->place_resource;
            $room->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('room')
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
        // $class = Class::get();
        $room = Room::find($id);

        return view('pages.room.show', compact(['room']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $levels    = Level::get();
        $room = Room::find($id);

        return view('pages.room.edit', compact(['levels','room']));
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

            $room                      = Room::find($id);
            $room->code                = $request->code;
            $room->name                = $request->name;
            $room->level_id            = $request->level_id;
            $room->total_place_number  = $request->total_place_number;
            $room->place_resource      = $request->place_resource;
            $room->save();
        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('room')
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

            $room = Room::find($id);
            $room->delete();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil sihapus!'
                ];

        return redirect('room')
                    ->with($res);
    }

    public function export() 
    {
        $rooms = Room::select('name','total_place_number','place_resource','levels.code','levels.class')
                    ->join('levels', 'rooms.level_id', '=', 'levels.id')
                    ->get();
       return Excel::create('Data Ruangan', function($excel) use ($rooms){
             $excel->sheet('Data Ruangan', function($sheet) use ($rooms){
                 $sheet->fromArray($rooms);
             });

        })->download('csv');

    }
    public function getData(Request $request)
    {
        $rooms = Room::with(['level'])->get();

        return DataTables::of($rooms)

        ->rawColumns(['options'])

        ->addColumn('options', function($room){
            return '
                <a href="'.route('room.edit', $room->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ubah"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="on_delete('.$room->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('room.destroy', $room->id).'" method="POST" id="form-delete-'.$room->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }
}
