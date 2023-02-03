<!-- ======= Sidebar ======= -->
<?php
$menuItems = [
    [
        'url' => 'pages-register.html',
        'icon' => 'bi bi-card-list',
        'label' => 'Categorias'
    ],
    [
        'url' => 'pages-register.html',
        'icon' => 'bi bi-card-list',
        'label' => 'Productos'
    ],
    [
        'url' => 'pages-register.html',
        'icon' => 'bi bi-card-list',
        'label' => 'Textos'
    ],
    [
        'url' => 'pages-register.html',
        'icon' => 'bi bi-card-list',
        'label' => 'Clientes'
    ],
    [
        'url' => 'pages-register.html',
        'icon' => 'bi bi-card-list',
        'label' => 'Administradores'
    ],
];
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-heading">Mis módulos</li>
        <li class="nav-item">
            <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="nav-link collapsed" href="<?php echo e($item['url']); ?>">
                    <i class="<?php echo e($item['icon']); ?>"></i>
                    <span><?php echo e($item['label']); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </li><!-- End Register Page Nav -->
    </ul>
</aside><!-- End Sidebar-->