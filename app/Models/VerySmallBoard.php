<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerySmallBoard extends Model
{
    use HasFactory;
    protected $fillable = ['small_board_id','title','border','dueDate','comment','users'];
}
