<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerySmallBoard extends Model
{
    use HasFactory;
    protected $fillable = ['small_board_id','title','border','startDate','dueDate','duration','comment','users'];

    public function comments()
    {
        return $this->hasMany(Comment::class,'very_small_board_id','id');
    }

    public function files()
    {
        return $this->hasMany(File::class,'very_small_board_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'very_small_board_user','very_small_board_id','user_id');
    }

    public function small_board()
    {
        return $this->belongsTo(SmallBoard::class,'small_board_id','id');
    }

    public function belongToThisUser($id)
    {
        return $this->users->contains($id);
    }
}
