import {http, httpFile} from './http_service';

export function getDashboard(){
  return http().get('/admin/get-dashboard')
}