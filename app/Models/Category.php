<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'categories';
    protected $primaryKey = 'categoryId';
    protected $fillable = ['categoryId', 'categoryName'];
    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId'); 
    }

    

}
