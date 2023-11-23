// ----------------------- On Load -----------------------
// Display account sections
document.addEventListener("DOMContentLoaded", function () {
	// check the post
	const urlParams = new URLSearchParams(window.location.search);
	const updateBool = urlParams.get("update");
	if (updateBool == "success" || updateBool == "failed") {
		updateAlert(updateBool);
	}
});
// function to display correct toast
function updateAlert(alertType) {
	const updateToast = document.getElementById("updateAlert");
	const toast = new bootstrap.Toast(updateToast);
	const toastBody = document.querySelector(".toast-body");
	if (alertType == "success") {
		updateToast.classList.remove("text-bg-danger");
		updateToast.classList.add("text-bg-success");
		toastBody.innerHTML = "Updated details successfully!";
	} else {
		updateToast.classList.remove("text-bg-success");
		updateToast.classList.add("text-bg-danger");
		toastBody.innerHTML = "Update failed.";
	}
	// display toast
	toast.show();
}
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

// Alert for updating profile
document.addEventListener("DOMContentLoaded", function () {
	// check the post
});
