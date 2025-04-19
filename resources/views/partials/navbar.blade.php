<!--- ====== nav bar ====== --->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">MyBlog</a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            @auth
                <li class="nav-item me-2">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item mt-1">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </li>
            @endauth

            @guest
                @if (Request::routeIs('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @elseif (Request::routeIs('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            @endguest
        </ul>
    </div>
</nav>
<!-- End of nav bar -->
