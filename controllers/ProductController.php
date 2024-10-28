<?php
require 'models/Product.php';

class ProductController
{
    public function show()
    {
        $productModel = new Product();
        $products = $productModel->all();

        require 'views/products/show.view.php';
    }

    public function create()
    {
        require 'views/products/create.view.php';
    }

    public function store()
    {
        $productModel = new Product();
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $productModel->create($data);
        header('Location: /products');
        exit;
    }

    public function edit()
    {
        $productModel = new Product();
        $product = $productModel->find($_GET['id']);

        require 'views/products/edit.view.php';
    }

    public function update()
    {
        $productModel = new Product();
        $id = $_POST['id'];
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price']
        ];

        $productModel->update($id, $data);
        header('Location: /products');
        exit;
    }

    public function delete()
    {
        $productModel = new Product();
        $id = $_POST['id'];
        $productModel->delete($id);

        header('Location: /products');
        exit;
    }
}
