<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Items;
use App\Models\Category;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class ItemsController extends Controller
{
public function RetrieveAll(Request $request)
    {
        $limit = $request->input('limit', 10);
        $searchQuery = $request->input('query');
        
        $items = Items::with('category')
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('description', 'like', "%{$searchQuery}%")
                    ->orWhere('itemCode', 'like', "%{$searchQuery}%");
                    
                    // ->orWhereRaw("CONCAT(firstName, ' ', lastName) LIKE ?", ["%{$searchQuery}%"])
                    // ->orWhereRaw("CONCAT(firstName, ' ', lastName, ' ', otherNames) LIKE ?", ["%{$searchQuery}%"]);
            })
            ->orderBy('itemId', 'asc')
            ->paginate($limit);
    
        return response()->json([
            'data' => $items->items(),
            'total' => $items->total(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
        ]);
    }


    public function searchDataBank(Request $request)
    {
        $limit = $request->input('limit', 10);
        $searchQuery = $request->input('queryParameter');
        $rate = (float) $request->input('rate', 0) / 100;
        $yearUnderReview = (int) $request->input('yearUnderReview', date('Y')); // Ensure yearUnderReview is an integer
    
        $items = DB::table('items')
            ->select('itemId', 'year', 'value', 'description', 'itemCode', 'source')
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('year', 'like', "%{$searchQuery}%")
                    ->orWhere('value', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%")
                    ->orWhere('brand', 'like', "%{$searchQuery}%")
                    ->orWhere('itemCode', 'like', "%{$searchQuery}%");
            })
            ->get()
            ->map(function ($item) use ($rate, $yearUnderReview) {
                $item->value = (float) $item->value; // Ensure value is a float
                $item->year = (int) $item->year; // Ensure year is an integer
    
                // Perform calculation
                // $item->calculated_value = $item->value * pow(((1 + $rate)*100), ($item->year - $yearUnderReview));
                $item->calculated_value = $item->value * pow((1 + $rate), ($yearUnderReview - $item->year));

                return $item;
            });
    
        $paginatedItems = $this->paginate($items, $limit);
    
        return response()->json([
            'data' => $paginatedItems['data'],
            'total' => $paginatedItems['total'],
            'current_page' => $paginatedItems['current_page'],
            'last_page' => $paginatedItems['last_page'],
        ]);
    }
    

    private function paginate($items, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $total = $items->count();
        $itemsForPage = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
        return [
            'data' => $itemsForPage,
            'total' => $total,
            'current_page' => $currentPage,
            'last_page' => (int) ceil($total / $perPage),
        ];
    }

    public function store(Request $request)
    {
        // Directly get the data from the request
        $data = $request->all();
    
        // Create a new user with the data (ensure that the fields are mass assignable in the model)
        $items = Items::create($data);
    
        // Return a response, typically JSON
        return response()->json([ $items,
        ], 201); // HTTP status code 201: Created
    }

    public function retrieveCategories(){
        $category = Category::all();
        return response()->json([
            $category
        ]);
    }
}


