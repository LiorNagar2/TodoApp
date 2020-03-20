<li class="list-group-item" data-todo-id="<?= $todo['id'] ?>">
    <div class="row">
        <div class="col-md-9">
            <h4 class="font-weight-normal"><?= $todo['title']; ?></h4>
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
                <a type="button" class="btn btn-sm btn-success">
                    <i class="fa fa-check"></i>
                </a>
                <a type="button" class="btn btn-sm btn-warning edit-todo-btn"
                   data-toggle="modal"
                   data-target="#EditTodoModal">
                    <i class="fa fa-edit"></i>
                </a>
                <a type="button" class="btn btn-sm btn-danger delete-todo-btn">
                    <i class="fa fa-remove"></i>
                </a>
            </div>
        </div>
    </div>
</li>