import {http, httpFile} from './http_service';

export function addSubCategory(data) {
    return http().post('/auth/sub-categories', data);
}
export function getCategories() {
    return http().get('/auth/categories');
}
export function getSubCategories(page) {
    return http().get('/auth/sub-categories?page=' +page);
}

export function updateSubCategory(id, data){
    return http().post(`/auth/sub-categories/${id}`, data);
}

export function deleteSubCategory(id, data) {
    return http().delete(`/auth/sub-categories/${id}`, data);
}