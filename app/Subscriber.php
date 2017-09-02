<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['telegram_user_id'];
    protected $table = 'subscribers';
}
