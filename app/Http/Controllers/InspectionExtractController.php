<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InspectionExtract;
use App\Models\InspectionExtractItems;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class InspectionExtractController extends Controller
{
public function RetrieveAll(){
    $inspection_extracts = InspectionExtract::with('inspection_items')->get();
    // $inspection_extracts = InspectionExtract::all();
    return $inspection_extracts;
    // return response()->json([
    //     $inspection_extracts
    // ]);
}
    

public function store(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'companyName' => 'nullable|string',
        'fileNumber' => 'nullable|string',
        'natureOfBusiness' => 'nullable|string',
        // 'officerId' => 'nullable|exists:officers,officerId',
        'inspectionItems' => 'required|array',
        'inspectionItems.*.description' => 'nullable|string',
        'inspectionItems.*.year' => 'nullable|string',
        'inspectionItems.*.countryOfOrigin' => 'nullable|string',
        'inspectionItems.*.costFob' => 'nullable|string',
        'inspectionItems.*.costCif' => 'nullable|string',
        'inspectionItems.*.exchangeRate' => 'nullable|string',
        'inspectionItems.*.nairaValue' => 'nullable|string',
        'inspectionItems.*.source' => 'nullable|string',
        'inspectionItems.*.type' => 'nullable|string',
        'inspectionItems.*.model' => 'nullable|string',
        'inspectionItems.*.capacity' => 'nullable|string',
        'inspectionItems.*.currency' => 'nullable|string',
    ]);

    try {
        // Use a transaction to ensure both tables are updated atomically
        DB::beginTransaction();

        // Create the inspection extract record
        $inspectionExtract = InspectionExtract::create([
            'companyName' => $validatedData['companyName'] ?? null,
            'fileNumber' => $validatedData['fileNumber'] ?? null,
            'natureOfBusiness' => $validatedData['natureOfBusiness'] ?? null,
            // 'officerId' => $validatedData['officerId'] ?? null,
        ]);

        // Loop through each item and insert into the inspection_extract_items table
        $itemsData = $validatedData['inspectionItems'];
        foreach ($itemsData as $item) {
            InspectionExtractItems::create([
                'extractId' => $inspectionExtract->extractId,
                'description' => $item['description'] ?? null,
                'year' => $item['year'] ?? null,
                'countryOfOrigin' => $item['countryOfOrigin'] ?? null,
                'costFob' => $item['costFob'] ?? null,
                'costCif' => $item['costCif'] ?? null,
                'exchangeRate' => $item['exchangeRate'] ?? null,
                'nairaValue' => $item['nairaValue'] ?? null,
                'source' => $item['source'] ?? null,
                'type' => $item['type'] ?? null,
                'model' => $item['model'] ?? null,
                'capacity' => $item['capacity'] ?? null,
                'currency' => $item['currency'] ?? null,
            ]);
        }

        // Commit the transaction
        DB::commit();

        return response()->json([
            'message' => 'Inspection extract and items successfully created.',
            'inspectionExtract' => $inspectionExtract,
            'items' => $inspectionExtract->items,
        ], 201);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();

        return response()->json([
            'message' => 'An error occurred while creating the inspection extract.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


   
}


