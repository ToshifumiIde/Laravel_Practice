"use strict";

{
    function doAction() {
        let id = document.getElementById("id").value;
        console.log(id);
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `/hello/json/${id}`, true);
        xhr.responseType = "json";
        console.log(xhr);
        xhr.onload = function (e) {
            if (this.status == 200) {
                let result = this.response;
                console.log(result);
                document.getElementById("name").textContent = result.name;
                document.getElementById("mail").textContent = result.mail;
                document.getElementById("age").textContent = result.age;
            }
        };
        xhr.send();
    }

    document.getElementById("button").addEventListener("click", doAction);
}
