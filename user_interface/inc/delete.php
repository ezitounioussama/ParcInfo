<?php
require_once 'header.php';


// Process delete operation after confirmation
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM materials WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: home.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>


<aside class="p-12 bg-gray-100 sm:p-16 lg:p-24">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="max-w-xl mx-auto text-center">
            <p class="text-sm font-medium text-gray-500">
                Delete Record
            </p>
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
            <p class="mt-2 text-3xl font-bold sm:text-5xl">
                Are you sure you want to delete this employee record?
            </p>

            <div class="mt-8 sm:items-center sm:justify-center sm:flex">

                <input type="submit" value="Yes" class="block px-5 py-3 font-medium text-white bg-red-500 rounded-lg shadow-xl hover:bg-red-600">

                <a href="home.php" class="block px-5 py-3 mt-4 font-medium text-blue-500 rounded-lg hover:text-blue-600 sm:mt-0">
                    No
                </a>

            </div>
        </div>
    </form>
</aside>




<?php
require_once 'footer.php';
?>