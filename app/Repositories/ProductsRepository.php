<?php

namespace App\Repositories;

use App\Http\Requests\Admin\Products\CreateRequest;
use App\Models\Product;
use App\Repositories\Contract\ProductsRepositoryContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ProductsRepository implements ProductsRepositoryContract
{

    public function create(CreateRequest $request): Product|false
    {
        try {
            DB::beginTransaction();

            $data = $this->formRequestData($request);
            $product = Product::create($data['attributes']);
            $this->setProductRelationData($product, $data);


            DB::commit();
            return $product;
        } catch (Throwable $e) {
            DB::rollBack();

            logs()->error($e->getMessage());

            return false;
        }
    }

    protected function setProductRelationData(Product $product, array $data): void
    {
        $product->categories()->sync($data['categories']);
    }

    protected function formRequestData(CreateRequest $request): array
    {
        return [
            'attributes' => collect($request->validated())
                ->except(['categories'])
                ->prepend(Str::slug($request->get('title')), 'slug')
                ->toArray(),
            'categories' => $request->get('categories', [])

        ];
    }
}
