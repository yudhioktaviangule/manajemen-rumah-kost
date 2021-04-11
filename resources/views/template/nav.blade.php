<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
    </ul>
    <form class="form-inline ml-3">
    </form>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

</nav>