import { quickUnauthenticatedUser, getGravatar } from './utils.js';

const user = JSON.parse(localStorage.getItem('user'));

quickUnauthenticatedUser();

document.addEventListener('DOMContentLoaded', () => {
    setUserInfo();
    document.getElementById('logout').addEventListener('click', logout);
});

/////////////
//FUNCTIONS//
////////////
const setUserInfo = () => {
    const gravatarUrl = getGravatar(user.email, 50);
    const gravatar = document.getElementById('gravatar');

    gravatar.src = gravatarUrl;

    const username = document.getElementById('username');
    username.innerHTML = `${user.first_name} ${user.last_name}`;
}

const logout = () => {
    localStorage.setItem('user', null);
    window.location.href = 'auth';
}
