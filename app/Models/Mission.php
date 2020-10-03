<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','status','manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id','id');
    }
}
