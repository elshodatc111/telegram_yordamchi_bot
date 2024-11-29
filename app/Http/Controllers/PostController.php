<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $Post = Post::get();
        return view('post.index',compact('Post'));
    }
    public function create(){
        return view('post.create');
    }
    public function story(Request $request){
        $validate = $request->validate([
            'chat_id' => 'required',
            'message_id' => 'required',
            'description' => 'required',
        ]);
        Post::create([
            'chat_id' => $request->chat_id,
            'message_id' => $request->message_id,
            'description' => $request->description,
        ]);
        return redirect()->route('post')->with('status', "Yangi targ'ibot materiallari yaratildi");
    }
    public function update($id){
        $Post = Post::find($id);
        return view('post.update',compact('Post'));
    }
    public function update_story(Request $request, $id){
        $validate = $request->validate([
            'chat_id' => 'required',
            'message_id' => 'required',
            'description' => 'required',
        ]);
        $Post = Post::find($id);
        $Post->chat_id = $request->chat_id;
        $Post->message_id = $request->message_id;
        $Post->description = $request->description;
        $Post->save();
        return redirect()->route('post')->with('status', "Targ'ibot materiallari yangilandi");
    }
    public function delete($id){
        $Post = Post::find($id);
        $Post->delete();
        return redirect()->back()->with('status', "Targ'ibot materiallari o'chirildi");
    }
}
