let resetBtn = document.getElementById("reset-btn");
let saveBtn = document.getElementById("save-btn");

resetBtn.addEventListener("click", resetForm);
saveBtn.addEventListener("click", saveForm);

function resetForm() {
    var prt = prompt("Thông tin cũ sẽ bị xoá vĩnh viễn. " +
        "Nhập \"Y\" nếu bạn chắc chắn muốn thực hiện hành động này!");
    if (prt == "y" | prt == "Y") {
        var inputs = document.getElementsByClassName("form-control");
        var num = inputs.length;
        var i;
        for (i = 0; i < num; i++) {
            inputs[i].value = "";
        }
        var dayOfAge = document.getElementsByClassName("day-of-age");
        dayOfAge[0].innerHTML = "";

        let barnNum = document.getElementById("barn-num").innerHTML.slice(7);
        console.log(barnNum);

        let httpRequest = new XMLHttpRequest();
        httpRequest.open("POST", "/CricketFarm/InsertToDatabase.php", false);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send("pass=Lcn11031996&barnID=" + barnNum);
        console.log(httpRequest.status);
        console.log(httpRequest.responseText);
    }
}

function saveForm() {
    console.log("purpose");
}