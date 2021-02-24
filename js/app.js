$(function () {
  let edit = false;

  $("#task-result").hide();
  fetchTasks();
  $("#search").keyup(function () {
    if ($("#search").val()) {
      let query = $("#search").val();
      $.ajax({
        url: "tasks/search/" + query,
        type: "GET",
        success: function (data) {
          let tasks = JSON.parse(data);
          let template = "";
          tasks.forEach((task) => {
            template += `<li class="">
                        <a class="text-info" href="#">
                          ${task.title}
                        </a> 
                    </li>`;
          });
          $("#container").html(template);
          let query = $("#search").val();
          if (query !== "") {
            $("#task-result").show();
          } else {
            $("#task-result").hide();
          }
        },
        error: function (e) {
          let template = `<li class="">
                        <a class="text-info" href="#">
                          No result found ${e}
                        </a> 
                    </li>`;

          $("#container").html(template);
        },
      });
    }
  });

  $("#task-form").submit(function (e) {
    const data = {
      title: $("#name").val(),
      description: $("#description").val(),
      id: $("#taskId").val(),
    };

    let uri = edit === false ? "task/add" : "task/edit/";

    $.ajax({
      url: uri,
      type: "POST",
      data: data,
      success: function (res) {
        console.log(res);
        fetchTasks();
        $("#task-form").trigger("reset");
      },
    });

    e.preventDefault();
  });

  function fetchTasks() {
    $.ajax({
      url: "tasks",
      type: "GET",
      success: function (res) {
        let tasks = JSON.parse(res);
        let template = "";
        tasks.forEach((task) => {
          template += `
                    
                    <tr taskId="${task.id}">
                        <td>${task.id}</td>
                        <td>
                            <a href="#" class="task-item">${task.title}</a>
                        </td>
                        <td>${task.description}</td>
                        <td>
                            <button class="btn btn-outline-primary task-delete">X</button>
                        </td>
                    </tr>`;
        });
        $("#tasks").html(template);
      },
      error: function () {
        let template = ``;
        $("#tasks").html(template);
      },
    });
  }

  $(document).on("click", ".task-refresh", function () {
    fetchTasks();
  });

  $(document).on("click", ".task-delete", function () {
    if (confirm("Are you sure you want to delete this tasks?")) {
      let elm = $(this)[0].parentElement.parentElement;
      let id = $(elm).attr("taskId");
      $.post("task/delete/" + id, function (res) {
        console.log(res);
        fetchTasks();
      });
    }
  });

  $(document).on("click", ".task-item", function () {
    let elm = $(this)[0].parentElement.parentElement;
    let id = $(elm).attr("taskId");
    $.post("tasks/" + id, function (res) {
      const task = JSON.parse(res);
      $("#taskId").val(task[0].id);
      $("#name").val(task[0].title);
      $("#description").val(task[0].description);
      edit = true;
    });
  });
});
