// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// set url link
	let webUrl = window.location.search;
	webUrl = new URLSearchParams(webUrl);
	webUrl = webUrl.get("type");
	if (webUrl == "login") {
		document.title = "Login - Inventory";
		document.querySelector(".register-section").setAttribute("hidden", "hidden");
		document.querySelector(".login-section").removeAttribute("hidden", "hidden");
	} else if (webUrl == "register") {
		document.title = "Register - Inventory";
		document.querySelector(".login-section").setAttribute("hidden", "hidden");
		document.querySelector(".register-section").removeAttribute("hidden", "hidden");
	}
	// give active to correct class
	if (webUrl == "login" || webUrl == "register") {
		document.querySelectorAll(".navbar-sections").forEach((element) => {
			element.classList.remove("active");
		});
		document.querySelector(`.navbar-${webUrl}`).classList.add("active");
	}
});

// Turn off refresh when submitted (login)
document.getElementById("login-form").addEventListener("submit", function (e) {
	e.preventDefault();

	// Submit the form using JavaScript
	document.getElementById("login-form").submit();
});

// Turn off refresh when submitted (register)
document.getElementById("register-form").addEventListener("submit", function (e) {
	e.preventDefault();

	// Submit the form using JavaScript
	const invalidCount = document.querySelectorAll("is-invalid").length;
	if (invalidCount == 0) {
		document.getElementById("register-form").submit();
	} else {
		console.log("eror");
	}
});
