<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Todo App</title>
</head>

<body>
    <?php
    // Deals with the persenation of the data
    class TodosView {
        private $controller;

        function __construct($controller) {
            $this->controller = $controller;


            print "<div class='flex justify-center text-xl font-bold'><h3 class='text-green-400 align-center'>Todo App</h3></div>";
        }

        //show all todos
        public function index() {

            $allTodos = $this->controller->getAllTodos();

            echo '<form method="POST" action="/MVC-PHP/todos">';
            echo 'New Todo: <input type="text" name="todo"  class="shadow appearance-none border rounded w-1/3 py-2 px-10 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">';
            echo '<input type="submit" value="Add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">';
            echo '</form>';

            echo '<ol class="flex flex-col">';
            foreach ($allTodos as $obj) {
                $completed = $obj["completed"] ? 'yes' : 'no';

                echo '<li class="m-4" id="li' . $obj["id"] . '">';
                echo '<span class="text-lg font-bold text-green-500">' . $obj['todo'] . '</span>';
                echo '<div><span class="font-bold">completed:</span> ' . $completed . ' </div>';
                echo '<button  onclick="deleteTodo(' . $obj["id"] . ')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline w-1/8">delete</button>';
                echo '<a  href="/MVC-PHP/todos/' . $obj["id"] . '" class="bg-green-500 hover:bg-green-700 text-white font-bold  py-1 px-4 rounded focus:outline-none focus:shadow-outline w-1/8">View Todo</a>';
                echo "<hr>";
                echo '</li>';
            }
            echo '</ol>';
        }

        // Show only one todo
        public function showTodo($id) {
            $todo = $this->controller->getTodo($id);
            $completed = $todo["completed"] ? "Completed" : "Incomplete";
            $isChecked = $todo["completed"] ? "checked" : "unchecked";
            $id = $todo["id"];
    ?>
            <div class="m-5">
                <div>Todo:</div>
                <div><?php echo $todo["todo"]; ?></div>
                <div>Completed:</div>
                <div><?php echo $completed; ?></div>
                <div>Edit Todo:</div>
                <input id="todoId" type="text" class="border-2 border-black">
                <div>Edit Status:</div>
                <div><input id="statusId" type="checkbox" <?php echo $isChecked; ?>></div>

                <button onclick="editTodo(<?php echo $id; ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline w-1/8">edit</button>
                <div id="updateDone"></div>
            </div>
    <?php
        }
    }

    ?>

    <script>
        function deleteTodo(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("li" + id).remove();
                }
            };
            xhttp.open("DELETE", "todos/" + id + "", true);
            xhttp.send();
        }

        function editTodo(id) {
            var xhttp = new XMLHttpRequest();
            var data = {
                todo: document.getElementById('todoId').value,
                completed: document.getElementById('statusId').checked
            }
            var json = JSON.stringify(data)
            console.log(json)
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('updateDone').innerHTML = "<a href='/MVC-PHP/todos' class='bg-green-500'> check update</a>"
                }
            };
            xhttp.open("PUT", "todos/" + id + "", true);
            xhttp.send(json);
        }
    </script>
</body>

</html>