<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catigory;
use App\Models\Group;
class CatigoryController extends Controller{
    public function index(){
        return view('catigory.index');
    }
    public function create(){
        return view('catigory.create');
    }
    public function update(){
        return view('catigory.update');
    }
    public function show(){
        return view('catigory.show');
    }
}
