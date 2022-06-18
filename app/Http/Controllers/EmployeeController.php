<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::all()
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            'employeeRoles' => EmployeeRole::all()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:100',
            'date_of_birth' => ['required', 'date', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->diff(Carbon::now())->y;
                if ($age < 18 || $age > 65) {
                    $fail('The ' . $attribute . ' is invalid GUASAAAA.');
                }
            }],
            'email' => 'required|email',
            'employee_role_id' => 'required'
        ]);

        Employee::create($attributes);
        return response()->json(['redirect_to' => route('home')]);
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'employeeRoles' => EmployeeRole::all()
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $attributes = $request->validate([
            'name' => 'required|max:100',
            'date_of_birth' => ['required', 'date', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->diff(Carbon::now())->y;
                if ($age < 18 || $age > 65) {
                    $fail('The ' . $attribute . ' is invalid GUASAAAA.');
                }
            }],
            'email' => 'required|email',
            'employee_role_id' => 'required'
        ]);

        $employee->name = $attributes['name'];
        $employee->surname = $attributes['surname'] ?? null;
        $employee->date_of_birth = $attributes['date_of_birth'];
        $employee->email = $attributes['email'];
        $employee->employee_role_id = $attributes['employee_role_id'];

        $employee->save();

        return response()->json(['redirect_to' => route('home')]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['redirect_to' => route('home')]);
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->employees as $employee) {
            Employee::find($employee)->delete();
        }

        return response()->json(['redirect_to' => route('home')]);
    }
}
