import { getUserData } from "./user.js";

export async function handleUserAuthenctication() {
    const token = localStorage.getItem('token');
    const user = await getUserData();
    
    if (user == null || token == '' || token == null) {
        window.location.href = "./../auth/signin/signin.html";
    }
}