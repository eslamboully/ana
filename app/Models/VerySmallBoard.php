<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerySmallBoard extends Model
{
    use HasFactory;
    protected $fillable = ['small_board_id','title','border','dueDate','comment','users'];

    public function comments()
    {
        return $this->hasMany(Comment::class,'very_small_board_id','id');
    }

    public function files()
    {
        return $this->hasMany(File::class,'very_small_board_id','id');
    }
}
