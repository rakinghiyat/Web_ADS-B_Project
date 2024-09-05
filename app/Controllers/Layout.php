<?php

namespace App\Controllers;

class Layout extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | ADS-B Status Monitoring'
        ];
        return view('layout/home', $data);
    }

    //--------------------------------------------------------------------

}
