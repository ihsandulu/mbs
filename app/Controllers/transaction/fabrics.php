<?php

namespace App\Controllers\transaction;


use App\Controllers\baseController;

class fabrics extends BaseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function target()
    {
        $data = new \App\Models\transaction\fabrics_m();
        $data = $data->data();
        $data["buyer"]=1;
        $data["title"]="Target";
        return view('transaction/fabrics_v', $data);
    }

    public function polham()
    {
        $data = new \App\Models\transaction\fabrics_m();
        $data = $data->data();
        $data["buyer"]=2;
        $data["title"]="Polham";
        return view('transaction/fabrics_v', $data);
    }

    public function topten()
    {
        $data = new \App\Models\transaction\fabrics_m();
        $data = $data->data();
        $data["buyer"]=3;
        $data["title"]="Topten";
        return view('transaction/fabrics_v', $data);
    }

    public function carters()
    {
        $data = new \App\Models\transaction\fabrics_m();
        $data = $data->data();
        $data["buyer"]=4;
        $data["title"]="Carters";
        return view('transaction/fabrics_v', $data);
    }
}
