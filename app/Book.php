<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model {

	protected $table = 'book';
	protected $fillable = ['name', 'author', 'genre'];

	public $timestamps = false;

	public function bookReview(): HasMany {
		return $this->hasMany(BookReview::class);
	}

}
