
<?php $__env->startSection('module-name'); ?>
Categorias
<?php $__env->stopSection(); ?>
<?php $__env->startSection('module-form'); ?>
<div class="row" id="app">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $__env->yieldContent('module-name'); ?></h5>
                <!-- General Form Elements -->
                <form @submit.prevent="submitForm" @keyup.enter="submitForm">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input required v-model='name' id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                            <textarea required v-model='description' id="description" name="description" class="form-control" style="height: 100px"></textarea>
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
                <h5 class="card-title">Mis <?php echo $__env->yieldContent('module-name'); ?></h5>
                <div v-if="loadingSpinner" class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div v-if="!loadingSpinner" class="news">
                    <div v-for="category in categories" class="post-item clearfix">
                        <img src="<?php echo e(asset('assets/img/category.png')); ?>" alt="">
                        <h4><a href="#">{{category.name}}</a></h4>
                        <p>{{category.description}}</p>
                        <!--ubicamos los bones al lado derecho -->
                        <div class="float-end">
                            <button  @click="editCategory(category)"><i class="ri-edit-fill"></i></button>
                            <button  @click="deleteCategory(category.id)"><i class="ri-delete-bin-6-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/js/app.categories.js?v=rand()')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>