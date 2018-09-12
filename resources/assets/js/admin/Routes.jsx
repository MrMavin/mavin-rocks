import React, {Component} from 'react';
import {Route} from 'react-router-dom';
import ArticleList from "./pages/ArticleList";
import ArticleEdit from "./pages/ArticleEdit";

class Routes extends Component{
  render() {
    return <div className="column is-9">
      <Route path="/admin/articles-list" component={ArticleList} />
      <Route path="/admin/article-new" />
      <Route path="/admin/article-edit/:id" component={ArticleEdit} />
    </div>
  }
}

export default Routes;