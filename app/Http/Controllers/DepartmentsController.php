<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departments;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class DepartmentsController extends Controller
{
public function RetrieveAll(){
    $departments = Departments::all();
    return response()->json([
        $departments
    ]);
}
    

  

    public function store(Request $request)
    {
        // Directly get the data from the request
        $data = $request->all();
    
        // Create a new user with the data (ensure that the fields are mass assignable in the model)
        $departments = Departments::create($data);
    
        // Return a response, typically JSON
        return response()->json([ $departments,
        ], 201); // HTTP status code 201: Created
    }

   
}


