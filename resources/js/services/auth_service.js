import {http, httpFile} from './http_service';
import jwt from 'jsonwebtoken';
import store from '../store';

export function register(user) {
    return http().post('/auth/register', user);
}

export function login(user) {
    return http().post('/auth/login', user)
    .then(response => {
        if (response.status === 200) {
            setToken(response.data)
        }

        return response;
    });
}


function setToken(user) {
    const token = jwt.sign({ user: user }, 'question.tlarpakittestestjd2ez7kdsafdevelopedBysgjasljsoftgear2020testbedjaheaquestionlth');
    localStorage.setItem('questionaire-sg2020', token);
    store.dispatch('authenticate', user.user);
}

export function isLoggedIn() {
    const token = localStorage.getItem('questionaire-sg2020');
    return token != null;
}

export function logout() {
    http().get('/auth/logout');
    localStorage.removeItem('questionaire-sg2020');
}

export function getAccessToken() {
    const token = localStorage.getItem('questionaire-sg2020');
    if (!token) {
        return null;
    }

    const tokenData = jwt.decode(token);
    return tokenData.user.access_token;
}

export function getUserRole() {
    const token = localStorage.getItem('questionaire-sg2020');
    if (!token) {
        return null;
    }

    const tokenData = jwt.decode(token);
    return tokenData.user.user.role;
}

export function getProfile() {
    return http().get('/auth/profile');
}

export function getUserInfo() {
    return http().get('/auth/user-info');
}

export function resetPasswordRequest(user) {
    return http().post('/auth/reset-password-request', user);
}

export function resetPassword(user) {
    return http().post('/auth/reset-password', user);
}

