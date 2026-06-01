export function initProffileAction() {
    const proffiles = document.querySelectorAll('.proffile');
    proffiles.forEach(proffile => {
        proffile.onclick = () => {
            const name = localStorage.getItem('name');
            if (confirm(`${name}, are you sure you want to logout?`)) {
                localStorage.setItem('token','');
                localStorage.setItem('name', '');
                window.location.href = './../auth/signin/signin.html';
            }
        }
    })
}

export async function getUserData() {
    const API_URL = 'http://localhost:8080/users/me';
    const token = localStorage.getItem('token');
    
    try {
        const response = await fetch(API_URL, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            }
        });

        if (response.ok) {
            const user = await response.json();
            localStorage.setItem('name', user.name);
            return user;
        } else {
            return null;
        }

    } catch(error) {
        console.log(`Error while geting user data: ${error}`);
        return null;
    }

}