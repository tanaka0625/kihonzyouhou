<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function words()
    {
        return $this->hasMany(Word::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
