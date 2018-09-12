import React, {Component} from 'react';
import Loading from "../components/Loading";
import {NavLink} from 'react-router-dom';

class ArticleList extends Component{
  constructor(props) {
    super(props);

    this.state = {
      articles: []
    }
  }

  componentDidMount() {
    fetch('/api/admin/articles')
      .then(r => r.json())
      .then(articles => {
        this.setState({
          articles: articles.data
        });
      });
  }

  render() {
    if (this.state.articles.length <= 0)
      return <Loading/>;

    return this.state.articles.map(article => {
      const image = article.image ? <React.Fragment>&nbsp;<i className="fas fa-image" /></React.Fragment> : '';
      const published = !article.published ? 'unpublished' : '';

      return <article key={article.id} className="media">
        <div className="media-content">
          <div className="content">
            <p className="is-marginless">
              <NavLink to={"/admin/article-edit/" + article.id}>
                <strong>{article.title}</strong>
              </NavLink>&nbsp;
              <small>{article.created_at} ({article.created})</small>
              {image}
            </p>
            <p className={"is-marginless" + published}>
              {article.excerpt.substr(0, 255)}...
            </p>
            <small className='is-marginless'>
              <i className="fas fa-tags fa-sm" />&nbsp;
              {article.tags.map(tag => {
                return tag.tag;
              }).join(', ')}&nbsp;
              <i className="fas fa-list fa-sm" />&nbsp;
              {article.category.name}
            </small>
          </div>
        </div>
      </article>
    });
  }
}

export default ArticleList;