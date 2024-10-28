<?php require 'views/partials/header.php'; ?>
<main class="container m-4">
    <h1>Products</h1>

    <!-- Display all products -->
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="card-text">$<?php echo htmlspecialchars($product['price']); ?></p>
                        
                        <!-- Edit and Delete Buttons -->
                        <a href="/products/edit?id=<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/products/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require 'views/partials/footer.php'; ?>
