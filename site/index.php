<?php

require_once '../includes/functions.php';

init_session();
handleIsLogged();



$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fasks</title>
    <style>
      :root {
        --border-radius: 8px;
        --shadow: 0 4px 10px rgba(0, 0, 0, 0.36);
        --transition: all 0.3s ease;
        --header-height: 56px;
        --primary: #2445a2ff;
        --primary-gradient: linear-gradient(330deg, #2b2358ff, #2445a2ff);
      }
      body {
        background-color: #eee;
      }
      * {
        font-family: "Segoe UI", Tahoma;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        transition: var(--transition);
      }
      header {
        height: var(--header-height);
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 12px;
        align-items: center;
        position: sticky;
        z-index: 1000;
        top: 0;
        width: 100%;
        border-bottom: 1px solid #b0c1edff;
        background-color: #ffffff8a;
        backdrop-filter: blur(5px);
      }
      main {
        padding: 12px 0;
      }
      .logo {
        font-size: 35px;
        font-weight: bold;
      }
      .logo span {
        color: var(--primary);
      }
      .user {
        cursor: pointer;
        font-family: Verdana;
        font-size: 18px;
        background-color: var(--primary);
        border-radius: 100%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
      }
      .user:hover {
        background-color: rebeccapurple;
      }
      .card {
        height: 120px;
        position: relative;
        padding: 8px;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: var(--shadow);
      }
      .card:hover {
        scale: 1.01;
      }
      .green i {
        background: green;
      }
      .green {
        border-left: 2px green solid;
      }
      .orange i {
        background: orange;
      }
      .orange {
        border-left: 2px orange solid;
      }
      .blue i {
        background: blue;
      }
      .blue {
        border-left: 2px blue solid;
      }
      .card i {
        font-size: 20px;
        border-radius: 100%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        align-self: center;
        right: 12px;
        position: absolute;
      }
      .card span {
        color: #555;
        font-size: 16px;
      }
      .card h3 {
        color: #404040ff;
        font-size: 22px;
      }
      .card p {
        font-size: 30px;
        font-weight: bold;
      }
      .cards-container {
        padding: 8px;
        gap: 8px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      }
      .tasks-label {
        padding: 20px 10px 5px 10px;
      }
      .tasks-container {
        gap: 8px;
        padding: 8px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      }
      .task {
        height: 120px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        border-radius: 4px;
        padding: 8px;
        box-shadow: var(--shadow);
        background-color: #fff;
        position: relative;
      }
      .task i {
      }
      .task-name {
        padding-left: 20px;
      }

      .undone-task {
        border-bottom: 2px solid orange;
      }
      .done-task {
        border-bottom: 2px solid green;
      }
      .undone-task .task-name::before {
        content: "";
        left: 8px;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        background-color: orange;
        position: absolute;
        align-self: center;
      }
      .done-task .task-name::before {
        content: "";
        left: 8px;
        width: 15px;
        height: 15px;
        border-radius: 100%;
        background-color: green;
        position: absolute;
        align-self: center;
      }
      .task input {
        position: absolute;
        left: 8px;
        bottom: 8px;
      }
      .create-task {
        background: var(--primary);
        color: #fff;
        font-size: 12pt;
        border: none;
        border-bottom: 2px solid #5f70ddff;
        height: 50px;
        width: 50px;
        padding: 4px 8px;
        position: fixed;
        bottom: 24px;
        right: 24px;
        border-radius: 100%;
        cursor: pointer;
      }
      .create-task:active {
        border-bottom: none;
      }
      .create-task:hover {
        bottom: 26px;
        background-color: rebeccapurple;
      }
      textarea {
        resize: none;
      }

      .create-task-form {
        background-color: #ffffff7c;
        backdrop-filter: blur(2px);
        position: absolute;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        display: none;
        align-items: center;
        justify-content: center;
      }
      .create-task-form form {
        padding: 8px 4px;
        box-sizing: border-box;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: var(--shadow);
        min-width: 330px;
        width: 30vw;
        display: flex;
        flex-direction: column;
        border: 1px #bebee7ff solid;
      }
      .create-task-form form label {
        padding: 0 8px;
        font-size: 14px;
      }
      .create-task-form form h2 {
        color: var(--primary);
        text-align: center;
        padding: 12px;
      }
      .create-task-form form input,
      button,
      textarea {
        border-radius: var(--border-radius);
        border: 1px #6e6e9aff solid;
        margin: 4px 8px;
        padding: 12px 8px;
        outline: none;
      }

      .create-task-form form input:focus-within,
      textarea:focus-within {
        border: 1px #7474b3ff solid;
      }
      #submit-task {
        text-align: center;
        /* border-radius: 999px; */
        font-weight: 400;
        color: #fff;
        font-size: 11pt;
        background: linear-gradient(330deg, #2b2358ff, #2445a2ff);
      }
      #submit-task,
      button {
        cursor: pointer;
      }
      .actions {
        display: grid;
        grid-template-columns: 50% 50%;
      }
      .delete-task {
        cursor: pointer;
        color: red;
        font-size: 9pt;
        position: absolute;
        bottom: 8px;
        right: 8px;
        border-radius: 100%;
        width: 23px;
        height: 23px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background-color: black; */
      }
      .delete-task:hover {
        background-color: red;
        color: #fff;
      }
      #no-tasks {
        margin: 8px auto;
        padding: 12px;
        border-radius: var(--border-radius);
        /* background-color: #e6e6e6ff; */
        /* background-color: #000; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: gray;
      }
      #no-tasks i {
        font-size: 2rem;
      }
    </style>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css" />
  </head>
  <body>
    <header>
      <div class="logo"><span>F</span>ASKS</div>
      <div title="<?php echo $username ?>"
        class="user">
        <?php echo strtoupper(substr($username,0, 2)) ?>
      </div>
    </header>
    <main>
      <section id="cards-container" class="cards-container">
        <div class="card blue">
          <div class="information">
            <h3>Total</h3>
            <p class="total_tasks">0</p>
            <span
              >você tem um total de
              <span class="total_tasks">0</span> tarefas</span
            >
          </div>
          <i class="fa-solid fa-tasks"></i>
        </div>
        <div class="card green">
          <div class="information">
            <h3>Concluídas</h3>
            <p class="done_tasks">0</p>
            <span>você concluiu <span class="done_tasks">0</span> tarefas</span>
          </div>
          <i class="fa-solid fa-check-circle"></i>
        </div>
        <div class="card orange">
          <div class="information">
            <h3>Pendentes</h3>
            <p class="undone_tasks">0</p>
            <span
              >você tem <span class="undone_tasks">0</span> tarefas
              pendentes</span
            >
          </div>
          <i class="fa-solid fa-clock"></i>
        </div>
      </section>

      <section class="tasks">
        <h2 class="tasks-label">Minhas tarefas</h2>
        <div id="no-tasks" class="no-tasks">
          <i class="fa-solid fa-folder-open"></i>
          <p>A tua sua lista está vazia. Crie uma nova tarefa para começar.</p>
        </div>
        <section id="tasks-container" class="tasks-container"></section>
        <button id="create-task" title="Adicionar Tarefa" class="create-task">
          <i class="fa-solid fa-add"></i>
        </button>
      </section>

      <div id="create-task-form" class="create-task-form">
        <form id="create-form" method="POST">
          <h2>Nova Tarefa</h2>
          <label for="task_name">Nome da tarefa</label>
          <input
            id="task-name"
            placeholder="sua tarefa..."
            name="task_name"
            type="text"
            required
          />
          <label for="task_description">Descrição da tarefa</label>
          <textarea
            id="task-description"
            placeholder="Descreva o que vai fazer..."
            rows="10"
            name="task_description"
            required
          ></textarea>
          <div class="actions">
            <button id="cancel-create-button">cancelar</button>
            <button
              type="submit"
              id="submit-task"
              value="adicionar"
              title="adicionar"
            >
              adicionar
            </button>
          </div>
        </form>
      </div>
    </main>

    <script>
      const cancelButton = document.getElementById("cancel-create-button");
      const createButton = document.getElementById("create-task");
      const taskFormContainer = document.getElementById("create-task-form");
      const subitButtom = document.getElementById("submit-task");

      createButton.onclick = () => {
        taskFormContainer.style.display = "flex";
        window.scrollTo(0, 0);
      };

      cancelButton.onclick = () => {
        taskFormContainer.style.display = "none";
      };

      document
        .getElementById("create-form")
        .addEventListener("keydown", function (event) {
          if (event.key === "Enter") {
            event.preventDefault();
          }
        });

      document.getElementById("create-form").onsubmit = async () => {
        const task_name = document.getElementById("task-name").value;
        const task_description =
          document.getElementById("task-description").value;
        const status = "UNDONE";

        fetch(
          `api/create_task.php?task_name=${task_name}&task_description=${task_description}`
        );
        taskFormContainer.style.display = "none";
      };
    </script>
    <script src="./js/script.js?v=<?php echo time() ?>"></script>
  </body>
</html>
