<?php require 'views/partials/header.php'; ?>

<main class="container m-4">
    <h1>Edit Product</h1>

    <form action="/products/update" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</main>

<?php require 'views/partials/footer.php'; ?>
