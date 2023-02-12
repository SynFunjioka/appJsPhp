$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "./php/taskController.php",
    data: {action: 'getList' },
    // dataType: "dataType",
    success: function (res) {
      console.log(res);
      let tasks = JSON.parse(res);
      let htmlTemplate = '';
      tasks.forEach(task => {
        htmlTemplate += 
          `
          <div class="item" id="task-${task.id}">
            <input type="checkbox" ${task.estatus === 1 ? 'checked' : null}>
            <p>${task.tarea}</p>
            <button class="trash">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                  viewBox="0 0 16 16">
                  <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
          </button>
          </div>
          `;

        $('#content').prepend(htmlTemplate);
        $('[id^="task-"]').each(function (index, element) {
          let id = ($(element).attr('id')).split("-")[1];
          console.log('task #', id);

          $(`[id=task-${id}] button`).click(function () {
            console.log('Delete task #', id);
            DeleteTask(id);
          });
        });
      });
    }
  });

  $('form button').click(function () {
    let task = $('form input').val();
    AddNewTask(task);
  });
});

function AddNewTask(task) {
  $.ajax({
    type: "POST",
    url: "./php/taskController.php",
    data: {
      action: 'create',
      task,
    },
    // dataType: "dataType",
    success: function (response) {
      console.log(response);
    }
  });
}

function DeleteTask(taskID){
  $.ajax({
    type: "POST",
    url: "./php/taskController.php",
    data: {
      action: 'deleteTask',
      taskID
    },
    // dataType: "dataType",
    success: function (response) {
      console.log(response);
    }
  });
}