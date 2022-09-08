<?php
namespace App\Helpers;

use Illuminate\Http\Response;

/**
 * RESTApi has methods to handle restapi response
 */
trait RESTApi
{
    /**
	* Return response with json object
	* @param $responseObject, $responseKey, $statusCode 
	* @return \Illuminate\Http\JsonResponse
	*/
	public function sendJson($responseObject, $statusCode = Response::HTTP_OK, $responseKey = 'response'){
		$jsonResponse['statusCode'] = $statusCode;
		if($responseObject !== null)
			$jsonResponse[$responseKey] = $responseObject;
		return response($jsonResponse, $statusCode);
	}
	
	/**
	* Return response with error object
	* @param $errorObject, $errorKey, $statusCode
	* @return \Illuminate\Http\JsonResponse
	*/
	public function sendError($errorObject, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY, $errorKey = 'error'){
		$errorResponse['statusCode'] = $statusCode;
		$errorResponse[$errorKey] = $errorObject;
		return response($errorResponse, $statusCode);
	}

	/**
	* Get Paginator form LengthAwarePaginator object
	* @param LengthAwarePaginator
	* @return \Illuminate\Http\JsonResponse
	*/
	public function getPaginator($paginatedObject){
		$paginatedArray = $paginatedObject->toArray();
		// $paginator['data'] = $paginatedArray['data'];
		$paginator['links']['first_page_url'] = $paginatedArray['first_page_url'];
		$paginator['links']['last_page_url'] = $paginatedArray['last_page_url'];
		$paginator['links']['next_page_url'] = $paginatedArray['next_page_url'];
		$paginator['links']['prev_page_url'] = $paginatedArray['prev_page_url'];
		$paginator['meta']['path'] = $paginatedArray['path'];
		$paginator['meta']['current_page'] = $paginatedArray['current_page'];
		$paginator['meta']['from'] = $paginatedArray['from'];
		$paginator['meta']['per_page'] = $paginatedArray['per_page'];
		$paginator['meta']['to'] = $paginatedArray['to'];
		$paginator['meta']['total'] = $paginatedArray['total'];
		return $paginator;
	}

	/**
	* Return Paginated json response
	*
	* @param Illuminate\Pagination\LengthAwarePaginator
	* @param Illuminate\Http\Resources\Json\ResourceCollection
	* @return array
	*/

	public function getPaginatedResponse( $paginatedObject,  $resourceCollection) {
		// dd($paginatedObject);
		$paginator = $this->getPaginator($paginatedObject);
		return[
			'data' => $resourceCollection,
			'links' => $paginator['links'],
			'meta' => $paginator['meta']
		];
	}
}

?>