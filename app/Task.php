<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [

        'name',
        'description',
        'status',
        'priority',
        'checklist_id',

  ];

  public function checklist() {

    return $this -> belongsTo(Checklist::class);

  }
}
