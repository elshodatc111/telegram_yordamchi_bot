<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catigory;
use App\Models\Group;
class CatigoryController extends Controller{
    public function index(){
        return view('catigory.index');
    }
}
