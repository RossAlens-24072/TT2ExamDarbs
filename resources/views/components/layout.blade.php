@props(['title'=> ''])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
    
    <body>
        <x-navbar />
        <div class="d-flex">
            <div class="col-md-3">
                @include('components.sidebar')
            </div>
            
            <main class="container">
                {{ $slot }}
            </main>
            </div>
        </div>

    </body>

</html>
