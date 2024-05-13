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
            
            $newProduct = $this->productRepository->createProduct($data);

            if($newProduct == null)
            {
                return null;
            }

            $finalData = [
                'name' => $newProduct->name,
                'description' => $newProduct->description,
                'variations' => $newProduct->variations,
                'stock' => $newProduct->stock,
                'category' => $newProduct->category_id
            ];

            return $finalData;

        }catch(Exception $e)
        {
            exception_log("Failed to create product in product service", $e);
            return null;
        }
    }
}
