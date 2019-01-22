<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = New Category();
        $cat->name = $request->get('name');
        $cat->slug = str_slug($request->get('name'));

        if($cat->save()){
            return response('Category has successfully been added.', 200);
        }

        return response('Category could not be added due to an ERROR!', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->slug = str_slug($request->get('name'));

        if($category->update()){
            return response('Category updated successfully.', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            return response('Category has been deleted successfully.', 200);
        }
    }
}
