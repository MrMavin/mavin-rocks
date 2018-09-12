import ReactDOM from 'react-dom';
import React, {Component} from 'react';
import {BrowserRouter} from 'react-router-dom';
import Navigation from "./Navigation";
import Sidebar from "./Sidebar";
import Routes from "./Routes";

class Admin extends Component {
  render() {
    return <BrowserRouter>
      <React.Fragment>
        <Navigation/>
        <div className="container">
          <div className="columns">
            <Sidebar/>
            <Routes/>
          </div>
        </div>
      </React.Fragment>
    </BrowserRouter>
  }
}

export default Admin;

const domContainer = document.querySelector('#root');
ReactDOM.render(<Admin/>, domContainer);