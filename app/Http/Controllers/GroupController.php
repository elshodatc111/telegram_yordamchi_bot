<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
class GroupController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $Group = Group::get();
        return view('groups.index',compact('Group'));
    }
    
}
