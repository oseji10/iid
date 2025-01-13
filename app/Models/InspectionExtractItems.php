<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InspectionExtractItems extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'inspection_extract_items';
    protected $primaryKey = 'extractId';
    protected $fillable = [
    'extractItemId', 
    'extractId', 
    'year', 
    'costFob', 
    'costCif',
    'exchangeRate',
    'nairaValue',
    'source',
    'type',
    'model',
    'capacity',
    'countryOfOrigin',
    'currency',
    'description'
];
    protected $dates = ['deleted_at'];

   

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'categoryId', 'categoryId'); 
    // }

    

}
