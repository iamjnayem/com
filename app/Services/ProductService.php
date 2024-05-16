<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;

class ProductService
{
    private ProductRepository $productRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function createProduct($request)
    {
        try
        {
            $data = $request->validated();
            $data['variations'] = json_encode($data['variations']);
            $data['created_by'] = auth()->user()->id;
            
            $newProduct = $this->productRepository->createProduct($data);

            if($newProduct == null)
            {
                return null;
            }

            $finalData = [
                'name'        => $newProduct->name,
                'description' => $newProduct->description,
                'stock'       => $newProduct->stock,
                'category'    => $newProduct->category_id,
                "unit_id"     => $newProduct->unit_id,
                'created_by'  => $newProduct->created_by,
                'variations'  => json_decode($newProduct->variations)
            ];

            return $finalData;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to create product in product service");
            return null;
        }
    }

    public function fetchProduct($request)
    {
        
        try
        {
            $products = $this->productRepository->fetchProduct($request);
            return $products;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to create product in product service");
            return null;
        }
    }


    public function editProduct($request)
    {
        try
        {
            $product = $this->productRepository->findOneById($request);

            return $product;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to edit product in product service");
            return null;
        }
    }

    
    public function updateProduct($request)
    {
        try
        {
            $category = $this->productRepository->updateProduct($request);
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to update product in product service");
            return null;
        }
    }
}
