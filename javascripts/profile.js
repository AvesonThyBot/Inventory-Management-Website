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

// ----------------------- Functions -----------------------

// function to enable and disable input element
function editToggle(element, button) {
	if (element.classList.contains("disable-input")) {
		// disable input
		button.textContent = "Save";
		element.classList.remove("disable-input");
	} else {
		button.textContent = "Edit";
		element.classList.add("disable-input");
	}
}

// Toggle disabled for first name
document.getElementById("toggleFirst").onclick = () => {
	editToggle(document.getElementById("firstName"), document.getElementById("firstName").nextElementSibling);
};

// Toggle disabled for last name
document.getElementById("toggleLast").onclick = () => {
	editToggle(document.getElementById("lastName"), document.getElementById("lastName").nextElementSibling);
};

// Toggle disabled for last name
document.getElementById("toggleEmail").onclick = () => {
	editToggle(document.getElementById("email"), document.getElementById("email").nextElementSibling);
};

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
