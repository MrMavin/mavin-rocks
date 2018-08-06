@php
    /* Required: $label, $type */
    $name = $id = isset($name) ? $name : strtolower($label);
    $placeholder = isset($placeholder) ? $placeholder : $label;
    $autofocus = isset($autofocus) ? 'autofocus' : '';
    $minlength = isset($minlength) ? "minlength={$minlength}" : '';
    $maxlength = isset($maxlength) ? "maxlength={$maxlength}" : '';
@endphp
<div class="field">
    <label class="label" for="{{ $id }}">{{ $label }}</label>
    <div class="control @if (isset($icon)) has-icons-left @endif">
        <input name="{{ $name }}"
               id="{{ $id }}"
               class="input @if ($errors->has($name)) is-danger @endif"
               type="{{ $type }}"
               placeholder="{{ $placeholder }}"
               value="{{ old($name) }}"
                {{ $autofocus }} {{ $minlength }} {{ $maxlength }}>
        @if (isset($icon))
            <span class="icon is-small is-left">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
    </div>

    @if ($errors->has($name))
        @foreach($errors->get($name) as $error)
            <p class="help is-danger">{{ $error }}</p>
        @endforeach
    @endif
</div>