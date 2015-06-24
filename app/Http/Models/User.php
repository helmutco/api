<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'ht_users';
	protected $fillable = ['email'];
}