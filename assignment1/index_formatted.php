<?php
//this file is used for step 7 : Format Content
//Format the data content using HTML and CSS. Validate 
// If/Else within the loops is also used in this file 
require('connect.php');

$query = "
  SELECT d.name, c.name AS country, d.best_season, d.avg_cost_usd, d.rating, d.last_visited
  FROM destinations d
  JOIN countries c ON d.country_code = c.code
";

$result = mysqli_query($connect, $query);
$destinations = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Formatted Output</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Destinations</h2>

<?php foreach ($destinations as $place): ?>
  <?php
    $class = "destination";
    if ($place['rating'] >= 4.7) $class .= " top-rated";
    if ($place['avg_cost_usd'] >= 1800) $class .= " expensive";
  ?>
  <div class="<?php echo $class; ?>">
    <h3><?php echo htmlspecialchars($place['name']); ?> (<?php echo htmlspecialchars($place['country']); ?>)</h3>
    <p><strong>Best Season:</strong> <?php echo htmlspecialchars($place['best_season']); ?></p>
    <p><strong>Avg Cost:</strong> $<?php echo htmlspecialchars($place['avg_cost_usd']); ?></p>
    <p><strong>Rating:</strong> <?php echo htmlspecialchars($place['rating']); ?></p>
    <p><strong>Last Visited:</strong> <?php echo htmlspecialchars($place['last_visited']); ?></p>
  </div>
<?php endforeach; ?>

</body>
</html>
