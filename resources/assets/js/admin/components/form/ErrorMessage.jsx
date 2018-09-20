import React, {Component} from 'react';

class ErrorMessage extends Component{
  render() {
    if (this.props.error){
      return <p className="help is-danger">
        {this.props.error}
      </p>
    }

    return '';
  }
}

export default ErrorMessage;