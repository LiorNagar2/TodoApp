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
                    console.log(data);
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


    $('#Sort').on('change', function () {
        var sortBy = this.value;
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "includes/ajax.php",
            data: {
                action: 'sort_todos',
                sort_by: sortBy,
            },
            success: function (data) {
                if (data.status == '500') {
                    alert('Error');
                } else {
                    console.log(data.todos_html);
                    $('#TodoList').html(data.todos_html);
                }
            }
        });

    });


})(jQuery);