import React, {Component} from 'react';
import {Redirect} from 'react-router-dom'
import TextElement from "./form/TextElement";
import Form from "./form/Form";
import SelectElement from "./form/SelectElement";
import TextAreaElement from "./form/TextAreaElement";
import CheckBoxElement from "./form/CheckBoxElement";
import Trumbowyg from "./form/Trumbowyg";
import FileElement from "./form/FileElement";
import {createArticle, getCategories, modifyArticle} from "../util/Axios";

export default class ArticleEditor extends Component {
    constructor(props) {
        super(props);

        this.handleUpdate = this.handleUpdate.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

        this.state = {
            categories: [],
            article: this.props.article || {
                'category_id': '',
                'title': '',
                'tags': ''
            },
            errors: {},
            redirect: false,
            processing: false
        };
    }

    componentDidMount() {
        getCategories().then(categories => {
            this.setState({
                categories: categories
            });
        });
    }

    handleUpdate(e) {
        const target = e.target;
        const name = target.name;
        let value = target.value;

        if (name === 'image') {
            value = e.target.files[0];
        }

        if (target.type === 'checkbox') {
            value = target.checked ? 1 : 0;
        }

        this.setState({
            article: {
                ...this.state.article,
                [name]: value
            }
        });
    }

    handleSubmit(event) {
        event.preventDefault();

        this.setState({
            processing: true
        });

        let data = new FormData();

        for (const [key, value] of Object.entries(this.state.article)) {
            data.append(key, value);
        }

        const result = this.props.editing ? modifyArticle(this.state.article.id, data) : createArticle(data);

        result.then(r => {
            this.setState({
                processing: false,
                errors: r.errors
            });

            if (!this.props.editing && r.success){
                const articleId = r.data.article;

                this.setState({
                    redirect: '/admin/article-edit/' + articleId
                });
            }
        });
    }

    render() {
        if (this.state.redirect !== false) {
            return <Redirect to={this.state.redirect}/>;
        }

        const slug = <TextElement
            type={"text"}
            label={"Slug"}
            icon={"fas fa-link"}
            maxlength={255}
            value={this.state.article.slug}
            error={this.state.errors.slug}
            onChange={this.handleUpdate}/>;

        const reset_dates = <CheckBoxElement label={"Reset creatinullon date"}
                                             name={"reset_dates"}
                                             value={1}
                                             onChange={this.handleUpdate}/>;

        const delete_image = <CheckBoxElement label={"Delete image"}
                                              name={"delete_image"}
                                              value={1}
                                              onChange={this.handleUpdate}/>;

        /*
          Image (Image)
           */

        return <Form onSubmit={this.handleSubmit}>
            <Trumbowyg onChange={this.handleUpdate}/>

            <FileElement name={"image"}
                         label={"Chose an image..."}
                         fileName={"640x360.jpg"}
                         value={this.state.article.image}
                         error={this.state.errors.image}
                         onChange={this.handleUpdate}/>

            <TextElement type={"text"}
                         label={"Title"}
                         icon={"fas fa-pencil-alt"}
                         maxlength={255}
                         value={this.state.article.title}
                         error={this.state.errors.title}
                         onChange={this.handleUpdate}/>

            <SelectElement label={"Category"}
                           name={"category_id"}
                           options={this.state.categories}
                           value={this.state.article.category_id}
                           error={this.state.errors.category_id}
                           icon={"fas fa-list"}
                           allowNull={"true"}
                           onChange={this.handleUpdate}/>

            {this.props.editing && slug}

            <div className={"content"}>
                <TextAreaElement label={"Excerpt"}
                                 value={this.state.article.excerpt}
                                 error={this.state.errors.excerpt}
                                 readOnly={true}/>
            </div>

            <div className={"content"}>
                <TextAreaElement label={"Content"}
                                 value={this.state.article.content}
                                 error={this.state.errors.content}
                                 readOnly={true}/>
            </div>

            <TextElement type={"text"}
                         label={"Tags"}
                         maxlength={255}
                         value={this.state.article.tags}
                         error={this.state.errors.tags}
                         onChange={this.handleUpdate}/>

            <CheckBoxElement label={"Published"}
                             value={1}
                             current={this.state.article.published}
                             error={this.state.errors.published}
                             onChange={this.handleUpdate}/>

            {this.props.editing && reset_dates}
            {this.props.editing && delete_image}

            <div className="field is-grouped">
                <div className="control">
                    <button type="submit" className="button is-link" disabled={this.state.processing}>Submit</button>
                </div>
            </div>
        </Form>
    }
}