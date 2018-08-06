@php
    /* Required: $label, $type */
    $name = $id = isset($name) ? $name : strtolower($label);
@endphp
<div class="field">
    <label class="label" for="{{ $id }}">{{ $label }}</label>
    <div class="control">
        <textarea name="{{ $name }}" id="{{ $id }}">{{ old($name) }}</textarea>
    </div>

    @if ($errors->has($name))
        @foreach($errors->get($name) as $error)
            <p class="help is-danger">{{ $error }}</p>
        @endforeach
    @endif
</div>