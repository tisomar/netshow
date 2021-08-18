<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\Contato as Contato;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail as MailContato;
use App\Http\Resources\Contato as ContatoResource;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $contato = new Contato;
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->mensagem = $request->input('mensagem');

        $tem_arquivo = $request->hasFile('arquivo');

        if($tem_arquivo){
            $arquivo_valido = $request->file('arquivo')->isValid();
            $nome_arquivo = $request->file('arquivo')->getClientOriginalName();
            if($arquivo_valido){
                $contato->arquivo = $request->arquivo->storeAs('arquivo_contato',$nome_arquivo."-".date("Y-m-d H:i:s"));
            }
        }

        $contato->ip = $request->input('ip');

        $rules = array(
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|regex:/(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/',
            'mensagem' => 'required',
            'arquivo' => 'required',
        );

        $request->validate($rules);

        if( $contato->save() ){
            Mail::send(new MailContato($contato));
            return new ContatoResource( $contato );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

    }
}
