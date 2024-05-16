<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductEditRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
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

    public function createProduct(ProductStoreRequest $request)
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



    public function list(Request $request)
    {
        try
        {
            request_log($request->all(), "Incoming input for fetching products");

            $result = $this->productService->fetchProduct($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't fetch product"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse,"Final Response from product list ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during fetching products");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from product list");
            return $finalResponse;
        }
    }


    public function editProduct(ProductEditRequest $productEditRequest)
    {
        try
        {
            request_log($productEditRequest->all(), "Incoming input for edit product");
            $result = $this->productService->editProduct($productEditRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't edit product"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from editProduct ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during editing product");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from editProduct");
            return $finalResponse;
        }
    }


    public function updateCategory(ProductUpdateRequest $productUpdateRequest)
    {
        try
        {
            request_log($productUpdateRequest->all(), "Incoming input for update product");
            $result = $this->productService->updateProduct($productUpdateRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't update product"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from updateProduct");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during update product");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from updateProduct", $finalResponse);
            return $finalResponse;
        }
    }
}
