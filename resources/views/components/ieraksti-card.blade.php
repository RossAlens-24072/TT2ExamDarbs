<div class="w-75 mx-auto">
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $ieraksti->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $ieraksti->tema->title ?? 'Bez tēmas' }}</h6>
            <!-- <p class="card-text">{{ $ieraksti->content }}</p> -->

            <div class="mb-3" style="justify-content: center; display:flex;">
                @if($ieraksti->bilde)
                <img src="{{ asset('storage/' . $ieraksti->bilde) }}"
                     alt="Ieraksta bilde"
                     class="img-fluid rounded"
                     style="max-height: 450px; width: auto; object-fit: cover;">
                @endif
            </div>

            <ul class="list-unstyled mb-3">
                <li><strong>Autors:</strong> {{ $ieraksti->user->name ?? 'Nezināms' }}</li>
                <li><strong>Datums:</strong> {{ $ieraksti->created_at?->format('Y-m-d') }}</li>
            </ul>

            <a href="{{ route('ieraksti.show', $ieraksti->id) }}" class="btn btn-primary">Skatīt paplašināti</a>
        </div>
    </div>
</div>
