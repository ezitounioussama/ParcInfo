<?php require_once 'header.php';
require_once 'nav.php';
?>
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $CIN = $pass = $function  =  "";
$name_err = $CIN_err =  $pass_err = $function_err = "";

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
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, CIN , pass, function) VALUES (:username, :CIN, :pass, :function)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_name);
            $stmt->bindParam(":CIN", $param_CIN);
            $stmt->bindParam(":pass", $param_pass);
            $stmt->bindParam(":function", $param_function);
            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_pass = $pass;
            $param_function = $function;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
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
}
?>


<div class="container mx-auto">
    <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
        <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700">Insert Users</h1>

        </div>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm text-gray-600">Username</label>
                    <input type="text" name="name" placeholder="John Doe" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm text-gray-600">CIN</label>
                    <input type="text" name="cin" placeholder="XX-----" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="mb-6">
                    <label for="phone" class="text-sm text-gray-600">Password</label>
                    <input type="password" name="pass" placeholder="*********" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="function" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>user</option>
                        <option>admin</option>

                    </select>
                </div>
                <div class="mt-10 col-span-6">
                    <button class="rounded-lg bg-black text-sm p-2.5 text-white w-full block" type="submit" name="submit">
                        Insert
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>







<div class="overflow-hidden overflow-x-auto border border-gray-100 rounded">
    <?php
    // Include config file
    require_once "config.php";

    // Attempt select query execution
    $sql = "SELECT * FROM users";
    if ($result = $pdo->query($sql)) {
        if ($result->rowCount() > 0) {
            echo '<table class=" min-w-full text-sm divide-y divide-gray-200">';
            echo '<thead>';
            echo '<tr class="bg-gray-50">';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">#</th>';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Username</th>';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">CIN</th>';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Password</th>';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Role</th>';
            echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap" colspan="2"></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="divide-y divide-gray-100">';
            while ($row = $result->fetch()) {
                echo '<tr>';
                echo '<td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">' . $row['UserId'] . '</td>';
                echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["username"] . '</td>';
                echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["CIN"] . '</td>';
                echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["pass"] . '</td>';
                echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["function"] . '</td>';
                echo '<td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                        <a href="update.php?id=' . $row['UserId'] . '" class="modal-open text-indigo-600 hover:text-indigo-900" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
    
                      </td>';
                echo  '<td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                  <a href="delete.php?id=' . $row['UserId'] . '"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg></a>
  
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            // Free result set
            unset($result);
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    // Close connection
    unset($pdo);
    ?>

</div>
<?php
require_once 'footer.php';
?>