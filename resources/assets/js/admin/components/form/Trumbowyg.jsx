import React, {Component} from 'react';
import icons from 'trumbowyg/dist/ui/icons.svg';

class Trumbowyg extends Component {
  componentDidMount() {
    $.trumbowyg.svgPath = icons;

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
      }).on('tbwchange', (e) => {
        this.props.onChange(e);
    });
  }

  render() {
    return '';
  }
}

export default Trumbowyg;