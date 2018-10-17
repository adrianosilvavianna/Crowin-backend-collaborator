<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
		use SoftDeletes;
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
    protected $fillable = ['age', 'gender', 'phone', 'photo_address', 'about', 'nick_name', 'cpf'];

		public function User()
		{
		  return  $this->belongsTo(User::class);
		}
}
