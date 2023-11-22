// ----------------------- On Load -----------------------
// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// set url link
	let webUrl = window.location.search;
	webUrl = new URLSearchParams(webUrl);
	webUrl = webUrl.get("type");
	if (webUrl == "catalogue") {
		document.title = "Catalogue - Inventory";
		document.querySelector(".cart-section").setAttribute("hidden", "hidden");
		document.querySelector(".catalogue-section").removeAttribute("hidden", "hidden");
	} else if (webUrl == "cart") {
		document.title = "Cart - Inventory";
		document.querySelector(".catalogue-section").setAttribute("hidden", "hidden");
		document.querySelector(".cart-section").removeAttribute("hidden", "hidden");
	}
	// give active to correct class
	if (webUrl == "catalogue" || webUrl == "cart") {
		document.querySelectorAll(".navbar-sections").forEach((element) => {
			element.classList.remove("active");
		});
		document.querySelector(`.${webUrl}-navbar-section`).classList.add("active");
	}
});

// Toggle show and hide password
document.getElementById("togglePassword").addEventListener("click", function () {
	const passwordInput = document.getElementById("password");
	if (passwordInput.type === "password") {
		passwordInput.type = "text";
		passwordInput.toggleAttribute("disabled");
	} else {
		passwordInput.type = "password";
		passwordInput.toggleAttribute("disabled");
	}
});
