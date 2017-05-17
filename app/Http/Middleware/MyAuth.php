<?php

namespace App\Http\Middleware;

use Closure;
class MyAuth
{
  public function handle($request, Closure $next)
  {
    if(!auth()->check() && !auth()->user()->id == request()->get('id'))
    {
      dd("you are not allowed to see this");
    }

    return $next($request);
  }
}
