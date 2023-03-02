@extends ('layouts.search')
@section('module-name')
Buscador
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
<!-- card conineter fecha compra -->
<div id="app" class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-2">
                                <img width="120" src="{{ asset('assets/img/text.png') }}" alt="">
                            </div>
                            <div class="col-7">
                                <b>Documento:</b> {{$producs->name}}
                                <br>
                                <span>
                                    <b>Descripción:</b>
                                </span>
                                {{$producs->description}}
                            </div>
                            <div class="col-3">
                                <h2>${{ number_format($producs->price,0, '.', ',') }} COP</h2>
                            </div>
                            <form @submit.prevent="submitForm" @keyup.enter="submitForm">
                                <input type="hidden" name="product_id" id="product_id" value="{{$producs->id}}">
                                <input type="hidden" name="price" id="price" value="{{$producs->price}}">
                                <button  :disabled="loadingIndicator" type="submit" type="button" class="btn btn-primary w-100">Comprar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
<script src="{{ asset('assets/js/app.buy.js') }}?v={{ uniqid() }}"></script>
@endsection