<div class="bg_wra">
    <div class="bg_ima_menu">
        <p class="menu_popup btx_modal_ind">
            <img src="../img/menu.png" alt="">
        <p>
    </div>
    <div class="bg_ima">
        <a href="/">
            <img src="../img/logo.png" alt="">
        </a>
    </div>
    <div class="header_nav">
        <div class="nav">
            <ul>
                <li>
                    <a href="#" class="cr_weight_bold share_fsize_tow share_clr_tow active">Trang chủ</a>
                </li>
                <li>
                    <a href="#" class="cr_weight_bold share_fsize_tow share_clr_tow">Tin tức</a>
                </li>
                <li>
                    <a href="#" class="cr_weight_bold share_fsize_tow share_clr_tow">Hướng dẫn</a>
                </li>
            </ul>
            <div class="hd_log">
                <!-- <? if(isset($_COOKIE['acc_token']) && isset($_COOKIE['role']) && isset($_COOKIE['rf_token'])) {
                        if(isset($_COOKIE['user']) && $_COOKIE['user'] != "" && $_COOKIE['role'] == 1){
                            $token= $_COOKIE['acc_token'];
                            $curl = curl_init();
                            $data = array();
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                            curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/user_info_company.php');
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));

                            $response = curl_exec($curl);
                            curl_close($curl);
                            $data_tt = json_decode($response,true);
                            $tt_user = $data_tt['data']['user_info_result'];

                        ?>
                        <div class="bg_log_aff" data="<?= $tt_user['com_id'] ?>">
                            <div class="bg_log_img">
                                <? if(isset($tt_user['com_logo']) && $tt_user['com_logo'] != "") {?>
                                <img src="https://chamcong.24hpay.vn/upload/company/logo/<?= $tt_user['com_logo'] ?>" alt="">
                                <?} else{?>
                                    <img src="../img/add.png" alt="">
                                <?}?>
                            </div>
                            <div class="bg_logout">
                                <div class="chd_content">
                                    <p class="chuyen_doi">
                                        <a href="/quan-ly-ung-dung-cong-ty.html">Chuyển đổi số 365</a>
                                    </p>
                                    <p class="dang_xuat btx_logout">
                                        <a>Đăng xuất</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? }
                    if(isset($_COOKIE['user']) && $_COOKIE['user'] != "" && $_COOKIE['role'] == 2){
                        $token= $_COOKIE['acc_token'];
                        $curl = curl_init();
                        $data = array();
                        curl_setopt($curl, CURLOPT_POST, 1);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/user_info_employee.php');
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));

                        $response = curl_exec($curl);
                        curl_close($curl);
                        $data_tt = json_decode($response,true);
                        $tt_user = $data_tt['data']['user_info_result'];

                        ?>
                        <div class="bg_log_aff">
                            <div class="bg_log_img" data="<?= $tt_user['ep_id'] ?>">
                                <? if(isset($tt_user['ep_image']) && $tt_user['ep_image'] != "") {?>
                                <img src="https://chamcong.24hpay.vn/upload/employee/<?= $tt_user['ep_image'] ?>" alt="">
                                <?} else{?>
                                    <img src="../img/add.png" alt="">
                                <?}?>
                            </div>
                            <div class="bg_logout">
                                <div class="chd_content">
                                    <p class="chuyen_doi">
                                        <a href="/quan-ly-ung-dung-cong-ty.html">Chuyển đổi số 365</a>
                                    </p>
                                    <p class="dang_xuat btx_logout">
                                        <a>Đăng xuất</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                <? }
            }
            if (!isset($_COOKIE['acc_token']) && !isset($_COOKIE['role']) && !isset($_COOKIE['rf_token'])) {?> -->
                    <div class="bg_log">
                        <p><a href="lua-chon-dang-ky.html" class="cr_weight_bold share_fsize_tow share_clr_tow">Đăng ký</a>
                            /
                            <a href="lua-chon-dang-nhap.html" class="cr_weight_bold share_fsize_tow share_clr_tow">Đăng nhập</a>
                        </p>
                    </div>
                <!-- <? } ?> -->
            </div>
        </div>
    </div>
</div>