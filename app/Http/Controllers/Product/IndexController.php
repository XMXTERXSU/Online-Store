<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Http\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;

class IndexController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return ProductResource::collection($products);
    }
}
