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

// ----------------------- Displaying Functions -----------------------

// Displaying products
function productDisplay() {
	fetch("https://fakestoreapi.com/products?limit=50")
		.then((data) => data.json())
		.then((data) => {
			console.log(data);
			const productBox = document.querySelector(".catalogue-box");
			productBox.textContent = "";
			for (let index = 0; index < data.length; index++) {
				productBox.innerHTML += `<div class="product-item"><img draggable="false" (dragstart)="false;" class="product-image rounded-top" src="${data[index].image}" alt="thumbnail image of product"/><span class="text-dark bg-white rounded-bottom">${data[index].title}</span></div>`;
			}
		});
}

// Display
productDisplay();
