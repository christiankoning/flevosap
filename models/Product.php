<?php

class Product
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function lastId()
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT MAX(id) FROM Products');
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //CREATE
    public function create($productName, $productPrice, $productDesc, $productImg, $categoryId, $productFeature, $productStock)
    {
        try {
            $query= $this->conn->query('INSERT INTO Products SET name = ?, price = ?, description = ?, productImg = ?, categoryId = ?, featured = ?, stock = ?, createdAt = NOW(), updatedAt = NOW()',[$productName, $productPrice, $productDesc, $productImg, $categoryId, $productFeature, $productStock]);
        }
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
    public function createNutrition($productId, $nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt)
    {
        try {
            $query= $this->conn->query('INSERT INTO Nutritional_Values SET productId = ?, energy = ?, fats = ?, saturated = ?, carbohydrates = ?, sugars = ?, protein = ?, salt = ?,  createdAt = NOW(), updatedAt = NOW()',[$productId, $nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt]);
        }
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    //show the featured products
    public function showFeaturedProducts()
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Products WHERE featured =1');
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //show all the products from a category
    public function showAllFromCategory($categoryId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Products WHERE categoryId = ? ', [$categoryId]);
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
    public function showAll()
{
    try {
        //executes the search query
        $query = $this->conn->query('SELECT * FROM Products');
        //returns the search query
        return $query['msg'];
        //catches an exception
    } catch (Exception $exception) {
        //return exception message
        die(var_dump($exception->getMessage()));
    }
}

    //show one product
    public function showOne($productId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Products WHERE id = ? ', [$productId]);
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //show one product
    public function safeShowOne($productId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Products WHERE id = ? ', [$productId]);
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //show nutrition values from a product
    public function showNutrition($productId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Nutritional_Values WHERE productId = ? ', [$productId]);
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //order a product by name
    public function orderByName($categoryId, $orderBy)
    {
        try {
            if($orderBy === 'ASC')
            {
                //executes the search query
                $query = $this->conn->query('SELECT * FROM Products WHERE categoryId = ? ORDER BY name ASC', [$categoryId]);
                //returns the search query
                return $query['msg'];
            }
            elseif($orderBy === 'DESC')
            {
                //executes the search query
                $query = $this->conn->query('SELECT * FROM Products WHERE categoryId = ? ORDER BY name DESC', [$categoryId]);
                //returns the search query
                return $query['msg'];
            }
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //order a product by price
    public function orderByPrice($categoryId, $orderBy)
    {
        try {
            if($orderBy === 'priceHigh')
            {
                //executes the search query
                $query = $this->conn->query('SELECT * FROM Products WHERE categoryId = ? ORDER BY price DESC', [$categoryId]);
                //returns the search query
                return $query['msg'];
            }
            elseif($orderBy === 'priceLow')
            {
                //executes the search query
                $query = $this->conn->query('SELECT * FROM Products WHERE categoryId = ? ORDER BY price ASC', [$categoryId]);
                //returns the search query
                return $query['msg'];
            }
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    public function edit($productName, $productPrice, $productDesc, $productImg, $categoryId, $productFeature, $productStock, $productId)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE Products SET name = ?, price = ?, description = ?, productImg = ?, categoryId = ?, featured = ?, stock = ?, updatedAt = NOW() WHERE id = ?', [$productName, $productPrice, $productDesc, $productImg, $categoryId, $productFeature, $productStock, $productId]);
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }
    public function editStock($productStock, $productId)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE Products SET stock = ?, updatedAt = NOW() WHERE id = ?', [$productStock, $productId]);
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }
    public function editNutrition($nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt, $productId)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE Nutritional_Values SET energy = ?, fats = ?, saturated = ?, carbohydrates = ?, sugars = ?, protein = ?, salt = ?, updatedAt = NOW() WHERE productId = ?', [$nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt, $productId]);
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }
    //DELETE
    public function destroy($id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('DELETE FROM Products WHERE id = ?', [$id]);
        }
            //catches an exception
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }

    public function destroyNutrition($id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('DELETE FROM Nutritional_Values WHERE productId = ?', [$id]);
        }
            //catches an exception
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }

}