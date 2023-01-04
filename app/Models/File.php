<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $hash_name
 */
class File extends Model
{
    protected $fillable = [
        'name',
        'path',
        'hash_name',
        'public_link',
        'folder_id',
        'size'
    ];

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->path . '/' . $this->name;
    }

}
