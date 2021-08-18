<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contato extends JsonResource {
    public function toArray($request){
        //return parent::toArray($request);
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'mensagem' => $this->mensagem,
            'arquivo' => $this->arquivo,
            'ip' => $this->ip,

        ];
    }

    /* public function with( $request ){
      return [
        'version' => '1.0.0',
        'author_url' => url('https://terminalroot.com.br')
      ];
    } */
}
