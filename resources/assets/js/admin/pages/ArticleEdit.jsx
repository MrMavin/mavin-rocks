import React, {Component} from 'react';
import Loading from "../components/Loading";
import ArticleEditor from "../components/ArticleEditor";

export default class ArticleEdit extends Component {
  constructor(props) {
    super(props);

    this.state = {
      article: {}
    }
  }

  componentDidMount() {
    const articleId = this.props.match.params.id;

    fetch('/api/admin/article/' + articleId)
      .then(r => r.json())
      .then(article => {
        this.setState({
          article: article.data
        });
      });
  }

  render() {
    if (Object.keys(this.state.article) <= 0)
      return <Loading/>;

    return <ArticleEditor editing={true} article={this.state.article} />
  }
}