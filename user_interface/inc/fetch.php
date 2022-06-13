<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "parcinfo");
$output = '';
if (isset($_POST["query"])) {
  $search = mysqli_real_escape_string($connect, $_POST["query"]);
  $query = "
  SELECT * FROM materials 
  WHERE name LIKE '%" . $search . "%'
  OR serie LIKE '%" . $search . "%'
 ";
} else {
  $query = "
  SELECT * FROM materials ORDER BY name
 ";
}
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
  $output .= '
    <table class="min-w-full text-sm border border-gray-100 divide-y-2 divide-gray-200">
    <thead>
    <tr class="divide-x divide-gray-100">
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">#</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">CIN</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Material Name</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Serie</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Status</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Informations</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Section</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Division</th>
    <th class="px-4 py-2 font-medium text-left text-gray-900 whitespace-nowrap">Category</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">';

  while ($row = mysqli_fetch_array($result)) {
    $output .= '
   <tr>
   <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["id"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["CIN"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["name"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["serie"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["status"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["infos"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["pays"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["division"] . '</td>
    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">' . $row["category"] . '</td>
    <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                    <a href="update.php?id=' . $row['id'] . '" class="modal-open text-indigo-600 hover:text-indigo-900" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
    
    </td> 
    <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                  <a href="delete.php?id=' . $row['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg></a>
  
   </td>
   </tr>
  ';
  }
  echo $output;
} else {
  echo 'Data Not Found';
}
