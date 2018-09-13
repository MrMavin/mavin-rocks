import React from 'react';
import BaseElement from "./BaseElement";
import ErrorMessage from "./ErrorMessage";

class SelectElement extends BaseElement {
  render() {
    const error = this.props.error ? 'is-danger' : '';

    let options = this.props.options.map(option => {
      return <option key={option.id}
                     value={option.id}>
        {option.name}
      </option>
    });

    if (this.props.allowNull) {
      options.push(<option key="0" value="">No value</option>);
    }

    return <div className="field">
      <label htmlFor={this.name} className="label">{this.props.label}</label>
      <div className="control has-icons-left">
        <div className="select full-width">
          <select name={this.name}
                  id={this.name}
                  className="full-width"
                  value={this.props.value}
                  onChange={this.props.onChange}>
            {options}
          </select>
          <div className="icon is-small is-left">
            <i className={this.props.icon}/>
          </div>
        </div>
      </div>

      <ErrorMessage error={this.props.error} />
    </div>;
  }
}

export default SelectElement;