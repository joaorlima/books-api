<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model {

	protected $table = 'book';
	protected $fillable = ['name', 'author', 'genre'];
	protected $appends = ['link'];
	protected $perPage = 5;

	public $timestamps = false;

	public function bookReview(): HasMany {
		return $this->hasMany(BookReview::class);
	}

	public function getLinkAttribute(mixed $_): array {
		return [
			'self' => '/api/book/' . $this->id,
			'reviews' => '/api/book/' . $this->id . '/review/',
		];
	}

}
