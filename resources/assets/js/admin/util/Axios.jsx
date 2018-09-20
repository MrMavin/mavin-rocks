import Axios from "axios";

let axios = null;

export function loadAxios(apiKey) {
    if (axios === null) {
        axios = Axios.create({
            baseURL: '/api/'
        });

        axios.defaults.headers.common['Authorization'] = apiKey;
    }
}

export async function getArticles() {
    let articles = [];

    await axios.get('/admin/articles')
        .then(r => {
            articles = r.data.data;
        }).catch(e => console.log(e.response));

    return articles;
}

export async function getArticle(articleId) {
    let article = {};

    await axios.get(`/admin/article/${articleId}`)
        .then(r => {
            article = r.data.data
        }).catch(e => console.log(e.response));

    return article;
}

export async function createArticle(data) {
    return await manageArticle('/admin/article/create', data);
}

export async function modifyArticle(articleId, data) {
    return await manageArticle(`/admin/article/${articleId}`, data);

}

export async function manageArticle(path, data) {
    let result = {
        errors: {},
        data: {}
    };

    await axios.post(path, data, {
        headers: {'Content-Type': 'multipart/form-data'},
    }).then(r => {
        result.data = r.data
    }).catch(e => {
        const response = e.response;

        if (response.status === 422) {
            result.errors = response.data.errors;
        }
    });

    return result;
}

export async function deleteArticle(articleId) {
    await axios.post(`/admin/article/${articleId}/delete`, [])
        .catch(e => console.log(e.response));

    return true;
}

export async function getCategories() {
    let categories = [];

    await axios.get('/admin/categories')
        .then(r => {
            categories = r.data.data
        }).catch(e => console.log(e.response));

    return categories;
}