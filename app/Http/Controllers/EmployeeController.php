<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->query('name');
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
     * @param Request $request
     * @return JsonResponse
     */
    public function showName(Request $request)
    {
        return response()->json([
            'result' => $this->employee->name()
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByName(Request $request)
    {
        dd($request->toArray()['name']);
        return response()->json([
            'result' => $this->employee->byName($request->toArray())
        ], 200);
    }
}
