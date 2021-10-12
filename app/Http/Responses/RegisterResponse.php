<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{        
    public function toResponse($request)
    {
        // below is the existing response
        // replace this with your own code
      if($request->wantsJson()){
           return new JsonResponse('', 201);
      }elseif($request->employee){
          return view('employees.index');
      }else{
          return redirect(config('fortify.home'));
      }
       
    }
}