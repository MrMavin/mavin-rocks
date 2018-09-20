import React from 'react'
import ArticleEditor from "../components/ArticleEditor";

export default class ArticleNew extends React.Component {
    render() {
        return <ArticleEditor editing={false}/>
    }
}