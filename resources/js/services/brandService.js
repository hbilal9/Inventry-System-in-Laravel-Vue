import {http, httpFile} from './http_service';

export function addBrand(data) {
    return http().post('/auth/brands', data);
}
export function getBrands() {
    return http().get('/auth/brands');
}

export function updateBrand(id, data){
    return http().post(`/auth/brands/${id}`, data);
}

export function deleteBrand(id, data) {
    return http().delete(`/auth/brands/${id}`, data);
}