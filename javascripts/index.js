// Display account sections
document.addEventListener("DOMContentLoaded", function () {
    // set url link
    let webUrl = window.location.search;
    webUrl = new URLSearchParams(webUrl);
    webUrl = webUrl.get("type");
    if (webUrl == "catalogue") {
        document.title = "Catalogue - Inventory"
        document.querySelector(".cart-section").setAttribute("hidden", "hidden")
        document.querySelector(".catalogue-section").removeAttribute("hidden", "hidden")
    } else if (webUrl == "cart") {
        document.title = "Cart - Inventory"
        document.querySelector(".catalogue-section").setAttribute("hidden", "hidden")
        document.querySelector(".cart-section").removeAttribute("hidden", "hidden")
    }
})