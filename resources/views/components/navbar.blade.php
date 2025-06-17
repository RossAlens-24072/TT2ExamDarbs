<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container d-flex justify-content-between align-items-center py-3">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('ieraksti.index') }}">
            @lang('messages.logo')
        </a>

        <!-- Navigācija -->
        <ul class="navbar-nav flex-row align-items-center gap-3 text-black">

            @auth
                @can('create', App\Models\Ieraksti::class)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ieraksti.create') }}">@lang('messages.izveidot')</a>
                    </li>
                @endcan
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">@lang('messages.registreties')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">@lang('messages.ienakt')</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link p-0 m-0">@lang('messages.izrakstities')</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('messages.profils')</a>
                </li>
            @endauth

            <!-- Valodas dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'lv') }}">Latviešu</a></li>
                    <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
