<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter for fast order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                   
                </div>
            </div>

            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Brand List</h6>
                            <hr>
                            <?php
                              require 'connection.php';
                              $conn = Connect();
                              
                              $brand_query = "SELECT * FROM category";
                             // $result = mysqli_query($conn, $sql);
                    
                            
                                $brand_query_run  = mysqli_query($conn, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['category']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Brands Found";
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            <div class="col-md-9 mt-3">
                <div class="card ">
                    <div class="card-body row">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM FOOD WHERE category_id  IN ($rowbrand)";
                                    $products_run = mysqli_query($conn, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
  <form method="post" action="cart.php?action=add&id=<?php echo $proditems["F_ID"]; ?>">
                                                <div class="col-md-8 mt-3">
                                                    <div class="border p-2">
                                                   
                                                      
                                                        <img src="<?php echo $proditems["images_path"]; ?>" class="img-responsive" style="width:250px">
<h4 class="text-dark"><?php echo $proditems["name"]; ?></h4>
<h5 class="text-info"><?php echo $proditems["description"]; ?></h5>
<h5 class="text-danger">&#8377; <?php echo $proditems["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 80px;"> </h5>
                                                    <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"> 
                                                    <input type="hidden" name="hidden_name" value="<?php echo $proditems["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $proditems["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $proditems["R_ID"]; ?>">
                                                  
                                                </div>
                                                </div>
                                                </form>                                             
                                            <?php
                                        endforeach;
                                    }
                             
                                }
                            }
                        
                            else
                            {
                                $products = "SELECT * FROM FOOD";
                                $products_run = mysqli_query($conn, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                            <div class="col-md-4 mt-3">
                                                <div class="border p-2">
                                                    <h6><?= $proditems['name']; ?></h6>
                                                    <img src="<?php echo $proditems["images_path"]; ?>" class="img-responsive" width="150px" >
                                                    <h6 class="text-info"><?= $proditems["description"]; ?></h5>
                                                  <h5 class="text-danger">&#8377; <?= $proditems["price"]; ?></h5>
                                                  <!-- <h6 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 80px;"> </h5> -->
                                                    <!-- <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"> -->
                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                }
                                else
                                {
                                    echo "No Items Found";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

