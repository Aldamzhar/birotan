<div>
    @if($getRecord()->file_path)
        <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($getRecord()->file_path) }}"
           target="_blank"
           class="filament-link inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-primary-600 hover:text-primary-500">
            Скачать файл
        </a>
    @else
        -
    @endif
</div>
