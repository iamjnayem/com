<?php

namespace App\Repositories;

use App\Models\Product;
use Exception;

class ProductRepository
{
 
    private Product $product;

    /**
     * Create a new class instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function createProduct($productData)
    {
        try{

            $product = $this->product::create($productData);
            return $product;

        }catch(Exception $e)
        {
            exception_log("Failed to Insert Product", $e);
            return null;
        }
    }
}
