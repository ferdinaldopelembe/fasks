const container = document.getElementById("tasks-container");

async function getAllTasks() {
  container.innerHTML = "";
  fetch("api/get_tasks.php")
    .then((response) => response.json())
    .then((json) => json.data)
    .then((tasks) =>
      tasks.forEach((task) => {
        createTaskCard(task);
      })
    );
}

function createTaskCard(task) {
  const taskCard = document.createElement("div");
  taskCard.classList.add("task");
  taskCard.classList.add(task.status == "DONE" ? "done-task" : "undone-task");

  const taskName = document.createElement("h2");
  taskName.classList.add("task-name");
  taskName.innerText = task.name;

  const taskDescription = document.createElement("p");
  taskDescription.innerText = task.description;

  const markDone = document.createElement("input");

  markDone.setAttribute("type", "checkbox");

  if (task.status == "DONE") markDone.setAttribute("checked", true);

  const deleteButton = document.createElement("i");
  const divDelete = document.createElement("div");
  divDelete.setAttribute("title", "remover tarefa");
  divDelete.appendChild(deleteButton);
  divDelete.classList.add("delete-task");
  deleteButton.classList.add("fa", "fa-trash");

  divDelete.onclick = async () => {
    const task_id = task.id;
    await fetch(`api/delete_task.php?task_id=${task_id}`);
    getAllTasks();
  };

  taskCard.appendChild(taskName);
  taskCard.appendChild(taskDescription);
  taskCard.appendChild(divDelete);
  taskCard.appendChild(markDone);

  container.appendChild(taskCard);

  markDone.onclick = async () => {
    const task_id = task.id;
    const task_status = markDone.checked ? "DONE" : "UNDONE";
    taskCard.classList.remove(
      task_status == "DONE" ? "undone-task" : "done-task"
    );
    taskCard.classList.add(task_status == "DONE" ? "done-task" : "undone-task");
    await fetch(
      `api/toggle_task_status.php?task_id=${task_id}&task_status=${task_status}`
    );
    refreshDashboard();
  };
}

function refreshDashboard() {
  fetch("api/refresh_dashboard.php")
    .then((response) => response.json())
    .then((stats) => {
      const total = stats.total_tasks;
      const done = stats.done_tasks;
      const undone = stats.undone_tasks;

      Array.from(document.getElementsByClassName("total_tasks")).forEach(
        (element) => {
          element.innerText = total;
        }
      );
      Array.from(document.getElementsByClassName("done_tasks")).forEach(
        (element) => {
          element.innerText = done;
        }
      );
      Array.from(document.getElementsByClassName("undone_tasks")).forEach(
        (element) => {
          element.innerText = undone;
        }
      );
    });
}

refreshDashboard();
getAllTasks();
