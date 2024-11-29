<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostJob;

class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('home');
    }
    public function jobs(){
        $PostJob = PostJob::join('posts','posts.id','=','post_jobs.post_id')->join('groups','groups.id','=','post_jobs.chat_id')->get();
        return view('jobs.index',compact('PostJob'));
    }
}
