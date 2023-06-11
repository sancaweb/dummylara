<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $dataPage = [
            'pageTitle' => "Dashboard",
            'page' => 'dashboard',

        ];

        return view('dashboard/index', $dataPage);
    }
}
