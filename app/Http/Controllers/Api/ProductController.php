<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'products' => Product::with(['categories', 'images'])->get(),
        ], 200);
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
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $product = Product::create($request->only('name', 'description'));

            if (isset($request->categories)) {
                foreach ($request->categories as $category) {
                    if (!$temp = Category::where('name', $category['name'])->first()) {
                        $temp = Category::create([
                            'name' => $category['name'],
                        ]);
                    }

                    $product->categories()->attach($temp->id);
                }
            }

            if (isset($request->images)) {
                foreach ($request->images as $image) {
                    $fileName = rand(1000, 9999) . '.' . $image['file']->extension();
                    $image['file']->move(public_path('images'), $fileName);

                    $temp = Image::create([
                        'name' => $image['name'],
                        'file' => '/images/' . $fileName,
                    ]);

                    $product->images()->attach($temp->id);
                }
            }

            DB::commit();

            return response([
                'message' => 'success',
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response([
            'product' => $product->load(['categories', 'images']),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $product->update($request->only('name', 'description'));

            $product->categories()->detach();

            if (isset($request->categories)) {
                foreach ($request->categories as $category) {
                    if (!$temp = Category::where('name', $category['name'])->first()) {
                        $temp = Category::create([
                            'name' => $category['name'],
                        ]);
                    }

                    $product->categories()->attach($temp->id);
                }
            }

            DB::commit();

            return response([
                'message' => 'success',
            ], 202);
        } catch (\Exception $e) {
            DB::rollback();

            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            'message' => 'success',
        ], 202);
    }
}
