<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    
    public function index()
    {
        return view('simulation.index');
    }

}
