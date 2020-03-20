<li class="list-group-item <?php echo $todo['status'] == 0 ? 'todo-done list-group-item-danger' : ''; ?>" data-todo-id="<?= $todo['id'] ?>">
    <div class="row">
        <div class="col-md-9">
            <h4 class="todo-title font-weight-normal"><?= $todo['title']; ?></h4>
            <ul class="list-inline list-inline-separated">
                <li class="list-inline-item">
                    Category: <?= $todo['category_name'] ? $todo['category_name'] : 'null'; ?>
                </li>
                <li class="list-inline-item">Created
                    at: <?= $todo['created_at']; ?></li>
            </ul>
        </div>
        <div class="col-md-3 text-right">
            <div class="btn-group" role="group">
                <a class="btn btn-sm btn-success check-todo-btn">
                    <i class="fa fa-check"></i>
                </a>
                <a class="btn btn-sm btn-warning edit-todo-btn d-none"
                   data-toggle="modal"
                   data-target="#EditTodoModal">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger delete-todo-btn">
                    <i class="fa fa-remove"></i>
                </a>
            </div>
        </div>
    </div>
</li>