<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InspectionExtract extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'inspection_extract';
    protected $primaryKey = 'extractId';
    protected $fillable = [
    'extractId', 
    'companyName', 
    'fileNumber', 
    'natureOfBusiness', 
    'officerId'
];
    protected $dates = ['deleted_at'];

    
    public function inspection_items()
    {
        return $this->hasMany(InspectionExtractItems::class, 'extractId', 'extractId'); 
    }

    

}
