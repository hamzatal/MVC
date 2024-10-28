<?php require 'views/partials/header.php'; ?>

<main class="container m-4">
    <h1>Create Product</h1>

    <form action="/products/create" method="POST"> <!-- Correct route to match store action -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php require 'views/partials/footer.php'; ?>
