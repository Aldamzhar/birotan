<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .preview-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>{{ $book->title }} - Preview</h1>
    <div class="preview-container">
        <iframe src="{{ $publicPreviewPath }}" allowfullscreen></iframe>
    </div>
    <a href="{{ route('books.buy', $book->id) }}" class="btn btn-primary mt-3">Buy Full Book</a>
</div>
</body>
</html>
