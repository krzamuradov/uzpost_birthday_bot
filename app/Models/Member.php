<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        "firstname",
        "lastname",
        "middlename",
        "birthday_at",
        "is_active"
    ];
}
