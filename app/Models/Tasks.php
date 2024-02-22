<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "tasks";
    protected $primaryKey = "id";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
