<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Doctor;
use App\Inpatient;
use App\User;
use App\Outpatient;
use App\Setting;
use App\Charts\SampleChart;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$users = User::get();
     	$doctors = Doctor::get();
     	$inpatient = Inpatient::get();
     	$outpatient = Outpatient::get();
	
		$today_inpatient = Inpatient::whereDate('created_at', today())->count();
		$yesterday_inpatient = Inpatient::whereDate('created_at', today()->subDays(1))->count();
		$inpatient_2_days_ago = Inpatient::whereDate('created_at', today()->subDays(2))->count();
		 
		$chart = new SampleChart();
		$chart->labels(['2 Hari Lalu', 'Kemarin', 'Hari Ini']);	
		$chart->loaderColor('lightcoral');
		$chart->dataset('Pasien Rawat Inap', 'bar', [$inpatient_2_days_ago, $yesterday_inpatient, $today_inpatient])->backgroundColor('lightcoral');

		$today_outpatient = Outpatient::whereDate('created_at', today())->count();
		$yesterday_outpatient = Outpatient::whereDate('created_at', today()->subDays(1))->count();
		$outpatient_2_days_ago = Outpatient::whereDate('created_at', today()->subDays(2))->count();
		 
		$chart2 = new SampleChart;
		$chart2->labels(['2 Hari Lalu', 'Kemarin', 'Hari Ini']);	
		$chart2->loaderColor('lightgreen');
		$chart2->dataset('Pasien Rawat Jalan', 'bar', [$outpatient_2_days_ago, $yesterday_outpatient, $today_outpatient])->backgroundColor('lightgreen');

   //  	$types = Type::get();
   //      $group_locations = GroupLocation::get();

   //  	if ($request->ajax()) {

			// $data['other_park'] = number_format($parks->whereNotIn('type_id', [$vehicle_type->car, $vehicle_type->motorcycle])->pluck('rate_total')->sum(), 2, ',', '.');

			// return response()->json($data);

   //  	}

        // if (auth()->user()->hasRole('approval')) {
        return view('pages.dashboard', compact(['users','doctors','inpatient','outpatient', 'chart', 'chart2']));
    }

    public function getChart(Request $request)
    {

        $vehicle_type = Setting::getValue('vehicle_type');

    	if ($request->type == 'line') {


    		$data = [

    			[ 
    				'y' => '00:00',
    				'a' => Park::countPark($vehicle_type->car, '00:00', '01:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '00:00', '01:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '00:00', '01:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '01:00',
    				'a' => Park::countPark($vehicle_type->car, '01:00', '02:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '01:00', '02:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '01:00', '02:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '02:00',
    				'a' => Park::countPark($vehicle_type->car, '02:00', '03:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '02:00', '03:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '02:00', '03:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '03:00',
    				'a' => Park::countPark($vehicle_type->car, '03:00', '04:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '03:00', '04:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '03:00', '04:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '04:00',
    				'a' => Park::countPark($vehicle_type->car, '04:00', '05:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '04:00', '05:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '04:00', '05:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '05:00',
    				'a' => Park::countPark($vehicle_type->car, '05:00', '06:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '05:00', '06:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '05:00', '06:00', $request->date_filter)->count(),
				],


				[ 
					'y' => '06:00',
    				'a' => Park::countPark($vehicle_type->car, '06:00', '07:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '06:00', '07:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '06:00', '07:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '07:00',
    				'a' => Park::countPark($vehicle_type->car, '07:00', '08:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '07:00', '08:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '07:00', '08:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '08:00',
    				'a' => Park::countPark($vehicle_type->car, '08:00', '09:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '08:00', '09:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '08:00', '09:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '09:00',
    				'a' => Park::countPark($vehicle_type->car, '09:00', '10:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '09:00', '10:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '09:00', '10:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '10:00',
    				'a' => Park::countPark($vehicle_type->car, '10:00', '11:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '10:00', '11:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '10:00', '11:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '11:00',
    				'a' => Park::countPark($vehicle_type->car, '11:00', '12:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '11:00', '12:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '11:00', '12:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '12:00',
    				'a' => Park::countPark($vehicle_type->car, '12:00', '13:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '12:00', '13:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '12:00', '13:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '13:00',
    				'a' => Park::countPark($vehicle_type->car, '13:00', '14:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '13:00', '14:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '13:00', '14:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '14:00',
    				'a' => Park::countPark($vehicle_type->car, '14:00', '15:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '14:00', '15:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '14:00', '15:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '15:00',
    				'a' => Park::countPark($vehicle_type->car, '15:00', '16:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '15:00', '16:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '15:00', '16:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '16:00',
    				'a' => Park::countPark($vehicle_type->car, '16:00', '17:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '16:00', '17:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '16:00', '17:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '17:00',
    				'a' => Park::countPark($vehicle_type->car, '17:00', '18:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '17:00', '18:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '17:00', '18:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '18:00',
    				'a' => Park::countPark($vehicle_type->car, '18:00', '19:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '18:00', '19:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '18:00', '19:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '19:00',
    				'a' => Park::countPark($vehicle_type->car, '19:00', '20:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '19:00', '20:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '19:00', '20:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '20:00',
    				'a' => Park::countPark($vehicle_type->car, '20:00', '21:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '20:00', '21:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '20:00', '21:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '21:00',
    				'a' => Park::countPark($vehicle_type->car, '21:00', '22:00', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '21:00', '22:00', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '21:00', '22:00', $request->date_filter)->count(),
				],

				[ 
					'y' => '23:00',
    				'a' => Park::countPark($vehicle_type->car, '23:00', '23:59', $request->date_filter)->count(),
    				'b' => Park::countPark($vehicle_type->motorcycle, '23:00', '23:59', $request->date_filter)->count(),
    				'c' => Park::countPark(null, '23:00', '23:59', $request->date_filter)->count(),
				],

    		];

    		return response()->json($data);

    	} else {


    		$data = [

    			[
    				'label' => 'Mobil',
    				'value' => Park::where('type_id', $vehicle_type->car)->whereDate('park_at', $request->date_filter)->count()
    			],
    			[
    				'label' => 'Motor',
    				'value' => Park::where('type_id', $vehicle_type->motorcycle)->whereDate('park_at', $request->date_filter)->count()
    			],
    			[
    				'label' => 'Lainnya',
    				'value' => Park::whereNotIn('type_id', [$vehicle_type->car, $vehicle_type->motorcycle])->whereDate('park_at', $request->date_filter)->count()
    			],

    		];

    		return response()->json($data);

    	}
    }

    public function getDataPark(Request $request)
    {
        ini_set('memory_limit', '2048M');
        
    	$parks = Park::with(['user.user_data', 'rate', 'type', 'groupLocation'])
    				->where(function($where) use ($request){
    					
    					if (!empty($request->date_from) && !empty($request->date_to)) {

    						$where->whereDate('park_at', '>=', $request->date_from)
    								->whereDate('park_at', '<=', $request->date_to);
    					}

    					if ($request->type_id != 'all') {
    						$where->where('type_id', $request->type_id);
    					}

                        if ($request->group_location_id != 'all') {
                            $where->where('group_location_id', $request->group_location_id);
                        }

                        if (!empty($request->name)) {
                            $where->whereHas('user.user_data', function($where) use ($request){
                                $where->where('name', 'like', '%'.$request->name.'%');
                            });
                        }

    				})
    				->orderBy('id', 'desc')
    				->get();

    	return DataTables::of($parks)->toJson();
    }

    public function getDataUser(Request $request)
    {
    	$users = User::with(['user_data', 'tokens'])->where(function($where) use ($request){

    				if ($request->status == 'Online') {

    					$where->whereHas('tokens');
    				}

    				if ($request->status == 'Offline') {
    					$where->doesntHave('tokens');
    				}

                    if (!empty($request->name)) {
                        $where->whereHas('user_data', function($where) use ($request){
                            $where->where('name', 'like', '%'.$request->name.'%');
                        });
                    }

    			})->get();

    	return DataTables::of($users)

    	->rawColumns(['options'])

    	->addColumn('status', function($user){
    		if (count($user->tokens) > 0) {
    			return 'Online';
    		} else {
    			return 'Offline';
    		}
    	})

    	->addColumn('options', function($user){

    		return count($user->tokens) > 0 ? '<a class="btn btn-link text-danger" href="'.url('dashboard/revoke/'.$user->id).'" data-toggle="tooltip" title="Revoke Access">
    					<i class="fa fa-close"></i>
					</a>' : '';

    	})

    	->toJson();
    }

    public function revoke($id)
    {
    	$user = User::find($id);

    	$user->tokens->each(function($token, $key){
            $token->delete();
        });

        return redirect()
        		->back();
    }
}
