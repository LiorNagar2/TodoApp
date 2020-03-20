<?php
include "Todo.php";

//Checks if action value exists
if (isset($_POST["action"]) && !empty($_POST["action"])) {

    $todo = new Todo();
    $action = $_POST["action"];

    switch ($action) { //Switch case for value of action
        case "create_todo":
            $output = $todo->create_todo();
            break;
        case "delete_todo":
            $output = $todo->delete_todo();
            break;
        case "filter_todos":
            $output = $todo->filter_todos();
            break;
        case "update_todo_status":
            $output = $todo->update_todo_status();
            break;
        case "delete_category":
            $output = $todo->delete_category();
            break;
    }

    if (is_array($output)) {
        echo json_encode($output);
    } else {
        echo $output;
    }

    exit;

}