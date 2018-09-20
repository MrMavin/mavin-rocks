import React, {Component} from 'react';

class BaseElement extends Component{
  constructor(props) {
    super(props);

    this.name = this.props.name ? this.props.name : this.props.label.toLowerCase();
  }
}

export default BaseElement;