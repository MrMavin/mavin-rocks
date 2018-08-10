@push('scripts')
    <div id="trumbowyg-icons">
        @php
            $icons = base_path('node_modules/trumbowyg/dist/ui/icons.svg');
            $content = \File::get($icons);
            echo $content;
        @endphp
    </div>

    <script nonce="{{ csp_nonce() }}">
        $('textarea')
            .trumbowyg({
                autogrow: true,

                btnsDef: {
                    image: {
                        dropdown: ['insertImage', 'base64', 'upload'],
                        ico: 'insertImage'
                    }
                },

                btns: [
                    ['viewHTML'],
                    ['historyUndo', 'historyRedo'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['image', 'noembed'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['preformatted'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                ],

                plugins: {
                    upload: {}
                }
            });
    </script>
@endpush