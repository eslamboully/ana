<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'photo',
        'country',
        'phone',
        'job',
        'dateOfBirth',
        'address'
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

    public function haveBoard($id)
    {
        $boardsIds = [];
        $roles = $this->roles()->get();

        foreach ($roles as $role)
        {
            $exlore = explode('-',$role->name);
            if ($exlore[2]) {
                array_push($boardsIds,$exlore[2]);
            }
            array_unique($boardsIds);
        }

        if (in_array($id,$boardsIds)) {
            return true;
        }
        return false;
    }

    public function very_small_boards()
    {
        return $this->belongsToMany(VerySmallBoard::class,'very_small_board_user','very_small_board_id','user_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class,'user_package','user_id','package_id');
    }

    public function hasPackage()
    {
        $lastPackage = $this->packages()->get()->last();
        if($lastPackage) {
            $expirationCondition = DB::table('user_package')
                ->where('user_id',$this->id)
                ->where('package_id',$lastPackage->id)
                ->get()->last();
            if (Carbon::parse($expirationCondition->end_at) > Carbon::now()) {
                return true;
            }
        }
        return false;
    }

    public function hasPackageInfo()
    {
        $lastPackage = $this->packages()->get()->last();
        if($lastPackage) {
            $expirationCondition = DB::table('user_package')
                ->where('user_id',$this->id)
                ->where('package_id',$lastPackage->id)
                ->get()->last();
            if (Carbon::parse($expirationCondition->end_at) > Carbon::now()) {
                return ['package' => $lastPackage,'package-info' => $expirationCondition];
            }
        }
        return null;
    }
}
