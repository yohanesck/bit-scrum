<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'result' => $this->employee->data()->find($employee->NIP)
        ], 200);
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'result' => $this->employee->data()->get()
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByName(Request $request)
    {
        return response()->json([
            'result' => $this->employee->data()->byName($request->query('name'))->get()
        ], 200);

//        $result = $this->employee->byName($request->query('name'));
//
//        if (empty($result)) {
//            return response()->json([
//               'result' => 'No Data Found'
//            ], 404);
//        } else {
//            return response()->json([
//                'result' => $result
//            ], 200);
//        }
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function getEmployeeCoordinate(Employee $employee)
    {
        return response()->json([
            'result' => $employee->getCoordinate($employee->NIP)
        ], 200);
    }

    /**
     * @param $building
     * @param $floor
     * @return JsonResponse
     */
    public function getEmployeeByFloorBuilding($building, $floor)
    {
        return response()->json([
            'result' => $this->employee->getEmployeeByFloor($building, $floor)
        ], 200);
    }
}
