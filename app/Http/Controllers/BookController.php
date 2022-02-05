<?php

namespace App\Http\Controllers;

use App\Book;

class BookController extends BaseController {

	public function __construct() {
		$this->class = Book::class;
	}

}
