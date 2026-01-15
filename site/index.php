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
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
    <header>
      <div class="logo"><span>F</span>ASKS</div>
      <div class="user">
        <?php echo strtoupper(substr($username,0, 2)) ?>
        <div class="user-menu">
          <!-- <a>
            <div title="<?php echo $username ?>" class="boing">
              <i style="color: blue;" class="fa-solid fa-user"></i>
            </div>
            <?php echo $username ?>
          </a>
          <a><div class="boing"><i style="color: orange;" class="fa-solid fa-cog"></i></div>configurações</a>
          <a><div class="boing"><i style="color: rebeccapurple;" class="fa-solid fa-question"></i></div>ajuda</a> -->
          <a id="log-out"><div class="boing"><i style="color: red;" class="fas fa-sign-out-alt"></i></div> sair da conta</a>
        </div>
      </div>
    </header>

    <main>
      <section id="cards-container" class="cards-container">
        <div class="card blue">
          <div class="information">
            <h3>Total</h3>
            <p class="total_tasks card-value">0</p>
            <span id="card-label"
              >você tem um total de
              <span class="total_tasks">0</span> tarefas</span
            >
          </div>
          <i class="fa-solid fa-tasks"></i>
        </div>
        <div class="card green">
          <div class="information">
            <h3>Concluídas</h3>
            <p class="done_tasks card-value">0</p>
            <span id="card-label">você concluiu <span class="done_tasks">0</span> tarefas</span>
          </div>
          <i class="fa-solid fa-check-circle"></i>
        </div>
        <div class="card orange">
          <div class="information">
            <h3>Pendentes</h3>
            <p class="undone_tasks card-value">0</p>
            <span id="card-label"
              >você tem <span class="undone_tasks">0</span> tarefas
              pendentes</span
            >
          </div>
          <i class="fa-solid fa-clock"></i>
        </div>
      </section>

      <section class="tasks">
        <h2 id="task-title" class="tasks-label">Minhas tarefas</h2>
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
        taskFormContainer.style.left = "0";
        window.scrollTo(0, 0);
      };

      cancelButton.onclick = () => {
        taskFormContainer.style.left = "-120vw";
      };

      document
        .getElementById("task-name")
        .addEventListener("keydown", function (event) {
          if (event.key === "Enter") {
            event.preventDefault();
          }
        });


        document.getElementById('log-out').onclick = async ()=> {
          if (confirm("Tem certeza que pretende sair desta conta?")) {
            await fetch('api/log_out.php');
            location.reload();
          }
        }

      document.getElementById("create-form").onsubmit = async () => {
        const task_name = document.getElementById("task-name").value;
        const task_description =
          document.getElementById("task-description").value;
        const status = "UNDONE";

        await fetch(
          `api/create_task.php`,
          {
            method: "POST",
            headers: {
              "Content-Type": "Content-Type: application/json"
            },
            body: JSON.stringify({
              task_name,
              task_description,
              status: 'UNDONE'
            })
          }
        );
        taskFormContainer.style.left = "-120vw";
      };
    </script>
    <script src="./js/script.js?v=<?php echo time() ?>"></script>
  </body>
</html>
