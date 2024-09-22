<?php

namespace App\Http\Controllers\Api\V1;

class ProductCollection
{

    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $products
     */
    public function __construct(\Illuminate\Contracts\Pagination\LengthAwarePaginator $products)
    {
    }
}
