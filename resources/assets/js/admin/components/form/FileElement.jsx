import React from 'react';
import BaseElement from "./BaseElement";
import ErrorMessage from "./ErrorMessage";

class FileElement extends BaseElement {
  render() {
    const error = this.props.error ? 'is-danger' : '';

    // const name = Object.hasOwnProperty(this.props.value.name) ? this.props.value.name : false;

    return <div className="field">
      <div className={"file is-fullwidth has-name " + error}>
        <label className="file-label" htmlFor={this.props.name}>
          <input className="file-input"
                 type="file"
                 name={this.props.name}
                 id={this.props.name}
                 onChange={this.props.onChange}/>
          <span className="file-cta">
              <span className="file-icon">
                  <i className="fas fa-upload"/>
              </span>
              <span className="file-label">{this.props.label}</span>
          </span>
          <span className="file-name">{this.props.fileName}</span>
        </label>
      </div>

      <ErrorMessage error={this.props.error} />
    </div>
  }
}

export default FileElement;