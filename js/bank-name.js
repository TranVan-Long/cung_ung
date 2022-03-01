function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) { //up
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
var bank = ["Ngân hàng liên doanh Việt Nga (VietNam - Russia Bank)", 
"Ngân hàng Ngoại thương Việt Nam (Vietcombank)",
"Ngân hàng Shinhan Việt Nam (Shinhan bank Việt Nam)",
"Ngân hàng Công thương Việt Nam (Incombank) Vietinbank",
"Ngân hàng Phát triển Nhà Đồng bằng sông Cửu Long (MHB)",
"Ngân hàng Nhà nước Việt Nam",
"Ngân hàng Phát triển Việt Nam (VDB)",
"Ngân hàng Chính sách Xã hội Việt Nam (VBSP) Ngân hàng",
"VID Public Bank",
"ACB(Ngân hàng Á Châu)",
"VP Bank",
"Ngân hàng Đầu tư và Phát triển Việt Nam(BIDV)",
"Habubank",
"Sacombank(Ngân hàng Sài Gòn Thương Tín)",
"Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam(Agribank)",
"Techcombank(Ngân hàng Kỹ thương Việt Nam) Ngân hàng",
"LV(Ngân hàng Liên Việt)",
"Ngân hàng VIB(Ngân hàng Quốc tế Việt Nam)",
"OCB(Ngân hàng Phương Đông)",
"VietABank",
"Ngân hàng Sài Gòn(Sài Gòn Công Thương Ngân Hằng)",
"TP Bank(Tiên Phong Bank)",
"Eximbank(Ngân hàng TMCP Xuất nhập khẩu Việt Nam)",
"PG ​​Bank(Petrolimex Global Bank)",
"GP Bank(Global Petrol Commercial Bank)",
"MB(Ngân hàng Quân đội)",
"EAB(Ngân hàng TMCP Đông Á)"];