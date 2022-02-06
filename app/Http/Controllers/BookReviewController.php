<?php

namespace App\Http\Controllers;

use App\BookReview;
use Illuminate\Database\Eloquent\Collection;

class BookReviewController extends BaseController {

	public function __construct() {
		$this->class = BookReview::class;
	}

	public function getPerBook(int $book_id): Collection {
		return BookReview::query()
			->where('book_id', $book_id)
			->get();
	}

}
