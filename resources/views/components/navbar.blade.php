<nav class="bg-gray-200 navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container mx-auto flex justify-center items-center space-x-6 py-4 d-flex justify-content-between">
        <a href="{{ route('ieraksti.index') }}" class="text-gray-700 hover:underline">Vajadzēs logo</a>


        @auth
        @can ('create', App\Models\Ieraksti::class)
        <a href="{{ route('ieraksti.create') }}" class="text-gray-700 hover:underline">Izveidot ierakstu</a>
        @endcan
        @endauth

        @guest
        <a href="{{ route('register') }}" class="text-gray-700 hover:underline">Reģistrēties</a>

        <a href="{{ route('login') }}" class="text-gray-700 hover:underline">Ienākt</a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-700 hover:underline focus:outline-none">
                    Izrakstīties
                </button>
            </form>
        @endauth

        @auth
        <a href="#" class="text-gray-700 hover:underline">Tavs profils</a>
        @endauth
    </div>
    <hr>
</nav>

