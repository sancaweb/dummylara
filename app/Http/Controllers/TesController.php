<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TesController extends Controller
{
    public function index()
    {
        $data = Http::withHeaders([
            'accept' => 'application/json',
        ])->withToken('e3887b8db62546988547a32a4d916724')
            ->get('http://newsapi.org/v2/top-headlines?country=id')->json();


        return $data;
    }

    public function covidProvinsi()
    {
        $data = Http::get('https://data.covid19.go.id/public/api/prov.json')->json();
        $datanya = $data['list_data'];
        return $datanya;
    }
}
