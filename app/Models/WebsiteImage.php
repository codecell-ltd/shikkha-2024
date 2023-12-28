<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteImage extends Model
{
    use HasFactory;

    public function getImageAttribute($image)
    {
        return asset($image);
    }
}
