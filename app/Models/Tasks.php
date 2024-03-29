<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "tasks";
    protected $primaryKey = "id";
    protected $with = ['user','categories'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
