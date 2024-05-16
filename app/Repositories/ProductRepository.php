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
            exception_log($e, "Failed to Insert Product");
            return null;
        }
    }


    public function fetchProduct($request)
    {
        try{
           
            $perPage = isset($request->per_page) ? $request->per_page : 10;

            $products = $this->product::with(['creationInfo', 'category'])
                        ->filter($request->all())
                        ->orderBy('id', 'desc')
                        ->paginate($perPage);
            
                        
            return $products;

        }catch(Exception $e)
        {
            dd($e->getMessage());
            exception_log($e, "Failed to fetch product");
            return null;
        }
    }

    public function findOneById($request)
    {
        try{

            $product = $this->product::with(['creationInfo', 'category'])
                       ->where('id', $request->product)
                       ->first();
            return $product;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to find Product");
            return null;
        }
    }


    public function updateProduct($request)
    {
        try{
            $product = $request->product;

            $data = $request->all();
            if(isset($data['product']))
            {
                unset($data['product']);
            }
            $product = $this->product::where('id', $product)->update($data);
            return $product;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to update Product");
            return null;
        }
    }
}
