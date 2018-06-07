<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['ip', 'tanggal', 'hits', 'online','page',];
}
