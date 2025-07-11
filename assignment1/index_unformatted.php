<?php
//// this file is used for Step 6: Output Dataset Content
// Within the loop output the data content in plain unformatted text. 
require('connect.php');

// join table between destinations and countries
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
  <title>Plain Output</title>
</head>
<body>

<h2>Destinations</h2>
<pre>
<?php
foreach ($destinations as $place) {
  echo "Name: " . $place['name'] . "\n";
  echo "Country: " . $place['country'] . "\n";
  echo "Best Season: " . $place['best_season'] . "\n";
  echo "Avg Cost: $" . $place['avg_cost_usd'] . "\n";
  echo "Rating: " . $place['rating'] . "\n";
  echo "Last Visited: " . $place['last_visited'] . "\n";
  echo "--------------------------\n";
}
?>
</pre>

</body>
</html>
