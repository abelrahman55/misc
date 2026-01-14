<?php

namespace App\Http\Controllers\Web;

use App\Services\Web\ArticlesServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreArticlesRequest;
use App\Models\Articles;

class ArticlesController extends Controller
{
    public function __construct(public ArticlesServices $ArticlesServices)
    {}

    public function index(){
        $articless=$this->ArticlesServices->index();
        return view('articles.index',compact('articless'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticlesRequest $request){
    $Articless=$this->ArticlesServices->store($request->validated());
       return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $articles = Articles::findOrFail($id);
        return view('articles.edit',compact('articles'));
    }



    public function update(StoreArticlesRequest $request, $id){
        $Articless=$this->ArticlesServices->update($request->validated(),$id);
        return redirect()->route('articles.index');
    }

    public function delete($id){
        $Articless=$this->ArticlesServices->delete($id);
        if($Articless){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
    }


}
