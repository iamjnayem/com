<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function createProduct(ProductRequest $request)
    {
        try
        {
            request_log($request->all(), "Incoming input for create product");
            $result = $this->productService->createProduct($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't create product"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from createProduct ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during creating product");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from createProduct");
            return $finalResponse;
        }
    }
}
