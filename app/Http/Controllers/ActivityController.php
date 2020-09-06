<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index()
    {
        $userAct = Activity::select('causer_id')->distinct()->get();
        $logNameAct = Activity::select('log_name')->distinct()->get();


        $dataPage = [
            'title' => "Activity Log",
            'page' => 'activity',
            'userAct' => $userAct,
            'logNameAct' => $logNameAct
        ];
        return view('activity.index', $dataPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {

        $dataJson['message'] = "Data Activity ditemukan";
        $dataJson['data'] = [
            'user' => $activity->user->name,
            'log_name' => $activity->log_name,
            'description' => $activity->description,
            'properties' => $activity->properties,
            'created_at' => $activity->created_at->translatedFormat('j F Y H:i:s'),
        ];
        return response()->json($dataJson, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }

    public function datatable(Request $request)
    {

        // dd($request);

        $columns = array(
            0 => 'id',
            1 => 'causer_id',
            2 => 'log_name',
            3 => 'description',
            4 => 'created_at',
        );

        $totalData = Activity::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        //custom data
        $userAct = $request->input('userAct');
        $logNameAct = $request->input('logNameAct');


        if (empty($request->input('search.value'))) {
            if ($request->input('order.0.column') == 1) {

                $query = Activity::whereHas('user', function ($q) use ($dir) {
                    $q->orderBy('name', $dir);
                });

                if (!empty($userAct)) {
                    $query->where('causer_id', $userAct);
                }
                if (!empty($logNameAct)) {
                    $query->where('log_name', $logNameAct);
                }
                $activities = $query->offset($start)->limit($limit)->get();
            } else {
                $query = Activity::offset($start)->limit($limit)
                    ->orderBy($order, $dir);
                if (!empty($userAct)) {
                    $query->where('causer_id', $userAct);
                }
                if (!empty($logNameAct)) {
                    $query->where('log_name', $logNameAct);
                }

                $activities = $query->get();
            }
        } else {

            $search = $request->input('search.value');
            if ($request->input('order.0.column') == 1) {
                $query = Activity::whereHas('user', function ($q) use ($dir, $search) {
                    $q->orderBy('name', $dir);
                    $q->where('name', 'LIKE', "%{$search}%");
                });

                if (!empty($userAct)) {
                    $query->where('causer_id', $userAct);
                }
                if (!empty($logNameAct)) {
                    $query->where('log_name', $logNameAct);
                }

                $activities = $query->offset($start)
                    ->limit($limit)
                    ->get();
            } else {

                $query =  Activity::whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
                if (!empty($userAct)) {
                    $query->where('causer_id', $userAct);
                }
                if (!empty($logNameAct)) {
                    $query->where('log_name', $logNameAct);
                }

                $activities = $query->orWhere('log_name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }


            $qTotalFiltered = Activity::whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
                ->orWhere('log_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");

            if (!empty($userAct)) {
                $qTotalFiltered->where('causer_id', $userAct);
            }
            if (!empty($logNameAct)) {
                $qTotalFiltered->where('log_name', $logNameAct);
            }

            $totalFiltered = $qTotalFiltered->count();
        }

        $data = array();
        if (!empty($activities)) {
            $no = $start;
            foreach ($activities as $act) {
                $no++;
                $nestedData['no'] = $no;
                $nestedData['user'] = $act->user->name;
                $nestedData['logName'] = $act->log_name;
                $nestedData['description'] = $act->description;
                $nestedData['created_at'] = $act->created_at->translatedFormat('j F Y H:i:s');
                $nestedData['action'] = '<button data-id="' . $act->id . '" class="btn btn-info btn-circle btn-detail">
                <i class="fas fa-search"></i>
                            </button>';

                $data[] = $nestedData;
            }
        }




        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "order"           => $order,
            "dir" => $dir,
            "userAct" => $userAct,
            "logNameCat" => $logNameAct,
        );


        return response()->json($json_data, 200);
    }
}
