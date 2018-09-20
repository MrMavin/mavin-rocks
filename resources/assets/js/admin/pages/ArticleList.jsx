import React, {Component} from 'react';
import Loading from "../components/Loading";
import {NavLink} from 'react-router-dom';
import {deleteArticle, getArticles} from "../util/Axios";

export default class ArticleList extends Component {
    constructor(props) {
        super(props);

        this.handleDelete = this.handleDelete.bind(this);

        this.state = {
            articles: []
        }
    }

    componentDidMount() {
        getArticles().then(articles => {
            this.setState({
                articles: articles
            });
        });
    }

    handleDelete(e) {
        e.preventDefault();

        const element = e.target;

        if (element.innerText !== 'sure?') {
            element.innerText = 'sure?';
            return;
        }

        const articleId = e.target.dataset.article;

        deleteArticle(articleId).then(r => this.componentDidMount());
    }

    render() {
        if (this.state.articles.length <= 0)
            return <Loading/>;

        return this.state.articles.map(article => {
            const image = article.image ? <React.Fragment>&nbsp;<i className="fas fa-image"/></React.Fragment> : '';
            const published = !article.published ? 'unpublished' : '';

            const category = article.category ? <React.Fragment>
                <i className="fas fa-list fa-sm"/>&nbsp;
                {article.category.name}
            </React.Fragment> : '';
            const tags = article.tags ? <React.Fragment>
                <i className="fas fa-tags fa-sm"/>&nbsp;
                {article.tags}&nbsp;
            </React.Fragment> : '';

            const infos = category || tags ? <small className='is-marginless'>
                {tags}
                {category}
            </small> : '';

            return <article key={article.id} className="media">
                <div className="media-content">
                    <div className="content">
                        <p className="is-marginless">
                            <NavLink to={"/admin/article-edit/" + article.id}>
                                <strong>{article.title}</strong>
                            </NavLink>&nbsp;
                            <small>{article.created_at} ({article.created})</small>
                            {image}
                            <a className={'is-pulled-right'} data-article={article.id} onClick={this.handleDelete}>
                                delete
                            </a>
                        </p>
                        <p className={"is-marginless" + published}>
                            {article.excerpt.substr(0, 255)}...
                        </p>
                        {infos}
                    </div>
                </div>
            </article>
        });
    }
}