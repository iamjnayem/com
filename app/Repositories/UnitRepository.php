<?php

namespace App\Repositories;

use App\Models\Unit;
use Exception;

class UnitRepository
{
    private Unit $unit;

    /**
     * Create a new class instance.
     */
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    public function createUnit($unitData)
    {
        try{

            $unit = $this->unit::create($unitData);
            return $unit;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to Insert Unit");
            return null;
        }
    }

    public function fetchUnit($request)
    {
        try{

            $perPage = isset($request->per_page) ? $request->per_page : 10;

            $units = $this->unit::with('creationInfo')->filter($request->all())->orderBy('id', 'desc')->paginate($perPage);
            return $units;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to fetch unit");
            return null;
        }
    }

    public function findOneById($request)
    {
        try{

            $category = $this->unit::with('creationInfo')->where('id', $request->category)->first();
            return $category;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to find unit");
            return null;
        }
    }


    public function updateUnit($request)
    {
        try{
            $unit = $request->unit;

            $data = $request->all();
            if(isset($data['unit']))
            {
                unset($data['unit']);
            }
            $category = $this->unit::where('id', $unit)->update($data);
            return $unit;

        }catch(Exception $e)
        {
            exception_log($e, "Failed to update unit");
            return null;
        }
    }

}
