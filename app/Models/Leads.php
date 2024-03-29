<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;
    protected $table = "leads";
    protected $primaryKey = "id";

    public function setNameAttribute($value)
    {
        $this->attributes["name"] = ucwords($value);
    }
}
