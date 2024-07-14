<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
      $posts = Post::with('user:id,first_name,last_name,profile_picture')->paginate(20);

      return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
      return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
      $user_id = Auth::id();
      $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'content' => 'required|string',
        'image' => 'nullable|mimes:png,jpg,jpeg|max:1024'
      ]);

      if($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      // file validation
      $file_store_location = null;
      if ($request->hasFile('image')){
        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->extension();
        $name = str_replace(' ', '-', $fileName) . '-' . time() . uniqid() . '.' . $extension;
        $store_path = 'uploads/posts';
        $file->move(public_path($store_path), $name);
        $file_store_location = $store_path . '/' . $name;
      }

      $post = new Post();
      $post->user_id = $user_id;
      $post->slug = $this->slugGenerator($request->title);
      $post->title = $request->title;
      $post->content = $request->content;
      $post->image = $file_store_location;
      $post->save();

      return redirect()->route('posts.index')
        ->with(['message' => 'Your post successfully added!', 'status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) {
      $owner = Auth::id() === $post->user_id;
      return view('posts.show', ['post' => $post, 'owner' => $owner]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {
      $user_id = Auth::id();
      if($user_id !== $post->user_id) {
        return back()->with(['message' => 'Invalid request!', 'status' => false]);
      }

      return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {
      $user_id = Auth::id();
      if($user_id !== $post->user_id) {
        return back()->with(['message' => 'Invalid request!']);  
      }

      $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'content' => 'required|string',
        'image' => 'nullable|mimes:png,jpg,jpeg|max:1024'
      ]);

      if($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      // file validation
      $file_store_location = null;
      if ($request->hasFile('image')){
        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->extension();
        $name = str_replace(' ', '-', $fileName) . '-' . time() . uniqid() . '.' . $extension;
        $store_path = 'uploads/posts';
        $file->move(public_path($store_path), $name);
        $file_store_location = $store_path . '/' . $name;

        if(!is_null($post->image)) {
          $removed_store_path = storage_path('app/private/removed/posts');
          $removed_file_path = storage_path('app/private/removed/posts/' . str_replace($store_path . "/", "", $post->image));

          if(!File::exists($removed_store_path)) {
            File::makeDirectory($removed_store_path, 0755, true, true);
          }
          File::move($post->image, $removed_file_path);
        }
      }

      $post->slug = $this->slugGenerator($request->title);
      $post->title = $request->title;
      $post->content = $request->content;
      $post->image = !is_null($post->image) && !$file_store_location ? $post->image : $file_store_location;
      $post->save();

      return redirect()->route('posts.index')
        ->with(['message' => 'Your post successfully edited!', 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
      $user_id = Auth::id();
      if($user_id !== $post->user_id) {
        return back()->with(['message' => 'Invalid request!']);  
      }

      $post->delete();
      return redirect()->route('posts.index')->with(['message' => 'The post was deleted successfully!']);
    }

    private function slugGenerator(string $title) {
      // generate unique slug
      $slug = Str::slug($title);
      $exists = Post::where('slug', $slug)->get(['slug']);
      if($exists->count() > 0) {
        $next_id = uniqid();
        $slug .= "-" . $next_id;
      }

      return $slug;
    }
}
