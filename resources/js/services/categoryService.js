import {http, httpFile} from './http_service';

export function addCategory(data) {
    return http().post('/admin/categories', data);
}
export function getCategories() {
    return http().get('/admin/categories');
}

export function updateCategory(id, data){
    return http().post(`/admin/categories/${id}`, data);
}

export function deleteCategory(id, data) {
    return http().delete(`/admin/categories/${id}`, data);
}