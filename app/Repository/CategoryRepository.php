<?php

namespace App\Repository;

use App\Models\Category;
use Exception;

class CategoryRepository
{
    private Category $category;
    
    /**
     * Create a new class instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function createCategory($categoryData)
    {
        try{

            $category = $this->category::create($categoryData);
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to Insert Category");
            return null;
        }
    }

    public function fetchCategory($request)
    {
        try{

            $perPage = isset($request->per_page) ? $request->per_page : 10;

            $categories = $this->category::with('creationInfo')
                        ->filter($request->all())
                        ->orderBy('id', 'desc')
                        ->paginate($perPage);

            return $categories;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to fetch Category");
            return null;
        }
    }

    public function findOneById($request)
    {
        try{

            $category = $this->category::with('creationInfo')
                        ->where('id', $request->category)
                        ->first();
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to find Category");
            return null;
        }
    }


    public function updateCategory($request)
    {
        try{
            
            $category = $request->category;
            $data = $request->all();

            if(isset($data['category']))
            {
                unset($data['category']);
            }
            $category = $this->category::where('id', $category)
                        ->update($data);

            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to update Category");
            return null;
        }
    }

    
}
