<?php
	include 'db_connect.php';

    $categories = $conn->query("SELECT * FROM category_list ORDER BY id ASC");
	$row_cnt_categories = $categories->num_rows;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav nav-pills flex-column">
                        <?php
			while($row=$categories->fetch_assoc()):
			 ?>
                        <a class="border-bottom nav-link <?php if(isset($_GET['catId']) && $_GET['catId'] == $row['id']) echo 'active'; ?>"
                            href="index.php?page=sales_monitoring&catId=<?php echo $row['id']; ?>"><?php echo $row['name'] ?></a>
                        <?php endwhile; ?>
                    </nav>
                </div>
                <div class="col-md-9">
                    <?php
                        if(empty($_GET['catId'])){
                            echo '<div class="alert alert-info text-center" role="alert">
                            Please select category.
                        </div>';
                        }else{
                            $catId = $_GET['catId'];
                            
                            $results = $conn->query("SELECT *, orders.name as cname FROM orders
                            LEFT JOIN order_list
                            ON order_list.order_id = orders.id
                            LEFT JOIN product_list
                            ON product_list.id = order_list.product_id WHERE orders.status = 1 AND product_list.category_id = $catId");
                            ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        while($row=$results->fetch_assoc()):
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['cname']; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['qty']*$row['price']."php"; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>