<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContatoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contato()
    {


        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.txt');

        $requested_arr = [
            'nome' => 'Teste',
            'email' => 'teste@teste.com',
            'telefone' => '(61) 98512-7199',
            'mensagem' => 'teste',
            'arquivo' => $file,
            'ip' => '192.168.0.1',
            'created_at' => '2021-08-18 06:25:29',
            'updated_at' => '2021-08-18 06:25:29'
        ];

        $response = $this->postJson('/api/contato', $requested_arr);

        $response->assertStatus(201);


    }
}
