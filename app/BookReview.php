<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReview extends Model {

	protected $table = 'book_review';
	protected $fillable = ['reviewer', 'grade', 'book_id'];

	public $timestamps = false;

	public function book(): BelongsTo {
		return $this->belongsTo(Book::class);
	}

}
