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
        <strong>@lang('messages.apraksts')</strong>
        {{ $ieraksts->content }}
    </div>

    <div class="mb-3">
        <strong>@lang('messages.tema')</strong>
        <br>{{ $ieraksts->tema->title }}
    </div>

    <!-- Komentāri -->
    <h2 class="mb-4">@lang('messages.komentari')</h2>

    @if ($ieraksts->komentari->count())
        @foreach ($komentari as $komentars)
            <div class="border rounded p-3 mb-3">
                <strong>{{ $komentars->user->name }}</strong>
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

                    <span class="ms-2">@lang('messages.reitings') {{ $komentars->balsuSumma() }}</span>
                </div>
            </div>
        @endforeach
    @else
        <p>@lang('messages.nkom')</p>
    @endif

    <hr>

    <!-- Komentāra pievienošana -->
    <h3 class="mb-2">@lang('messages.pkom')</h3>

    @auth
        <form method="POST" action="{{ route('komentari.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ieraksti_id" value="{{ $ieraksts->id }}">

            <div class="mb-3">
                <label class="form-label">@lang('messages.kom')</label>
                <textarea name="content" class="form-control" rows="3" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('messages.attels')</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-secondary">@lang('messages.pkom')</button>
        </form>
    @else
        <p> @lang('messages.bridi')<a href="{{ route('login') }}">@lang('messages.ienakt')</a></p>
    @endauth

    <br>

    <!-- Atpakaļ -->
    <a href="{{ route('ieraksti.index') }}" class="btn btn-primary">@lang('messages.atpakal')</a>

    <!-- Rediģēšana -->
    @can('update', $ieraksts)
        <a href="{{ route('ieraksti.edit', $ieraksts->id) }}" class="btn btn-primary">@lang('messages.rediget')</a>
    @endcan

    <!-- Dzēšana -->
    @can('delete', $ieraksts)
        <form action="{{ route('ieraksti.destroy', $ieraksts) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">@lang('messages.dzest')</button>
        </form>
    @endcan
</x-layout>
