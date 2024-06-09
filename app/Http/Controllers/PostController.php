<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::get();
        // return response()->json([
        //     'message' => 'List of post',
        //     'posts'=>$posts
        // ],200);
        return $this->successResponse($posts); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // $post=new Post();
        // $post->title=$request->title;
        // $post->content=$request->content;
        // $post->save();

        $post=POST::create($request->validated());

        // return response()->json([
        //     'message' => 'New post created',
        //     'post'=>$post
        // ],200);

        return $this->successResponse($post,'New post created',201); 

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post =POST::whereId($id)->first();
        
        if(!$post){
            return $this->errorResponse('Post not found'); 
        }

        return $this->successResponse($post); 

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // $post->title=$request->title??$post->title;
        // $post->content=$request->content??$post->content;
        // $post->save();

        $post =POST::whereId($id)->first();

        if(!$post){
            return $this->errorResponse('Post not found'); 
        }
        $post->update($request->validated()); 
        

        return $this->successResponse($post,'Post Updated Successfully'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post =POST::whereId($id)->first();

        if(!$post){
            return $this->errorResponse('Post not found'); 
        }
        $post->delete();

        return $this->successResponse(null,'Post deleted Successfully'); 

    }
}
