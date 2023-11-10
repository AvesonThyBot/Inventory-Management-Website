// Display account sections
document.addEventListener("DOMContentLoaded", function () {
    // set url link
    let webUrl = window.location.search;
    webUrl = new URLSearchParams(webUrl);
    webUrl = webUrl.get("type");
    if (webUrl == "login") {
        document.title = "Login - Inventory"
        document.querySelector(".register-section").setAttribute("hidden", "hidden")
        document.querySelector(".login-section").removeAttribute("hidden", "hidden")
    } else if (webUrl == "register") {
        document.title = "Register - Inventory"
        document.querySelector(".login-section").setAttribute("hidden", "hidden")
        document.querySelector(".register-section").removeAttribute("hidden", "hidden")
    }
})
