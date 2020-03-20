(function ($) {
    "use strict";

    // Add Todo
    $(document).on('submit', '#AddTodoForm', function (e) {
        // cancels the form submission
        e.preventDefault();

        var $form = $(this);

        // Collect Variables
        var todoText = $("#todo").val();
        var CatId = $("#todoCategory option:selected").val();

        if (todoText.length) {
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "includes/ajax.php",
                data: {
                    action: 'create_todo',
                    title: todoText,
                    category_id: CatId,
                },
                success: function (data) {
                    //console.log(data);
                    if (data.status == '200') {
                        // append new todo item
                        $('#TodoList').prepend(
                            $(data.todo_html).hide().fadeIn(500)
                        );
                        // update categories todos count
                        var catCounter = $('[data-cat-id="' + CatId + '"] .badge');
                        catCounter.html(parseInt(catCounter.text()) + 1);

                        // reset form
                        $form.trigger("reset");
                    }
                }
            });
        }
    });

    // Delete Todo
    $(document).on('click', '.delete-todo-btn', function (e) {
        e.preventDefault();
        var todoItem = $(this).closest('.list-group-item');
        var todoId = todoItem.data('todo-id');
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "includes/ajax.php",
            data: {
                action: 'delete_todo',
                id: todoId,
            },
            success: function (data) {
                console.log(data);
                if (data.status == '500') {
                    alert('Error');
                } else {
                    todoItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            }
        });
    });

    // filter todos
    $('#Sort, #CatFilter').on('change', function () {
        var sortBy = $('#Sort').val();
        var CatId = $('#CatFilter').val();
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "includes/ajax.php",
            data: {
                action: 'filter_todos',
                sort_by: sortBy,
                category_id: CatId,
            },
            success: function (data) {
                if (data.status == '500') {
                    alert('Error');
                } else {
                    $('#TodoList').html(data.todos_html);
                }
            }
        });

    });

    // Check todo
    $(document).on('click', '.check-todo-btn', function (e) {
        var todoItem = $(this).closest('.list-group-item');
        var todoId = todoItem.data('todo-id');
        var newsStatus = todoItem.hasClass('todo-done') ? 1 : 0;

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "includes/ajax.php",
            data: {
                action: 'update_todo_status',
                id: todoId,
                status: newsStatus
            },
            success: function (data) {
                if (!data) {
                    alert('Error');
                } else {
                    if(newsStatus == 1){
                        todoItem.removeClass('todo-done list-group-item-danger');
                    }else{
                        todoItem.addClass('todo-done list-group-item-danger');
                    }
                }
            }
        });
    });


    /*$(document).on('click', '.edit-todo-btn', function (e) {
        var todoItem = $(this).closest('.list-group-item');
        var todoId = todoItem.data('todo-id');
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "includes/ajax.php",
            data: {
                action: 'get_todo_form',
                id: todoId,
            },
            success: function (data) {
                if (!data.id) {
                    alert('Error');
                } else {
                    console.log(data)
                }
            }
        });
    });*/


})(jQuery);