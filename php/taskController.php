<?php

include('db.php');

if (isset($_POST['action']) && !empty(isset($_POST['action']))) {
    $action = $_POST['action'];

    switch ($action) {
        case "create": {
                echo create($_POST['task']);
            }
            break;

        case "deleteTask": {
                echo delete($_POST['taskID']);
            }
            break;
            
        case "setStatus": {
                echo setStatus($_POST['taskID'], $_POST['isFinished']);
            }
            break;

        default: {
                return 'No data';
            }
    }
}

if (isset($_GET['action']) && !empty(isset($_GET['action']))) {
    $action = $_GET['action'];

    switch ($action) {
        case "getList": {
                echo getList();
            }
            break;

        default: {
                return 'No data';
            }
    }
}

function getList()
{
    $connection = connect();


    if (isset($connection)) {
        $query = "SELECT * FROM tareas WHERE eliminado = 0;";
        $res = mysqli_query($connection, $query);

        if (!$res) {
            die('Query error' . mysqli_error($connection));
        }

        $json = array();
        while ($row = mysqli_fetch_array($res)) {
            $json[] = array(
                'id' => $row['id'],
                'tarea' => $row['tarea'],
                'estatus' => $row['estatus']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    } else {
        echo 'We had problems to create this new task';
    }
}

function create($task)
{
    $connection = connect();

    if (isset($connection)) {
        $query = 'INSERT INTO tareas (tarea) values ("' . $task . '");';
        echo $query . "\n";
        $res = mysqli_query($connection, $query);

        if (!$res) {
            die('Query error' . mysqli_error($connection));
        }
        return $res;
    } else {
        echo 'We had problems to create this new task';
    }
}

function setStatus($taskID, $isFinished)
{
    $connection = connect();

    if (isset($connection)) {
        // echo 'Estatus of task ID # '. $taskID . ' update to ' . $isFinished ? 0 : 1;

        $query = 'UPDATE tareas SET estatus ='. $isFinished .' WHERE id ="' . intval($taskID) . '";';
        // echo $query;
        $res = mysqli_query($connection, $query);

        if (!$res) {
            die('Query error' . mysqli_error($connection));
        }
        echo 'Estatus of task ID # '. $taskID . ' update ';
        return $res;
    } else {
        echo 'We had problems to create this new task';
    }
}

function delete($taskID)
{
    $connection = connect();

    if (isset($connection)) {
        echo 'We are connected';
        $query = 'UPDATE tareas SET eliminado = 1 WHERE id =' . $taskID . ';';
        $res = mysqli_query($connection, $query);

        if (!$res) {
            die('Query error' . mysqli_error($connection));
        }
        return $res;
    } else {
        echo 'We had problems to create this new task';
    }
}
