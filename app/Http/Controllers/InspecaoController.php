<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspect;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use stdClass;
use App\Models\User;
use App\Http\Controllers\userController;
use App\Http\Controllers\authController;
use \App\Http\Requests\InspectRequest;


class InspecaoController extends Controller
{

    private $inspect;
    public $valid;
    public $validN;

    public function __construct()
    {
        $this->inspect = new Inspect();
        $this->valid = new authController();
    }

    public function index()
    {
        if($this->valid->validation()){
            return view('inspecao', [
            'title' => 'Registrar Inspeção', 
            'action' => 'Fazer leitura do Código de barras'
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
    }

    public function create(InspectRequest $request)
    {
        if($this->valid->validation()){
            $inspecao = $this->inspect;
            $inspecao->qrcode = $request->input('qrcode');
            $inspecao->nome_insp = $request->input('nome_insp');
            $inspecao->status = $request->input('status');
            $insert = $inspecao->save();

            if($insert){
                return redirect('/inspectQuery');
            }
        }else{
            return $this->valid->redirectToLogin();
        }
        
    }

    public function read()
    {
        
        return $this->inspect;

    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function showDetails($id)
    {
        if($this->valid->validation()){
            $inspect = $this->inspect->find($id);
            $dados = $inspect->qrcode;
            $dados = explode('#',$dados);
            

            return view('showDetail', compact(['inspect','dados']), [
                'title' => 'Detalhes do registro', 
                'action' => ''
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
}

    public function edit($id)
    {
        if($this->valid->validation()){
            $inspect = $this->inspect->find($id);

            return view('inspecao', compact('inspect'), [
                'title' => 'Alterar Registro de inspeção', 
                'action' => 'Ler código de barras',
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
    }

    public function update(Request $request, $id)
    {
        if($this->valid->validation()){
            $this->inspect->where(['id' => $id])->update([
                'qrcode' => $request->qrcode,
                'nome_insp' => $request->nome_insp,
                'status' => $request->status
            ]);
            return redirect('/inspectQuery');
        }else{
            return $this->valid->redirectToLogin();
        }

    }

    public function destroy($id)
    {
        if($this->valid->validation()){
            $this->inspect->destroy($id);
            return redirect('/inspectQuery');
        }else{
            return $this->valid->redirectToLogin();
        }

    }

    public function inspectQuery()
    {
        if($this->valid->validation()){
            $validA = $this->valid->validAction();

            $inspect = $this->read()->paginate(5);
            return view('inspectQuery', compact(['inspect','validA']), [
                'title' => 'Registros de Inspeção', 
                'action' => 'Registros realizados'
            ]);
        }else{
            return $this->valid->redirectToLogin();
        }
    }

    public function relUsers()
    {
        return $this->hasOne('App\Models\User','id', 'id_user');
    }

}
