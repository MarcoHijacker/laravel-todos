<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [

        'name',
        'description',
        'status',
        'priority',
        'user_id',

  ];

  public function user() {

    return $this -> belongsTo(User::class);

  }

  public function tasks() {

    return $this -> hasMany(Task::class);

  }

}
