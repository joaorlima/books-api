<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReview extends Model {

	protected $table = 'book_review';
	protected $fillable = ['reviewer', 'grade', 'book_id'];
	protected $appends = ['link'];
	protected $perPage = 2;

	public $timestamps = false;

	public function book(): BelongsTo {
		return $this->belongsTo(Book::class);
	}

	public function getLinkAttribute(mixed $_): array {
		return [
			'self' => '/api/review/' . $this->id,
			'book' => '/api/book/' . $this->book_id,
		];
	}

}
