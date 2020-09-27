<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $dataJson['message'] = "Data user ditemukan";
        $dataJson['data'] = $users;

        return response()->json($dataJson, 200);
    }
}
