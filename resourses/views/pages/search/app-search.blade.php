@extends ('layouts.search')
@section('module-name')
Buscador
@endsection
@section('module-form')
<div id="app">
    <div  class="container-fluid p-4 bg-primary">
        <div class="row d-flex align-items-center">
            <div class="col-md-2 mt-1">
               <div style="color:#FFF;"> <img width="50" src="{{ asset('assets/img/logo-white.png') }}" alt=""> tu escrito</div>
            </div>
            <div class="col-md-6 mt-1">
                <div class="input-group">
                    <input type="text" placeholder="Buscar..." class="form-control"> 
                    <button type="button" class="btn btn-light">Buscar</button>
                </div>
            </div>
            <div class="col-md-2 mt-1">
                <div class="btn-group"  role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    @{{category.name}} 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li @click="changeCategory('','Todas las categorias')" style="cursor:pointer" class="p-2" data-value="" >Todas las categorias</li>
                        @foreach ($categories as $category)
                            <li @click="changeCategory('{{ $category->id }}','{{ $category->name }}')" style="cursor:pointer" class="p-2" data-value="{{ $category->id }}" >{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2 mt-1">
                @include('componets.account')
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div v-if="loadingSpinner" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-if="!loadingSpinner" class="row" id="productos">
            <div v-for="product in products"  class="col-md-3 d-flex justify-content-center ">
                <div class="card" style="width: 18rem;">
                <img style="background-color: #d5d5d5;"  src="{{ asset('assets/img/text.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">@{{product.name}}</h5>
                    <p class="card-text">@{{product.category.name}} <br>Precio: $ @{{product.price}} </p>
                    <a v-bind:href="'./buy/'+product.id" class="btn btn-primary w-100"><i class='bx bx-cart-add'></i> Comprar</a>
                </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/app.search.js') }}?v={{ uniqid() }}"></script>
<script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
@endsection