<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Staff extends Model
{
  use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'name', 'designation', 'section', 'employee_type', 'phone', 'email', 'photo', 'room_no', 'photo_full_path'
	];

	public function setPhotoAttribute($image) {
		$this->attributes['photo'] = $image;
		$this->attributes['photo_full_path'] = env('APP_URL') .'/storage/staff/' .$image;
	}
}
