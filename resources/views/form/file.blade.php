@php
    /* Required: $name */
    $name = $id = $name;
    $label = isset($label) ? $label : 'Choose a file...';
    $fileName = isset($fileName) ? $fileName : 'sample.pdf';
@endphp
@push('scripts')
    <script nonce="{{ csp_nonce() }}">
        let file = document.getElementById('{{ $name }}');
        file.onchange = function () {
            if (file.files.length > 0) {
                document.getElementsByClassName('file-{{ $name }}')[0].innerHTML = file.files[0].name;
            }
        };
    </script>
@endpush
<div class="field">
    <div class="file is-fullwidth has-name @if ($errors->has($name)) is-danger @endif">
        <label class="file-label" for="{{ $name }}">
            <input class="file-input" type="file" name="{{ $name }}" id="{{ $name }}">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                    {{ $label }}
                </span>
            </span>
            <span class="file-name file-{{ $name }}">{{ $fileName }}</span>
        </label>
    </div>

    @if ($errors->has($name))
        @foreach($errors->get($name) as $error)
            <p class="help is-danger">{{ $error }}</p>
        @endforeach
    @endif
</div>
