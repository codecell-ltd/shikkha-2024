<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovorningBody extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getImageAttribute($image)
    {
        return asset($image);
    }
}
