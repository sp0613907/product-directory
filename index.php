<?php
    //get the db
    require_once('./db.php');
    
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if($category_id == null || $category_id == false){
        $category_id = 1;
    }

    //category
    $query = 'SELECT * FROM categories WHERE id = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $category_name = $category['name'];
    $statement->closeCursor();

    // $category = getOne('SELECT * FROM categories WHERE id = :category_id',
    //                     [':category_id', $category_id],
    //                     $db);

    //categories
    $query = 'SELECT * FROM categories ORDER BY id';
    $statement = $db->prepare($query);
    // $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();

    // $categories = getOne('SELECT * FROM categories ORDER BY id',
    //                      [], $db);

    //products
    $query = 'SELECT * FROM products WHERE category_id = :category_id ORDER BY id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();

    // $products = getOne('SELECT * FROM products WHERE category_id = :category_id ORDER BY id',
    //                     [':category_id', $category_id],
    //                     $db);
?>  

<!doctype html>
<html>  
    <head>
        <title>Guitar Shop</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="*">
    </head>

    <body>
    <div class="container">
        <h1>Product List</h1>
        <div class="row">
            <div class="col-sm-3">
                <h2>Categories</h2>
                <nav>
                    <ul>
                        <?php foreach($categories as $category) : ?>
                        <li>
                            <a href="?category_id=<?php echo $category['id']; ?>">
                                <?php echo $category['name'];?>
                            </a>
                        </li>
                        <?php endforeach?>
                    </ul>
                </nav>
            </div>
        

            <div class="col-sm-6">
                <h2><?php echo $category_name?></h2>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th>Code</th>
                        <th>Name</th>
                        <th class="text-right">Price</th>
                    </thead>

                    <?php foreach($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['code']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td class="text-right"><?php echo "$".number_format($product['price'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

</html>