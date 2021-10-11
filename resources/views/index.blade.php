@extends('layouts.layout')

@section('content')
    <style>
        input.form-control:focus {
            outline: none;
            box-shadow: none !important;
        }
    </style>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">SALDO</h1>
        <p class="fs-5 text-muted">R${{ $balance }}</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center align-items-start justify-content-center">
        @if($type === \App\Constants\Constants::USER_ACCOUNT_TYPE_USER)
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Transferência</h4>
                </div>
                <div class="card-body">
                    <small class="text-muted fw-light">VALOR</small><input type="text" name="edit_balance" id="edit_balance" value="R$" class="form-control" style="border: none; border-inline: none; font-size: 35px; text-align: center"/>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Digite um valor</li>
                    </ul>
                    <button onclick="window.location='{{ url("/transfer") }}'" type="button" class="w-100 btn btn-lg btn-outline-primary" > Enviar</button>
                </div>
            </div>
        </div>
        @endif
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Depósito</h4>
                </div>
                <div class="card-body">
                    <small class="text-muted fw-light">VALOR</small><input type="text" name="edit_balance" id="edit_balance" value="R$" class="form-control" style="border: none; border-inline: none; font-size: 35px; text-align: center"/>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Digite um valor</li>
                    </ul>
                        <button onclick="window.location='{{ url("/deposit") }}'" type="button" class="w-100 btn btn-lg btn-outline-primary" > Depositar</button>
                </div>
            </div>
        </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Saque</h4>
                    </div>
                    <div class="card-body">
                        <small class="text-muted fw-light">VALOR</small><input type="text" name="edit_balance" id="edit_balance" name="deposit_balance" value="R$" class="form-control" style="border: none; border-inline: none; font-size: 35px; text-align: center"/>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Digite um valor</li>
                        </ul>
                        <button onclick="window.location='{{ url("/withdrawl") }}'" type="button" class="w-100 btn btn-lg btn-outline-primary" >Retirar</button>
                    </div>
                </div>
            </div>
    </div>
    <hr/>
    <div class="container-fluid">
        <header>
            <h4 class="display-4 mb-4 text-center">Calendário</h4>
            <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                <h5 class="col-sm p-1 text-center">Sunday</h5>
                <h5 class="col-sm p-1 text-center">Monday</h5>
                <h5 class="col-sm p-1 text-center">Tuesday</h5>
                <h5 class="col-sm p-1 text-center">Wednesday</h5>
                <h5 class="col-sm p-1 text-center">Thursday</h5>
                <h5 class="col-sm p-1 text-center">Friday</h5>
                <h5 class="col-sm p-1 text-center">Saturday</h5>
            </div>
        </header>
        <div class="row border border-right-0 border-bottom-0">
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">29</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">30</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">31</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">1</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">2</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">3</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-info text-white" title="Test Event 1">Introdução a nova f</a>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">4</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="w-100"></div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">5</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">6</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">7</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">8</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white" title="Test Event 2">Evento</a>
                <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white" title="Test Event 3">Abertura lançamento</a>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">9</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">10</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">11</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="w-100"></div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">12</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">13</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">14</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">15</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">16</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">17</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">18</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="w-100"></div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">19</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">20</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-primary text-white" title="Test Event with Super Duper Really Long Title">Evento abertura de </a>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">21</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">22</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">23</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">24</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">25</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="w-100"></div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">26</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">27</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">28</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">29</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate ">
                <h5 class="row align-items-center">
                    <span class="date col-1">30</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">1</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">2</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="w-100"></div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">3</span>
                    <small class="col d-sm-none text-center text-muted">Sunday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">4</span>
                    <small class="col d-sm-none text-center text-muted">Monday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">5</span>
                    <small class="col d-sm-none text-center text-muted">Tuesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">6</span>
                    <small class="col d-sm-none text-center text-muted">Wednesday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">7</span>
                    <small class="col d-sm-none text-center text-muted">Thursday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">8</span>
                    <small class="col d-sm-none text-center text-muted">Friday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
            <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted">
                <h5 class="row align-items-center">
                    <span class="date col-1">9</span>
                    <small class="col d-sm-none text-center text-muted">Saturday</small>
                    <span class="col-1"></span>
                </h5>
                <p class="d-sm-none">No events</p>
            </div>
        </div>
    </div>
<br>

@endsection
