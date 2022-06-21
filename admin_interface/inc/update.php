<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $CIN = $pass = $function  =  "";
$name_err = $CIN_err =  $pass_err = $function_err = "";

// Processing form data when form is submitted
if (isset($_POST["UserId"]) && !empty($_POST["UserId"])) {
    // Get hidden input value
    $id = $_POST["UserId"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    // Validate Serie
    $input_CIN = trim($_POST["cin"]);
    if (empty($input_CIN)) {
        $CIN_err = "Please enter your CIN";
    } else {
        $CIN = $input_CIN;
    }


    // Validate Serie
    $input_pass = trim($_POST["pass"]);
    if (empty($input_pass)) {
        $pass_err = "Please enter a password";
    } else {
        $pass = $input_pass;
    }

    // Validate status
    $input_function = trim($_POST["function"]);
    if (empty($input_function)) {
        $function_err = "Please enter a function";
    } else {
        $function = $input_function;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($CIN_err) && empty($pass_err) && empty($function_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET username=:username, CIN=:CIN, pass=:pass, function=:function WHERE UserId=:UserId";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_name);
            $stmt->bindParam(":CIN", $param_CIN);
            $stmt->bindParam(":pass", $param_pass);
            $stmt->bindParam(":function", $param_function);
            $stmt->bindParam(":UserId", $param_id);

            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_pass = $pass;
            $param_function = $function;
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
    if (isset($_GET["UserId"]) && !empty(trim($_GET["UserId"]))) {
        // Get URL parameter
        $id =  trim($_GET["UserId"]);

        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE UserId = :UserId";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":UserId", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $name = $row["username"];
                    $CIN = $row["CIN"];
                    $pass = $row["pass"];
                    $function = $row["function"];
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




    <div class="container mx-auto">
        <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700">Mise a jour des informations</h1>

            </div>
            <div>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm text-gray-600">Nom d'utilisateur</label>
                        <input type="text" name="name" placeholder="John Doe" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" value="<?php echo $name; ?>" />
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm text-gray-600">CIN</label>
                        <input type="text" name="cin" placeholder="XX-----" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" value="<?php echo $CIN; ?>" />
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="text-sm text-gray-600">Mot de passe</label>
                        <input type="password" name="pass" placeholder="*********" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" value="<?php echo $pass; ?>" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="function" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo $function; ?>">
                            <option>user</option>
                            <option>admin</option>

                        </select>
                    </div>
                    <div class="mt-10 col-span-6">
                        <input type="hidden" name="UserId" value="<?php echo $id; ?>" />
                        <button class="rounded-lg bg-[blue] text-sm p-2.5 text-white w-full block" type="submit" name="submit">
                            Iserer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</section>












<?php
require_once 'footer.php';
?>