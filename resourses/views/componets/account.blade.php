<div class="btn-group float-end" role="group">
    @if (isset($_SESSION['user_id']) ) 
        <img height="50" style="border-radius:10px 0 0 10px;" src="{{ @profile_image($_SESSION['user_photo']) }}" alt="Profile" >
    @endif
    <button style="background-color: rgb(255,255,255,.4); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;" id="btnGroupDrop2" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        @if (isset($_SESSION['user_id']) ) 
            @php    
                echo $_SESSION['user_name']." ".$_SESSION['user_last_name'];
            @endphp
        @else
            Mi cuenta
        @endif
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop2">
        @if (!isset($_SESSION['user_id']) ) 
            <li><a class="dropdown-item" href="{{$path}}/user/login">Iniciar Session</a></li>
        @else
            <li><a class="dropdown-item" href="{{$path}}/user/profile">Perfil</a></li>
            <li><a class="dropdown-item" href="{{$path}}/user/buys">Mis compras</a></li>
            <li><a class="dropdown-item" href="{{$path}}/user/logout">Cerrar Session</a></li>
        @endif
    </ul>
</div>