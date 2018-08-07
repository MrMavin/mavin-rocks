@push('scripts')
    {{-- XHR request will be dropped because https is not available --}}
    @if (config('app.env') == 'local')
        <div id="trumbowyg-icons">
            @php
                $icons = base_path('node_modules/trumbowyg/dist/ui/icons.svg');
                $content = \File::get($icons);
                echo $content;
            @endphp
        </div>
    @endif

    <script>
        $('textarea')
            .trumbowyg({
                autogrow: true,

                btnsDef: {
                    // Create a new dropdown
                    image: {
                        dropdown: ['insertImage', 'base64', 'upload'],
                        ico: 'insertImage'
                    }
                },

                // Redefine the button pane
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
                    upload: {
                        //serverPath: 'https://api.imgur.com/3/image',
                        //fileFieldName: 'image',
                        //headers: {
                        //    'Authorization': 'Client-ID xxxxxxxxxxxx'
                        //},
                        //urlPropertyName: 'data.link'
                    }
                }
            });
    </script>
@endpush