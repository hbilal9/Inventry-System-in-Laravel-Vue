import {http, httpFile} from './http_service';

export function addBrand(data) {
    return http().post('/admin/brands', data);
}
export function getBrands() {
    return http().get('/admin/brands');
}

export function updateBrand(id, data){
    return http().post(`/admin/brands/${id}`, data);
}

export function deleteBrand(id, data) {
    return http().delete(`/admin/brands/${id}`, data);
}