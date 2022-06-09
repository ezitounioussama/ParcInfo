<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $CIN = $serie = $pays = $info = $category = $status =  "";
$name_err = $CIN_err =  $serie_err = $pays_err = $info_err = $category_err = $status_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        // Prepare an insert statement
        $sql = "INSERT INTO materials (name, CIN , serie, status, infos, pays, category) VALUES (:name, :CIN, :serie, :status, :infos , :pays, :category)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":CIN", $param_CIN);
            $stmt->bindParam(":serie", $param_serie);
            $stmt->bindParam(":status", $param_status);
            $stmt->bindParam(":infos", $param_infos);
            $stmt->bindParam(":pays", $param_pays);
            $stmt->bindParam(":category", $param_category);
            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_serie = $serie;
            $param_status = $status;
            $param_infos = $info;
            $param_pays = $pays;
            $param_category = $category;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add materials record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>