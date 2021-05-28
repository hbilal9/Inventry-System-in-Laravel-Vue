import {http, httpFile} from './http_service';

export function addToCart(product) {
  return http().post('/auth/cart', product);
}

export function getCartProducts() {
  return http().get('/auth/cart');
}

export function sellProduct(data) {
  return http().post('/auth/sell-product', data);
}