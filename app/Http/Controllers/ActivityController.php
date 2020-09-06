<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index()
    {
        $dataPage = [
            'title' => "Activity Log",
            'page' => 'activity',
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
        //
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

        if (empty($request->input('search.value'))) {
            if ($request->input('order.0.column') == 1) {

                $activities = Activity::whereHas('user', function ($query) use ($dir) {
                    $query->orderBy('name', $dir);
                })
                    ->offset($start)
                    ->limit($limit)
                    ->get();
            } else {
                $activities = Activity::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        } else {

            $search = $request->input('search.value');
            if ($request->input('order.0.column') == 5) {
                $activities = Activity::whereHas('user', function ($query) use ($dir, $search) {
                    $query->orderBy('name', $dir);
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                    ->offset($start)
                    ->limit($limit)
                    ->get();
            } else {

                $activities =  Activity::whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhere('log_name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }


            $totalFiltered = Activity::whereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
                ->orWhere('log_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->count();
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
            "dir" => $dir
        );


        return response()->json($json_data, 200);
    }
}
