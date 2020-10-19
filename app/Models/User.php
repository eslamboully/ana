<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class,'manager_id','id');
    }

    public function personal_board()
    {
        $board = Board::where(['user_id' => $this->id,'isPersonalities' => 1])->first();
        return $board;
    }

    public function boards()
    {
        $boardsIds = [];
        $roles = $this->roles()->get();
        $boards = [];

        foreach ($roles as $role)
        {
            $exlore = explode('-',$role->name);
            if ($exlore[2]) {
                array_push($boardsIds,$exlore[2]);
            }
            array_unique($boardsIds);
        }
        foreach ($boardsIds as $id)
        {
            $board = Board::find($id);
            array_push($boards,$board);
        }

        return $boards;
    }
}
