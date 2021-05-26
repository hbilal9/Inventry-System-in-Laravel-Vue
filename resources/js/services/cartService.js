import {http, httpFile} from './http_service';

export function addToCart(product) {
  return http().post('/admin/cart', product);
}

export function getCartProducts() {
  return http().get('/admin/cart');
}

export function sellProduct(data) {
  return http().post('/admin/sell-product', data);
}