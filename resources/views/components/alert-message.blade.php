@if ($type && $message)
    <div class="p-4 mb-4 text-sm {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-lg"
        role="alert">
        <span class="font-bold">{{ $type == 'success' ? '¡Éxito!' : '¡Error!' }}</span>
        <p>{{ $message }}</p>
    </div>
@endif
