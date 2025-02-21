<?php
   
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
   
class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
  
    /**
     * create/ membuat posts
     *
     * @return response()
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }
    
    /**
     * store
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
   
        Post::create($request->all());
            
        return redirect(route('posts.index'))->with('success', 'Post created.');
    }
  
    /**
     * edit post
     *
     * @return response()
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }
    
    /**
     * update id, rquest
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
    
        Post::find($id)->update($request->all());
        return redirect(route('posts.index'))->with('success', 'Post updated.');
    }
    
    /**
     * destroy id.
     *
     * @return Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect(route('posts.index'))->with('success', 'Post deleted.');
    }
}  
