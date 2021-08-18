@component('mail::message')
<h1>Dados do Contato</h1>
<b>Nome:<b/> {{ $contato->nome }} <p/>
<b>E-mail:<b/> {{ $contato->email }} <p/>
<b>Telefone:<b/> {{ $contato->telefone }} <p/>
<b>Mensagem:<b/> {{ $contato->mensagem }} <p/>
<b>Arquivo:<b/> {{ $contato->arquivo }} <p/>
<b>IP:<b/> {{ $contato->ip }}
@endcomponent
