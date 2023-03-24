function validate() {
    let x = document.getElementById("fname").value;
    if (x == "" || x == null) {
        alert("Name is mandatory");
        return false;
    }
    var regName = /^[a-z A-Z]{2,20}$/;
    if (!regName.test(x)) {
        alert("Name must be in characters");
    }
    let z = document.getElementById("fid").value;
    if (z == "" || x == null) {
        alert("Name is mandatory");
        return false;
    }
    let y = document.getElementById("email").value;
    if (y == "" || y == "null") {
        alert("Email is mandatory");
        return false;
    }
    var mailFormat =
        /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (!mailFormat.test(y)) {
        alert("Email not in format!");
        return false;
    } else return true;
}
