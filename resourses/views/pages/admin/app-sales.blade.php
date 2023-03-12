@extends ('layouts.app')
@section('module-name')
Ventas
@endsection
@section('module-form')
@include('componets.vue-pagination')
<div id="app">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <!--
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
                -->
                <div class="card-body">
                    <h5 class="card-title">@yield('module-name')</h5>
                    <div v-if="loadingSpinner" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div v-if="buys.length > 0" class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-container">
                            <table v-if="!loadingSpinner" class="table table-borderless dataTable-table">
                                <thead>
                                    <tr>
                                        <th scope="col" data-sortable="" style="width: 10.8974%;"><a href="#" class="dataTable-sorter">#</a></th>
                                        <th scope="col" data-sortable="" style="width: 23.9744%;"><a href="#" class="dataTable-sorter">Cliente</a></th>
                                        <th scope="col" data-sortable="" style="width: 40.1282%;"><a href="#" class="dataTable-sorter">Producto</a></th>
                                        <th scope="col" data-sortable="" style="width: 9.8718%;"><a href="#" class="dataTable-sorter">Precio</a></th>
                                        <th scope="col" data-sortable="" style="width: 15.1282%;"><a href="#" class="dataTable-sorter">Estado</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="b in buys">
                                        <th scope="row"><a href="#"># @{{b.id}}</a></th>
                                        <td>@{{b.user.name}} @{{b.user.last_name}}</td>
                                        <td>
                                            <button @click="setSale(b)" data-bs-toggle="modal" data-bs-target="#fullscreenModal" class="btn btn-primary">
                                                <i class="bi bi-send-fill"></i>
                                                Envio digital
                                            </button>
                                        </td>
                                        <td>@{{b.price | formatMoneda }}</td>
                                        <td><span class="badge bg-success">Aprobado</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="dataTable-bottom">
                            <div class="dataTable-info"></div>
                            <nav class="dataTable-pagination">
                                <ul class="dataTable-pagination-list"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fullscreenModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@include('componets.logo')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img height="200" v-bind:src="sale?.user?.photo_url" alt="Profile" class="rounded-circle">
                                <h5>@{{sale?.user?.name}} @{{sale?.user?.last_name}}</h5>
                                <h6>@{{sale?.user?.email}}</h6>

                            </div>
                            <ul class="list-group">
                                <li v-for="s in sale?.purchase_details" class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>@{{s?.product?.name}}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>@{{s?.product?.price | formatMoneda}}</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Slides with controls -->
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filtro</h6>
                                            </li>
                                            <li @click="getText(p.id)" style="cursor:pointer;" v-for="p in products"><span class="m-2">@{{p.name}}</span></li>
                                        </ul>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="100000">
                                        <div class="carousel-inner">
                                            <div v-for="(t, index) in texts" :key="index" :class="{ 'carousel-item active': index === 0, 'carousel-item': index !== 0 }">
                                                <div class="d-block w-100 mt-3">
                                                    <h1>@{{t.title}}</h1>
                                                    <p>@{{t.description}}</p>
                                                    <button @click="setTemplate(t)" v-if="t.title != 'Cargando...'" class="btn btn-primary">
                                                        <i class="bi bi-file-earmark-text-fill"></i>
                                                        Ver plantilla
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div><!-- End Slides with controls -->
                                    <div class="row border p-2">
                                        <div class="col-md-8">
                                            <h6>Plantilla</h6>
                                            <div style="min-height: 200px;" v-html="template" class="p-3 border"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>Datos</h6>
                                            <div style="min-height: 200px;" class="border p-3">
                                                <!--fomulario con datos del template -->
                                                <div v-for="(p, index) in parameters" :key="index" class="mb-3">
                                                    <label :for="'box'+index" class="form-label">@{{p.label}}</label>
                                                    <input :id="'box'+index" v-model="p.key" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                    </div>
                </div>
            </div>
        </div><!-- End Full Screen Modal-->
    </div>
    @endsection
    @section('scripts')
    <script src="{{ asset('assets/js/app.sales.js') }}?v={{ uniqid() }}"></script>
    @endsection