<form id="TodoEditForm" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title">
    </div>
    <div class="form-group">
        <label for="category_name">Category</label>
        <input type="text" class="form-control" name="category_name" value="Enter Category">
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" name="status">
            <option value="0">Todo</option>
            <option value="1">Done</option>
        </select>
    </div>
    <div class="form-group">
        <label for="created_at">Created at:</label>
        <input type="datetime-local" class="form-control" name="created_at">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>