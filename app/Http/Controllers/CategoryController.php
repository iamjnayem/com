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
            request_log($categoryRequest->all(), "Incoming input for create category");
            $result = $this->categoryService->createCategory($categoryRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't create category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from createCategory ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during creating category");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from createCategory");
            return $finalResponse;
        }
    }

    

    public function list(Request $request)
    {
        try
        {
            request_log($request->all(), "Incoming input for fetching category");

            $result = $this->categoryService->fetchCategory($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't fetch category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse,"Final Response from category list ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during fetching categories");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from category list");
            return $finalResponse;
        }
    }


    public function editCategory(CategoryEditRequest $categoryEditRequest)
    {
        try
        {
            request_log($categoryEditRequest->all(), "Incoming input for edit category");
            $result = $this->categoryService->editCategory($categoryEditRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't edit category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from editCategory ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during editing category");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from editCategory");
            return $finalResponse;
        }
    }


    public function updateCategory(CategoryUpdateRequest $categoryUpdateRequest)
    {
        try
        {
            request_log($categoryUpdateRequest->all(), "Incoming input for update category");
            $result = $this->categoryService->updateCategory($categoryUpdateRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't update category"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from updateCategory");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during update category");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from updateCategory", $finalResponse);
            return $finalResponse;
        }
    }
}
