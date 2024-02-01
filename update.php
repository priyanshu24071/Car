<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$carNo = $userNo = $arName = $enName = $cardNo = $beginDate = $endDate = $company = $color = $model = "";
$carNo_err = $userNo_err = $arName_err = $enName_err = $cardNo_err = $beginDate_err = $endDate_err = $company_err = $color_err = $model_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Car No
    $input_carNo = trim($_POST["carNo"]);
    if (empty($input_carNo)) {
        $carNo_err = "Please enter a car number.";
    } else {
        $carNo = $input_carNo;
    }

    // Validate User No
    $input_userNo = trim($_POST["userNo"]);
    if (empty($input_userNo)) {
        $userNo_err = "Please enter a user number.";
    } else {
        $userNo = $input_userNo;
    }

    // Validate Ar Name
    $input_arName = trim($_POST["arName"]);
    if (empty($input_arName)) {
        $arName_err = "Please enter an Arabic name.";
    } else {
        $arName = $input_arName;
    }

    // Validate En Name
    $input_enName = trim($_POST["enName"]);
    if (empty($input_enName)) {
        $enName_err = "Please enter an English name.";
    } else {
        $enName = $input_enName;
    }

    // Validate Card No
    $input_cardNo = trim($_POST["cardNo"]);
    if (empty($input_cardNo)) {
        $cardNo_err = "Please enter a card number.";
    } else {
        $cardNo = $input_cardNo;
    }

    // Validate Begin Date
    $input_beginDate = trim($_POST["beginDate"]);
    if (empty($input_beginDate)) {
        $beginDate_err = "Please enter a begin date.";
    } else {
        $beginDate = $input_beginDate;
    }

    // Validate End Date
    $input_endDate = trim($_POST["endDate"]);
    if (empty($input_endDate)) {
        $endDate_err = "Please enter an end date.";
    } else {
        $endDate = $input_endDate;
    }

    // Validate Company
    $input_company = trim($_POST["company"]);
    if (empty($input_company)) {
        $company_err = "Please enter a company name.";
    } else {
        $company = $input_company;
    }

    // Validate Color
    $input_color = trim($_POST["color"]);
    if (empty($input_color)) {
        $color_err = "Please enter a color.";
    } else {
        $color = $input_color;
    }

    // Validate Model
    $input_model = trim($_POST["model"]);
    if (empty($input_model)) {
        $model_err = "Please enter a model.";
    } else {
        $model = $input_model;
    }

    // Check input errors before updating the database
    if (empty($carNo_err) && empty($userNo_err) && empty($arName_err) && empty($enName_err) && empty($cardNo_err) && empty($beginDate_err) && empty($endDate_err) && empty($company_err) && empty($color_err) && empty($model_err)) {
        // Prepare an update statement
        $sql = "UPDATE car SET carNo=?, userNo=?, arName=?, enName=?, cardNo=?, beginDate=?, endDate=?, company=?, color=?, model=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $param_carNo, $param_userNo, $param_arName, $param_enName, $param_cardNo, $param_beginDate, $param_endDate, $param_company, $param_color, $param_model, $param_id);

            // Set parameters
            $param_carNo = $carNo;
            $param_userNo = $userNo;
            $param_arName = $arName;
            $param_enName = $enName;
            $param_cardNo = $cardNo;
            $param_beginDate = $beginDate;
            $param_endDate = $endDate;
            $param_company = $company;
            $param_color = $color;
            $param_model = $model;
            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

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
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $carNo = $row["carNo"];
                    $userNo = $row["userNo"];
                    $arName = $row["arName"];
                    $enName = $row["enName"];
                    $cardNo = $row["cardNo"];
                    $beginDate = $row["beginDate"];
                    $endDate = $row["endDate"];
                    $company = $row["company"];
                    $color = $row["color"];
                    $model = $row["model"];
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Car Information</h2>
                    <p>Please edit the input values and submit to update the car information.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Car No</label>
                            <input type="text" name="carNo" class="form-control <?php echo (!empty($carNo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $carNo; ?>">
                            <span class="invalid-feedback"><?php echo $carNo_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>User No</label>
                            <input type="text" name="userNo" class="form-control <?php echo (!empty($userNo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $userNo; ?>">
                            <span class="invalid-feedback"><?php echo $userNo_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Ar Name</label>
                            <input type="text" name="arName" class="form-control <?php echo (!empty($arName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $arName; ?>">
                            <span class="invalid-feedback"><?php echo $arName_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>En Name</label>
                            <input type="text" name="enName" class="form-control <?php echo (!empty($enName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $enName; ?>">
                            <span class="invalid-feedback"><?php echo $enName_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Card No</label>
                            <input type="text" name="cardNo" class="form-control <?php echo (!empty($cardNo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cardNo; ?>">
                            <span class="invalid-feedback"><?php echo $cardNo_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Begin Date</label>
                            <input type="date" name="beginDate" class="form-control <?php echo (!empty($beginDate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $beginDate; ?>">
                            <span class="invalid-feedback"><?php echo $beginDate_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="endDate" class="form-control <?php echo (!empty($endDate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $endDate; ?>">
                            <span class="invalid-feedback"><?php echo $endDate_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control <?php echo (!empty($company_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company; ?>">
                            <span class="invalid-feedback"><?php echo $company_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
                            <span class="invalid-feedback"><?php echo $color_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control <?php echo (!empty($model_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $model; ?>">
                            <span class="invalid-feedback"><?php echo $model_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
