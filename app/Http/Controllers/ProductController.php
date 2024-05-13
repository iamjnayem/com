<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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
            request_log("Incoming input for create product", $request->all());
            $result = $this->productService->createProduct($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't create product"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from createProduct ", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log("Exception occurred during creating product", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from createProduct", $finalResponse);
            return $finalResponse;
        }
    }
}
