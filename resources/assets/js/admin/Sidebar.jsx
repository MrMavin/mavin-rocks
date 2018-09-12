import React, {Component} from 'react';
import {NavLink} from 'react-router-dom';

class Sidebar extends Component {
  render() {
    return <div className="column is-3">
      <aside className="menu">
        <p className="menu-label">
          Articles
        </p>
        <ul className="menu-list">
          <li>
            <NavLink to='/admin/articles-list' activeClassName='active'>
              <span className="icon">
                  <i className="fas fa-list"/>
                </span>
              List
            </NavLink>
          </li>
          <li>
            <NavLink to='/admin/article-new' activeClassName='active'>
              <span className="icon">
                  <i className="fas fa-plus-circle"/>
                </span>
              New
            </NavLink>
          </li>
        </ul>
      </aside>
    </div>
  }
}

export default Sidebar;