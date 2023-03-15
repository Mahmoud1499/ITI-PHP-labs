<?php
$current_index = isset($_GET["next"]) && is_numeric($_GET["next"]) ? $_GET["next"] : 0;

$items =
  $db->get_all_records_paginated(array(), $current_index);
$rowCount = $db->rawCount;

echo $rowCount;

$next_index = ($current_index + __RECORDS_PER_PAGE__ < $rowCount) ? $current_index + __RECORDS_PER_PAGE__ : 0;
$previous_index =
  ($current_index - __RECORDS_PER_PAGE__ > 0) ? $current_index - __RECORDS_PER_PAGE__ : 0;

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

  <div class="container">
    <table class=" table">
      <thead>
        <tr>
          <?php
          foreach (array_keys($items[0]) as $item)

            echo "<th scope='col'>$item </th>";
          echo "<th > Item Details </th>"
          ?>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        foreach ($items as $item) {
          echo "  <tr>";
          echo "<th scope='row'>" . $item['id'] . "</th>";
          echo "<th >" . $item['name'] . "</th>";
          echo "<th >" . $item['price'] . "</th>";
          echo "<th >" . $item['units_in_stock'] . "</th>";
          echo "<th scope='col'>
          <a href='" . $_SERVER["PHP_SELF"] . "?id=" . $item["id"] . "'> Details </a> 
        </th>";

          echo "  </tr>";
        }
        ?>
      </tbody>
    </table>
    <div class="" aria-label="...">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="<?=
                                      $_SERVER["PHP_SELF"] . "?next=" . $previous_index;
                                      ?>"> Previous</a>
        </li>
        <?php
        for ($i = 0; $i < $rowCount; $i += __RECORDS_PER_PAGE__) {
        ?>
          <a class="page-link" href="<?=
                                      $_SERVER["PHP_SELF"] . "?next=" . $i;
                                      ?>"><?= $i  / __RECORDS_PER_PAGE__ + 1 ?></a>
        <?php
        }
        ?>



        <!-- <li class=" page-item"><a class="page-link" href="#">1</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">2</span>
                </li> -->
        <!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
        <li class="page-item">
          <a class="page-link" href="<?=
                                      $_SERVER["PHP_SELF"] . "?next=" . $next_index;
                                      ?>">Next</a>
        </li>
      </ul>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</body>

</html>