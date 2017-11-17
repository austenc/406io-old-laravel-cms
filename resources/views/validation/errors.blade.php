@if ($errors->has($field))
    <p class="text-red italic text-xs">
        <strong>{{ $errors->first($field) }}</strong>
    </p>
@endif