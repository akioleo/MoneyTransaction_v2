@extends('layouts.layout')

@section('content')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">SALDO</h1>
        <p class="fs-5 text-muted">R${{ $balance }}</div>
    <div class="container">
        <main class="row justify-content-center">
                <div class="col-md-7 col-lg-12">
                    <h4 class="mb-3">Preencha os campos abaixo</h4>
                    <form class="needs-validation" action="{{ route('store') }}" method="post" >
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Primeiro nome</label>
                                <input type="text" name="name" class="form-control" id="firstName" placeholder="Digite seu nome" value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Digite o sobrenome" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
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
