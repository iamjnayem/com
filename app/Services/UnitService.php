<?php

namespace App\Services;

use App\Repositories\UnitRepository;
use Exception;

class UnitService
{
    private UnitRepository $unitRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function createUnit($request)
    {
        try
        {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->id;
            
            $newUnit = $this->unitRepository->createUnit($data);

            if($newUnit == null)
            {
                return null;
            }

            $finalData = [
                'name'   => $newUnit->name,
                'status' => $newUnit->status
            ];

            return $finalData;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to create unit in unit service");
            return null;
        }
    }

    public function fetchUnit($request)
    {
        try
        {
            $categories = $this->unitRepository->fetchUnit($request);
            return $categories;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to create unit in unit service");
            return null;
        }
    }

    public function editUnit($request)
    {
        try
        {
            $category = $this->unitRepository->findOneById($request);

            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to edit unit in unit service");
            return null;
        }
    }

    
    public function updateCategory($request)
    {
        try
        {
            $category = $this->unitRepository->updateUnit($request);
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to edit unit in unit service");
            return null;
        }
    }
}
