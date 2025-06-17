<x-layout>
    <x-slot name="title">
        Pieslēgšanās
    </x-slot>

    <h1 class="mb-4">@lang('messages.ienakt')</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">@lang('messages.epasts')</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">@lang('messages.parole')</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">@lang('messages.ienakt')</button>
    </form>
</x-layout>