<?php
include 'includes/Todo.php';
$todoClass = new Todo();
$todos = $todoClass->get_todos();
$categories = $todoClass->get_categories();

if (isset($_POST['new_category'])) {
    $todoClass->create_category($_POST['new_category']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/all.css">

    <title>Lior's Todo List</title>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-md-center">
        <div class="col col-lg-10">
            <div class="card">

                <div class="card-body">
                    <h1 class="card-title">Lior's Todo List</h1>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-todos-tab" data-toggle="tab" href="#nav-todos"
                               role="tab" aria-controls="nav-todos" aria-selected="true">Todos</a>
                            <a class="nav-item nav-link" id="nav-categories-tab" data-toggle="tab"
                               href="#nav-categories" role="tab" aria-controls="nav-categories" aria-selected="false">Categories</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-todos" role="tabpanel"
                             aria-labelledby="nav-todos-tab">
                            <h3>Add Todo</h3>
                            <form role="form" id="AddTodoForm" action="post">
                                <div class="input-group input-group-lg mb-4">
                                    <input type="text" class="form-control" id="todo"
                                           placeholder="What do you need to do today?" autofocus>
                                    <div class="input-group-append">
                                        <select id="todoCategory" class="selectpicker form-control form-control-lg"
                                                data-live-search="true"
                                                title="Please select a lunch ...">
                                            <option value="">Category</option>
                                            <?php
                                            foreach ($categories as $category) {
                                                echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" type="button">ADD TODO</button>
                                </div>
                            </form>
                            <?php /*if(isset($_GET['edit'])){
                                include_once 'includes/views/todo-edit-form.php';
                            } */?>

                            <h3>Todos</h3>

                            <div class="row justify-content-between">
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label for="">Sort</label>
                                        <select class="form-control form-control-sm" id="Sort">
                                            <option value="created_at" selected>Created date</option>
                                            <option value="title">Title</option>
                                            <option value="status">Status</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="SortCat">Filter</label>
                                    <select class="form-control form-control-sm" id="CatFilter">
                                        <option value="0">-- Select category --</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <ul class="list-group todos-list" id="TodoList">
                                <?php foreach ($todos as $todo): ?>
                                    <?php echo $todoClass->get_todo_html($todo); ?>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Modal -->
                            <div class="modal fade" id="EditTodoModal" tabindex="-1" role="dialog"
                                 aria-labelledby="EditTodoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="EditTodoModalLabel">Edit Todo</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php include 'includes/views/todo-edit-form.php'; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-categories" role="tabpanel"
                             aria-labelledby="nav-categories-tab">
                            <h3>Add Category</h3>
                            <form role="form" id="AddCategoryForm" method="post">
                                <div class="input-group input-group-lg mb-4">
                                    <input type="text" name="new_category" class="form-control" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">ADD CATEGORY</button>
                                    </div>

                                </div>
                            </form>
                            <h3>Categories</h3>
                            <ul class="list-group" id="CatList">
                                <?php foreach ($categories as $category): ?>
                                    <li class="list-group-item d-flex justify-content-between"
                                        data-cat-id="<?= $category['id']; ?>">
                                        <p class="p-0 m-0 flex-grow-1"><?php echo $category['category_name']; ?></p>
                                        <div class="btn-group" role="group">
                                            <span class="badge badge-primary badge-pill rounded-circle"><?php echo $category['todos_count']; ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script src="js/bundle.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>