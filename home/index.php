<?
include("config_2.php");
// $list_ch = new db_query("SELECT * FROM cau_hoi WHERE active = 1 LIMIT 10");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    header('Location: /quan-ly-trang-chu.html');
    exit;
}


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phần mềm Quản lý cung ứng xây dựng miễn phí, tốt nhất</title>

    <meta name="description" content="Phần mềm quản lý cung ứng xây dựng miễn phí tốt nhất. Phần mềm quản lý theo dõi tiến độ công trình xây dựng. Tham khảo ngay">
    <meta name="keywords" content="Phần mềm quản lý cung ứng xây dựng">

    <meta property="og:title" content="Phần mềm Quản lý cung ứng xây dựng miễn phí, tốt nhất">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:description" content="Phần mềm quản lý cung ứng xây dựng miễn phí tốt nhất. Phần mềm quản lý theo dõi tiến độ công trình xây dựng. Tham khảo ngay">
    <meta property="og:image" content="https://phanmemquanlycungung.timviec365.vn/img/bgr_banner.png">

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Phần mềm quản lý cung ứng xây dựng miễn phí tốt nhất. Phần mềm quản lý theo dõi tiến độ công trình xây dựng. Tham khảo ngay">
    <meta name="twitter:title" content="Phần mềm Quản lý cung ứng xây dựng miễn phí, tốt nhất">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="canonical" href="https://phanmemquanlycungung.timviec365.vn/" />


    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/slick-theme.css">
    <link rel="stylesheet" href="../css/slick.css">

    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css?ver=<?= $ver ?>">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div id="trangchu-all" class="trang_chu">
        <div class="wrapper">
            <div class="header_ql">
                <div class="cnt_header">
                    <? include("../includes/inc_header.php") ?>
                    <div class="butt_header">
                        <div class="ctn_butth">
                            <div class="bgr_header">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="../img/bgr_banner_rthree.png">
                                    <source media="(max-width: 768px)" srcset="../img/bgr_banner_rtwo.png">
                                    <source media="(max-width: 1024px)" srcset="../img/bgr_banner_res.png">
                                    <source media="(max-width: 1366px)" srcset="../img/bgr_banner_rone.png">
                                    <img src="../img/bgr_banner.png" alt="Phần mềm quản lý cung ứng xây dựng">
                                </picture>
                            </div>
                            <div class="bgr_froh">
                                <div class="fonh_one">
                                    <h1 class="share_clr_tow cr_weight_bold">PHẦN MỀM QUẢN LÝ CUNG ỨNG XÂY DỰNG</h1>
                                    <span class="gduoi_td share_bgr_tow"></span>
                                    <p class="share_clr_tow">Giải pháp quản lý xây dựng hàng đầu được tin dùng bởi hàng
                                        nghìn doanh nghiệp lớn nhỏ!</p>
                                </div>
                                <div class="fonh_tow">
                                    <a href="https://quanlychung.timviec365.vn/lua-chon-dang-ky.html" rel="nofollow" class="share_bgr_three share_clr_tow tex_center cr_weight">
                                        Đăng ký sử dụng ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_ql">
                <div class="ctn_cu_one">
                    <div class="content_ct_one doanh_ngb">
                        <div class="ctn_ct_one">
                            <div class="container">
                                <h2 class="tieu_de share_clr_one w_100 tex_center mt_65">Doanh nghiệp bạn có đang gặp
                                    phải... ???</h2>
                                <div class="nd_chitiet d_flex fl_wrap">
                                    <div class="nd_one">
                                        <div class="nd_ctiet_nho d_flex">
                                            <img src="../img/icon_tat.png" alt="vấn đề gặp phải">
                                            <p class="nd_nho share_fsize_four share_clr_one tex_left">Vấn đề vật tư tại
                                                công trường
                                                chưa được quản lý chặt chẽ có thể gây nguy cơ
                                                thất thoát vật tư, thi công vượt định mức
                                            </p>
                                        </div>
                                        <div class="nd_ctiet_nho d_flex">
                                            <img src="../img/icon_tat.png" alt="vấn đề gặp phải">
                                            <p class="nd_nho share_fsize_four share_clr_one tex_left">Phiếu đề nghị
                                                xuất/nhập vật tư, đề nghị thanh toán mất nhiều thời gian
                                                để phê duyệt do xác minh thông tin
                                            </p>
                                        </div>
                                        <div class="nd_ctiet_nho share_dnone">
                                            <div class="d_flex">
                                                <img src="../img/icon_tat.png" alt="vấn đề gặp phải">
                                                <p class="nd_nho share_fsize_four share_clr_one tex_left">
                                                    Tình hình nghiệm thu, thanh toán cho thầu phụ, nhà cung cấp, chủ đầu
                                                    tư không được sát sao cũng dẫn tới mất uy tín doanh nghiệp
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nd_two">
                                        <div class="nd_avt tex_center">
                                            <picture>
                                                <source media="(max-width: 1024px)" srcset="../img/nguoi_res.png">
                                                <img src="../img/nguoi.png" alt="công nhân">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="nd_three">
                                        <div class="nd_ctiet_nho d_flex">
                                            <img src="../img/icon_tat.png" alt="vấn đề gặp phải">
                                            <p class="nd_nho share_fsize_four share_clr_one tex_left">
                                                Tình hình nghiệm thu, thanh toán cho thầu phụ, nhà cung cấp, chủ đầu tư
                                                không được sát sao cũng dẫn tới mất uy tín doanh nghiệp
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_ct_two w_100">
                        <div class="container">
                            <h2 class="tieu_de share_clr_one w_100 tex_center">Các tính năng chính của Phần mềm quản lý cung ứng
                            </h2>
                            <div class="tatca_tinhn w_100">
                                <div class="ctn_tatca w_100 d_flex fl_nwrap">
                                    <div class="tinhn_one">
                                        <div class="ctn_ctiet_tnang">
                                            <div class="avt_tnang">
                                                <img src="../img/tinhnang4.png" alt="Quản lý cung ứng, xuất nhập vật tư">
                                            </div>
                                            <p class="share_fsize_tow share_clr_one">Quản lý cung ứng, xuất nhập vật tư
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tinhn_one tinhn_one_o">
                                        <div class="ctn_ctiet_tnang">
                                            <div class="avt_tnang">
                                                <img src="../img/tinhnang3.png" alt="Quản lý hợp đồng, thanh quyết toán">
                                            </div>
                                            <p class="share_fsize_tow share_clr_one">Quản lý hợp đồng, thanh quyết toán
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tinhn_one tinhn_one_t">
                                        <div class="ctn_ctiet_tnang">
                                            <div class="avt_tnang">
                                                <img src="../img/tinhnang2.png" alt="Quản lý nhà cung cấp, thầu phụ">
                                            </div>
                                            <p class="share_fsize_tow share_clr_one">Quản lý nhà cung cấp, thầu phụ</p>
                                        </div>
                                    </div>
                                    <div class="tinhn_one">
                                        <div class="ctn_ctiet_tnang">
                                            <div class="avt_tnang">
                                                <img src="../img/tinhnang1.png" alt="Báo cáo theo dõi vật tư">
                                            </div>
                                            <p class="share_fsize_tow share_clr_one">Báo cáo theo dõi vật tư</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_ct_three w_100">
                        <div class="container">
                            <h2 class="tieu_de share_clr_one w_100 tex_center">Những lợi ích khi sử dụng</h2>
                            <div class="ctn_loii w_100">
                                <div class="loii_tatca w_100 float_l">
                                    <div class="loii_one w_100 float_l">
                                        <div class="ctn_loii_ctiet w_100 float_l">
                                            <div class="avt_loii_dd float_l">
                                                <img src="../img/loiich1.png" alt="Kiểm soát chặt chẽ cung ứng & sử dụng vật tư">
                                            </div>
                                            <div class="ttin_loii ttin_loii_o float_r">
                                                <h4 class="tde_ttin w_100 float_l share_fsize_four share_clr_one cr_weight">
                                                    Kiểm soát chặt chẽ cung ứng & sử dụng vật tư
                                                </h4>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Kiểm soát việc
                                                    cung ứng vật tư tại các công trường thông qua
                                                    các phiếu nhập/xuất vật tư</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Kiểm soát việc sử
                                                    dụng vật tư tại công trường</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Giảm thiểu rủi ro
                                                    các hạng mục thi công vượt định mức cho phép</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loii_one w_100 float_l">
                                        <div class="ctn_loii_ctiet w_100 float_l">
                                            <div class="avt_loii_dd float_r">
                                                <img src="../img/loiich2.png" alt="Quản lý chi phí công trình hiệu quả, giảm thiểu rủi ro tài chính">
                                            </div>
                                            <div class="ttin_loii ttin_loii_t float_l">
                                                <h4 class="tde_ttin w_100 float_l share_fsize_four share_clr_one cr_weight">
                                                    Quản lý chi phí công trình hiệu quả, giảm thiểu rủi ro tài chính
                                                </h4>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Lập các phiếu
                                                    thu/phiếu chi ngân sách và gửi quản lý phê duyệt online dễ dàng</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Kiểm soát chặt
                                                    chẽ các khoản chi của công trình đảm bảo công trình hoàn thành
                                                    trong khoản ngân sách cho phép</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loii_one w_100 float_l">
                                        <div class="ctn_loii_ctiet w_100 float_l">
                                            <div class="avt_loii_dd float_l">
                                                <img src="../img/loiich3.png" alt="Đề xuất & xét duyệt các yêu cầu cung cấp vất tư, báo giá nhanh chóng">
                                            </div>
                                            <div class="ttin_loii ttin_loii_o float_r">
                                                <h4 class="tde_ttin w_100 float_l share_fsize_four share_clr_one cr_weight">
                                                    Đề xuất & xét duyệt các yêu cầu cung cấp vất tư, báo giá nhanh chóng
                                                </h4>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Nhân viên dễ dàng
                                                    lập đề xuất thanh toán NCC, đề xuất mua sắm
                                                    nguyên vật liệu, ...</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Lãnh đạo dễ dàng
                                                    thẩm định và phê duyệt đề xuất mọi lúc mọi nơi</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Chuẩn hóa các
                                                    loại đề xuất, loại bỏ sai sót, chậm trễ trong phê duyệt </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loii_one w_100 float_l">
                                        <div class="ctn_loii_ctiet w_100 float_l">
                                            <div class="avt_loii_dd float_r">
                                                <img src="../img/loiich4.png" alt="Quản lý thông tin khách hàng & nhà cung cấp dễ dàng">
                                            </div>
                                            <div class="ttin_loii ttin_loii_t float_l">
                                                <h4 class="tde_ttin w_100 float_l share_fsize_four share_clr_one cr_weight">
                                                    Quản lý thông tin khách hàng & nhà cung cấp dễ dàng</h4>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Số hóa thông tin,
                                                    các lần giao dịch của nhà cung cấp & khách hàng
                                                    để quản lý trên một hệ thống</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">So sánh giá của
                                                    các nhà cung cấp giúp tiết kiệm thời gian và chi phí</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loii_one w_100 float_l">
                                        <div class="ctn_loii_ctiet w_100 float_l">
                                            <div class="avt_loii_dd float_l">
                                                <img src="../img/loiich5.png" alt="Theo dõi tiến độ các lần nghiệm thu và thanh toán">
                                            </div>
                                            <div class="ttin_loii ttin_loii_o float_r">
                                                <h4 class="tde_ttin w_100 float_l share_fsize_four share_clr_one cr_weight">
                                                    Theo dõi tiến độ các lần nghiệm thu và thanh toán</h4>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Thực hiện lập các
                                                    phiếu đề nghị thanh toán cho nhà thầu dễ dàng & nhanh chóng</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Theo dõi tiến độ
                                                    thanh toán với thầu phụ, chủ đầu tư</p>
                                                <p class="share_fsize_tow share_clr_one w_100 float_l">Lập báo cáo
                                                    nghiệm thu chi tiết</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_ct_four w_100 float_l">
                        <div class="container">
                            <h2 class="tieu_de share_clr_one w_100 float_l tex_center">Những người đã sử dụng nói gì về
                                chúng tôi</h2>
                            <div class="ctn_dtot w_100 float_l">
                                <div class="dtot_tatca w_100 float_l d_flex fl_nwrap">
                                    <div class="dtot_one">
                                        <div class="dgia_ctoi share_bgr_one w_100 float_l">
                                            <p class="share_fsize_five cr_weight share_clr_tow">Phần mềm rất hữu ích. Nó
                                                đã giúp cho công việc
                                                của tôi nhanh chóng hơn. Các hợp đồng, hóa đơn
                                                hay các yêu cầu đều dễ dàng được xử lý hơn.
                                                Từ đó, tăng uy tín của chúng tôi với khách hàng.</p>
                                        </div>
                                        <div class="nguoi_dgia w_100 float_l d_flex fl_nwrap">
                                            <div class="avt_dgia">
                                                <img src="../img/avt1.jpg" alt="Trần Khánh Linh">
                                            </div>
                                            <div class="ttin_ndgia">
                                                <p class="ten_ndgia w_100 float_l share_fsize_five cr_weight">Trần Khánh Linh</p>
                                                <p class="cvu_ndgia w_100 float_l share_fsize_five share_clr_one">Giám
                                                    đốc Công Ty Tnhh Đầu Tư, Sản Xuất Và Phát Triển Tín Phát </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dtot_one">
                                        <div class="dgia_ctoi share_bgr_one w_100 float_l">
                                            <p class="share_fsize_five cr_weight share_clr_tow">Phần mềm rất hữu ích. Nó
                                                đã giúp cho công việc
                                                của tôi nhanh chóng hơn. Các hợp đồng, hóa đơn
                                                hay các yêu cầu đều dễ dàng được xử lý hơn.
                                                Từ đó, tăng uy tín của chúng tôi với khách hàng.</p>
                                        </div>
                                        <div class="nguoi_dgia w_100 float_l d_flex fl_nwrap">
                                            <div class="avt_dgia">
                                                <img src="../img/avt2.jpg" alt="Nguyễn Hoàng Hải">
                                            </div>
                                            <div class="ttin_ndgia">
                                                <p class="ten_ndgia w_100 float_l share_fsize_five cr_weight">Nguyễn Hoàng Hải</p>
                                                <p class="cvu_ndgia w_100 float_l share_fsize_five share_clr_one">Giám
                                                    đốc Công ty VNP Group</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dtot_one">
                                        <div class="dgia_ctoi share_bgr_one w_100 float_l">
                                            <p class="share_fsize_five cr_weight share_clr_tow">Phần mềm rất hữu ích. Nó
                                                đã giúp cho công việc
                                                của tôi nhanh chóng hơn. Các hợp đồng, hóa đơn
                                                hay các yêu cầu đều dễ dàng được xử lý hơn.
                                                Từ đó, tăng uy tín của chúng tôi với khách hàng.</p>
                                        </div>
                                        <div class="nguoi_dgia w_100 float_l d_flex fl_nwrap">
                                            <div class="avt_dgia">
                                                <img src="../img/avt3.jpg" alt="Nguyễn Văn Lâm">
                                            </div>
                                            <div class="ttin_ndgia">
                                                <p class="ten_ndgia w_100 float_l share_fsize_five cr_weight">Nguyễn Văn
                                                    Lâm</p>
                                                <p class="cvu_ndgia w_100 float_l share_fsize_five share_clr_one">Giám
                                                    đốc Công Ty Cổ Phần Động Lực</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_ct_five w_100 float_l">
                        <div class="container">
                            <h2 class="tieu_de share_clr_one w_100 tex_center">Những câu hỏi thường gặp</h2>
                            <div class="ctn_cauh w_100 float_l">
                                <div class="cauh_tatca w_100 float_l">
                                    <div class="dat_cauh">
                                        <form action="" method="" class="form_search w_100 float_l">
                                            <div class="form_choi_nd d_flex">
                                                <input type="text" name="search_ch" class="form_control" placeholder="Nhập nội dung tìm kiếm">
                                                <p class="cl_search share_bgr_one share_clr_tow share_fsize_three share_cursor">
                                                    Tìm kiếm</p>
                                            </div>
                                        </form>
                                        <div class="dat_choi_ndung share_bgr_tow w_100 float_l">
                                            <h4 class="tde_dat_cauh w_100 float_l share_clr_four share_fsize_four">Đặt
                                                câu hỏi với Quản lý cung ứng xây dựng 365</h4>
                                            <form class="form_dat_cauh share_distance w_100 float_l">
                                                <div class="form-group">
                                                    <label>Họ tên</label>
                                                    <input type="text" name="name_nd" class="form-control" placeholder="Nhập họ và tên">
                                                </div>
                                                <div class="form-group">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" name="so_dient" class="form-control" placeholder="Nhập số điện thoại">
                                                </div>
                                                <div class="form-group">
                                                    <label>Câu hỏi <span class="cr_weight cr_red">*</span></label>
                                                    <textarea type="text" name="cau_hoi" class="form-control" rows="5" placeholder="Nhập nội dung"></textarea>
                                                </div>
                                                <div class="form-group group_o d_flex fl_nwrap fl_agi">
                                                    <div class="nhap_ma float_l">
                                                        <label>Nhập mã Captcha <span class="cr_red">*</span></label>
                                                        <input type="text" name="ma_capcha" class="form-control" placeholder="Nhập mã">
                                                    </div>
                                                    <div class="ma_captcha float_l d_flex">
                                                        <div class="hien-ma-nhap share_bgr_tow share_clr_one cr_weight ramdum" id="ma-cap">
                                                            <p class="ramdum" id="code" oncopy="return false" oncut="return false" onpaste="return false">456h89</p>
                                                        </div>
                                                        <input type="hidden" class="code_input" id="code_input">
                                                        <img class="img-xoay img-rest share_cursor" src="../img/icon_load.png" alt="capcha">
                                                    </div>
                                                </div>
                                                <div class="form_submit">
                                                    <button type="button" class="w_100 float_l share_cursor share_clr_tow share_bgr_one share_fsize_four luu_cau_hoi">Gửi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="list_cauh float_l">
                                        <div class="ctiet_cauh w_100 float_l">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_ct_six w_100 float_l">
                        <div class="container">
                            <div class="ctn_tnghiem w_100 float_l">
                                <div class="tnghiem_tatca w_100 float_l d_flex">
                                    <div class="tnghiem_one float_l">
                                        <h3 class="tieu_de share_clr_one w_100 tex_center">Hãy trải nghiệm ngay trên app
                                        </h3>
                                        <div class="avt_tnghiem w_100 float_l d_flex">
                                            <div class="avt_white w_100 float_l d_flex">
                                                <div class="tnghiem_image_o tnghiem_image_two">
                                                    <picture>
                                                        <source media="(max-width: 768px)" srcset="../img/train_rma.png">
                                                        <img src="../img/ma_qr_o.png" alt="mã QR">
                                                    </picture>
                                                </div>
                                                <div class="tnghiem_image_o">
                                                    <p>
                                                        <picture>
                                                            <source media="(max-width: 768px)" srcset="../img/gg_play_res.png">
                                                            <img src="../img/gg_play.png" alt="Download phần mềm quản lý cung ứng trên CHplay">
                                                        </picture>
                                                    </p>
                                                    <p>
                                                        <picture>
                                                            <source media="(max-width: 768px)" srcset="../img/gg_app_res.png">
                                                            <img src="../img/gg_app.png" alt="Download phần mềm quản lý cung ứng trên Appstore">
                                                        </picture>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tnghiem_avt float_l">
                                        <div class="thun_avt_one">
                                            <picture>
                                                <source media="(max-width: 768px)" srcset="../img/res_tnghiem.png">
                                                <img src="../img/avt_tn_two.png" alt="trải nghiệm ngay trên app">
                                            </picture>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ctn_cu_two w_100 float_l">
                    <div class="content_ct_one w_100 float_l">
                        <div class="container">
                            <div class="ctn_video w_100 float_l">
                                <h2 class="tieu_de share_clr_tow w_100 float_l tex_center">Video hướng dẫn sử dụng</h2>
                                <div class="ctn_hd_video">
                                    <div class="img-hd">
                                        <iframe controls width="100%" height="100%" src="https://www.youtube.com/embed/Tm0T2CmvNj4">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ctn_cu_three w_100 float_l">
                    <div class="container">
                        <div class="content_ct_one w_100 float_l">
                            <div class="ctn_baiv">
                                <h4 class="tieud_baiv share_clr_one">1.1. Máy chấm công bạn hiểu là gì? </h4>
                                <p class="share_clr_one">Ngay từ thời điểm doanh nghiệp hình thành,các thiết bị chấm
                                    công kết hợp với việc điểm danh cơ học của nhân sự trở thành căn cứ tiêu biểu giúp
                                    các công ty ghi lại
                                    được thời điểm đến làm việc, tan làm, nghỉ phép của người lao động từ đó, tính công
                                    và lương, thưởng cho người lao động vào cuối tháng một cách chính xác,
                                    đồng thời góp phần nâng cao ý thức làm việc và kỷ luật của nhân viên tại nơi làm
                                    việc.
                                </p>
                                <div class="avt_bv">
                                    <img src="../img/timhieu.png" alt="tim hieu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <? include('../includes/inc_footer.php') ?>
        </div>
    </div>
    <? include("../modals/modal_logout.php") ?>
    <? include("../includes/in_chat.php") ?>
    <? include("../modals/modal_menu_tt.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/slick.min.js"></script>
<script type="text/javascript">
    var dang_xuat = $(".dang_xuat");
    var logout_ht = $(".logout_ht");
    var huy_button = $(".huy_button");
    $(".logout_all").click(function() {
        window.location.href = "/dang-xuat.html";
    });

    dang_xuat.click(function() {
        logout_ht.show();
    });

    huy_button.click(function() {
        logout_ht.hide();
    });

    $(window).click(function(e) {
        if ($(e.target).is(".logout_ht")) {
            logout_ht.hide();
        }
    })

    $(document).ready(function() {
        var do_xuay = 0;
        $(".img-rest").click(function() {
            do_xuay += 360;
            xoay($(this), do_xuay);
        })

        function xoay(img, deg) {
            img.css("transform", "rotate(" + deg + "deg)");
            img.css("transition", "0.3s");
        }
    });


    function ramdumso(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }

    $(".macap1").value == $(".ddd").html();

    $(".ramdum").html(ramdumso(6));
    $('#code_input').val($(".ramdum").html());
    $(".img-rest").click(function() {
        $(".ramdum").html(ramdumso(6));
        $('#code_input').val($(".ramdum").html());
    });

    var btx_modal_ind = $(".btx_modal_ind");
    var menu_tt = $(".menu_tt");

    btx_modal_ind.click(function() {
        menu_tt.show();
    });

    $(window).click(function(e) {
        if ($(e.target).is(".menu_tt")) {
            menu_tt.hide();
        }
    });

    $('.ctiet_cauh').slick({
        dots: true,
        infinite: false,
        speed: 800,
        slidesToShow: 2,
        slidesToScroll: 1,
        vertical: true,
    });

    $(".xem_them").click(function() {
        $(this).parents(".choi_chit").find(".cty_tloi .cauh_ndung .tro_loi_r").addClass("active");
        $(this).addClass("share_dnone");
        $(this).parents(".choi_chit").find(".an_bot").removeClass("share_dnone");
    });

    $(".an_bot").click(function() {
        $(this).parents(".choi_chit").find(".cty_tloi .cauh_ndung .tro_loi_r").removeClass("active");
        $(this).addClass("share_dnone");
        $(this).parents(".choi_chit").find(".xem_them").removeClass("share_dnone");
    });

    var avt_nv_dn = $(".avt_nv_dn");
    var ten_nv_dn = $(".ten_nv_dn");
    var bg_logout = $(".bg_logout");

    $(".avt_nv_dn, .ten_nv_dn").click(function() {
        $(this).parents(".bg_log_aff").find(".bg_logout").toggleClass('active');
    });

    $(window).click(function(e) {
        if (!avt_nv_dn.is(e.target) && !ten_nv_dn.is(e.target) && !bg_logout.is(e.target) && bg_logout.has(e.target).length === 0) {
            bg_logout.removeClass("active");
        }
    });

    $(".luu_cau_hoi").click(function() {
        var form_add = $(".form_dat_cauh");
        form_add.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-group"));
                error.appendTo(element.parents(".nhap_ma"));
                error.wrap("<span class='error'>");
            },
            rules: {
                cau_hoi: {
                    required: true,
                },
                so_dient: {
                    number: true,
                },
                ma_capcha: {
                    required: true,
                    equalTo: '#code_input',
                }
            },
            messages: {
                cau_hoi: {
                    required: "Câu hỏi không được để trống",
                },
                so_dient: {
                    number: "Nhập số điện thoại",
                },
                ma_capcha: {
                    required: "Mã capcha không được để trống",
                    equalTo: "Mã capcha nhập không đúng",
                }
            }
        });
        if (form_add.valid() === true) {
            // var ho_ten = $("input[name='name_nd']").val();
            // var so_dt = $("input[name='so_dient']").val();
            // var cau_hoi = $("textarea[name='cau_hoi']").val();

            // $.ajax({
            //     url: '../ajax/cau_hoi.php',
            //     type: 'POST',
            //     data: {
            //         ho_ten: ho_ten,
            //         so_dt: so_dt,
            //         cau_hoi: cau_hoi,
            //     },
            //     success: function(data) {
            // if(data == ""){
            //     alert("Bạn đã tạo câu hỏi thành công");
            //     window.location.reload();
            // }else{
            //     alert(data);
            window.location.reload();
            // }

            //         }
            //     })
        }
    })
</script>

</html>