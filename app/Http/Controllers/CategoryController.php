<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryEditRequest;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;    
    }


    public function createCategory(CategoryRequest $categoryRequest)
    {
        try
        {
            request_log("Incoming input for create category", $categoryRequest->all());
            $result = $this->categoryService->createCategory($categoryRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't create category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from createCategory ", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log("Exception occurred during creating category", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from createCategory", $finalResponse);
            return $finalResponse;
        }
    }

    

    public function list(Request $request)
    {
        try
        {
            request_log("Incoming input for fetching category", $request->all());

            $result = $this->categoryService->fetchCategory($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't fetch category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from category list ", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log("Exception occurred during fetching categories", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from category list", $finalResponse);
            return $finalResponse;
        }
    }


    public function editCategory(CategoryEditRequest $categoryEditRequest)
    {
        try
        {
            request_log("Incoming input for edit category", $categoryEditRequest->all());
            $result = $this->categoryService->editCategory($categoryEditRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't edit category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from editCategory ", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log("Exception occurred during editing category", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from editCategory", $finalResponse);
            return $finalResponse;
        }
    }


    public function updateCategory(CategoryUpdateRequest $categoryUpdateRequest)
    {
        try
        {
            request_log("Incoming input for update category", $categoryUpdateRequest->all());
            $result = $this->categoryService->updateCategory($categoryUpdateRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't update category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from updateCategory", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log("Exception occurred during update category", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from updateCategory", $finalResponse);
            return $finalResponse;
        }
    }
}
