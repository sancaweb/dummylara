<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function userTes()
    {
        // $start = 0;
        // $limit = 2;
        // $where = 'user';

        // $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //     ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //     ->select('users.*', 'roles.name as rolename')
        //     ->orderBy('roles.name', 'asc')
        //     ->get();


        // echo '<ul>';
        // foreach ($users as $user) {
        //     echo '<li>' . $user->name . '-' . $user->rolename . '</li>';
        // }

        // echo '</ul>';
    }


    public function index()
    {
        // dd(Role::all()->pluck('name'));
        $dataPage = [
            'title' => "User List",
            'page' => 'user',
            'action' => route('user.store'),
            'user' => null,
            'roles' => Role::all()->pluck('name'),
        ];

        return view('user.index', $dataPage);
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
        // dd($request->file('foto'));
        DB::beginTransaction();
        try {
            $input = $request->all();


            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoUrl = $foto->store("images/user");
            } else {
                $fotoUrl = null;
            }


            $input['password'] = Hash::make($input['password']);
            $input['name'] = ucwords($input['name']);
            $input['foto'] = $fotoUrl;
            $user = User::create($input);

            $user->assignRole($input['role']);
            activity('user_management')->withProperties($input)->performedOn($user)->log('Penambahan User');
        } catch (Exception $uStore) {
            DB::rollBack();

            $dataJson['exception'] = $uStore;
            $dataJson['message'] = "Ada kesalahan peng-kodean store User. Detail Error: ";
            return response()->json($dataJson, 503);
        }

        DB::commit();

        $dataJson['message'] = "Data User berhasil ditambahkan";
        return response()->json($dataJson, 200);
    }

    public function show(User $user)
    {
        //...
    }

    public function edit(User $user)
    {
        $user['foto'] = $user->takeImage();
        $dataJson['message'] = "Data User ditemukan";
        $dataJson['data'] = [
            'dataUser' => $user,
            // 'role' => $user->roles()->pluck('name'),
            'role' => $user->getRoleNames(),
            'action' => route('user.update', $user->id)
        ];

        return response()->json($dataJson, 200);
    }

    public function update(UserRequest $request, User $user)
    {

        DB::beginTransaction();

        try {
            $input = $request->all();
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoUrl = $foto->store("images/user");
                Storage::delete($user->foto);
            } else {
                $fotoUrl = $user->foto;
            }

            if ($input['password'] === null) {
                $input = $request->except('password');
            } else {
                $input['password'] = Hash::make($input['password']);
            }


            $input['name'] = ucwords($input['name']);
            $input['foto'] = $fotoUrl;
            $user->update($input);

            $user->syncRoles($input['role']);
        } catch (Exception $userUpdate) {
            DB::rollBack();
            $dataJson['exception'] = " " . $userUpdate;
            $dataJson['message'] = "Ada kesalahan peng-kodean update User. Detail Error: ";
            return response()->json($dataJson, 503);
        }

        try {
            activity('user_management')->withProperties($input)->performedOn($user)->log('Perubahan User');
        } catch (Exception $erAct) {
            DB::rollBack();
        }

        DB::commit();
        $dataJson['message'] = "Data User berhasil dirubah";
        return response()->json($dataJson, 200);
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();

        $dataJson['message'] = "User berhasil dihapus";
        return response()->json($dataJson, 200);
    }

    public function trash()
    {
        $dataPage = [
            'title' => "Trashed User",
            'page' => 'user',
        ];

        return view('user.trash', $dataPage);
    }

    public function restore(Request $request, $id)
    {
        // $user->restore();
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();

        $dataJson['message'] = "User berhasil di restore";

        return response()->json($dataJson, 200);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();

        Storage::delete($user->foto);
        $user->forceDelete();
        $user->roles()->detach();

        $dataJson['message'] = "User berhasil dihapus";
        return response()->json($dataJson, 200);
    }


    public function datatable(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'foto',
            2 => 'name',
            3 => 'username',
            4 => 'email',
            5 => 'role',
            6 => 'created_at',
        );

        $totalData = User::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            if ($request->input('order.0.column') == 5) {

                $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as rolename')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy('roles.name', $dir)
                    ->get();
            } else {
                $users = User::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        } else {

            $search = $request->input('search.value');
            if ($request->input('order.0.column') == 5) {
                $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as rolename')
                    ->where('roles.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy('roles.name', $dir)
                    ->get();


                // $users =  User::whereHas('roles', function ($query) use ($search, $dir) {
                //     $query->where('name', 'LIKE', "%{$search}%");
                //     $query->orderBy('name', $dir);
                // })
                //     ->orWhere('name', 'LIKE', "%{$search}%")
                //     ->orWhere('username', 'LIKE', "%{$search}%")
                //     ->orWhere('email', 'LIKE', "%{$search}%")
                //     ->offset($start)
                //     ->limit($limit)
                //     ->get();
            } else {

                $users =  User::whereHas('roles', function ($query) use ($search) {
                    $query->where('roles.name', 'LIKE', "%{$search}%");
                })
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }


            $totalFiltered = User::whereHas('roles', function ($query) use ($search) {
                $query->where('roles.name', 'LIKE', "%{$search}%");
            })
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            $no = $start;
            foreach ($users as $user) {
                $no++;
                $nestedData['no'] = $no;
                $nestedData['foto'] = '<img style="height: 100px; width:100px; object-fit:cover; object-position:center;" src="' . $user->takeImage() . '" alt="' . $user->username . '" class="rounded img-fluid img-thumbnail">';
                $nestedData['name'] = $user->name;
                $nestedData['username'] = $user->username;
                $nestedData['email'] = $user->email;
                $nestedData['role'] = $user->getRoleNames();
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

    public function trashedDatatable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'foto',
            2 => 'name',
            3 => 'usrname',
            4 => 'email',
            5 => 'created_at',
        );

        $totalData = User::onlyTrashed()->count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $users = User::onlyTrashed()->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users =  User::onlyTrashed()->where('name', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();


            $totalFiltered = User::onlyTrashed()->where('name', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            $no = $start;
            foreach ($users as $user) {
                $no++;
                $nestedData['no'] = $no;
                $nestedData['foto'] = '<img style="height: 100px; width:100px; object-fit:cover; object-position:center;" src="' . $user->takeImage() . '" alt="' . $user->username . '" class="rounded img-fluid img-thumbnail">';
                $nestedData['name'] = $user->name;
                $nestedData['username'] = $user->username;
                $nestedData['email'] = $user->email;
                $nestedData['created_at'] = $user->created_at->translatedFormat('j F Y H:i:s');

                $nestedData['action'] = '<button data-id="' . $user->id . '" class="btn btn-warning btn-circle btn-restore" title="Restore User">
                <i class="fas fa-trash-restore"></i>
                            </button>
                            <button type="button" data-id="' . $user->id . '" class="btn btn-danger btn-circle btn-destroy" title="Permanent Delete">
                                <i class="fas fa-trash"></i> 
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
