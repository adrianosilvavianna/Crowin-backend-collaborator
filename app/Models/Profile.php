<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Get table relationship
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * Get guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return  $this->belongsTo(User::class);
    }
}
