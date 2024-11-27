<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        list(
            $dataProduct,
            $dataProductVariants,
            $dataProductImages,
            $dataProductTags
        ) = $this->handleData($request);

        try {
            DB::beginTransaction();

            /** @var Product $product */

            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $item) {
                $item += ['product_id' => $product->id];
                ProductVariant::query()->create($item);
            }

            $product->tags()->attach($dataProductTags);

            foreach ($dataProductImages as $item) {
                $item += ['product_id' => $product->id];

                ProductImage::query()->create($item);
            }

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Thao tác thành công');
        } catch (\Throwable $exception) {
            DB::rollBack();

            Log::error('Error in ProductController@store: ' . $exception->getMessage(), [
                'dataProduct' => $dataProduct,
                'dataProductVariants' => $dataProductVariants,
                'dataProductTags' => $dataProductTags,
                'dataProductImages' => $dataProductImages,
            ]);

            if (!empty($dataProduct['img_thumbnail']) && Storage::exists($dataProduct['img_thumbnail'])) {
                Storage::delete($dataProduct['img_thumbnail']);
            }

            $dataHasImage = $dataProductVariants + $dataProductImages;
            foreach ($dataHasImage as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Đã xảy ra lỗi khi lưu sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    private function handleData(StoreProductRequest $request)
    {

        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);

 
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if (!empty($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVarriantsTmp = $request->product_variants;
        // dd($dataProductVarriantsTmp);
        $dataProductVariants = [];

        foreach ($dataProductVarriantsTmp as $key => $item) {
            $tmp = explode('-', $key);

            $dataProductVariants[] = [
                'product_color_id'  => $tmp[0],
                'product_size_id'   => $tmp[1],
                'quantity'          => $item['quantity'],
                'image'             => !empty($item['image']) ? Storage::put('product_variants', $item['image']) : null
            ];
        }

        $dataProductGalleriesTmp = $request->product_galleries ?: [];
        $dataProductGalleries = [];

        foreach ($dataProductGalleriesTmp as $image) {
            if (!empty($image)) {
                $dataProductGalleries[] = [
                    'image' => Storage::put('product_images', $image)
                ];
            }
        }

        $dataProductTags = $request->tags;

        return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataProductTags];
    }
}
