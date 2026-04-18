<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Info Terkini Kink</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('beranda.index') }}">Home</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link active" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
                @endguest
                @auth

                    <li class="nav-item">
                        <form action="{{ route('login.logout') }}" method="POST">
                            @csrf
                            <button class="nav-link btn btn-link" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Blog</a></li>
                    <li class="nav-item">
                        <span class="nav-link active">
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
