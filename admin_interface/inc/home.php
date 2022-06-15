<?php require_once 'header.php';
require_once 'nav.php';
?>



<div class="container mx-auto">
    <div class="max-w-xl p-5 mx-auto my-10 bg-white rounded-md shadow-sm">
        <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700">Contact Us</h1>
            <p class="text-gray-400">Fill up the form below to send us a message.</p>
        </div>
        <div>
            <form action="" method="POST">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm text-gray-600">Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm text-gray-600">Email Address</label>
                    <input type="email" name="email" placeholder="you@email.com" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="mb-6">
                    <label for="phone" class="text-sm text-gray-600">Phone Number</label>
                    <input type="text" name="phone" placeholder="91 1234-567" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" />
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm text-gray-600">Your Message</label>

                    <textarea rows="5" name="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" required></textarea>
                </div>
                <div class="mb-6">
                    <button type="submit" class="w-full px-2 py-4 text-white bg-indigo-500 rounded-md  focus:bg-indigo-600 focus:outline-none">
                        Send Message
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