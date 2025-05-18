<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
          $data = DB::table('distriks')->get();

         $features = [];

        foreach ($data as $row) {
            $features[] = [
                "type" => "Feature",
                "properties" => [
                    "nama_distrik" => $row->nama_distrik,
                    "keterangan" => $row->keterangan
                ],
                "geometry" => json_decode($row->geojson)
            ];
        }

       $geojson = json_encode([
    'type' => 'FeatureCollection',
    'features' => $features
]);

         return view('admin.dashboard.index', compact('geojson'));
    }
}
