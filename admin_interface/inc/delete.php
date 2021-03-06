<?php
require_once 'header.php';


// Process delete operation after confirmation
if (isset($_POST["UserId"]) && !empty($_POST["UserId"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM users WHERE UserId = :UserId";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":UserId", $param_id);

        // Set parameters
        $param_id = trim($_POST["UserId"]);

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
    if (empty(trim($_GET["UserId"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../../error.php");
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
            <input type="hidden" name="UserId" value="<?php echo trim($_GET["UserId"]); ?>" />
            <p class="mt-2 text-3xl font-bold sm:text-5xl">
                Voulez-vous vraiment supprimer <br>cet utilisateur?
            </p>

            <div class="mt-8 sm:items-center sm:justify-center sm:flex">

                <input type="submit" value="Oui" class="block px-5 py-3 font-medium text-white bg-red-500 rounded-lg shadow-xl hover:bg-red-600">

                <a href="home.php" class="block px-5 py-3 mt-4 font-medium text-blue-500 rounded-lg hover:text-blue-600 sm:mt-0">
                    Non
                </a>

            </div>
        </div>
    </form>
</aside>




<?php
require_once 'footer.php';
?>