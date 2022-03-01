<?
    function result_data($data, $error = null, $totalItems){
        # Định dạng lại dữ liệu chung để trả về cho api
        // if ($error == null){
        //     $error = set_error();
        // }
        $data_is_list = is_array($data);
        if ($data_is_list){
            $items = array();
            $items["totalItems"] = $totalItems;
            $items["items"] = $data;
            $data = $items;
        }
        $result = array();
        $result["data"] = $data;
        $result["error"] = $error;
        return json_encode($result);
    }

    function set_error($code = null, $message = null){
        # Định dạng lại dữ liệu chung để trả về cho api
        $error = array();
        if ($code == null && $message == null){
            $code = 200;
            $message = "Message from Chamcong365";
        }
        $error["code"] = $code;
        $error["message"] = $message;
        return $error;
    }

    function is_assoc($array){
        if ($array == null) return false;
        return array_values($array)!==$array;
    }

    function encodeBase36($str)
    {
        # code...
        return base_convert("$str", 10, 36);
    }

    function encodePathToBase36($path)
    {
        # hàm này để chuyển path của id kế thừa sang dạng base36, mỗi segment có 4 kí tự nếu thiếu thì sẽ thành 0, vd: 101->002t.
        # 102/123 -> 002t003f
        $encode_path = "";
        $arr_id = array_filter(explode("/", $path));
        foreach ($arr_id as $value) {
            $base36_id = base_convert("$value", 10, 36);
            $len = (4 - strlen($base36_id));
            if (strlen($base36_id) < 4){
                for ($x = 0; $x < $len; $x++) {
                    $base36_id = "0".$base36_id;
                }
            }
            $encode_path .= $base36_id;
        }
        return $encode_path;
    }

    function decodePathBase36($base36)
    {
        # hàm này để giải mã base36 thành path của id, mỗi segment có 4 kí tự nếu thiếu thì sẽ thành 0.
        # 102/123 -> 002t003f
        $decode_path = "";
        $len = strlen($base36);
        for ($x = 0; $x < $len; $x+=4) {
            $id_encode = str_replace("0", "", substr($base36,$x,4));
            $id_decode = base_convert("$id_encode", 36, 10);
            $decode_path .= "/".$id_decode;
        }
        return $decode_path;
    }

    function cc365_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'cc365';
        $secret_iv = 'cc365_iv';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }
?>