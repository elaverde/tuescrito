@extends ('layouts.app')
@section('module-name')
Productos
@endsection
@section('module-form')
<div class="row" id="app">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@yield('module-name')</h5>
                <!-- General Form Elements -->
                <form @submit.prevent="submitForm" @keyup.enter="submitForm">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Categoría</label>
                        <div class="col-sm-9">
                            <select required v-model='category_id' id="category_id" name="category_id" class="form-control" v-bind:required="category_id === ''">
                                <option value="" disabled>Seleccione un producto</option>
                                <option v-for="category in categories" :value="category.id">@{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input placeholder="Nombre del producto" required v-model='name' id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Precio</label>
                        <div class="col-sm-9">
                            <input placeholder="Precio" required v-model='price' id="price" name="price" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                            <textarea placeholder="Descripción del producto" required v-model='description' id="description" name="description" class="form-control" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <!--posicionamos boton en el lado derecho-->
                            <div class="float-end">
                                <button :disabled="loadingIndicator" type="submit" class="btn btn-primary  ">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mis @yield('module-name')</h5>
                <div v-if="loadingSpinner" class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div v-if="!loadingSpinner" class="news">
                    <div v-for="product in products" class="post-item clearfix">
                        <img src="{{ asset('assets/img/product.png') }}" alt="">
                        <h4><a href="#">@{{product.name}}</a></h4>
                        <p>@{{product.description}}</p>
                        <!--ubicamos los bones al lado derecho -->
                        <div class="float-end">
                            <button  @click="editProduct(product)"><i class="ri-edit-fill"></i></button>
                            <button  @click="deleteProduct(product.id)"><i class="ri-delete-bin-6-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/app.product.js') }}?v={{ uniqid() }}"></script>
@endsection