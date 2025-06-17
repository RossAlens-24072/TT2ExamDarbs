<x-layout>
    <x-slot name="title">
        Publicētie ieraksti
    </x-slot>

    <h1 class="mb-4">@lang('messages.ieraksti')</h1>

    @if ($ieraksti->count())
        <div class="d-flex flex-column align-items-center gap-4">
            @foreach ($ieraksti as $ieraksts)
                <x-ieraksti-card :ieraksti="$ieraksts" />
            @endforeach
        </div>
    @else
        <div class="alert alert-info">@lang('messages.navi')</div>
    @endif
</x-layout>
