<x-layout>
    <x-slot name="title">
        {{$ieraksts->title}}
    </x-slot>

    <h1 class="mb-4">{{$ieraksts->title}}</h1>

    <div class="mb-3">
        <strong>Apraksts:</strong>
        {{$ieraksts->content}}
    </div>
    <div class="mb-3">
        <strong>Tēma:</strong>
        <br>{{$ieraksts->tema->title}}
    </div>

    <!-- Komentāri -->
     <h2 class="mb-4">Komentāri</h2>

     @if ($ieraksts->komentari->count())
        @foreach ($ieraksts->komentari as $komentars)
            <div class="border rounded p-3 mb-3">
                <strong>{{ $komentars->user->name ?? 'Anonīms' }}</strong>
                <p>{{ $komentars->content }}</p>
                <small class="text-muted">{{ $komentars->created_at->format('d.m.Y H:i') }}</small>
            </div>
        @endforeach
    @else
        <p>Vēl nav komentāru.</p>
    @endif

    <hr>

    <!-- Koemntāra pievienošana -->
    <h3 class="mb-2"> Pievienot komentāru</h3>

    <form method="POST" action=" {{route('komentari.store')}} " >
        @csrf
        <input type="hidden" name="ieraksti_id" value="{{$ieraksts->id}}">

        <div class="mb-3">
            <label class="form-label">Komentārs:</label>
            <textarea name="content" class="form-control" rows="3" required>{{old('content')}}</textarea>
        </div>

        <button type="submit" class="btn btn-secondary">Pievienot komentāru</button>
    </form>
    <br>

    <a href="{{route('ieraksti.index')}}" class="btn btn-primary"> Atpakaļ</a>
    
    <!-- Rediģēšana -->
    <a href="{{route('ieraksti.edit', $ieraksts->id)}} " class="btn btn-primary">Rediģēt ierakstu</a>

    <!-- Dzēšana -->

</x-layout>