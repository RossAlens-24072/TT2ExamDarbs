<x-layout>
    <x-slot name="title">
        Publicētie ieraksti
    </x-slot>

    <h1 class="mb-4">Ieraksti</h1>

    @if ($ieraksti->count())
        <div class="row">
            @foreach ($ieraksti as $ieraksts)
                <div class="col-md-6 col-lg-4 mb-4">
                    <x-ieraksti-card :ieraksts="$ieraksts" />
                </div>
            @endforeach
        </div>

        {{-- Lapotājs --}}
        <div class="d-flex justify-content-center">
            {{ $ieraksti->links() }}
        </div>
    @else
        <div class="alert alert-info">Nav publicēts neviens ieraksts.</div>
    @endif
</x-layout>
