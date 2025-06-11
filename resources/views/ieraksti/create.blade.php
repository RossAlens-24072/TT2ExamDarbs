<x-layout>
    <x-slot name="title">
        Izveidot jaunu ierakstu
    </x-slot>

    <h1 class="mb-4"> Izveidot Jaunu Ierakstu</h1>
    <form method="POST" action="{{route('ieraksti.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nosaukums:</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Apraksts:</label>
            <textarea type="text" name="content" class="form-control" rows="5">{{old('content')}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Pievienot attēlu:</label>
            <input type="text" name="bilde" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Izvēlēties attiecīgo tēmu:</label>
            <select name="tema_id" class="form-select">
                <option value="">Izvēlies Tēmu</option>
                @foreach($temas as $tema)
                    <option value="{{$tema->id}}" {{old('tema_id')==$tema->id ? 'selected' : ''}}>
                        {{$tema->title}}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Izveidot Ierakstu</button>
    </form>
</x-layout>