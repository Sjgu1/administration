<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /*
   public function search($field = null){
        $users = User::paginate(8);
        $valorname="";
        return view('users', compact(['users', 'valorname']));
    }
    */

    public function gith(){

        /*$client = new \Github\Client();
        $client->authenticate('jph11', 'Passwordprueba123', \Github\Client::AUTH_HTTP_PASSWORD);
        $commits = $client->api('repo')->commits()->all('jph11', 'crisantemo', array('sha' => 'master'));

        //var_dump($commits);

        $contributors = array();

        foreach ($commits as $commit){

            //var_dump($commit['author']['login']);

            if (array_key_exists($commit['committer']['login'], $contributors)){

                $contributors[$commit['committer']['login']] += 1;

            }
            else {

                $contributors[$commit['committer']['login']] = 1;

            }
        }

        var_dump($contributors);*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/jph11/crisantemo/stats/contributors');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $output = json_decode(curl_exec($ch), true);
        $contributors = array();

        foreach ($output as $contributor){

            $contributors[$contributor['author']['login']] = $contributor['total'];
        }

        //var_dump($contributors);
        //var_dump(json_decode($output, true));

        curl_close($ch);
        
        return view('prueba', ['contributors' => $contributors]);
    }

    public function search(){
         $users = User::get();
         return view('users', compact('users'));
     }

    public function filtrar(Request $request ){
        $name = $request->input('name');
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorname="";
        if ($name!=null) {
            $users = User::get();
            foreach($users as $user){
                $nameLeido = $user->name;
                $nameLeido = strtolower($nameLeido);
                $name = strtolower($name);
                if(strpos($nameLeido, $name ) !== false){
                    $appends[]= $user->id;
                }
                    
            }
            $valorname=$name;
        }
        if ($name==null) {
            $users = User::get();
            foreach($users as $user){
                $appends[]= $user->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $usersDevolver = User::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $usersDevolver = User::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        } else{
            if($orden == "asc")
                $usersDevolver = User::whereIn('id', $appends)->orderBy('name','asc')->paginate(3);
            else
                $usersDevolver = User::whereIn('id', $appends)->orderBy('name','desc')->paginate(3);
        }
        
        $users = $usersDevolver;

        return view('users', compact(['users','valorname']));
    
    }

    public function create(Request $request){

        $user = new User();
        $user->name = $request->input('name');
        $user->apellidos = $request->input('apellidos');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        $user->save();
        return redirect('users');
    }

     public function details($id){
        $user = User::where('id', $id)->first();
        if($user==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Usuario: " .$id  ] );
        }else{
            return view('profile', ['user' => $user]);
        }
     }

    public function modify(Request $request){

        $this->validate($request, [
            'name' => ['string', 'min:3', 'max:20'],
            'apellidos' => ['string', 'min:3', 'max:50'],
            'email' => ['email'],
            'username' => ['string', 'min:3', 'max:20']
        ]);

        $user = User::where('id', $request->input('id'))->first();
        $user->name = $request->input('name');
        $user->apellidos = $request->input('apellidos');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Usuario: " .$user->id  ] );

    }

    public function delete($id){

        $user = User::where('id', $id)->first();
        $user->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Usuario: " .$user->id  ] );

    }

    public function sayHello($id){
        $user = User::where('id', $id)->first();
        if($user==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Usuario: " .$id  ] );
        }else{
            return view('user', ['user' => $user]);
        }
    }

    public function userspublic($id = null){

        return view('user.users');
    }
}
