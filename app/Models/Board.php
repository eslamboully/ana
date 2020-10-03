<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','isPersonalities'];

    public function smallBoards()
    {
        return $this->hasMany(SmallBoard::class);
    }
}
