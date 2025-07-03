<?php
// Database connection setup
$servername = "localhost";
$username = "root";       
$password = "";            
$dbname = "todolist_db";  //  database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection stablished or not 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Table if not exists
$sql = "CREATE TABLE IF NOT EXISTS a4_todo (
    todo_item_id INT AUTO_INCREMENT PRIMARY KEY,
    todo_item VARCHAR(255) NOT NULL,
    todo_item_author VARCHAR(100) NOT NULL,
    todo_item_completed_date DATE DEFAULT NULL,
    todo_item_creation_date DATE NOT NULL,
    todo_item_due_date DATE DEFAULT NULL,
    todo_item_start_date DATE DEFAULT NULL,
    todo_item_person_accountable VARCHAR(100) DEFAULT NULL
)";
if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Insert data if form is submitted via Post 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $todo_item = $_POST['todo_item'];
    $todo_item_author = $_POST['todo_item_author'];
    $todo_item_creation_date = date('Y-m-d'); // Automatically take today's date
    $todo_item_due_date = $_POST['todo_item_due_date'];
    $todo_item_start_date = $_POST['todo_item_start_date'];
    $todo_item_person_accountable = $_POST['todo_item_person_accountable'];
    $todo_item_completed_date = !empty($_POST['todo_item_completed_date']) ? $_POST['todo_item_completed_date'] : NULL; // Allow NULL

    //Insert the data into the table
    $sql = "INSERT INTO a4_todo (todo_item, todo_item_author, todo_item_creation_date, todo_item_due_date, todo_item_start_date, todo_item_person_accountable, todo_item_completed_date)
            VALUES ('$todo_item', '$todo_item_author', '$todo_item_creation_date', '$todo_item_due_date', '$todo_item_start_date', '$todo_item_person_accountable', " . ($todo_item_completed_date ? "'$todo_item_completed_date'" : "NULL") . ")";

    if ($conn->query($sql) === FALSE) {
        die("Error inserting data: " . $conn->error);
    }
    // Redirect to the same page to prevent resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Query to fetch data from the a4_todo table
$sql = "SELECT * FROM a4_todo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="todocss.css">
</head>
<body>

    <h1>To-Do List</h1>

    <!-- Form to add a new task -->
    <form method="POST" action="">
        <div class="todo_form">
            <div class="todo_items">
                <div>
                    <label for="todo_item" class="todo_label">To-Do Item:</label>
                    <input type="text" name="todo_item" id="todo_item" required><br><br>
                </div>

                <div>
                    <label for="todo_item_author" class="todo_label">Author:</label>
                    <input type="text" name="todo_item_author" id="todo_item_author" required><br><br>
                </div>

                <div>
                    <label for="todo_item_person_accountable" class="todo_label">Person Accountable:</label>
                    <input type="text" name="todo_item_person_accountable" id="todo_item_person_accountable"><br><br>
                </div>
            </div>

            <div class="todo_items">
                <div>
                    <label for="todo_item_start_date" class="todo_label">Start Date:</label>
                    <input type="date" name="todo_item_start_date" id="todo_item_start_date"><br><br>
                </div>

                <div>
                    <label for="todo_item_due_date" class="todo_label">Due Date:</label>
                    <input type="date" name="todo_item_due_date" id="todo_item_due_date"><br><br>
                </div>

                <div>
                    <label for="todo_item_completed_date" class="todo_label">Completed Date:</label>
                    <input type="date" name="todo_item_completed_date" id="todo_item_completed_date"><br><br>
                </div>
            </div>            
        </div>

        <div class="todo_submit">
            <input type="submit" value="Add Task">
        </div>
    </form>

    <br><br>

    <!-- Display data from the database -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Creation Date</th>
                <th>Author</th>
                <th>Person Accountable</th>
                <th>Item</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Completed Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Displaying data from the database in table format
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['todo_item_id'] . "</td>";
                    echo "<td>" . date('m/d/Y', strtotime($row['todo_item_creation_date'])) . "</td>";
                    echo "<td>" . $row['todo_item_author'] . "</td>";
                    echo "<td>" . ($row['todo_item_person_accountable'] ? $row['todo_item_person_accountable'] : 'N/A') . "</td>";
                    echo "<td>" . $row['todo_item'] . "</td>";
                    echo "<td>" . ($row['todo_item_start_date'] ? date('m/d/Y', strtotime($row['todo_item_start_date'])) : 'N/A') . "</td>";
                    echo "<td>" . ($row['todo_item_due_date'] ? date('m/d/Y', strtotime($row['todo_item_due_date'])) : 'N/A') . "</td>";
                    echo "<td>" . ($row['todo_item_completed_date'] ? date('m/d/Y', strtotime($row['todo_item_completed_date'])) : 'N/A') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No tasks found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
