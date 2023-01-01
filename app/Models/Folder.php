<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string name
 * @property-read integer user_id
 */
class Folder extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_id',
    ];

}
