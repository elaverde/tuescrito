<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">{{APP_NAME}}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="search-bar">
    </div><!-- End Search Bar -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li @click="setViewed" class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">@{{notifications}}</span>
                </a><!-- End Notification Icon -->
                <ul v-show="notifications > 0" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        Tienes @{{notifications}} nuevas notificaciones
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li v-for="n in buys" class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4 class="m-0 p-0">Compra</h4>
                            <p class="m-0 p-0">@{{n.user.name}} @{{n.user.last_name}} - @{{n.price | formatMoneda }} </p>
                            <p class="m-0 p-0">@{{n.updated_at}}</p>
                        </div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Notification Dropdown Items -->
            </li><!-- End Notification Nav -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ @profile_image($_SESSION['user_photo']) }}" alt="Profile" class="rounded-circle">
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;" class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['user_name'] . " " . $_SESSION['user_last_name'] ?></span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;"><?= $_SESSION['user_name'] . " " . $_SESSION['user_last_name'] ?></h6>
                        <span>Administrador</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./profile">
                            <i class="bi bi-person"></i>
                            <span>Mis datos</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="./logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Salir</span>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->