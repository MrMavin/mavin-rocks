import React, {Component} from 'react';
import Loading from "../components/Loading";
import ArticleEditor from "../components/ArticleEditor";
import {getArticle} from "../util/Axios";

export default class ArticleEdit extends Component {
  constructor(props) {
    super(props);

    this.state = {
      article: {}
    }
  }

  componentDidMount() {
    const articleId = this.props.match.params.id;

    getArticle(articleId).then(article => {
        this.setState({
            article: article
        });
    });
  }

  render() {
    if (Object.keys(this.state.article) <= 0)
      return <Loading/>;

    return <ArticleEditor editing={true} article={this.state.article} />
  }
}