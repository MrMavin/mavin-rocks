import React, {Component} from 'react';
import {NavLink} from 'react-router-dom';

class Navigation extends Component {
  render() {
    return <header className='header'>
      <nav id="navigation" className="navbar admin">
        <div className="container">
          <div className="navbar-brand">
            <NavLink className='navbar-item' to='/admin' activeClassName='active'>
              Admin Panel
            </NavLink>
          </div>
          <div className="navbar-menu">
            <div className="navbar-start">
              <a href="/" className="navbar-item" target="_blank">
                Site
              </a>
            </div>
          </div>
        </div>
      </nav>
    </header>
  }
}

export default Navigation;