@extends ('layouts.app')
@section('module-name')
Plantillas
@endsection
@section('module-form')
@include('componets.vue-pagination')
<div   id="app">
    
    <form class="row" @submit.prevent="submitForm" >
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@yield('module-name')</h5>
                    <div style="height:260px" id="editor">
                        <div class="page">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- formularion infomacón básica-->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información adicional</h5>
                    <label for="inputText" class="col-sm-3 col-form-label">Título</label>
                    <input required type="text" class="form-control" v-model="title" placeholder="Título">
                    <label for="inputText" class="col-sm-3 col-form-label">Producto</label>
                    <select required class="form-control" v-model="product_id" v-bind:required="product_id === ''">
                        <option value="" disabled>Seleccione un producto</option>
                        <option v-for="product in products"  v-bind:key="product.id" :value="product.id">@{{product.name}}</option>
                    </select>
                    <label for="inputText" class="col-sm-3 col-form-label">Descripción</label>
                    <textarea required class="form-control" v-model="description" placeholder="Descripción"></textarea>
                    <div v-if="inputs.length > 0">
                        <div v-for="(input, index) in inputs" :key="index">
                            <label for="inputText" class="col-form-label">Etiqueta @{{values[input].key}} </label>
                            <input :placeholder="'Etiqueta '+values[input].key" required class="form-control" v-model="values[input].label" />
                        </div>
                    </div>
                    <!--alert error bootstrap-->
                    <div v-if="errors.length > 0" class="alert alert-danger mt-3" role="alert" v-if="error">
                        <strong>Error!</strong> @{{errors}}
                    </div>
                    <div class="row mt-3 ">
                        <div class="col-sm-12">
                            <div class="float-end">
                                <button :disabled="loadingIndicator" type="submit" class="btn btn-primary  ">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
    <div class="row">
        <!--listados de plantillas-->
        <div  class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row mt-4 mb-4">
                            <div class="col-sm-4">
                                <select @change="getText" required class="form-control" v-model="product_id_filter" v-bind:required="product_id_filter === ''">
                                    <option value="" disabled>Seleccione un producto</option>
                                    <option v-for="product in products"  v-bind:key="product.id" :value="product.id">@{{product.name}}</option>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input v-model="search" type="text" class="form-control" placeholder="Buscar...">
                                    <button class="btn btn-primary" type="button">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div v-if="loadingSpinner" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div v-if="!loadingSpinner" class="news">
                            <div v-for="text in texts" class="post-item clearfix">
                                <img src="{{ asset('assets/img/text.png') }}" alt="">
                                <h4><a href="#">@{{text.title}}</a></h4>
                                <p>@{{text.description}}</p>
                                <!--ubicamos los bones al lado derecho -->
                                <div class="float-end">
                                    <a target="_blank" :href="'./textsToPdf/'+text.id">
                                        <button class="btn btn-primary"  @click="editText(text)">
                                            <i class="ri-file-list-2-fill"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-primary"  @click="editText(text)">
                                        <i class="ri-edit-fill"></i>
                                    </button>
                                    <button class="btn btn-primary"  @click="deleteText(text.id)">
                                        <i class="ri-delete-bin-6-fill"></i>
                                    </button>
                                </div>
                            </div>
                    </div>
                    <paginator v-bind:pagination="pagination" v-bind:segment_size="5"  v-bind:pageChange="getText" ></paginator>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('assets/js/app.text.js') }}?v={{ uniqid() }}"></script>
@endsection