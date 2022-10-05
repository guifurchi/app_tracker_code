<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use stdClass;
use App\Models\User;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\InspecaoController;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Auth\Events\Authenticated;

class authController extends Controller
{

    //Autenticação de usuário para acesso ao sistema
    public function auth(){
        
        if(session_start())
            session_destroy();
        $users = DB::table('users')->where('matricula', $_POST['matricula'])->where('password', md5($_POST['password']))->first();

        if($users){
            session_start();
            $_SESSION['name'] = $users->name;
            $_SESSION['nivel'] = $users->nivel;
            $_SESSION['id'] = $users->id;

           return redirect('/mainPage');

        }else{
            return view('login', [
                'title' => 'Login', 
                'action' => 'Acesso Negado',
                'erro' => 'Usuario e/ou senha incorretos!'
            ]);
        }

        return $users;

    }

    public function validUser(){
        session_start();

        if(isset($_SESSION['name']) && $_SESSION['name'] != ''){
            $this->validU = true;
        }else{
            $this->validU = false;
        }
        return $this->validU;
    }
    //Valida se o usuário tem permissão de acesso à pagina sem que esteja logado
    //O objeto é instanciado nos controladores para ação direta no metodo de classe e metódo da rota
    public function validNivel()
    {           
        if(isset($_SESSION['nivel']) && $_SESSION['nivel'] != ''){
            $this->nivel = $_SESSION['nivel'];
            $path= $_SERVER['REQUEST_URI'];

            //excluir o id após o ultimo "/" da rota de consulta, se houver
            $a = strpos($path,'/',2);
            $b = strpos($path,'?',1);

                if($a){
                    $pathC = substr($path, 0, $a);
                    $this->path = $pathC;
                }elseif($b){
                    $pathC = substr($path, 0, $b);
                    $this->path = $pathC;
                }else{
                    $this->path = $path;
                }
                
            //descrever quais as rotas podem ser acessadas por cada nível de usuário
            $validNivel = array(
                'admin' => ['/password','/mainPage','/inspecao','/inspectQuery','/usuarios','/cadastrar',"/showUser",'/showDetails'],  
                'user' => ['/mainPage','/inspecao','/inspectQuery','/showDetails','/password']  
            );
            //extrai dois niveis do array associativo para criar o objeto
            $this->validN = false;
            foreach ($validNivel as $nivel => $route) {
                foreach ($route as $k => $v) {
                    if($nivel === $this->nivel && $v === $this->path){
                            $this->validN = true;
                    }
                }
            }
            return $this->validN; 
        }
    }

    //valida se usuario tem permissão de acesso para o CRUD
    //o objeto é instanciada nos Controladores para o compact na view
    //atua direto na form de consulta da tabela
    public function validAction()
    {           
        if(isset($_SESSION['nivel']) && $_SESSION['nivel'] != ''){
            $this->nivel = $_SESSION['nivel'];

            $validAct = array(
                'admin' => ['create','edit','delete'],  
                'user' => ['create']  
            );
            foreach ($validAct as $nivel => $value) {
                if($nivel == $this->nivel){
                    $this->validA = $value;
                }
            }
            return $this->validA;
        }
    }

    public function logout(){

        session_start();

        session_destroy();

        Session::flush();
        
        Auth::logout();

        return redirect('/');

    }

    public function redirectToLogin()
    {
            return view('login', [
                'title' => 'Login', 
                'action' => 'Sem acesso a Página',
                'erro' => 'Você não tem acesso a essa pagina! Favor entrar com um usuário válido ou entre em contato com o administrador.'
            ]);
    }

    //validação de geral de acesso ao sistema
    public function validation(){
        $this->validation = false;
        $validU = $this->validUser();//autenticação de usuário
        $validN = $this->validNivel();//autenticação de nivel de acesso
        if($validU && $validN)
        
            $this->validation = true;
            return $this->validation;
    }
}
