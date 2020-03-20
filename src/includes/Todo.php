<?php
include "DB.php";

Class Todo
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_todos($order_by = 'created_at', $order = 'DESC', $cat_id = false)
    {
        $where = '';
        if ($cat_id) {
            $where = " WHERE tc.id={$cat_id} ";
        }
        $query = "
            SELECT t.*, tc.category_name 
            FROM todos t
                LEFT JOIN todos_category tc ON t.category_id = tc.id 
                {$where}
            ORDER BY t.{$order_by} {$order};
        ";

        $todos = $this->db->query($query)->fetchAll();
        return $todos;
    }

    public function get_todo($id)
    {
        $todo = $this->db->query('
            SELECT t.*, tc.category_name as category_name
            FROM todos t
                LEFT JOIN todos_category tc ON t.category_id = tc.id  
            WHERE t.id = ?'
            , $id)->fetchArray();

        return $todo;
    }

    public function get_todo_html($todo)
    {
        ob_start();
        include 'views/todo-item.php';
        return ob_get_clean();
    }

    public function get_categories()
    {
        $query = "
        SELECT tc .*,COUNT(t . id) AS todos_count 
        FROM `todos_category` tc
            LEFT JOIN todos t ON tc . id = t . category_id
        GROUP BY
            tc.id
        ";
        $categories = $this->db->query($query)->fetchAll();
        return $categories;
    }

    public function create_todo()
    {
        $title = $_POST['title'];
        $cat_id = $_POST['category_id'];
        $date = date("Y - m - d H:i:s");

        $insert = $this->db->query(
            'INSERT INTO todos (category_id,title,status) VALUES (?,?,?)',
            $cat_id, $title, 1);

        if ($insert->affectedRows()) {
            $new_todo_id = $this->db->lastInsertID();
            $new_todo = $this->get_todo($new_todo_id);
            $new_todo_html = $this->get_todo_html($new_todo);

            $response = array(
                'status' => 200,
                'todo_data' => $new_todo,
                'todo_html' => $new_todo_html,
            );

        } else {
            $response = array(
                'status' => 500,
                'error' => "Some error accrued",
            );
        }

        return $response;

    }

    public function delete_todo()
    {
        $delete = $this->db->query("DELETE FROM todos WHERE id=?", $_POST['id']);
        $response = array(
            'status' => 200
        );
        return $response;
    }

    public function create_category($cat_name)
    {
        //var_dump($cat_name);
        $this->db->query('INSERT INTO todos_category (category_name) VALUES (?)', $cat_name);
        header('Location:' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
    }

    public function filter_todos()
    {
        if (isset($_POST['sort_by'])) {
            $order_by = $_POST['sort_by'];
            $cat_id = $_POST['category_id'];
            $order = 'DESC';

            if ($order_by == 'title') {
                $order = 'ASC';
            }
            $todos = $this->get_todos($order_by, $order, $cat_id);

            $todo_html = '';
            foreach ($todos as $todo) {
                $todo_html .= $this->get_todo_html($todo);
            }
            return array(
                'status' => 200,
                'todos_html' => $todo_html,
            );
        }

    }

    function update_todo_status()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $update = $this->db->query("UPDATE todos SET status={$status} WHERE id={$id}");
        return array(
            'status' => 200,
            'id' => $id,
            'todo_status' => $status,
        );
    }

    function delete_category()
    {
        $delete = $this->db->query("DELETE FROM todos_category WHERE id=?", $_POST['cat_id']);
        return array(
            'status' => 200
        );
    }
}