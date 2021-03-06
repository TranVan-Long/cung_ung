<?
if(isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1){
    $com_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $ce_name = $_SESSION['com_name'];
    $image = $_SESSION['com_logo'];
    if($image != ""){
        $avt_img = 'https://chamcong.24hpay.vn/upload/company/logo/'.$image;
    }else{
        $avt_img='../img/logo_com.png';
    }
}else if(isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2){
    $ce_id = $_SESSION['ep_id'];
    $ce_name = $_SESSION['ep_name'];
    $com_id = $_SESSION['user_com_id'];
    $com_name = $_SESSION['com_name'];
    $image = $_SESSION['ep_image'];
    if($image != ""){
        $avt_img = 'https://chamcong.24hpay.vn/upload/employee/'.$image;
    }else{
        $avt_img='../img/logo_com.png';
    }
}

?>
<div class="header">
    <div class="header-left d_flex fl_agi">
        <div class="side_menu_hd mr_30 d_flex fl_agi">
            <img src="../img/menu.png" alt="menu" class="avt_menu">
        </div>
        <div class="ctiet_cty">
            <span class="ten_cty_nv"><?= $com_name ?></span>
            <span class="thanh_chan">|</span>
            <span class="text-bold">ID: <?= $com_id ?></span>
        </div>
    </div>
    <div class="right text-right">
        <ul class="right chi_tiet_item mr-20">
            <li class="nav-item">
                <a href="#"><?php echo $ic_messenger ?><span class="badge"></span></a>
            </li>
            <li class="nav-item">
                <a class="nnho_blk"><?php echo $ic_info ?><span class="badge"></span></a>
                <div class="tc_thongb nhac_nho share_bgr_tow">
                    <div class="ctn_tc_tbao">
                        <div class="nd_tc_thongb">
                            <div class="scroll_tbao">
                                <div class="detl_tb_nn">
                                    <div class="content_tb">
                                        <div class="avt_tb_nn">
                                            <img src="../img/logo_com.png" alt="ảnh đại diện">
                                        </div>
                                        <div class="titl_tb_nn">
                                            <a href="#">
                                                <p class="cr_weight share_clr_one">Nhắc nhở</p>
                                                <p class="share_clr_one">Nhiều đơn hàng sắp quá hạn!</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="time_tb_nb tex_right">8:00, 20/05/2021</p>
                                </div>
                                <div class="detl_tb_nn">
                                    <div class="content_tb">
                                        <div class="avt_tb_nn">
                                            <img src="../img/logo_com.png" alt="ảnh đại diện">
                                        </div>
                                        <div class="titl_tb_nn">
                                            <a href="#">
                                                <p class="cr_weight share_clr_one">Nhắc nhở</p>
                                                <p class="share_clr_one">Nhiều đơn hàng sắp quá hạn!</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="time_tb_nb tex_right">8:00, 20/05/2021</p>
                                </div>
                            </div>
                        </div>
                        <div class="remove_tc_tbao">
                            <p class="share_cursor">Xóa tất cả</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="tbao_blk"><?php echo $ic_bell ?><span class="badge"></span></a>
                <div class="tc_thongb thong_bao share_bgr_tow">
                    <div class="ctn_tc_tbao">
                        <div class="nd_tc_thongb">
                            <div class="scroll_tbao">
                                <div class="detl_tb_nn">
                                    <div class="content_tb">
                                        <div class="avt_tb_nn">
                                            <img src="../img/logo_com.png" alt="ảnh đại diện">
                                        </div>
                                        <div class="titl_tb_nn">
                                            <a href="#">
                                                <p class="cr_weight share_clr_one">Thông báo</p>
                                                <p class="share_clr_one">Nhiều đơn hàng sắp quá hạn!</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="time_tb_nb tex_right">8:00, 20/05/2021</p>
                                </div>
                                <div class="detl_tb_nn">
                                    <div class="content_tb">
                                        <div class="avt_tb_nn">
                                            <img src="../img/logo_com.png" alt="ảnh đại diện">
                                        </div>
                                        <div class="titl_tb_nn">
                                            <a href="#">
                                                <p class="cr_weight share_clr_one">Thông báo</p>
                                                <p class="share_clr_one">Nhiều đơn hàng sắp quá hạn!</p>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="time_tb_nb tex_right">8:00, 20/05/2021</p>
                                </div>
                            </div>
                        </div>
                        <div class="remove_tc_tbao">
                            <p class="share_cursor">Xóa tất cả</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <div class="nav-avatar">
                    <p>
                        <img class="head-avatar" src="<?= $avt_img ?>">
                        <span class="mobi_showd"></span>
                    </p>
                </div>
                <div class="left mt-10">
                    <h5 class="user-name"><?= $ce_name ?></h5>
                </div>
                <ul class="dropdown-content">
                    <a href="https://quanlychung.timviec365.vn/quan-ly-thong-tin-tai-khoan-nhan-vien.html"
                        target="_blank">
                        <li><i class="ic ic-user"></i> Thông tin tài khoản</li>
                    </a>
                    <a href="#" target="_blank">
                        <li><i class="ic ic-pen"></i>Đánh giá</li>
                    </a>
                    <a href="#" target="_blank">
                        <li><i class="ic ic-warning"></i>Báo lỗi</li>
                    </a>
                    <li class="dang_xuat"><i class="ic ic-logout"></i>Đăng xuất</li>
                </ul>
            </li>
        </ul>
    </div>
</div>