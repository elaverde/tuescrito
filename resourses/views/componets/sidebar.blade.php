<!-- ======= Sidebar ======= -->
@php
    $menuItems = [
        [
            'url' => './category',
            'icon' => 'bi bi-bookmark-fill',
            'label' => 'Categorias'
        ],
        [
            'url' => './product',
            'icon' => 'bi bi-basket3-fill',
            'label' => 'Productos'
        ],
        [
            'url' => './text',
            'icon' => 'bi bi-chat-right-text-fill',
            'label' => 'Textos'
        ],
        [
            'url' => './client',
            'icon' => 'bi bi-people-fill',
            'label' => 'Clientes'
        ],
        [
            'url' => './admin',
            'icon' => 'bi bi-person-fill-gear',
            'label' => 'Administradores'
        ],
        [
            'url' => './sales',
            'icon' => 'bi bi-cart-check-fill',
            'label' => 'Ventas'
        ]
    ];
@endphp
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Mis módulos</li>
        <li class="nav-item">
            @foreach ($menuItems as $item)
                @if ('./'.$path == $item['url'] )
                    <a class="nav-link" href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @else
                    <a class="nav-link collapsed" href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endif
                
            @endforeach
        </li><!-- End Register Page Nav -->
    </ul>
</aside><!-- End Sidebar-->