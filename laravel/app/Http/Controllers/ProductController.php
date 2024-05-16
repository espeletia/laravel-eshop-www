<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        return response()->view('products.index', [
            'products' => Product::all()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : Response
    {
        return response()->view('products.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) : RedirectResponse
    {
        $validated = $request->validated();

        if($request->hasFile('featured_image')) {
            $filepath = Storage::disk('public')->put('images/products/featured_image', request()->file('featured_image'));
            $validated['featured_image'] = $filepath;
        }

        var_dump($validated);
        $create = Product::create($validated);

        if($create) {
            return redirect()->route("dashboard");
        } else {
            return redirect()->back();
        }
        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->view("products.edit", [
            "product" => Product::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $p = Product::findOrFail($id);

        $validated = $request->validated();

        if($request->hasFile('featured_image')) {
            $filepath = Storage::disk('public')->put('images/products/featured_image', request()->file('featured_image'));
            $validated['featured_image'] = $filepath;
        }

        if ($p->update($request->validated())) {
            return redirect()->route("dashboard");
        } else {
            return abort(500);
        }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $p = Product::findOrFail($id);

        if ($p->delete()) {
            return redirect()->route("dashboard");
        } else {
            return abort(500);
        }
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = $product;
        $request->session()->put('cart', $cart);
        return redirect()->route('dashboard');
    }
}
