$(function () {
    $('#toast_wrapper').css('display', 'block');
    setTimeout(function () {
        $('.toast').toast('show');
    }, 1000);
    showMessage();
    $('.homeBtn').on('click', function () {
        loadHome();
    });
    goToOrder();
});
addLoadEvent(loadHome);
addLoadEvent(resetPassword);

function loadOrders(index = "all", keyword = "orderID", sort = "asc", operation = "filt", gto = null) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('container').innerHTML = xmlhttp.response;
            loadDetails();
            $('.orderCollapse').on('shown.bs.collapse', function () {
                var offset = $(this).offset();
                offset.top -= 300;
                $('html, body').animate({
                    scrollTop: offset.top
                })
            })
            if (gto !== null) {
                var element = '#coid' + gto;
                $(element).collapse('show');
            }
        }
    }
    xmlhttp.open("GET", "orderHistoryOrder.php?si=" + index + "&key=" + keyword + "&sort=" + sort + "&op=" + operation, true);
    xmlhttp.send();
}

function showMessage() {
    $('.orderBadge').on('click', function () {
        $('.toast').toast('show');
    })
}

function goToOrder() {
    $('.goToOrder,.toastCheck').on('click', function () {
        var orderID = $(this).data('oid');
        loadCtrls();
        loadOrders(undefined, undefined, undefined, undefined, orderID);
    })
}

function loadHome() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp);
            document.getElementById('content_wrapper').innerHTML = xmlhttp.response;
            showMessage();
            getItems();
            goToOrder();
            editProfile();
            resetPassword();
        }
    }
    xmlhttp.open("GET", "personalHome.php", true);
    xmlhttp.send();
}

function selectChecking(i) {
    var index = i;
    if (document.getElementById('historyCtrls') == null) {
        loadCtrls();
        loadOrders(index);
    } else {
        loadOrders(index);
    }
}

function loadDetails() {
    $('.orderCollapse').on('show.bs.collapse', function () {
        var obj = $(this);
        var orderid = obj.siblings('.orders').data("orderid");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                obj.children('div').html(xmlhttp.response);
                reorder();
            }
        }
        xmlhttp.open("GET", "orderHistoryDetail.php?oi=" + orderid, true);
        xmlhttp.send();
    });
};

function changesort() {
    $('.sorter').on('click', function () {
        var keyword = $(this).attr('data-key');
        var sort = $(this).attr('data-sort');
        loadOrders('', keyword, sort, 'sort');
        if (sort == 'asc') {
            $(this).attr('data-sort', 'des');
        } else if (sort == 'des') {
            $(this).attr('data-sort', 'asc');
        }
    });
};

function loadCtrls() {
    if (document.getElementById('historyCtrls') == null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                document.getElementById('content_wrapper').innerHTML = xmlhttp.response;
                changesort();
            }
        }
        xmlhttp.open("GET", "orderhistoryCtrl.php", true);
        xmlhttp.send();
    } else {
        loadOrders();
    }
}

function reorder() {
    $('.reorderBtn').on('click', function () {
        var roid = $(this).data('roid');
        getItems(roid);
        window.location = "paymentprocess.php";
    });
}

function editProfile() {
    $('.editProfileBtn').on('click', function () {
        $('.displayTable').removeClass('show');
        $('.displayTable').addClass('hide');
        $('.editForm').removeClass('show');
        $('.editForm').removeClass('hide');
        $('.editProfileBtn').addClass('hide');
        $('.saveChange').removeClass('hide');
        $('.saveChange').addClass('show');
        saveChange();
    })
}

function saveChange() {
    $('.saveChange').on('click', function () {
        // alert($('input[name=email]'));
        var object = {
            firstName: $('input[name=firstName]').val(),
            lastName: $('input[name=lastName]').val(),
            email: $('input[type=email]').val(),
            phone: $('input[name=phone]').val(),
            address: $('input[name=address]').val(),
            companyName: $('input[name=companyName]').val()
        };
        var formVals = JSON.stringify(object);
        $('.saveChange').removeClass('show');
        $('.saveChange').addClass('hide');
        $('.spinnerContainer').removeClass('hide');
        $('.inputfield').attr('disabled', 'true');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(xmlhttp);
                console.log(xmlhttp.response);
                $('.displayTable').addClass('show');
                $('.displayTable').removeClass('hide');
                $('.editForm').removeClass('show');
                $('.editForm').addClass('hide');
                $('.editProfileBtn').removeClass('hide');
                $('.editProfileBtn').addClass('show');
                $('.spinnerContainer').addClass('hide');
                $('.inputfield').attr('disabled', 'false');
                $('#namefield').text(object.firstName + " " + object.lastName);
                $('#emailfield').text(object.email);
                $('#phonefield').text(object.phone);
                $('#addressfield').text(object.address);
                $('#companyNamefield').text(object.companyName);
                $('#userNameText').text(object.firstName + " " + object.lastName);
                editProfile()
            }
        }
        xmlhttp.open("POST", "saveChange.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/json")
        xmlhttp.send(formVals);
    })
}

function resetPassword() {
    // when reset btn clicked
    $('#resetPasswordBtn').on('click', function () {
        // needs for recaptacha ready
        grecaptcha.ready(function () {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('6LeF6qwUAAAAAAdU7lgKBD5Bs7reJ6DxPSmhpQE8', {
                action: 'RESET_PASSWORD'
            }).then(function (token) {
                $.post("resetToken.php", {
                    token: token
                }, function (result) {
                    console.log(result);
                    if (result) {
                        alert('DONE check your email.')
                    } else {
                        alert('You are spammer ! Get the @$%K out.')
                    }
                });
            });;
        });
    });
}