/*
 * This is the ArticleEditor component that I'm using in https://www.mavin.rocks/ admin panel
 */

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
            categories: [], // available categories are loaded by API
            article: this.props.article || { // current article or a new one with some place holders
                'category_id': '',
                'title': '',
                'tags': ''
            },
            errors: {},
            redirect: false, // react-router redirect if needed
            processing: false // processing flag to avoid multiple API requests
        };
    }

    componentDidMount() {
        // after mounting let's load the categories
        getCategories().then(categories => {
            this.setState({
                categories: categories
            });
        });
    }

    /**
     * Method called after every input modification to update our article state
     *
     * @param e
     */
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

    /**
     * Submit handler to create or edit an article
     *
     * @param event
     */
    handleSubmit(event) {
        event.preventDefault();

        this.setState({
            processing: true // we are now preparing a request
        });

        // in order to send a multipart/form-data request with Axios I have to build a FormData object
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

            // if we've successfully created a new article, switch to editing mode
            if (!this.props.editing && r.data.success) {
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

        // ---
        // these components are available only in editing mode

        const slug = <TextElement
            type={"text"}
            label={"Slug"}
            icon={"fas fa-link"}
            maxlength={255}
            value={this.state.article.slug}
            error={this.state.errors.slug}
            onChange={this.handleUpdate}/>;

        // useful when writing drafts
        const reset_dates = <CheckBoxElement label={"Reset creation date"}
                                             name={"reset_dates"}
                                             value={1}
                                             onChange={this.handleUpdate}/>;

        // useful when I don't like the image anymore
        const delete_image = <CheckBoxElement label={"Delete image"}
                                              name={"delete_image"}
                                              value={1}
                                              onChange={this.handleUpdate}/>;

        // ---

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