import React from 'react';
import BaseElement from "./BaseElement";
import ErrorMessage from "./ErrorMessage";

class TextAreaElement extends BaseElement {
  render() {
    return <div className="field">
      <label className={"label"} htmlFor={this.name}>
        {this.props.label}
      </label>
      <div className={"control"}>
        <textarea name={this.name}
                  id={this.name}
                  value={this.props.value}
                  onChange={this.props.onChange}
                  readOnly={this.props.readOnly}>
        </textarea>
      </div>

      <ErrorMessage error={this.props.error} />
    </div>
  }
}

export default TextAreaElement;