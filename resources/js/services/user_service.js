import { http, httpFile } from "./http_service";

export function updateProfile(data) {
  return http().post("/auth/update-profile", data);
}

export function changePassword(data) {
  return http().post("/auth/change-password", data);
}

export function fetchAllSales(){
  return http().get('/auth/fetch-sales');
}

export function getFilterSales(data){
  return http().post('/auth/filter-sales', data);
}