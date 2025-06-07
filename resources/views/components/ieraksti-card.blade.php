<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $ieraksts->title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $ieraksts->tema->title ?? 'Bez tēmas' }}</h6>
        <p class="card-text">{{ $ieraksts->content }}</p>

        <ul class="list-unstyled mb-3">
            <li><strong>Autors:</strong> {{ $ieraksts->user->name ?? 'Nezināms' }}</li>
            <li><strong>Datums:</strong> {{ $ieraksts->created_at?->format('Y-m-d') }}</li>
        </ul>

        <a href="{{ route('ieraksti.show', $ieraksts->id) }}" class="btn btn-primary">Skatīt detaļas</a>
    </div>
</div>
