<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController {

	protected string $class;

	public function index(Request $request): LengthAwarePaginator {
		return $this->class::paginate($request->per_page);
	}

	public function store(Request $request): JsonResponse {
		$resource = $this->class::create($request->all());

		return response()->json($resource, Response::HTTP_CREATED);
	}

	public function show(int $id): JsonResponse {
		$resource = $this->class::find($id);

		if (null === $resource) {
			return $this->resourceNotFoundResponse('Resource not found', Response::HTTP_NOT_FOUND);
		}

		return response()->json($resource, Response::HTTP_ACCEPTED);
	}

	public function update(int $id, Request $request): JsonResponse {
		$resource = $this->class::find($id);

		if (null === $resource) {
			return $this->resourceNotFoundResponse('Resource not found. Could not update', Response::HTTP_NOT_FOUND);
		}

		$resource->fill($request->all());
		$resource->save();

		return response()->json($resource, Response::HTTP_FOUND);
	}

	public function destroy(int $id) {
		$removed_resources = $this->class::destroy($id);
		if ($removed_resources === 0) {
			return $this->resourceNotFoundResponse('Resource not found. Could not delete', Response::HTTP_NOT_FOUND);
		}

		return response()->json([], Response::HTTP_ACCEPTED);
	}

	private function resourceNotFoundResponse(string $error_message, int $http_code): JsonResponse {
		return response()->json(['error' => $error_message], $http_code);
	}

}
