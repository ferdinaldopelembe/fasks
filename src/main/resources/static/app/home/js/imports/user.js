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
            return user;
        } else {
            return null;
        }

    } catch(error) {
        alert(error);
        return null;
    }

}