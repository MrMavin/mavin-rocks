@php
    /* Required: $label, $value */
    $name = $id = isset($name) ? $name : strtolower($label);
@endphp
<div class="field">
    <label class="checkbox @if ($errors->has($name)) is-danger @endif" for="{{ $id }}">
        <input name="{{ $name }}"
               id="{{ $id }}"
               type="checkbox"
               value="{{ $value }}"
               @if (old($name)) checked @endif>
        {{ $label }}
    </label>

    @if ($errors->has($name))
        @foreach($errors->get($name) as $error)
            <p class="help is-danger">{{ $error }}</p>
        @endforeach
    @endif
</div>