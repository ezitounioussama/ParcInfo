<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $CIN = $serie = $pays = $info = $category = $status =  "";
$name_err = $CIN_err =  $serie_err = $pays_err = $info_err = $category_err = $status_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    // Validate Serie
    $input_CIN = trim($_POST["CIN"]);
    if (empty($input_CIN)) {
        $CIN_err = "Please enter your CIN";
    } else {
        $CIN = $input_CIN;
    }


    // Validate Serie
    $input_serie = trim($_POST["serie"]);
    if (empty($input_serie)) {
        $status_err = "Please enter serie of the material";
    } else {
        $serie = $input_serie;
    }

    // Validate status
    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
        $status_err = "Please enter a status";
    } else {
        $status = $input_status;
    }


    // validate Informations
    $input_info = trim($_POST["info"]);
    if (empty($input_info)) {
        $info_err = "Please enter some informations";
    } else {
        $info = $input_info;
    }

    // Validate pays
    $input_pays = trim($_POST["pays"]);
    if (empty($input_pays)) {
        $pays_err = "Please enter from where ?";
    } else {
        $pays = $input_pays;
    }


    // Validate Category
    $input_category = trim($_POST["category"]);
    if (empty($input_category)) {
        $status_err = "Please enter category of the material";
    } else {
        $category = $input_category;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($CIN_err) && empty($serie_err) && empty($status_err) && empty($info_err) && empty($pays_err) && empty($category_err)) {
        // Prepare an update statement
        $sql = "UPDATE materials SET CIN=:CIN, name=:name, serie=:serie, status=:status, infos=:infos , pays=:pays , category=:category WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":CIN", $param_CIN);
            $stmt->bindParam(":serie", $param_serie);
            $stmt->bindParam(":status", $param_status);
            $stmt->bindParam(":infos", $param_infos);
            $stmt->bindParam(":pays", $param_pays);
            $stmt->bindParam(":category", $param_category);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_serie = $serie;
            $param_status = $status;
            $param_infos = $info;
            $param_pays = $pays;
            $param_category = $category;

            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM materials WHERE id = :id";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $CIN = $row["CIN"];
                    $name = $row["name"];
                    $serie = $row["serie"];
                    $status = $row["status"];
                    $info = $row["infos"];
                    $pays = $row["pays"];
                    $category = $row["category"];
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
        unset($stmt);

        // Close connection
        unset($pdo);
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>CIN</label>
                            <input type="text" name="CIN" class="form-control <?php echo (!empty($CIN_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $CIN; ?>">
                            <span class="invalid-feedback"><?php echo $CIN_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Serie</label>
                            <textarea name="serie" class="form-control <?php echo (!empty($serie_err)) ? 'is-invalid' : ''; ?>"><?php echo $serie; ?></textarea>
                            <span class="invalid-feedback"><?php echo $serie_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $status; ?>">
                            <span class="invalid-feedback"><?php echo $status_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Infos</label>
                            <input type="text" name="info" class="form-control <?php echo (!empty($info_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $info; ?>">
                            <span class="invalid-feedback"><?php echo $info_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Pays</label>
                            <input type="text" name="pays" class="form-control <?php echo (!empty($pays_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pays; ?>">
                            <span class="invalid-feedback"><?php echo $pays_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $category; ?>">
                            <span class="invalid-feedback"><?php echo $category_err; ?></span>
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