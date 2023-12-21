<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AllUser extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
