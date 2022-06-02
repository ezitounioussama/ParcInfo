<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>

<body>
  <?php
  try {
    $log = $_GET['name'];
    $passe = $_GET['pass'];
    $fun = $_GET['function'];
    include '../db/db.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO login (cin, pass, function)
    VALUES ('$log', '$passe', '$fun')";
    $conn->exec($sql);
    echo '
    <body class="bg-[url(Shape2.svg)] bg-no-repeat bg-cover m-7">
    <div class="w-full md:w-1/3 mx-auto ">
      <div class="flex flex-col p-5 rounded-lg shadow bg-white">
        <div class="flex">
          <div>
            <svg class="w-6 h-6 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
          </div>
    
          <div class="ml-3">
            <h2 class="font-semibold text-gray-800">New ' . $fun . ' ?</h2>
            <p class="mt-2 text-sm text-gray-600 leading-relaxed">Your registration has been accepted just go back and login</p>
          </div>
        </div>
    
        <div class="flex justify-end items-center mt-3">
          
    
          <button  class="px-4 py-2 ml-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md">
            <a href="index.php">Back</a>  
          </button>
        </div>
      </div>
    </div>
    </body>
    ';
  } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
  ?>
</body>

</html>