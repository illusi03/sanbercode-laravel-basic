<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }
  public function index() {
    $posts = Post::get();
    return view('posts.index', ['posts' => $posts]);
  }
  public function create() {
    return view('posts.create');
  }

  public function store(Request $request) {
    $request->validate([
      'title' => 'required|string',
      'content' => 'required|string',
      'image' => 'mimes:jpeg,png,jpg,gif,svg',
      'image.*' => 'mimes:jpeg,png,jpg,gif,svg',
    ]);
    $userId = Auth::user()->id;
    $datas = $request->all();
    $datas['user_id'] = $userId;
    if ($files = $request->file('image')) {
      // Define upload path
      $destinationPath = public_path('/images/'); // upload path
      // Upload Orginal Image
      $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
      $files->move($destinationPath, $profileImage);
      $datas['url_image'] = "$profileImage";
    }
    Post::create($datas);
    toast('Post Has Been Submitted !', 'success');
    return redirect('posts');
  }

  public function show(Post $post) {

  }

  public function edit(Post $post) {
    return view('posts.edit', ['post' => $post]);
  }

  public function update(Request $request, Post $post) {
    $request->validate([
      'title' => 'required|string',
      'content' => 'required|string',
      'image' => 'mimes:jpeg,png,jpg,gif,svg',
      'image.*' => 'mimes:jpeg,png,jpg,gif,svg',
    ]);
    $datas = $request->all();
    if ($files = $request->file('image')) {
      // Define upload path
      $destinationPath = public_path('/images/'); // upload path
      // Upload Orginal Image
      $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
      $files->move($destinationPath, $profileImage);
      $datas['url_image'] = "$profileImage";
    }
    $post->fill($datas);
    $post->save();
    toast('Post Has Been Updated !', 'success');
    return redirect('posts');
  }

  public function destroy(Post $post) {
    toast('Post Has Been Deleted !', 'success');
    $post->delete();
    return redirect('posts');
  }

  public function like(Post $post) {
    toast('Post Has Been Liked !', 'success');
    // $post->delete();
    return redirect('posts');
  }
}