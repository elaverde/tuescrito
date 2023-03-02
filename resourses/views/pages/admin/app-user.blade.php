@extends ('layouts.app')
@section('module-name')
Clientes
@endsection
@section('module-form')
@include('componets.vue-pagination')
<div class="row" id="app">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@yield('module-name')</h5>
                <!-- General Form Elements -->
                <form @submit.prevent="submitForm" @keyup.enter="submitForm">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Nombres</label>
                        <div class="col-sm-9">
                            <input required v-model='name' id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Apellidos</label>
                        <div class="col-sm-9">
                            <input required v-model='last_name' id="last_name" name="last_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input required v-model='email' id="email" name="email" type="email" class="form-control">
                        </div>
                    </div>
                    <div v-if="!isEditing" class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Contraseña</label>
                        <div class="col-sm-9">
                            <input required v-model='password' id="password" name="password" type="password" class="form-control">
                        </div>
                    </div>
                    <div v-if="!isEditing" class="row mb-3">
                        <label for="photo" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <input id="photo" name="photo" type="file" class="form-control">
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
                    <div v-for="client in clients" class="post-item clearfix">
                        <img v-bind:src="client.photo_url" alt="">
                        <h4><a href="#">@{{client.name}} @{{client.last_name}}</a></h4>
                        <p>@{{client.email}}</p>
                        <p>
                        <small class="text-muted">Creado: @{{client.created_at}}</small>
                        </p>
                        <!--ubicamos los bones al lado derecho -->
                        <div class="float-end">
                            <button  @click="editClient(client)"><i class="ri-edit-fill"></i></button>
                            <button  @click="deleteClient(client.id)"><i class="ri-delete-bin-6-fill"></i></button>
                        </div>
                    </div>
                </div>
                <paginator v-bind:pagination="pagination" v-bind:segment_size="5"  v-bind:pageChange="getClients" ></paginator>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/app.client.js') }}?v={{ uniqid() }}"></script>
@endsection