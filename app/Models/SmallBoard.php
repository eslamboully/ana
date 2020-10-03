<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallBoard extends Model
{
    use HasFactory;
    protected $fillable = ['title','board_id','bg-color','count_number'];

//    public static function boot() {
//        parent::boot();
//
//        static::creating(function ($small_board) {
//            $results = SmallBoard::query()->where('board_id',);
//            if ($results->count() == 0) {
//                $count_number = 1;
//            }else {
//                $count_number = $results->count() + 1;
//            }
//            $small_board->count_number = $count_number;
//        });
//    }

    public function verySmallBoard()
    {
        return $this->hasMany(VerySmallBoard::class);
    }
}
