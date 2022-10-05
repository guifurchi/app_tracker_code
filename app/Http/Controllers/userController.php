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
use Illuminate\Auth\Events\Authenticated;
use App\Http\Controllers\authController;
use \App\Http\Requests\UserRequest;
use App\Models\Nivel;


class userController extends Controller
{

    public function __construct()
    {
        $this->user = new User();
        $this->valid = new authController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->valid->validation()){
            $level = DB::table('nivel')->get();

            return view('cadastrar', compact('level'),[
                'title' => 'Cadastrar Usuário', 
                'action' => '',
                'erro' => ''
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {
        if($this->valid->validation()){

            //verificar se a matricula já foi cadastrada no sistema
            $users = DB::table('users')->where('matricula', $_POST['matricula'])->first();
            $level = DB::table('nivel')->get();

            if(!isset($users)){
                $user = $this->user;
                $user->name = $request->input('name');
                $user->matricula = $request->input('matricula');
                $user->password = md5($request->input('password'));
                $user->nivel = $request->input('nivel');
                $user = $user->save();
                return redirect('/usuarios');
            }else{
                return view('cadastrar', compact('level'), [
                    'title' => 'Cadastrar Usuário', 
                    'action' => '',
                    'erro' => 'usuário ja cadastrado'
                ]);
            }

        }else{
            return $this->valid->redirectToLogin();
        }

    }

    public function read()
    {
        return $this->user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'body' => 'required'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        if($this->valid->validation()){
            $user = $this->user->find($id);

            return view('showUser', compact('user'), [
                'title' => 'Detalhes do registro', 
                'action' => ''
            ]);

        }else{
            return $this->valid->redirectToLogin();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->valid->validation()){

            $user = $this->user->find($id);
            $level = DB::table('nivel')->get();

            return view('cadastrar', compact(['user','level']), [
                'title' => 'Alterar Usuário', 
                'action' => 'Novos dados do Usuário',
                'erro' => ''
            ]);

        }else{
            return $this->valid->redirectToLogin();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->valid->validation()){

            $this->user->where(['id' => $id])->update([
                'name' => $request->name,
                'matricula' => $request->matricula,
                'nivel' => $request->nivel,
            ]);

            return redirect('/usuarios');
        }else{
            return $this->valid->redirectToLogin();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if($this->valid->validation()){

            $this->user->destroy($id);
            return redirect('/usuarios');

        }else{
            return $this->valid->redirectToLogin();
        }

    }

    public function usersQuery()
    {
        if($this->valid->validation()){
            $users = $this->read()->paginate(5);
            $validA = $this->valid->validAction();

            return view('usersQuery', compact(['users','validA']), [
                'title' => 'Usuários', 
                'action' => 'Usuários cadastrados'
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
    }

    //controle de senhas
    public function editPassword($id, $erro = null)
    {
        if($this->valid->validation()){

            $user = $this->user->find($id);
            return view('password', compact('user'), [
                'title' => 'Alterar Senha', 
                'action' => 'Favor digitar as senhas',
                'erro' => $erro
            ]);

        }else{
            return $this->valid->redirectToLogin();
        }
    }

    public function validPassword($id)
    {
        $user = $this->user->find($id);

        $old =  md5($_POST['password_old']);
        $new =  md5($_POST['password']);

        if($user->password == $old  && $user->password != $new ){
            $this->validPassword = md5($_POST['password']);
            $validPass = $this->validPassword;

            return $this->updatePassword($validPass, $id);

        }else{

            if($user->password != $old){
                $erro = "Senha atual incorreta!";
            }
            elseif($user->password != $new){
                $erro = "Senha igual a anterior";
            }
            elseif($old == $new){
                $erro = "Senha nova deve ser diferente a Senha atual!";
            }

            $this->validPassword = false;
            $validPass = $this->validPassword;
            return $this->editPassword($id, $erro); 
        }
    }

    public function updatePassword($validPass, $id)
    {
        if($this->valid->validation()){

            $this->user->where(['id' => $id])->update([
                'password' => $validPass
            ]);
            return redirect('/usuarios');
            
        }else{
            return $this->valid->redirectToLogin();
        }
    }
}