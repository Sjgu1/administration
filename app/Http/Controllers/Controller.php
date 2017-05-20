<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use View;
use App\Sprint;
use App\Proyecto;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

        $this->middleware(function($request, $next){
             $gga = session()->get('selected_project')['id'];
            if ($request->session()->has('selected_project') ==true ){
                $selected_project_sprints = Sprint::where('proyecto_id', $gga)->get();
                View::share('selected_project_sprints', $selected_project_sprints);
            }else{
                $selected_project_sprints =[];
                View::share('selected_project_sprints', $selected_project_sprints);
            }

            $current_view = explode("/", $request->path());

            View::share('current_view', $current_view[0]);
            //var_dump($request->path());

            return $next($request);
        });
    }

}
