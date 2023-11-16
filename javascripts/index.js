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

// ----------------------- Main Functions -----------------------

// Displaying products
function productDisplay() {
	fetch("https://fakestoreapi.com/products")
		.then((data) => data.json())
		.then((data) => {
			const productBox = document.querySelector(".catalogue-box");
			productBox.textContent = "";
			for (let index = 0; index < data.length; index++) {
				productBox.innerHTML += `<div class="product-item ${index + 1}"><img draggable="false" (dragstart)="false;" class="product-info product-image rounded-top" src="${data[index].image}" alt="thumbnail image of product"/><span class="product-info text-dark bg-white">${data[index].title}</span><button type="button" class="btn btn-warning">Add 1 To Cart</button></div>`;
			}

			// Onclick function for the displayed items
			const productInfo = document.querySelectorAll(".product-info");
			productInfo.forEach((item) => {
				item.addEventListener("click", function (event) {
					const productID = item.parentElement.classList[1];
					displayInfo(productID);
				});
			});
		});
}

// Display
productDisplay();

// Display certain product's details (onclick)
function displayInfo(ID) {
	fetch(`https://fakestoreapi.com/products/${ID}`)
		.then((data) => data.json())
		.then((data) => {
			console.log(data);
		});
}
