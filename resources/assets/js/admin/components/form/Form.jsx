import React, {Component} from 'react';

class Form extends Component{
  render() {
    return <form onSubmit={this.props.onSubmit}>
      {this.props.children}
    </form>;
  }
}

export default Form;