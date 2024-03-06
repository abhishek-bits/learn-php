<?php

class ProductController
{
    // We'll use Dependency Injection to inject
    // the Repository class for the Product
    public function __construct(private ProductRepository $productRepository)
    {
    }

    // We can process a request based on:
    // 1. HTTP Method.
    // 2. id (which is nullable)
    public function processRequest(string $method, ?string $id): void
    {
        // var_dump($method, $id);
        if ($id) {
            // If id is present in the URI then this is
            // basically a single resource request.
            $this->processResourceRequest($method, $id);
        } else {
            // If id is not present in the URI then this is
            // a request for a group of resources.
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void
    {
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->productRepository->findAll());
                break;
            case "POST":
                $data = $_POST;
                echo $data;
                break;
        }
    }
}
