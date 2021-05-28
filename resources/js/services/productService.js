import {http, httpFile} from './http_service';

export function addProduct(data) {
    return http().post('/auth/products', data);
}

export function getProducts(page) {
    return http().get('/auth/products?page='+page);
}

export function getCategories() {
    return http().get('/auth/categories');
}

export function getSearchResult(query) {
    return http().get('/auth/product/search?query='+query);
}

export function getSubCategories(id) {
    return http().get(`/auth/get-sub-categories/${id}`);
}

export function updateProduct(id, data){
    return http().post(`/auth/products/${id}`, data);
}

export function deleteProduct(id, data) {
    return http().delete(`/auth/products/${id}`, data);
}