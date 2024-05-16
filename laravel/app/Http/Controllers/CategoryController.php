<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view("dashboard", [
            "categories" => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('categories.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) : RedirectResponse
    {
        $c = Category::create($request->validated());
        if ($c) {
            redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }

            return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);

        return response()->view('categories.show',[
            'category' => $category,
            'products' => $category->products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->view("categories.edit", [
            "category" => Category::findOrFail($id),
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id) : RedirectResponse
    {
        $category = Category::findOrFail($id);

        if ($category->update($request->validated())) {
            return redirect()->route('dashboard');
        } else {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $category = Category::findOrFail($id);

        if ($category->delete()) {
            return redirect()->route('dashboard');
        } else {
            return abort(500);
        }
    }
}
