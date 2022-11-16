<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:posts,title',
            'body' => 'required',
            'photo'           => 'required|image|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->post_slug     = Str::slug($request->title, '-');
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');

            $post->photo = $path;
        }

        // dd($post);

        $post->save();

        return redirect()->route('posts.index');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        return view('posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'photo'           => 'image|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->post_slug     = Str::slug($request->title, '-');
        $post->body = $request->body;
        $post->category_id = $request->category_id;

       if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');

            $oldfile = $post->photo;

            $post->photo = $path;

            if ($oldfile) {
                Storage::disk('public')->delete($oldfile);
            }
        }


        $post->save();

        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);

        Storage::disk('public')->delete($post->photo);
        $post->delete();


        return redirect()->route('posts.index');
    }
}