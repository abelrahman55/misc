<?php

namespace App\Http\Controllers\Web;


use App\Services\Web\BlogServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct(public BlogServices $blogServices)
    {}

    public function index(){
        $blogs=$this->blogServices->index();
        return view('Blog.index',compact('blogs'));
    }
     public function create()
    {
        return view('Blog.create');
    }

    public function store(StoreBlogRequest $request){
    $blogs=$this->blogServices->store($request->validated());
        return redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('Blog.edit',compact('blog'));
    }


    public function update(StoreBlogRequest $request, $id){
        $blogs=$this->blogServices->update($request->validated(),$id);
               return redirect()->route('blogs.index');

    }

    public function delete($id){
        $blogs=$this->blogServices->delete($id);
        if($blogs){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }


}
