<?php
// Include config file
require_once "config.php";

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $id =  trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM car WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array.
                Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_assoc($result);

                // Display car information in a box
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>View Car Information</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        .container {
                            margin-top: 50px;
                        }
                        .card {
                            width: 400px;
                            margin: 0 auto;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                Car Information
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Car No: <?php echo $row['carNo']; ?></h5>
                                <p class="card-text">User No: <?php echo $row['userNo']; ?></p>
                                <p class="card-text">Arabic Name: <?php echo $row['arName']; ?></p>
                                <p class="card-text">English Name: <?php echo $row['enName']; ?></p>
                                <p class="card-text">Card No: <?php echo $row['cardNo']; ?></p>
                                <p class="card-text">Begin Date: <?php echo $row['beginDate']; ?></p>
                                <p class="card-text">End Date: <?php echo $row['endDate']; ?></p>
                                <p class="card-text">Company: <?php echo $row['company']; ?></p>
                                <p class="card-text">Color: <?php echo $row['color']; ?></p>
                                <p class="card-text">Model: <?php echo $row['model']; ?></p>
                            </div>
                            <div class="card-footer text-muted">
                                <a href="index.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
                <?php
            } else {
                // URL doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
