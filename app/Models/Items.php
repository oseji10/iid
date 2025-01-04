<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Items extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'items';
    protected $primaryKey = 'itemId';
    protected $fillable = ['itemId', 'categoryId', 'description', 'brand', 'type', 'source', 'comment', 'year', 'value', 'model'];
    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId'); 
    }

    

}
