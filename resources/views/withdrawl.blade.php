@extends('layouts.layout')

@section('content')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">SALDO</h1>
        <p class="fs-5 text-muted">R${{ $balance }}</div>
    <div class="container">
        <main class="row justify-content-center">
            <div class="col-md-7 col-lg-12">
                <h4 class="mb-3">Por favor confirme os dados para realizar o saque</h4>
                <form class="needs-validation" action="{{ route('store') }}" method="post" >
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="firstName" class="form-label">Nome Completo</label>
                            <input type="text" name="name" class="form-control" id="completeName" placeholder="Digite seu nome completo" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-12">
                            @if($acctype === 0)
                            <label for="document" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" placeholder="Ex: 999.999.999-88" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                            @else
                            <label for="document" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" placeholder="Ex: XX. XXX. XXX/0001-XX" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="username" class="form-label">Digite o valor:</label>
                            <div class="input-group has-validation">
                                <input value="R$" type="text" class="form-control" placeholder="500.00" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>


                        <hr class="my-4">

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">Salvar dados para a próxima transação</label>
                        </div>

                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-lg btn-outline-primary" type="submit">Enviar</button>
                </form>
            </div>
    </div>
    </main>
@endsection
