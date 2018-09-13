import React, {Component} from 'react';

class TagsInput extends Component {
  componentDidMount() {
    $('#tags').tagsInput();
  }

  render() {
    return '';
  }
}

export default TagsInput;