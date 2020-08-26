<?php

namespace App\Http\Controllers\Ajax;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxUserController extends Controller
{
    public function index(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'created_at',
        );

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users =  User::where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();


            $totalFiltered = User::where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            $no = $start;
            foreach ($users as $user) {
                $no++;
                $nestedData['no'] = $no;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['created_at'] = $user->created_at->translatedFormat('j F Y H:i:s');

                $nestedData['action'] = '<button data-id="' . $user->id . '" class="btn btn-warning btn-circle btn-edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" data-id="' . $user->id . '" class="btn btn-danger btn-circle btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                            ';

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
