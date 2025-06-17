<x-layout>
    <x-slot name="title">
        Izveidot jaunu ierakstu
    </x-slot>

    <h1 class="mb-4"> @lang('messages.izv')</h1>

    <div class="pb-8">
        @if ($errors->any())
            <div class="bg-red-500 text-white font-bold">
                Something went wrong....
            </div>
            <ul class="border border-t-0 border-red-400">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif()
    </div>

    <form method="POST" action="{{route('ieraksti.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">@lang('messages.nosaukums')</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">@lang('messages.apraksts')</label>
            <textarea type="text" name="content" class="form-control" rows="5">{{old('content')}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">@lang('messages.patt')</label>
            <input type="file" name="bilde" class="form-control">
            @error('bilde')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">@lang('messages.izvt')</label>
            <select name="tema_id" class="form-select">
                <option value="">Izvēlies Tēmu</option>
                @foreach($temas as $tema)
                    <option value="{{$tema->id}}" {{old('tema_id')==$tema->id ? 'selected' : ''}}>
                        {{$tema->title}}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">@lang('messages.izvie')</button>
    </form>
</x-layout>