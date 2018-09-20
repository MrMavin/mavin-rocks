import ReactDOM from 'react-dom';
import React, {Component} from 'react';
import {BrowserRouter} from 'react-router-dom';
import Navigation from "./Navigation";
import Sidebar from "./Sidebar";
import Routes from "./Routes";
import {loadAxios} from "./util/Axios";

class Admin extends Component {
    constructor(props) {
        super(props);

        loadAxios(document.querySelector('#root').dataset['apiKey']);
    }

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

ReactDOM.render(<Admin/>, document.querySelector('#root'));