<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vino extends Model
{
    protected $fillable = ['nombre','img','edad','color','sabor','alcohol','precio','stock'];
}
