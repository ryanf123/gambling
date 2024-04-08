function load(page, destination) {
    fetch(page)
        .then(Response => Response.text())
        .then(data => document.getElementById(destination).innerHTML = data)
}
function loadpage(page) {
    load(page, "main");
}
function loadlogin(page) {
    load(page, "login");
}
