<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $CIN = $serie = $pays = $info = $division = $category = $status =  "";
$name_err = $CIN_err =  $serie_err = $division_err = $pays_err = $info_err = $category_err = $status_err = "";

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
    $input_division = trim($_POST["division"]);
    if (empty($input_division)) {
        $division_err = "Please enter your CIN";
    } else {
        $division = $input_division;
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
    if (empty($name_err) && empty($CIN_err) && empty($serie_err) && empty($status_err) && empty($info_err) && empty($pays_err) && empty($division_err) && empty($category_err)) {
        // Prepare an update statement
        $sql = "UPDATE materials SET CIN=:CIN, name=:name, serie=:serie, status=:status, infos=:infos , pays=:pays ,division =:division, category=:category WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":CIN", $param_CIN);
            $stmt->bindParam(":serie", $param_serie);
            $stmt->bindParam(":status", $param_status);
            $stmt->bindParam(":infos", $param_infos);
            $stmt->bindParam(":pays", $param_pays);
            $stmt->bindParam(":division", $param_division);
            $stmt->bindParam(":category", $param_category);
            $stmt->bindParam(":id", $param_id);

            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_serie = $serie;
            $param_status = $status;
            $param_infos = $info;
            $param_pays = $pays;
            $param_division = $division;
            $param_category = $category;

            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: home.php");
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
                    $division = $row["division"];
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

<?php
require_once 'header.php';
?>





<section>


    <div class="relative mx-auto max-w-screen-2xl">
        <div>


            <div class="py-12 bg-white md:py-24">
                <div class="max-w-lg px-4 mx-auto lg:px-8">

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST" class="grid grid-cols-6 gap-4">
                        <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="name">
                                CIN
                            </label>

                            <input name="CIN" class="rounded-lg shadow-sm cursor-no-drop w-full text-sm p-2.5" type="text" id="frst_name" value="<?php echo $CIN; ?>" readonly />
                        </div>
                        <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="name">
                                Material Name
                            </label>

                            <input name="name" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="frst_name" value="<?php echo $name; ?>" />
                        </div>

                        <div class="col-span-3">
                            <label class=" block mb-1 text-sm text-gray-600" for="last_name">
                                Serie
                            </label>

                            <input name="serie" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" value="<?php echo $serie; ?>" />
                        </div>

                        <div class="col-span-3">
                            <label class=" block mb-1 text-sm text-gray-600" for="last_name">
                                Status
                            </label>

                            <input name="status" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" value="<?php echo $status; ?>" />
                        </div>


                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Informations
                            </legend>

                            <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                <input type="text" id="info" name="info" class="border p-3 shadow-sm mt-1 block w-full sm:text-sm border-gray-100 rounded-md" value="<?php echo $info; ?>" placeholder="specifications.." />
                            </div>
                        </fieldset>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Section
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <input name="pays" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" value="<?php echo $pays; ?>" />



                            </div>
                        </fieldset>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Division
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <input name="division" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="division" value="<?php echo $division; ?>" />



                            </div>
                        </fieldset>


                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Category
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <input name="category" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" value="<?php echo $category; ?>" />



                            </div>
                        </fieldset>


                        <div class="col-span-6">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button class="rounded-lg bg-black text-sm p-2.5 text-white w-full block" type="submit" name="submit">
                                Insert
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>












<?php
require_once 'footer.php';
?>