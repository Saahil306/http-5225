<?php
require('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM schools WHERE `id` = " . (int)$id;
    $result = mysqli_query($connect, $query);
    $school = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $BoardName = $_POST['BoardName'];
    $SchoolName = $_POST['SchoolName'];

    $query = "UPDATE schools 
              SET `Board Name` = '$BoardName',
                  `School Name` = '$SchoolName'
              WHERE `id` = " . (int)$id;

    $result = mysqli_query($connect, $query);
    
    if ($result) {
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Update School</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <h2>Update School</h2>

  <form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($school['id']); ?>">

    <label>Board Name:</label><br>
    <input type="text" name="BoardName" value="<?php echo htmlspecialchars($school['Board Name']); ?>" required><br><br>

    <label>School Name:</label><br>
    <input type="text" name="SchoolName" value="<?php echo htmlspecialchars($school['School Name']); ?>" required><br><br>

    <input class="btn" type="submit" value="Update School">
    <a class="btn" href="index.php">Cancel</a>
  </form>

</body>
</html>
