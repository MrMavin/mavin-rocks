@php
    /* Required: $label, $icon, $data, $dataKey */
    $name = $id = isset($name) ? $name : strtolower($label);
@endphp
<div class="field">
    <label for="{{ $id }}" class="label @if ($errors->has($name)) is-danger @endif">
        {{ $label }}
    </label>

    <div class="control has-icons-left">
        <div class="select full-width">
            <select name="{{ $name }}" id="{{ $id }}" class="full-width">
                @if (isset($null) && $null)
                    <option value="">
                        No value
                    </option>
                @endif
                @foreach($data as $d)
                    <option value="{{ $d['id'] }}"
                            @if ($d['id'] == old($name)) selected @endif>
                        {{ $d[$dataKey] }}
                    </option>
                @endforeach
            </select>
            <div class="icon is-small is-left">
                <i class="{{ $icon }}"></i>
            </div>
        </div>
    </div>

    @if ($errors->has($name))
        @foreach($errors->get($name) as $error)
            <p class="help is-danger">{{ $error }}</p>
        @endforeach
    @endif
</div>