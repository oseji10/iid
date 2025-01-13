<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Departments extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'departments';
    protected $primaryKey = 'departmentId';
    protected $fillable = [
    'departmentId', 
    'departmentName', 
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
