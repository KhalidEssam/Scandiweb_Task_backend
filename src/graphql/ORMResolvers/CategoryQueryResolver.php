<?php



class CategoryQueryResolver extends AbstractQueryResolver {
    public function resolve($productId = 0) {
        $query = $this->entityManager->createQuery('SELECT c FROM CategoryEntity c');
        // // Execute the query
        $Categories = $query->getResult();

        $categoryArray = [];
        foreach ($Categories as $category) {
        $categoryArray[] = [
        'id' => $category->getId(),
        'name' => $category->getName()
        ];
        }
        return $categoryArray;
    }
}