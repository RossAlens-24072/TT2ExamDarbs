<aside class="bg-light p-3 border-end" style="position: sticky; top: 84px; height: max-content;">
    <h5 class="mb-3">@lang('messages.temas')</h5>
    <ul class="nav flex-column">
        @foreach($temas as $tema)
            <li class="nav-item mb-2">
                <a href="{{route('temas.show', $tema->id)}}" class="nav-link p-0 text-dark">
                    {{$tema->title}}
                </a>
            </li>
        @endforeach
    </ul>
</aside>