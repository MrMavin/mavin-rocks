import React, {Component} from 'react';
import TextElement from "./form/TextElement";
import Form from "./form/Form";
import SelectElement from "./form/SelectElement";
import TextAreaElement from "./form/TextAreaElement";
import CheckBoxElement from "./form/CheckBoxElement";
import Trumbowyg from "./form/Trumbowyg";
import TagsInput from "./form/TagsInput";
import FileElement from "./form/FileElement";
import Axios from "axios";

class ArticleEditor extends Component {
  constructor(props) {
    super(props);

    this.handleUpdate = this.handleUpdate.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

    this.state = {
      categories: [],
      article: this.props.article || {},
      errors: {}
    };

    console.log(this.props);
  }

  componentDidMount() {
    fetch('/api/admin/categories')
      .then(r => r.json())
      .then(categories => {
        this.setState({
          categories: categories.data
        });
      });
  }

  handleUpdate(e) {
    const target = e.target;
    const name = target.name;
    let value = target.value;

    if (name === 'image'){
      value = e.target.files[0];
    }

    if (target.type === 'checkbox'){
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

    Axios.defaults.headers['Content-Type'] = 'multipart/form-data';

    let data = new FormData();

    for(let [key, value] of Object.entries(this.state.article)){
      data.append(key, value);
    }

    Axios.post('/api/admin/article/' + this.state.article.id, data)
      .then(r => {
        console.log(r)
      })
      .catch(e => {
        const response = e.response;
        console.log(response);
        if (response.status === 422) {
          this.setState({
            errors: response.data.errors
          })
        }
      });
  }

  render() {
    const slug = <TextElement
      type={"text"}
      label={"Slug"}
      icon={"fas fa-link"}
      maxlength={255}
      value={this.state.article.slug}
      onChange={this.handleUpdate}
      error={this.state.errors.slug}/>;

    const reset_dates = <CheckBoxElement label={"Reset creation date"}
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
      <TagsInput/>

      <FileElement name={"image"}
                   label={"Chose an image..."}
                   fileName={"640x360.jpg"}
                   value={this.state.article.image}
                   onChange={this.handleUpdate}
                   error={this.state.errors.image}/>

      <TextElement type={"text"}
                   label={"Title"}
                   icon={"fas fa-pencil-alt"}
                   maxlength={255}
                   value={this.state.article.title}
                   onChange={this.handleUpdate}
                   error={this.state.errors.title}/>

      <SelectElement label={"Category"}
                     name={"category_id"}
                     options={this.state.categories}
                     value={this.state.article.category_id}
                     icon={"fas fa-list"}
                     allowNull={"true"}
                     onChange={this.handleUpdate}
                     error={this.state.errors.category_id}/>

      {this.props.editing && slug}

      <div className={"content"}>
        <TextAreaElement label={"Excerpt"}
                         value={this.state.article.excerpt}
                         readOnly={true}
                         error={this.state.errors.excerpt}/>
      </div>

      <div className={"content"}>
        <TextAreaElement label={"Content"}
                         value={this.state.article.content}
                         readOnly={true}
                         error={this.state.errors.content}/>
      </div>

      <TextElement type={"text"}
                   label={"Tags"}
                   maxlength={255}
                   value={this.state.article.tags}
                   onChange={this.handleUpdate}
                   error={this.state.errors.tags}/>

      <CheckBoxElement label={"Published"}
                       value={1}
                       current={this.state.article.published}
                       onChange={this.handleUpdate}
                       error={this.state.errors.published}/>

      {this.props.editing && reset_dates}
      {this.props.editing && delete_image}

      <div className="field is-grouped">
        <div className="control">
          <button type="submit" className="button is-link">Submit</button>
        </div>
      </div>
    </Form>
  }
}

export default ArticleEditor;