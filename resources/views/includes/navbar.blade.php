<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="{{ asset('222') }}#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();" class="nav-link">
                    <i class="fas fa-door-open"></i>
                    {{ __('navbar.logout') }}
                </x-dropdown-link>
            </form>
        </li>
        <li class="nav-item">
            <div class="switch">
                @include('components.language-switch')
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
