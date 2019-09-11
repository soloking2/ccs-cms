<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{

  public function __construct(){
    $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view ('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload the image
        $image = $request->image->store('posts');

        $post = Post::create([
          'title'=>$request->title,
          'description'=>$request->description,
          'content'=>$request->content,
          'image' => $image,
          'published_at' => $request->published_at,
          'category_id'=>$request->category,
          'user_id'=> auth()->user()->id
        ]);

        if($request->tags){
          $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
      //for security and prevents what hackers ingest from storing in the database
      $data = $request->only(['title', 'description', 'published_at', 'content']);
      //check for new image
      if($request->hasFile('image')){
        //upload the new image
          $image = $request->image->store('posts');
          //Delete the old image
          $post->deleteImage();

          $data['image'] = $image;
      }
      //this syncs the options selected, removes the one the former and adds the recent
      if($request->tags){
        $post->tags()->sync($request->tags);
      }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //model binding cannot work because the file is no longer in the database.
      //we find it ourselves using the withTrashed method
      //firstOrFail deletes if found or throws an error
      $post = Post::withTrashed()->where('id', $id)->firstOrFail();
      if($post->trashed()){
        $post->deleteImage();
        $post->forceDelete();
      } else {
        $post->delete();
      }

        return redirect()->route('posts.index')->with('success', 'Posts deleted successfully');
    }

    /**
     * Show all trashed posts the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function trashed_posts()
    {
      //use withTrashed() to fetch only the trashed posts
      //use get() to fetch all the trashed posts
      $trashed = Post::onlyTrashed()->get();

      //withPosts($trashed) === with('posts', $trashed )
      return view('posts.index')->with('posts', $trashed);
    }

    /**
     * Show all trashed posts the specified resource.
     *
     * @param  \App\Post  $post
     * use to restore deleted posts
     */
     public function restore($id){
       $post = Post::withTrashed()->where('id', $id)->firstOrFail();

       $post->restore();

       return redirect()->back()->with('success', 'post restored successfully');
     }
}
