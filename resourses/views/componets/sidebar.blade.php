<!-- ======= Sidebar ======= -->
@php
$menuItems = [
    [
        'url' => './category',
        'icon' => 'bi bi-card-list',
        'label' => 'Categorias'
    ],
    [
        'url' => './product',
        'icon' => 'bi bi-card-list',
        'label' => 'Productos'
    ],
    [
        'url' => './text',
        'icon' => 'bi bi-card-list',
        'label' => 'Textos'
    ],
    [
        'url' => './client',
        'icon' => 'bi bi-card-list',
        'label' => 'Clientes'
    ],
    [
        'url' => './admin',
        'icon' => 'bi bi-card-list',
        'label' => 'Administradores'
    ],
];
@endphp
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
            @foreach ($menuItems as $item)
                <a class="nav-link collapsed" href="{{ $item['url'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </li><!-- End Register Page Nav -->
    </ul>
</aside><!-- End Sidebar-->