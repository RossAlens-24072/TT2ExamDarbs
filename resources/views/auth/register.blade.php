<x-layout>
    <x-slot name="title">
        Reģistrēšanās
    </x-slot>

    <h1 class="mb-4">@lang('messages.registreties')</h1>

    <form action="{{route('register')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">@lang('messages.vards')</label>
            <input type="text" name="name" class="form-control" required value="{{old('name')}}">
            @error('name') <small class="text-danger">{{$message}}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">@lang('messages.epasts')</label>
            <input type="email" name="email" class="form-control" required value="{{old('email')}}">
            @error('email') <small class="text-danger">{{$message}}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">@lang('messages.parole')</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">@lang('messages.apar')</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            {{-- Optional error, usually validation combines this with 'password' --}}
        </div>

        <button type="submit" class="btn btn-primary">@lang('messages.registreties')</button>
    </form>
</x-layout>