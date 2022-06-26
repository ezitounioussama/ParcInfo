<?php
session_start();
require_once 'header.php';
?>
<?php
// Include config file
require_once "config.php";



// Define variables and initialize with empty values
$name = $CIN = $serie = $pays = $division = $info = $category = $status =  "";
$name_err = $CIN_err = $division_err =  $serie_err = $pays_err = $info_err = $category_err = $status_err = "";

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
    $input_division = trim($_POST["CIN"]);
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
    if (empty($name_err) && empty($CIN_err) && empty($serie_err) && empty($status_err) && empty($info_err) && empty($pays_err) && empty($category_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO materials (name, CIN , serie, status, infos, pays, division, category) VALUES (:name, :CIN, :serie, :status, :infos , :pays, :division , :category)";

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
            // Set parameters
            $param_name = $name;
            $param_CIN = $CIN;
            $param_serie = $serie;
            $param_status = $status;
            $param_infos = $info;
            $param_pays = $pays;
            $param_division = $division;
            $param_category = $category;

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
                <!-- <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    Bonjour,
                </h1> -->
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
                    <img class="object-cover w-10 h-10 rounded-full" src="https://t4.ftcdn.net/jpg/00/65/77/27/360_F_65772719_A1UV5kLi5nCEWI0BNLLiFaBPEkUbv5Fv.jpg" alt="Simon Lewis" />

                    <p class="hidden ml-2 text-xs text-left sm:block">
                        <strong class="block font-medium"><?php echo ($_SESSION['username']); ?></strong>

                        <span class="text-gray-500"><?php echo ($_SESSION['info']); ?></span>
                    </p>


                </button>
                <a href="../../index.php">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#78A5C3">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
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
                                Nom De Materiel
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
                                        <span> Nouveau </span>

                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <div class="relative">
                                    <input class="hidden group peer" type="radio" name="status" value="Used" id="next_day_alt" />

                                    <label class="block p-4 text-sm font-medium transition-colors border border-gray-100 rounded-lg shadow-sm cursor-pointer peer-checked:border-blue-500 hover:bg-gray-50 peer-checked:ring-1 peer-checked:ring-blue-500" for="next_day_alt">
                                        <span> Utilisé </span>


                                    </label>

                                    <svg class="absolute w-5 h-5 text-blue-600 opacity-0 top-4 right-4 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                        </div>



                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Informations De Materiel
                            </legend>

                            <div class="-space-y-px bg-white rounded-lg shadow-sm">
                                <textarea id="info" name="info" rows="3" class="border p-3 shadow-sm mt-1 block w-full sm:text-sm border-gray-100 rounded-md" placeholder="specifications.."></textarea>
                            </div>
                        </fieldset>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Section/Division
                            </legend>

                            <div class="-space-y-px bg-white rounded-md shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Section</label>

                                    <select class="mb-2 border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="pays" autocomplete="country-name">
                                        <option>TABRIQT INBIAAT</option>
                                        <option>ABDELKRIM ZINE</option>
                                        <option>BETTANA</option>
                                        <option>LAAYAYDA</option>
                                        <option>LAKBIR AHIZOUNE</option>
                                        <option>GHRABLIA</option>
                                        <option>MOHAMED REDOUANI</option>
                                        <option>SALA EL JADIDA</option>
                                        <option>BRAHOM ABALHATE</option>
                                        <option>SIDI ABDELLAH</option>
                                        <option>OMAR BEN EL GHAZI</option>
                                        <option>TABRIQT MAZRAA</option>
                                        <option>OMAR FADIL</option>
                                        <option>OULED MOUSSA</option>
                                        <option>MOUHSINE CHTIOUI</option>
                                        <option>LAMRISSA</option>
                                        <option>AHMED TRICHA</option>
                                        <option>PACHALIK BOUKNADEL</option>
                                        <option>DAEC</option>
                                        <option>CABINET</option>
                                        <option>CONSEIL PREFECTORAL</option>
                                        <option>DSICG</option>
                                        <option>DAUE</option>
                                        <option>DRHMG</option>
                                        <option>DAI</option>
                                        <option>DE</option>
                                        <option>DCL</option>
                                        <option>HISBA</option>
                                        <option>DAS</option>
                                        <option>DBM</option>
                                        <option>SG</option>
                                    </select>
                                </div>


                            </div>







                            <fieldset class="col-span-6">
                                <legend class="block mb-1 text-sm text-gray-600">
                                    Division
                                </legend>

                                <div class="-space-y-px bg-white rounded-md shadow-sm">
                                    <div>
                                        <label class="sr-only" for="div">Division</label>

                                        <select class="mb-2 border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="div" name="division" autocomplete="div">
                                            <option>DAEC</option>
                                            <option>CABINET</option>
                                            <option>CONSEIL PREFECTORAL</option>
                                            <option>DSICG</option>
                                            <option>DAUE</option>
                                            <option>DRHMG</option>
                                            <option>DAI</option>
                                            <option>DE</option>
                                            <option>DCL</option>
                                            <option>HISBA</option>
                                            <option>DAS</option>
                                            <option>DBM</option>
                                            <option>SG</option>


                                        </select>
                                    </div>


                                </div>






                            </fieldset>


                            <fieldset class="col-span-6">
                                <legend class="block mb-1 text-sm text-gray-600">
                                    Categorie
                                </legend>

                                <div class="-space-y-px bg-white rounded-md shadow-sm">
                                    <div>
                                        <label class="sr-only" for="country">Category</label>

                                        <select class="mb-3 border border-gray-200 relative rounded-t-lg w-full focus:z-10 text-sm p-2.5" id="country" name="category" autocomplete="country-name">
                                            <option>Ecran</option>
                                            <option>Clavier</option>
                                            <option>Souris</option>
                                            <option>Imprimante</option>
                                            <option>Unite Central</option>
                                            <option>Cables</option>
                                        </select>
                                    </div>


                                </div>
                            </fieldset>


                            <div class="col-span-6">
                                <button class="rounded-lg bg-black text-sm p-2.5 text-white w-full block" type="submit" name="submit">
                                    Inserer
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section>



    <div class="relative">

        <input type="search" name="search_text" id="search_text" class="block mb-5 p-3 pl-10 w-full text-sm text-black rounded-lg border border-gray-700 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>

    </div>

    <div class="overflow-x-auto">




        <div id="result"></div>







    </div>

</section>


<script>
    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>


<?php
require_once 'footer.php';
?>