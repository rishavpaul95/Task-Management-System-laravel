<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'email',
        'address',

    ];

    // My functions
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function categories()
    {
        return $this->hasMany(Categories::class);
    }
}
