import { getUserData } from "./user.js";

export async function isUserAuthenticated() {
    const token = localStorage.getItem('token');
    const user = await getUserData();

    // console.log(user);

    return token == '' || token == null || user == null ? 
        false :
        true;
}

export async function handleUserAuthenctication() {
    window.location.href = "./../auth/signin/signin.html";
}