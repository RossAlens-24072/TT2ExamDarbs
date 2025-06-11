<x-layout>
    <x-slot name="title">
        Publicētie ieraksti
    </x-slot>

    <h1 class="mb-4">Ieraksti</h1>

    @if ($ieraksti->count())
        <div class="d-flex flex-column align-items-center gap-4">
            @foreach ($ieraksti as $ieraksts)
                <x-ieraksti-card :ieraksti="$ieraksts" />
            @endforeach
        </div>

        {{-- Lapotājs --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $ieraksti->links() }}
        </div>
    @else
        <div class="alert alert-info">Nav publicēts neviens ieraksts.</div>
    @endif
</x-layout>
