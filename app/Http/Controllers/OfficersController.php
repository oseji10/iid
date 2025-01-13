<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Officers;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class OfficersController extends Controller
{
public function RetrieveAll(){
    $officers = Officers::all();
    return response()->json([
        $officers
    ]);
}
    

  

    public function store(Request $request)
    {
        // Directly get the data from the request
        $data = $request->all();
    
        // Create a new user with the data (ensure that the fields are mass assignable in the model)
        $officers = Officers::create($data);
    
        // Return a response, typically JSON
        return response()->json([ $officers,
        ], 201); // HTTP status code 201: Created
    }

   
}


