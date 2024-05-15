<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\UnitEditRequest;
use App\Http\Requests\Unit\UnitStoreRequest;
use App\Http\Requests\Unit\UnitUpdateRequest;
use App\Services\UnitService;
use Illuminate\Http\Request;
use Exception;

class UnitController extends Controller
{
    private UnitService $unitService;

    public function __construct(UnitService $unitService) {
        $this->unitService = $unitService;
    }

    public function createUnit(UnitStoreRequest $unitStoreRequest)
    {
        try
        {
            request_log($unitStoreRequest->all(), "Incoming input for create unit");
            $result = $this->unitService->createUnit($unitStoreRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't create unit"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from createUnit ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during creating unit");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from createUnit");
            return $finalResponse;
        }
    }


    public function list(Request $request)
    {
        try
        {
            request_log($request->all(), "Incoming input for fetching units");

            $result = $this->unitService->fetchUnit($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't fetch unit"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse,"Final Response from unit list");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during fetching units");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from unit list");
            return $finalResponse;
        }
    }


    public function editUnit(UnitEditRequest $unitEditRequest)
    {
        try
        {
            request_log($unitEditRequest->all(), "Incoming input for edit unit");
            $result = $this->unitService->editUnit($unitEditRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't edit unit"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from editUnit ");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during editing unit");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from editUnit");
            return $finalResponse;
        }
    }


    public function updateCategory(UnitUpdateRequest $unitUpdateRequest)
    {
        try
        {
            request_log($unitUpdateRequest->all(), "Incoming input for update unit");
            $result = $this->unitService->updateUnit($unitUpdateRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["couldn't update unit"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from updateUnit");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during update unit");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from updateUnit", $finalResponse);
            return $finalResponse;
        }
    }
}
