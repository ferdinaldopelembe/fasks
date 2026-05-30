export async function getUserTasks() {
    const API_URL = 'http://localhost:8080/tasks';
    const token = localStorage.getItem('token');

    try {
        const response = await fetch(API_URL, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
        })

        if (response.ok) {
            const list = await response.json();
            return list;
        } else {
            return null;
        }

    } catch(error) {
        console.log(`Erro de login: ${error}`);
        return null;
    }
}