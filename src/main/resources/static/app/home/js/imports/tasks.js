const showFormButton = document.querySelector('.create-task');
const form = document.querySelector('.form');
const createTaskButton = document.getElementById('create-button');
const taskFormContainer = document.querySelector('.create-task-form');
const taskTitle = document.getElementById('title');
const taskDescription = document.getElementById('description');

const API_URL = 'http://localhost:8080/tasks';

showFormButton.onclick = () => taskFormContainer.classList.remove('hidden');

form.addEventListener('submit', async (event) => {
    event.preventDefault(); 
    await createTask();
    taskFormContainer.classList.add('hidden');
})

async function createTask() {
    const token = localStorage.getItem('token');
    const task = {
        title: taskTitle.value,
        description: taskDescription.value
    }

    try {
        const response = await fetch(API_URL,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(task)
        });

        if (response.ok) {
            const task = await response.json();
            appendTaskElement(task, 'tasks-container');
        } else {
            console.log('Algo deu errado!');
        }
    } catch(error) {
        console.log(error);
    }
}



export async function getUserTasks() {
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

export function appendTaskElement(taskResponse, containerClass) {
    console.log(taskResponse);
    const tasks = document.querySelector(`.${containerClass}`);

    const task = document.createElement('div');
    task.classList.add(`task`, `task-${taskResponse.id}`);
    task.id = `task-${taskResponse.id}`;
    if (taskResponse.completed) {
        task.classList.add('completed');
    }

    const title = document.createElement('h3');
    title.classList.add('task-title');
    title.textContent = taskResponse.title;

    const description = document.createElement('p');
    description.classList.add('task-description');
    description.textContent = taskResponse.description;

    const actions = document.createElement('div');
    actions.classList.add('task-actions');

    const editButton = document.createElement('button');
    editButton.classList.add('edit');

    const completeButton = document.createElement('button');
    completeButton.classList.add('complete');

    const deleteButton = document.createElement('button');
    deleteButton.classList.add('delete');

    const editIcon = document.createElement('i');
    editIcon.classList.add('fa-solid', 'fa-pen');

    const completeIcon = document.createElement('i');
    completeIcon.classList.add('fa-solid', 'fa-circle-check');

    const deleteIcon = document.createElement('i');
    deleteIcon.classList.add('fa-solid', 'fa-trash');

    // actions.appendChild(editButton);
    if (!taskResponse.completed) {
        actions.appendChild(completeButton);
    }
    // actions.appendChild(deleteButton);

    
    // editButton.appendChild(editIcon);
    completeButton.appendChild(completeIcon);
    // deleteButton.appendChild(deleteIcon);

    tasks.appendChild(task);

    task.appendChild(title);
    task.appendChild(description);
    task.appendChild(actions);

    completeButton.onclick = async () => await completeTask(taskResponse);

    // <button class="edit">
    // <i class="fa-solid fa-pen"></i>
    // </button>
    // <button class="complete">
    // <i class="fa-solid fa-circle-check"></i>
    // </button>
    // <button class="delete">
    // <i class="fa-solid fa-trash"></i>
    // </button>
}

async function completeTask(task) {
    const token = localStorage.getItem('token');
    const updatedTask = {
        ...task,
        completed: true
    };

    const response = await fetch(API_URL, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
        body: JSON.stringify(updatedTask)
    });

    if (response.ok) {
        document.getElementById(`task-${task.id}`).classList.add('completed');
        document.querySelector(`.task-${task.id} .complete`).style.display = 'none';
        alert(`A tarefa \"${task.title}\" foi completa!`);
    } else {
        console.error('Falha ao completar tarefa:', response.status, await response.text());
    }
}

export async function loadHomeUserTasks() {
    const tasks = await getUserTasks();

    tasks.forEach(task => {
        appendTaskElement(task, 'tasks-container');
    });
}

export async function loadCompletedUserTasks() {
    const tasks = await getUserTasks();

    tasks.forEach(task => {
        if (task.completed) {
            appendTaskElement(task, 'completed-tasks-container');
        }
    });
}