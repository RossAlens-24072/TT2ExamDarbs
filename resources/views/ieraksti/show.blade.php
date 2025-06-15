<x-layout>
    <x-slot name="title">
        {{ $ieraksts->title }}
    </x-slot>

    <h1 class="mb-4">{{ $ieraksts->title }}</h1>

    <!-- Ieraksta bilde -->
    <div class="mb-3">
        @if($ieraksts->bilde)
            <img src="{{ asset('storage/' . $ieraksts->bilde) }}" alt="Ieraksta bilde" width="949px" height="auto">
        @endif
    </div>

    <div class="mb-3">
        <strong>Apraksts:</strong>
        {{ $ieraksts->content }}
    </div>

    <div class="mb-3">
        <strong>Tēma:</strong>
        <br>{{ $ieraksts->tema->title }}
    </div>

    <!-- Komentāri -->
    <h2 class="mb-4">Komentāri</h2>

    @if ($ieraksts->komentari->count())
        @foreach ($komentari as $komentars)
            <div class="border rounded p-3 mb-3">
                <strong>{{ $komentars->user->name ?? 'Anonīms' }}</strong>
                <p>{{ $komentars->content }}</p>

                @if ($komentars->image_path)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $komentars->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $komentars->image_path) }}"
                                alt="Komentāra attēls"
                                style="max-width: 300px; height: auto; cursor: zoom-in;"
                                class="img-fluid">
                        </a>
                    </div>
                @endif

                <small class="text-muted">{{ $komentars->created_at->format('d.m.Y H:i') }}</small>

                <div class="d-flex align-items-center mt-2">
                    <form method="POST" action="{{ route('komentari.vote', $komentars->id) }}" class="me-1">
                        @csrf
                        <input type="hidden" name="vote_type" value="up">
                        <button type="submit" class="btn btn-outline-success btn-sm">⬆️</button>
                    </form>

                    <form method="POST" action="{{ route('komentari.vote', $komentars->id) }}" class="me-1">
                        @csrf
                        <input type="hidden" name="vote_type" value="down">
                        <button type="submit" class="btn btn-outline-danger btn-sm">⬇️</button>
                    </form>

                    <span class="ms-2">Reitings: {{ $komentars->balsuSumma() }}</span>
                </div>
            </div>
        @endforeach
    @else
        <p>Vēl nav komentāru.</p>
    @endif

    <hr>

    <!-- Komentāra pievienošana -->
    <h3 class="mb-2">Pievienot komentāru</h3>

    @auth
        <form method="POST" action="{{ route('komentari.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ieraksti_id" value="{{ $ieraksts->id }}">

            <div class="mb-3">
                <label class="form-label">Komentārs:</label>
                <textarea name="content" class="form-control" rows="3" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Attēls:</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-secondary">Pievienot komentāru</button>
        </form>
    @else
        <p>Jums jābūt pieslēgušam, lai pievienotu komentāru. <a href="{{ route('login') }}">Ienākt</a></p>
    @endauth

    <br>

    <!-- Atpakaļ -->
    <a href="{{ route('ieraksti.index') }}" class="btn btn-primary">Atpakaļ</a>

    <!-- Rediģēšana -->
    @can('update', $ieraksts)
        <a href="{{ route('ieraksti.edit', $ieraksts->id) }}" class="btn btn-primary">Rediģēt ierakstu</a>
    @endcan

    <!-- Dzēšana -->
    @can('delete', $ieraksts)
        <form action="{{ route('ieraksti.destroy', $ieraksts) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Dzēst ierakstu</button>
        </form>
    @endcan
</x-layout>
