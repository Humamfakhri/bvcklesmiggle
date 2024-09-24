<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function index()
    {
        return view('partnership', [
            'partnerships' => Partnership::get(),
        ]);
    }
}
