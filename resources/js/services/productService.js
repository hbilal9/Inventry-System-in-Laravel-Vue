import {http, httpFile} from './http_service';

export function addProduct(data) {
    return http().post('/admin/products', data);
}

export function getProducts() {
    return http().get('/admin/products');
}

export function getCategories() {
    return http().get('/admin/categories');
}

export function getSearchResult(query) {
    return http().get('/admin/product/search?query='+query);
}

export function getSubCategories(id) {
    return http().get(`/admin/get-sub-categories/${id}`);
}

export function updateProduct(id, data){
    return http().post(`/admin/products/${id}`, data);
}

export function deleteProduct(id, data) {
    return http().delete(`/admin/products/${id}`, data);
}