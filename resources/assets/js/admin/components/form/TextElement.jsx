/*
@php
$name = $id = isset($name) ? $name : strtolower($label);
$placeholder = isset($placeholder) ? $placeholder : $label;
$autofocus = isset($autofocus) ? 'autofocus' : '';
$minlength = isset($minlength) ? "minlength={$minlength}" : '';
$maxlength = isset($maxlength) ? "maxlength={$maxlength}" : '';
@endphp
 */

import React, {Component} from 'react';

class TextElement extends Component {
  constructor(props) {
    super(props);

    this.name = this.props.name ? this.props.name : this.props.label.toLowerCase();
    this.id = this.name;

    this.state = {
      value: 'title',
      error: false
    }
  }

  render() {
    const icon = this.props.icon ? <span className="icon is-small is-left">
      <i className={this.props.icon}/>
    </span> : '';

    const error = this.state.error ? 'is-danger' : '';

    return <div className="field">
      <label className="label" htmlFor={this.id}>{this.props.label}</label>

      <div className={"control " + (icon ? 'has-icons-left' : '')}>
        <input minLength={this.props.minlength}
               maxLength={this.props.maxlength}
               autoFocus={this.props.autofocus}
               name={this.name}
               id={this.id}
               className={error}
               type={this.props.type}
               placeholder={this.props.placeholder}
               value={this.state.value} />
          {icon}
      </div>
    </div>
  }
}

export default TextElement;