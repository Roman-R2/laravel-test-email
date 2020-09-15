<?php

declare(strict_types=1);

namespace App\Entity;

use Eloquent;

class Message extends Eloquent
{
    protected $fillable = [
        'message', "remote_ip", 'token', 'expired_date'
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'expired_date' => 'datetime',
    ];
}
