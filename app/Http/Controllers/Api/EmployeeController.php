<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        $query = Employee::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('nopeg', 'LIKE', "%$search%");
        }

        $employees = $query->paginate($perPage);

        return response()->json($employees);
    }

    public function listAnnualSalary(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        $query = DB::table('annual_salary')
            ->select('employees.*', 'annual_salary.*')
            ->join('employees', 'employees.id', 'annual_salary.employee_id');

        if ($search) {
            $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('nopeg', 'LIKE', "%$search%");
        }

        $employees = $query->paginate($perPage);

        return response()->json($employees);   
    }

    public function detailAnnualSalary($id)
    {
        $data = DB::table('annual_salary')
            ->select(
                'employees.nopeg', 
                'employees.name', 
                'employees.company', 
                'employees.directorate', 
                'employees.division', 
                'employees.department', 
                'employees.section', 
                'employees.location', 
                'employees.current_gapok', 
                'annual_salary.*'
            )
            ->join('employees', 'employees.id', 'annual_salary.employee_id')
            ->where('annual_salary.id', $id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Detail Annual',
            'data' => $data
        ], 200);
    }

    public function detail($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Employee',
            'data' => Employee::where('id', $id)->first()
        ], 200);
    }

    public function getnoreg()
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Employee',
            'code' => $this->generateNoreg(),
            'date' => date('Y-m-d')
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $employee = DB::table('employees')->where('nopeg', $request->nopeg)->first();

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found'
                ], 404);
            }
            if (isset($request->id) && $request->id) {
                DB::table('annual_salary')->where('id', $request->id)
                ->update([
                    'employee_id' => $employee->id,
                    'register_date' => date('Y-m-d', strtotime($request->register_date)),
                    'adjustment_option' => $request->adjustmentType,
                    'amount' => $request->adjustmentType == 'percentage' ? 0 : $request->amount,
                    'percentage' => $request->adjustmentType == 'percentage' ? $request->percentage : 0,
                    'new_gapok' => $request->new_gapok,
                    'adjustment' => $request->adjustment,
                    'pctg_adjustment' => $request->adjustmentType == 'percentage' ? $request->pctg_adjustment : 0,
                    'flag_status' => 'register',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                $noreg = $this->generateNoreg();
                DB::table('annual_salary')->insert([
                    'noreg' => $noreg,
                    'employee_id' => $employee->id,
                    'register_date' => date('Y-m-d', strtotime($request->register_date)),
                    'adjustment_option' => $request->adjustmentType,
                    'amount' => $request->adjustmentType == 'percentage' ? 0 : $request->amount,
                    'percentage' => $request->adjustmentType == 'percentage' ? $request->percentage : 0,
                    'new_gapok' => $request->new_gapok,
                    'adjustment' => $request->adjustment,
                    'pctg_adjustment' => $request->adjustmentType == 'percentage' ? $request->pctg_adjustment : 0,
                    'flag_status' => 'register',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Annual Salary record successfully created'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create annual salary record',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function generateNoreg()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');

        $lastNoreg = DB::table('annual_salary')
            ->whereRaw("DATE_FORMAT(created_at, '%Y/%m') = ?", ["$year/$month"])
            ->orderBy('noreg', 'desc')
            ->value('noreg');

        if ($lastNoreg) {
            $lastNumber = (int) substr($lastNoreg, -6);
            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '000001';
        }

        return "$year/$month/$newNumber";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
