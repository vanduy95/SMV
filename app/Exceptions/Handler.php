<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Session\TokenMismatchException::class,
    \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException)
        {
            return redirect()->back();
        }
        if($exception)
        {   
            return response()->view('business.404.404', [], 404);               
        }
        if($exception instanceof ModelNotFoundException)
        {
            $modelname = strtolower(class_basename($exception->getModel()));
            return response()->json(['error'=>'Does not exists any'.$modelname,'code'=> 404],404);
        }
        if($exception instanceof MethodNotAllowedHttpException)
        {
            return response()->json(['error'=>'The specified method for the request is invalid','code'=> 405],405);
        }
        if($exception instanceof HttpException)
        {
            return response()->json(['error'=>$exception->getMessage(),'code'=>$exception->getStatusCode()],$exception->getStatusCode());
        }
        // if($exception instanceof QueryException)
        // {
        // // dd($exception);
        //     if($errorCode ==1451 ){
        //         return response()->json(['error'=>'Cannot remove this resource permanently. It is related with any other resource','code'=>409],409);
        //     }
        //     if($errorCode == 2002)
        //     {
        //         return response()->json(['error'=>'No connection could be made because the target machine actively refused it'],2002);
        //     }
        // }
        // if(config('app.debug')){
        //     return response()->json(['error'=>'Unexpected Exception. try later','code'=>500], 500);
        // }
        if($exception instanceof FatalThrowableError)
        {
            return response()->json(['error'=>'Method not found','code'=>500], 500);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return response()->json(['error' => 'Unauthenticated.'], 401);
    // }
    // protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    // {
    //     $error = $e->validator->error()->getMessages();

    //     return response()->json(['error' => $error, 422]);
    // }
}
