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

    //products
    $query = 'SELECT * FROM products WHERE category_id = :category_id ORDER BY id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();

    // $categories = getOne('SELECT * FROM categories ORDER BY id',
    //                      [], $db);
    // $products = getOne('SELECT * FROM products WHERE category_id = :category_id ORDER BY id',
    //                     [':category_id', $category_id],
    //                     $db);
?>  

<!doctype html>
<html>  
    <head>
        <title>Guitar Shop</title>
        <link rel="stylesheet" href="*">
    </head>

    <body>
    <div class="container">
        <h1>Product List</h1>
        <div>
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

        <div>
            <h2><?php echo $category_name?></h2>
            <table>
                <tr>
                    <th>Head</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>

                <?php foreach($products as $product) : ?>
                <tr>
                    <td><?php echo $product['code']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo "$".number_format($product['price'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    </body>

</html>