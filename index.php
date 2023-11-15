<?php
    require "config/database.php";

    // send to account
    if (count($_COOKIE) <= 0) {
            header("Location:account.php");
        }
    
    // Get user data
    $user_id = $_COOKIE['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="images/inventory.png" type="image/png">
    <title>Catalogue - Inventory</title>
</head>
<body class="bg-dark">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark" >
        <div class="container-fluid">
            <img class="navbar-brand img-fluid" src="/images/inventory.png" style="height:50px;" alt="logo" draggable="false"/>
            <!-- Button when compressed -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- navbar list -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active catalogue-navbar-section navbar-sections" aria-current="page" href="?type=catalogue">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-navbar-section navbar-sections" href="?type=cart">Cart</a>
                    </li>
                </ul>
            </div>
            <!-- Account dropdown -->
            <div class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end w-100 mw-100">
                        <?php if (isset($_COOKIE["is_logged_in"])) { ?>
                            <li><p class="dropdown-item"><?php echo $row['first_name'];?></p></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="account.php?type=logout">Log out</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="/account.php?type=login">Login</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="/account.php?type=register">Register</a></li>
                        <?php } ?>
                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <!-- Catalogue Section -->
    <section class="catalogue-section">
        <div class="product-list text-white">
			<h2>Products</h2>
			<div class="catalogue-box">
			</div>
		</div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section text-danger" hidden>b</section>

    <!-- Script -->
    <script src="javascripts/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html> 