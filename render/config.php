<?

if(!isset($_SESSION))
{
    session_start();
}

require_once("../classes/database.php");
require_once("../functions/functions.php");
require_once '../functions/pagebreak.php' ;
$oninput = "this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');";

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>