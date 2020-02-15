<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notice extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image', 'image_full_path',
    ];

    public function setImageAttribute($image) {
		$this->attributes['image'] = $image;
		$this->attributes['image_full_path'] = env('APP_URL') .'/storage/notice/' .$image;
	}
}
