<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $primaryKey = "id";

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}


