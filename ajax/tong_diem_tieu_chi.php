<?

include("config.php");
$tong_one = $_POST['tong_one'];
$tong_two = $_POST['tong_two'];
$a = 0;
// if($tong_one != ""){
//     $tong_one = str_replace('_', ',', $tong_one);
//     $tong_one = rtrim($tong_one, ',');
//     $tong_one = explode(',', $tong_one);
//     $co = count($tong_one);
//     for($l = 0; $l < $co; $l++){
//         $a += $tong_one[$l];
//     }
//     echo $a;
//     // die();
// }
if($tong_two != ""){
    $tong_two = str_replace('_', ',', $tong_two);
    $tong_two = rtrim($tong_two, ',');
    $tong_two = explode(',', $tong_two);
    $co1 = count($tong_two);
    for($t = 0; $t < $co1; $t++){
        $a += $tong_two[$l];
    }
    echo $a;
    // die();
}

?>