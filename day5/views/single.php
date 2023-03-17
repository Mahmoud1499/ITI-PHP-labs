<?php
$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ?  intval($_GET["id"]) : 0;

$current_items = $db->get_record_by_id($id)[0];
// var_dump($current_items);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
</head>

<body>


    <div class="container mt-2">

        <div class="card m-auto" style="width: 36rem;">
            <!-- <img src="../images/<?= $current_items["photo"] ?>" class="card-img-top" alt="..."> -->
            <img src="./images/<?= $current_items["photo"] ?>" class="card-img-top img-fluid " alt="<?= $current_items["photo"] ?>">

            <div class=" card-body">
                <h5 class="card-title"><?= $current_items["product_code"]  ?> - <?= $current_items["product_name"]  ?>
                </h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID : <?= $current_items["id"] ?></li>
                <li class="list-group-item">price : <?= $current_items["list_price"] ?></li>
                <li class="list-group-item">Unit in stock : <?= $current_items["units_in_stock"] ?></li>
                <li class="list-group-item">country : <?= $current_items["country"] ?></li>
                <li class="list-group-item">Category : <?= $current_items["category"] ?></li>
                <li class="list-group-item">Rating : <?= $current_items["rating"] ?></li>
                <li class="list-group-item">date : <?= $current_items["date"] ?></li>
                <li class="list-group-item">discontinued : <?= $current_items["discontinued"] ?></li>



            </ul>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>