<?php
require_once 'header.php';
?>
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
<header class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center sm:justify-between sm:gap-4">
            <div class="relative hidden sm:block">
                <!-- <label class="sr-only" for="search"> Search </label>

                <input class="w-full h-10 pl-4 pr-10 text-sm bg-white border-none rounded-lg shadow-sm sm:w-56" id="search" type="search" placeholder="Search website..." />

                <button class="absolute p-2 text-gray-600 transition -translate-y-1/2 rounded-md hover:text-gray-700 bg-gray-50 top-1/2 right-1" type="button" aria-label="Submit Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button> -->
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    Bonjour ,
                </h1>
            </div>

            <div class="flex items-center justify-between flex-1 gap-8 sm:justify-end">
                <div class="flex gap-4">
                    <button type="button" class="block sm:hidden p-2.5 text-gray-600 bg-white rounded-lg hover:text-gray-700 shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>


                </div>

                <button type="button" class="flex items-center transition rounded-lg group shrink-0">
                    <img class="object-cover w-10 h-10 rounded-full" src="https://www.morbius.movie/images/gallery/img2.jpg" alt="Simon Lewis" />

                    <p class="hidden ml-2 text-xs text-left sm:block">
                        <strong class="block font-medium">Your Name</strong>

                        <span class="text-gray-500"> your informations</span>
                    </p>


                </button>
            </div>
        </div>


    </div>
</header>



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

                            <input name="CIN" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="frst_name" autofocus />
                        </div>
                        <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="name">
                                Material Name
                            </label>

                            <input name="name" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="frst_name" autofocus />
                        </div>

                        <div class="col-span-3">
                            <label class=" block mb-1 text-sm text-gray-600" for="last_name">
                                Serie
                            </label>

                            <input name="serie" class="border border-gray-100 rounded-lg shadow-sm  w-full text-sm p-2.5" type="text" id="last_name" />
                        </div>

                        <div class="col-span-6">

                            <div class="grid grid-cols-2 gap-8">
                                <div class="relative">
                                    <input class="hidden group peer" type="radio" name="status" value="New" id="standard_alt" />

                                    <label class="block p-4 text-sm font-medium transition-colors border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500" for="standard_alt">
                                        <span> New </span>

                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <div class="relative">
                                    <input class="hidden group peer" type="radio" name="status" value="Used" id="next_day_alt" />

                                    <label class="block p-4 text-sm font-medium transition-colors border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500" for="next_day_alt">
                                        <span> Used </span>


                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                        </div>



                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Informations
                            </legend>

                            <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                <textarea id="info" name="info" rows="3" class="border p-3 shadow-sm mt-1 block w-full sm:text-sm border-gray-100 rounded-md" placeholder="specifications.."></textarea>
                            </div>
                        </fieldset>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                From where ?
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Country</label>

                                    <select class="border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="pays" autocomplete="country-name">
                                        <option>Rabat</option>
                                        <option>Sale</option>
                                        <option>Kenitra</option>
                                        <option>Casablanca</option>
                                        <option>Marrakech</option>
                                        <option>Tanger</option>
                                    </select>
                                </div>


                            </div>
                        </fieldset>


                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Category
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Category</label>

                                    <select class="border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="category" autocomplete="country-name">
                                        <option>Screen</option>
                                        <option>Keyboard</option>
                                        <option>Mouse</option>
                                        <option>Printer</option>
                                        <option>Computer-system-inheit</option>
                                        <option>Cables</option>
                                    </select>
                                </div>


                            </div>
                        </fieldset>


                        <div class="col-span-6">
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

<section>





    <div class="overflow-x-auto">

        <?php
        // Include config file
        require_once "config.php";

        // Attempt select query execution
        $sql = "SELECT * FROM materials";
        if ($result = $pdo->query($sql)) {
            if ($result->rowCount() > 0) {



                echo '<table class="min-w-full text-sm border border-gray-100 divide-y-2 divide-gray-200">';
                echo "<thead>";
                echo '<tr class="divide-x divide-gray-100">';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">#</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">CIN</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Material Name</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Serie</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Status</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Informations</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">From where</th>';
                echo '<th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Category</th>';
                echo "</tr>";
                echo "</thead>";
                echo '<tbody class="divide-y divide-gray-200">';

                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo '<td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap>' . $row['id'] . '</td>';
                    echo '<td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap>' . $row['id'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['CIN'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['CIN'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['name'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['name'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['serie'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['serie'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['status'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['status'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['infos'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['infos'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['pays'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['pays'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['category'] . '</td>';
                    echo '<td class="px-4 py-2 text-gray-700 whitespace-nowrap>' . $row['category'] . '</td>';
                    echo '<td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                    <a href="inc/update.php?id=' . $row['id'] . '" class="modal-open text-indigo-600 hover:text-indigo-900" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
    
                  </td>';

                    echo '<td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                    <a href="inc/delete.php?id=' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg></a>
    
                  </td>';
                    // echo "<td>";
                    // echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    // echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    // echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    // echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
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

</section>





<?php
require_once 'footer.php';
?>