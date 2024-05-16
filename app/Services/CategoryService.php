<?php

namespace App\Services;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Exception;

class CategoryService
{
    private CategoryRepository $categoryRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function createCategory($request)
    {
        try
        {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->id;
            
            $newCategory = $this->categoryRepository->createCategory($data);

            if($newCategory == null)
            {
                return null;
            }

            $finalData = [
                'name'   => $newCategory->name,
                'status' => $newCategory->status
            ];

            return $finalData;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to create category in category service");
            return null;
        }
    }

    public function fetchCategory($request)
    {
        try
        {
            $categories = $this->categoryRepository->fetchCategory($request);
            return $categories;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to fetch category in category service");
            return null;
        }
    }


    public function editCategory($request)
    {
        try
        {
            $category = $this->categoryRepository->findOneById($request);

            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to edit category in category service");
            return null;
        }
    }

    
    public function updateCategory($request)
    {
        try
        {
            $category = $this->categoryRepository->updateCategory($request);
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to update category in category service");
            return null;
        }
    }
}
