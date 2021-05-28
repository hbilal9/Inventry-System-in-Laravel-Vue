import {http, httpFile} from './http_service';

export function addCategory(data) {
    return http().post('/auth/categories', data);
}
export function getCategories(page) {
    return http().get('/auth/categories?page='+page);
}

export function updateCategory(id, data){
    return http().post(`/auth/categories/${id}`, data);
}

export function deleteCategory(id, data) {
    return http().delete(`/auth/categories/${id}`, data);
}