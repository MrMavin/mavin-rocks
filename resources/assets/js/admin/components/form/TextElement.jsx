import React from 'react';
import BaseElement from "./BaseElement";
import ErrorMessage from "./ErrorMessage";

class TextElement extends BaseElement {
  render() {
    const error = this.props.error ? 'is-danger' : '';

    const icon = this.props.icon ? <span className="icon is-small is-left">
      <i className={this.props.icon}/>
    </span> : '';

    return <div className="field">
      <label className="label" htmlFor={this.name}>{this.props.label}</label>

      <div className={"control " + (icon ? 'has-icons-left' : '')}>
        <input minLength={this.props.minlength}
               maxLength={this.props.maxlength}
               autoFocus={this.props.autofocus}
               name={this.name}
               id={this.name}
               className={"input " + error}
               type={this.props.type}
               placeholder={this.props.placeholder}
               value={this.props.value}
               onChange={this.props.onChange}/>
        {icon}
      </div>

      <ErrorMessage error={this.props.error} />
    </div>
  }
}

export default TextElement;