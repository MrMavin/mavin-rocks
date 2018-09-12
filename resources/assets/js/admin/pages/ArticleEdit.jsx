import React, {Component} from 'react';
import Loading from "../components/Loading";
import TextElement from "../components/form/TextElement";

class ArticleEdit extends Component{
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

    return <div>
      <TextElement type="text" label="Title" icon="fas fa-pencil-alt" />
      {console.log(this.state.article)}
    </div>
  }
}

export default ArticleEdit;