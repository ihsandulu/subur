<?php

namespace App\Controllers\transaction;


use App\Controllers\BaseController;

class invvdr extends BaseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\transaction\invvdr_m();
        $data = $data->data();
        $data["title"]="Invoice Vendor";
        return view('transaction/invvdr_v', $data);
    }
}
