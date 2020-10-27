<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment','user_id','board_id','very_small_board_id'];

    public function board()
    {
        return $this->belongsTo(Board::class,'board_id','id');
    }

    public function verySmallBoard()
    {
        return $this->belongsTo(VerySmallBoard::class,'very_small_board_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
