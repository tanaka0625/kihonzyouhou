<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function subCategories()
    {
        return $this->hasMany(subCategory::class);
    }

}
