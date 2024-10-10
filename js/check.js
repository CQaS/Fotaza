$(function () {
    $('body').on('keydown', '#first_name', function (e) {
        console.log(this.value);
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false;
        }
    });
});

function checkusername() {
    var status = document.getElementById("usernamestatus");
    var u = document.getElementById("username").value;
    if (u != "") {
        status.innerHTML = 'checking...';
        var hr = new XMLHttpRequest();
        hr.open("POST", "signin.php", true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if (hr.readyState == 4 && hr.status == 200) {
                status.innerHTML = hr.responseText;
            }
        }
        var v = "name2check=" + u;
        hr.send(v);
    }
}

function clean(username) {
    var textfield = document.getElementById(username);
    var regex = /[^a-z0-9]/g;
    textfield.value = textfield.value.replace(regex, "");
}
