<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ApiController extends Controller
{


    /**
     *Gets all the Blogs and returns with the blog publisher from
     * relationship.
     */

    public function index()
    {
        return Blog::with('user')->get();
    }

    /**
     * gets the authenticated user
     */
    public function getLoggedUser()
    {
        return Auth::user();
    }

    /**
     * Gets todays (current date) Blogs.
     */
    public function todaysBlog()
    {
        return Blog::ofToday()->with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        try {
            Blog::create($request->all());
            $blogs = Blog::with('user')->get();
            return response(['blogs' => $blogs, 'success' => ['Blog Created Successfully']]);
        } catch (\Exception $ex) {
            Log::error('An error occured when creating a blog' . $ex);
            $blogs = Blog::with('user')->get();
            if (Str::contains($ex, 'Duplicate entry')) {
                return response(['blogs' => $blogs, 'errors' => ['Blog Title Already Exists']]);
            }
            if (Str::contains($ex, "doesn't have a default value")) {
                return response(['blogs' => $blogs, 'errors' => ['Please fill all fields to continue']]);
            }
            return response(['blogs' => $blogs, 'errors' => ['Unexpected Error occurred'.$ex]]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $blog= Blog::find($request->input('id'));
       $blog->update($request->all());
       $blogs = Blog::with('user')->get();
       return response(['blogs' => $blogs, 'success' => ['Blog updated Successfully']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //return $request->input('id');
        Blog::destroy($request->input('id'));
        $blogs = Blog::with('user')->get();
        return response(['blogs' => $blogs, 'success' => ['Blog Deleted Successfully']]);

    }
}
