<?php

namespace App\Controllers\transaction;


use App\Controllers\baseController;

class fabricsd extends BaseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\transaction\fabricsd_m();
        $data = $data->data();
        $data["title"]="Detail";
        return view('transaction/fabricsd_v', $data);
    }
}
