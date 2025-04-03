<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Login</title>
    <style>
        body {
            background-color: aliceblue;
            font-family: sans-serif;
            margin: 0px;
        }

        .welcome {
            width: 100%;
            height: 100px;
            text-align: center;
            padding: 25px;
            background-color: rgb(9, 63, 130);
            color: #fff;
            font-size: 30px;
            font-family: Cambria, serif;
        }

        .input-box {
            width: 500px;
            background-color: aquamarine;
            margin: 30px auto;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }

        .input-box form {
            display: flex;
            flex-direction: column;
        }

        .input-box label {
            font-weight: bold;
            margin-top: 10px;
        }

        .input-box input,
        .input-box textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-box input[type="submit"] {
            background-color: rgb(9, 63, 130);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
        }

        .input-box input[type="submit"]:hover {
            background-color: rgb(7, 50, 110);
        }
    </style>
</head>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "";
$dbname = "notice";

// Connect to database
$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs safely
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $date = $_POST['date']; // Date input is safe

    // File upload handling
    $targetDir = "uploads/"; // Ensure this folder exists
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allowed file types
    $allowedTypes = ["jpg", "png", "jpeg", "gif"];
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die("Error: Only JPG, PNG, and GIF files are allowed.");
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Insert data into database
        $sql = "INSERT INTO notice_table (`title`, `desc`, `date`, `image`) 
                VALUES ('$title', '$desc', '$date', '$fileName')";

        if (mysqli_query($conn, $sql)) {
            echo "✅ Data submitted successfully!";
        } else {
            echo "❌ Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "❌ Error uploading file.";
    }
}

// Close database connection
mysqli_close($conn);
?>


<body>
    <div class="welcome">
        <h1>Welcome Server User....!</h1>
    </div>

    <div class="input-box">
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required="">

            <label for="desc">Description</label>
            <textarea id="desc" name="desc" rows="4" required=""></textarea>

            <label for="date">Date</label>
            <input type="date" id="date" name="date" required="">

            <label for="image">Upload Notice here</label>
            <input type="file" id="image" name="image" accept="image/*" required="">

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>



</body></html>
