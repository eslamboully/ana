<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','isPersonalities','name','startDate','endDate'];

    public function smallBoards()
    {
        return $this->hasMany(SmallBoard::class);
    }

    public function verySmallBoard()
    {
        $smallBoards = $this->smallBoards;
        $verySmallBoards = [];
        foreach ($smallBoards as $smallBoard) {
            if (!empty($smallBoard->verySmallBoard))
            {
                foreach ($smallBoard->verySmallBoard as $verySmallBoard)
                {
                    array_push($verySmallBoards,$verySmallBoard);
                }
            }
        }

        return $verySmallBoards;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'board_id','id');
    }

    public function files()
    {
        return $this->hasMany(File::class,'board_id','id');
    }
}
