<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Officers extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'officers';
    protected $primaryKey = 'officerId';
    protected $fillable = [
    'officerId', 
    'officerName', 
    'departmentId', 
    'designation', 
    'signature'
];
    protected $dates = ['deleted_at'];

    
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'categoryId', 'categoryId'); 
    // }

    

}
