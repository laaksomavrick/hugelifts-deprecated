<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Exercise extends Model
{

    protected $fillable = [
      'user_id',
      'name',
      'rep_max_interval',
      'rep_max'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
