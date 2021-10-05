@extends('layouts.layout')

@section('content')
    <img src="https://i.postimg.cc/rFrPvhyP/pic.png" alt="" width="100%" height="50%">
    <img src="https://i.postimg.cc/2y4XB6tf/pic.png" alt="" width="100%" height="50%">
    <img src="https://i.postimg.cc/3x49y1cH/contact.png" alt="" width="100%" height="50%">
<hr/>
    <h2 align="center" style="color: #1d68a7">Entre em contato</h2><br>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Nome e sobrenome" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="E-mail" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <span class="input-group-text" id="basic-addon2">@example.com</span>
</div>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Estado">
    <input type="text" class="form-control" placeholder="Cidade" aria-label="Username">
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Telefone">
    <input type="text" class="form-control" placeholder="Cidade" aria-label="CPF/CNPJ">
</div>

<div class="input-group">
    <span class="input-group-text">Motivo de contato</span>
    <textarea class="form-control" aria-label="With textarea"></textarea>
</div>
<br>
    <div class="text-center">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio2">Enviar formulário</label>
    </div>
@endsection

