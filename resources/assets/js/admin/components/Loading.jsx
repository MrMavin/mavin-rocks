import React, {Component} from 'react';

class Loading extends Component{
  render() {
    return <div className="loading">
      <i className="fas fa-spinner fa-3x fa-pulse" />
    </div>
  }
}

export default Loading;