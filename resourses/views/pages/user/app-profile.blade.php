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
    <div class="row" id="app">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@yield('module-name')</h5>
                    <!-- General Form Elements -->
                    <form @submit.prevent="updateAdmin" @keyup.enter="submitForm">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nombres</label>
                            <div class="col-sm-8">
                                <input required placeholder="Nombre" v-model='name' id="name" name="name" value="{{$name}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Apellidos</label>
                            <div class="col-sm-8">
                                <input required placeholder="Apellidos" v-model='last_name' id="last_name" name="last_name"  value="{{$last_name}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input required placeholder="Email" v-model='email' id="email" name="email" value="{{$email}}" type="email" class="form-control">
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
                    <h5 class="card-title">Foto de perfil</h5>
                    <!-- General Form Elements -->
                    <form @submit.prevent="updatePhoto" @keyup.enter="updatePhoto">
                        <div v-if="!isEditing" class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Foto</label>
                            <div class="col-sm-8">
                                <input name="photo" required type="file" class="form-control">
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
                    <h5 class="card-title">Contraseña</h5>
                    <!-- General Form Elements -->
                    <form @submit.prevent="updatePassword" @keyup.enter="updatePassword">
                        <div v-if="!isEditing" class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Antigua Contraseña</label>
                            <div class="col-sm-8">
                                <input required v-model='old_password' id="password" name="password" type="password" placeholder="Antigua Contraseña" class="form-control">
                            </div>
                        </div>
                        <div v-if="!isEditing" class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nueva Contraseña</label>
                            <div class="col-sm-8">
                                <input required v-model='new1_password' id="password" name="password" type="password" placeholder="Nueva Contraseña" class="form-control">
                            </div>
                        </div>
                        <div v-if="!isEditing" class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Confirmación Contraseña</label>
                            <div class="col-sm-8">
                                <input required v-model='new2_password' id="password" name="password" type="password" placeholder="Confirmación Contraseña" class="form-control">
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
    </div>   
</div>   

@endsection
@section('scripts')
<script src="{{ asset('assets/js/helpers.js') }}?v={{ uniqid() }}"></script>
<script src="{{ asset('assets/js/app.profile.user.js') }}?v={{ uniqid() }}"></script>
@endsection