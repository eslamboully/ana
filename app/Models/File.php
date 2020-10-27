<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file','board_id','very_small_board_id'];

    public function verySmallBoard()
    {
        return $this->belongsTo(VerySmallBoard::class,'very_small_board_id','id');
    }
}
