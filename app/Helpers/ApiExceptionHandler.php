<?php
namespace App\Helpers;

use Exception;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * ApiExceptionHandler to convert exception to json response with specific structure 
 */
trait ApiExceptionHandler
{
    /**
    * Render exception as HTTP response json object 
    * @param  \Illuminate\Http\Request  $request
    * @param  \Exception  $exception
    * @return \Illuminate\Http\Response
    */

    public function apiException($request,Exception $exception){

        /** Handle ModelNotFoundException */
        if($exception instanceof ModelNotFoundException){
            return $this->renderException('ModelNotFoundException',$exception->getMessage(),Response::HTTP_NOT_FOUND);
        }
    
        /** Handle NotFoundHttpException */
        if ($exception instanceof NotFoundHttpException) {
            return $this->renderException('NotFoundHttpException',"Route Not Found",Response::HTTP_NOT_FOUND);
        }
    
        /** Handle AuthenticationException */
        if($exception instanceof AuthenticationException) {
            return $this->renderException('AuthenticationException','Unauthorized Action',Response::HTTP_UNAUTHORIZED);	
        }
    
        /** Handle UnauthorizedException */
        if($exception instanceof UnauthorizedException) {
                return $this->renderException('UnauthorizedException',$exception->getMessage(),$exception->getStatusCode());     
        }
    
        /** Handle QueryException */
        if($exception instanceof QueryException){
                return $this->renderException('QueryException',$exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);       
        }
            
        /** Handle MethodNotAllowedHttpException */
        if($exception instanceof MethodNotAllowedHttpException){
                return $this->renderException('MethodNotAllowedHttpException',"Method Not Allowed Http",Response::HTTP_INTERNAL_SERVER_ERROR);       
        }
        
        /** Handle ThrottleRequestsException */
        if($exception instanceof ThrottleRequestsException){
            return $this->renderException('ThrottleRequestsException', 'Too Many Attempts.', Response::HTTP_TOO_MANY_REQUESTS);
        }

        /** Handle TooManyRequestsHttpException */
        if($exception instanceof TooManyRequestsHttpException){
            return $this->renderException('TooManyRequestsHttpException', 'Too Many Attempts.', Response::HTTP_TOO_MANY_REQUESTS);
        }

        /** Handle ErrorException */
        if($exception instanceof ErrorException){
            return $this->renderException('ErrorException', $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        /** Handle ValidationException */
        if($exception instanceof  ValidationException){
                
            /** Start convert validation errors array to string. */
            $errors = [];
            if(count($exception->errors())){
                foreach ($exception->errors() as $field => $err) {
                    if(count($err)){
                        foreach ($err as $key => $value) {
                            $errors[] = $value;
                        }
                    }
                }
            }
            $errorsString = implode('', $errors);
            /** End*/
    
            return $this->renderException('ValidationException',$errorsString,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        return parent::render($request, $exception);
    }

    /**
    * Render Exception as json object
    * @param $exceptionName,$exceptionMessage,$statusCode
    * @return \Illuminate\Http\Response
    */
    public function renderException($exceptionName,$exceptionMessage,$statusCode)
    {
        $exceptionJson['statusCode'] = $statusCode;
        $exceptionJson['error']['name'] = $exceptionName;
        $exceptionJson['error']['message'] = $exceptionMessage;
        return response()->json($exceptionJson,$statusCode);
    }   
}
?>