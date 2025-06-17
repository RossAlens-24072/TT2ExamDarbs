<x-layout>
    <h2 class="mb-4">Tēma: {{ $tema->title }}</h2>

    @forelse($ieraksti as $ieraksts)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $ieraksts->title }}</h5>
                <p>{{ Str::limit($ieraksts->content, 150) }}</p>
                <a href="{{ route('ieraksti.show', $ieraksts->id) }}" class="btn btn-sm btn-primary">@lang('messages.skatit')</a>
            </div>
        </div>
    @empty
        <p>@lang('messages.navi')</p>
    @endforelse

    {{ $ieraksti->links() }}
</x-layout>
