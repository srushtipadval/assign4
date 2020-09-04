<?php 

header("Content-type: application/json");
require 'menu.php';

$req = $_GET['req'] ?? null;

if($req) {
  $file = file_get_contents("rest.json");
  $data = json_decode($jsonfile, true)['menu_items'];
  try {
    $ResMenu = new resMenu($data);
  } catch (Exception $th) {
      echo json_encode([$th->getMessage()]);
      return;
  }
}

switch($req) {
  case 'res_list': 
    echo $ResMenu->getResItems();
    break;
  
  case 'res_data': 
    $id = $_GET['id'] ?? null;
    echo $ResMenu->getResdata($id);
    break;

  default: 
    echo json_encode(["Invalid Resquest!"]);
    break;
}

?>
