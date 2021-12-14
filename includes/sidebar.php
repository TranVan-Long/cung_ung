<?

$hop_dong = ['/quan-ly-hop-dong.html','/chi-tiet-hop-dong.html','/quan-ly-chi-tiet-hop-dong-mua.html','/them-hop-dong-mua.html','/chinh-sua-hop-dong-mua.html',
            '/quan-ly-chi-tiet-hop-dong-ban.html','/them-hop-dong-ban.html','/chinh-sua-hop-dong-ban.html','/quan-ly-chi-tiet-hop-dong-thue-thiet-bi.html',
            '/them-hop-dong-thue-thiet-bi.html','/chinh-sua-hop-dong-thue-thiet-bi.html','/quan-ly-chi-tiet-hop-dong-van-chuyen','/them-hop-dong-van-chuyen.html',
            '/chinh-sua-hop-dong-van-chuyen.html','/quan-ly-don-hang.html','/chi-tiet-don-hang-ban.html','/them-don-hang-ban.html','/chinh-sua-don-hang-ban.html',
            '/chi-tiet-don-hang-mua.html','/them-don-hang-mua.html','/chinh-sua-don-hang-mua.html','/quan-ly-ho-so-thanh-toan.html','/them-ho-so-thanh-toan.html',
            '/chinh-sua-ho-so-thanh-toan.html','/quan-ly-phieu-thanh-toan.html','/them-phieu-thanh-toan.html','/chinh-sua-phieu-thanh-toan.html',
            '/quan-ly-phieu-thanh-toan.html','/them-phieu-thanh-toan.html','/chinh-sua-phieu-thanh-toan.html'];

?>
<div class="side-bar">
    <div class="logo-container">
        <a href="#"><img alt="tim viec 365" class="logo" src="/img/logo_o.png"></a>
    </div>
    <ul class="menu">
        <li class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-trang-chu.html') ? "active":"" ?>">
            <a href="quan-ly-trang-chu.html">
            <span><?php echo $ic_home ?></span> Trang chủ
            </a>
        </li>
        <li class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-yeu-cau-vat-tu.html') ? "active" : "" ?>">
            <a href="quan-ly-yeu-cau-vat-tu.html">
            <span><?php echo $ic_wall; ?></span> Yêu cầu vật tư
            </a>
        </li>
        <li class="collapse <?= (in_array($_SERVER['REDIRECT_URL'], $hop_dong)) ? "active":"" ?>" data-tab="sub-menu1" >
            <a>
                <span><?php echo $ic_hop_dong ?></span>
                Hợp đồng
            </a>
            <ul id="sub-menu1" class="<?= (in_array($_SERVER['REDIRECT_URL'], $hop_dong)) ? "active":"" ?>">
                <li>
                    <a href="quan-ly-hop-dong.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-hop-dong.html') ? "active" : "" ?>"><span><?php echo $ic_circle ?></span> Hợp đồng</a>
                </li>
                <li>
                    <a href="quan-ly-don-hang.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-don-hang.html') ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Đơn hàng</a>
                </li>
                <li>
                    <a href="quan-ly-ho-so-thanh-toan.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-ho-so-thanh-toan.html') ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Hồ sơ thanh toán</a>
                </li>
                <li>
                    <a href="quan-ly-phieu-thanh-toan.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-phieu-thanh-toan.html') ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Phiếu thanh toán</a>
                </li>
            </ul>
        </li>
        <li class="collapse" data-tab="sub-menu2">
            <a><span><?php echo $ic_bang_gia ?></span>Bảng giá</a>
            <ul id="sub-menu2">
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Bảng giá</a>
                </li>
                <li>
                    <a href="#"><span><?php echo $ic_circle ?> </span>Yêu cầu báo giá
                    </a>
                </li>
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Báo giá
                    </a>
                </li>
            </ul>
        </li>
        <li class="collapse" data-tab="sub-menu3">
            <a><span><?php echo $ic_producer ?></span>Nhà cung cấp</a>
            <ul id="sub-menu3">
                <li>
                    <a href="../home/ncc-index.php"><span><?php echo $ic_circle ?></span>Nhà cung cấp</a>
                </li>
                <li>
                    <a href="../home/ncc-rating-index.php"><span><?php echo $ic_circle ?></span>Đánh giá nhà cung cấp</a>
                </li>
                <li>
                    <a href="../home/ratting-rules-index.php"><span><?php echo $ic_circle ?></span>Tiêu chí đánh giá</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="../home/kh-index.php"><span><?php echo $ic_customer ?></span>Khách hàng</a>
        </li>
        <li class="collapse" data-tab="sub-menu4">
            <a><span><?php echo $ic_report ?></span>Báo cáo</a>
            <ul id="sub-menu4">
                <li>
                    <a href="../home/bc-doanh-so.php"><span><?php echo $ic_circle ?></span>Doanh số bán hàng</a>
                </li>
                <li>
                    <a href="../home/bc-cong-no-thu.php"><span><?php echo $ic_circle ?></span>Công nợ phải thu</a>
                </li>
                <li>
                    <a href="../home/bc-cong-no-tra.php"><span><?php echo $ic_circle ?></span>Công nợ phải trả</a>
                </li>
            </ul>
        </li>
        <li><a>
            <span>
                <?php echo $ic_setting ?>
            </span>
                Cài đặt chung</a></li>
        <li class="collapse" data-tab="sub-menu5">
            <a><span><?php echo $ic_cds ?></span>Chuyển đổi số 365</a>
            <ul id="sub-menu5">
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Chấm công</a>
                </li>
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Tính lương</a>
                </li>
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Văn thư lưu trữ</a>
                </li>
                <li>
                    <a href="#"><span><?php echo $ic_circle ?></span>Quản trị nhân sự</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
