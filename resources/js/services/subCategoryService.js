import {http, httpFile} from './http_service';

export function addSubCategory(data) {
    return http().post('/admin/sub-categories', data);
}
export function getCategories() {
    return http().get('/admin/categories');
}
export function getSubCategories() {
    return http().get('/admin/sub-categories');
}

export function updateSubCategory(id, data){
    return http().post(`/admin/sub-categories/${id}`, data);
}

export function deleteSubCategory(id, data) {
    return http().delete(`/admin/sub-categories/${id}`, data);
}