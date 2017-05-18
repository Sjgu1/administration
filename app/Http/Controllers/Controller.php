<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use View;
use App\Sprint;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

        $this->middleware(function($request, $next){

            if ($request->session()->has('selected_project')){

                $selected_project_sprints = Sprint::where('proyecto_id', $request->session()->get('selected_project')->id)->get();
                View::share('selected_project_sprints', $selected_project_sprints);
            }

            var_dump($request->path());
            View::share('current_view', $request->path());
            //var_dump($request->path());

            return $next($request);
        });
    }

}
