@extends ('layouts.search')
@section('module-name')
Perfil
@endsection
@section('module-form')
<div>
    <div  class="container-fluid p-4 bg-primary">
        <div class="row d-flex align-items-center">
            <div class="col-md-2">
                <div style="color:#FFF;"> <img width="50" src="{{ asset('assets/img/logo-white.png') }}" alt=""> tu escrito</div>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                @include('componets.account')
            </div>
        </div>
    </div>
</div>
<div class="container mt-3 mb-5">
    <div  id="app">
        @foreach ($buys as $buy)
            <div class="card">
                <div class="card-body">
                    <div class="row P-2">
                        <div class="col-2">
                            <img width="120" src="{{ asset('assets/img/text.png') }}" alt="">
                        </div>
                        <div class="col-7">
                            <b>Documento:</b> {{ $buy->purchaseDetails[0]->product->name }}
                            <br>
                            <span>
                                <b>Descripción:</b>
                            </span>
                            {{ $buy->purchaseDetails[0]->product->description }}
                        </div>
                        <div class="col-3">
                            <h2>${{ number_format($buy->purchaseDetails[0]->product->price,0, '.', ',') }} COP</h2>
                            <span style="font-size:12px;">
                                <b>Fecha de compra:</b>
                                {{ $buy->created_at }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach   
    </div>
</div>   

@endsection
@section('scripts')
<script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
@endsection