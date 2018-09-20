import React from 'react';
import BaseElement from "./BaseElement";
import ErrorMessage from "./ErrorMessage";

class CheckBoxElement extends BaseElement {
  render() {
    const error = this.props.error ? 'is-danger' : '';

    return <div className="field">
      <label className={"checkbox " + error} htmlFor={this.name}>
        <input name={this.name}
               id={this.name}
               type="checkbox"
               value={this.props.value}
               defaultChecked={this.props.current}
               onChange={this.props.onChange}/>
        &nbsp;{this.props.label}
      </label>

      <ErrorMessage error={this.props.error} />
    </div>
  }
}

export default CheckBoxElement;