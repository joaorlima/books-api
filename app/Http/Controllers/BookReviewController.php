<?php

namespace App\Http\Controllers;

use App\BookReview;

class BookReviewController extends BaseController {

	public function __construct() {
		$this->class = BookReview::class;
	}

}
