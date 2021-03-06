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
var bank = ["Ng??n h??ng li??n doanh Vi???t Nga (VietNam - Russia Bank)", 
"Ng??n h??ng Ngo???i th????ng Vi???t Nam (Vietcombank)",
"Ng??n h??ng Shinhan Vi???t Nam (Shinhan bank Vi???t Nam)",
"Ng??n h??ng C??ng th????ng Vi???t Nam (Incombank) Vietinbank",
"Ng??n h??ng Ph??t tri???n Nh?? ?????ng b???ng s??ng C???u Long (MHB)",
"Ng??n h??ng Nh?? n?????c Vi???t Nam",
"Ng??n h??ng Ph??t tri???n Vi???t Nam (VDB)",
"Ng??n h??ng Ch??nh s??ch X?? h???i Vi???t Nam (VBSP) Ng??n h??ng",
"VID Public Bank",
"ACB(Ng??n h??ng ?? Ch??u)",
"VP Bank",
"Ng??n h??ng ?????u t?? v?? Ph??t tri???n Vi???t Nam(BIDV)",
"Habubank",
"Sacombank(Ng??n h??ng S??i G??n Th????ng T??n)",
"Ng??n h??ng N??ng nghi???p v?? Ph??t tri???n N??ng th??n Vi???t Nam(Agribank)",
"Techcombank(Ng??n h??ng K??? th????ng Vi???t Nam) Ng??n h??ng",
"LV(Ng??n h??ng Li??n Vi???t)",
"Ng??n h??ng VIB(Ng??n h??ng Qu???c t??? Vi???t Nam)",
"OCB(Ng??n h??ng Ph????ng ????ng)",
"VietABank",
"Ng??n h??ng S??i G??n(S??i G??n C??ng Th????ng Ng??n H???ng)",
"TP Bank(Ti??n Phong Bank)",
"Eximbank(Ng??n h??ng TMCP Xu???t nh???p kh???u Vi???t Nam)",
"PG ??????Bank(Petrolimex Global Bank)",
"GP Bank(Global Petrol Commercial Bank)",
"MB(Ng??n h??ng Qu??n ?????i)",
"EAB(Ng??n h??ng TMCP ????ng ??)"];