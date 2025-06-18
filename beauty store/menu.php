
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Products Menu</title>
    <link rel='stylesheet' href='styles.css'>
    <script>
    function addToCart(productName) {
    const formData = new FormData();
    formData.append('product', productName);  // ✅ send key as 'product'

    fetch('cart.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            alert("Item added to cart successfully!");
        } else {
            alert("Failed to add item to cart.");
        }
    }).catch(error => {
        alert("Error occurred: " + error);
    });

    return false;
}


    function filterProducts() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let products = document.getElementsByClassName("product-card");

        for (let i = 0; i < products.length; i++) {
            let name = products[i].innerText.toLowerCase();
            products[i].style.display = name.includes(input) ? "block" : "none";
        }
    }
    </script>
</head>
<body>
<h1>BEAUTY STORE</h1>
<div style="text-align: right; padding: 10px;">
    <form action="index.php" method="post">
        <button type="submit" >
            Logout
        </button>
    </form>
</div>
<div class='menu'>

<form action='cart2.php' method='POST'>
    <input type='submit' name='bu' value='View cart'>
</form>

<div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search products..." onkeyup="filterProducts()">
</div>


<?php
session_start();
$na = $_SESSION['user'];
echo"<h2 style='color: #a00050; font-size: 22px; font-family: 'Segoe UI'; text-align: right;'>
  👋 Hello <span style='font-weight: bold;'>pengu</span>!
</h2>";

?>



</div>
<div class='logo'>
<img src='maybelinelogo.png'>
</div>
<nav class='products-menu '>
    <ul>
        <li class="product-card">
            
                <img src='compact.jpg' alt='Compact'>
                <span>Compact<br>Rs.150<br></span>
                <button onclick="return addToCart('compact');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='compact'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='toner.jpeg' alt='Toner'>
                <span>Toner<br>Rs.260<br></span>
                <button onclick="return addToCart('toner');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='toner'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='kajal.jpg' alt='Kajal'>
                <span>Kajal<br>Rs.70<br></span>
                <button onclick="return addToCart('kajal');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='kajal'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">

                <img src='eyeshadow.jpg' alt='EyeShadow'>
                <span>EyeShadow<br>Rs.400<br></span>
                <button onclick="return addToCart('eyeshadow');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='eyeshadow'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='highlighter.jpeg' alt='Compact'>
                <span>Highlighter<br>Rs.400<br></span>
                <button onclick="return addToCart('highlighter');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='highlighter'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>

    <ul>
    <li class="product-card">
            
                <img src='eyeliner.jpeg' alt='Toner'>
                <span>Eyeliner<br>Rs.150<br></span>
                <button onclick="return addToCart('eyeliner');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='eyeliner'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        
        <li class="product-card">
            
                <img src='bronzer.jpeg' alt='Bronzer'>
                <span>Bronzer<br>Rs.200<br></span>
                <button onclick="return addToCart('bronzer');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='bronzer'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='foundation.jpg' alt='Foundation'>
                <span>Foundation<br>Rs.500<br></span>
                <button onclick="return addToCart('foundation');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='foundation'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lipstick.jpg' alt='Compact'>
                <span>Lipstick<br>Rs.100<br></span>
                <button onclick="return addToCart('lipstick');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lipstick'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        
        <li class="product-card">
            
                <img src='sunscreen.jpeg' alt='Toner'>
                <span>Sunscreen<br>Rs.200<br></span>
                <button onclick="return addToCart('sunscreen');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='sunscreen'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
</ul>
</nav>
<div class='logo'>
<img src='nykaalogo.jpeg'>
</div>
<nav class='products-menu '>
    <ul>
        <li class="product-card">
            
                <img src='maybelinecompact.jpeg' alt='Compact'>
                <span>Compact<br>Rs.250<br></span>
                <button onclick="return addToCart('nykaacompact');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaacompact'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='maybelinefoundation.jpg' alt='Toner'>
                <span>Foundation<br>Rs.250<br></span>
                <button onclick="return addToCart('nykaafoundation');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaafoundation'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='mascara.jpg' alt='Kajal'>
                <span>Mascara<br>Rs.100<br></span>
                <button onclick="return addToCart('mascara');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='mascara'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>


        <li class="product-card">
            
                <img src='eyeline1.jpg' alt='Kajal'>
                <span>Eyeliner<br>Rs.150<br></span>
                <button onclick="return addToCart('nykaaeyeliner');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaaeyeliner'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lipstick2.jpg' alt='EyeShadow'>
                <span>Lipstick<br>Rs.100<br></span>
                <button onclick="return addToCart('nykaalipstick');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaalipstick'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>
    <ul>
        <li class="product-card">
            
                <img src='blush2.jpg' alt='Compact'>
                <span>Blush<br>Rs.250<br></span>
                <button onclick="return addToCart('nykaablush');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaablush'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='bronzer.jpeg' alt='Toner'>
                <span>Bronzer<br>Rs.250<br></span>
                <button onclick="return addToCart('nykaabronzer');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaabronzer'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lipgloss.jpeg' alt='Kajal'>
                <span>Lipgloss<br>Rs.200<br></span>
                <button onclick="return addToCart('nykaalipgloss');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nykaalipgloss'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
         <li class="product-card">
            
                <img src='concealer.jpeg' alt='EyeShadow'>
                <span>Concealer<br>Rs.350<br></span>
                <button onclick="return addToCart('concealer');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='concealer'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='spray.jpeg' alt='Spray'>
                <span>Spray<br>Rs.300<br></span>
                <button onclick="return addToCart('spray');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='maybelinespray'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>
</nav>
<div class='logo'>
<img src='maclogo.jpg'>
</div>
<nav class='products-menu '>
    <ul>
        <li class="product-card">
            
                <img src='maccompact.jpeg' alt='Compact'>
                <span>Compact<br>Rs.250<br></span>
                <button onclick="return addToCart('maccompact');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='maccompact'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='macfoundation.jpeg' alt='Toner'>
                <span>Foundation<br>Rs.500<br></span>
                <button onclick="return addToCart('macfoundation');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='macfoundation'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='eyeline2.jpg' alt='Kajal'>
                <span>Eyeliner<br>Rs.250<br></span>
                <button onclick="return addToCart('maceyeliner');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='maceyeliner'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lipstick1.jpg' alt='EyeShadow'>
                <span>Lipstick<br>Rs.350<br></span>
                <button onclick="return addToCart('maclipstick');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='maclipstick'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='blender.jpg' alt='Blender'>
                <span>Blender<br>Rs.30<br></span>
                <button onclick="return addToCart('blender');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='blender'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
   
    </ul>
    <ul>
        <li class="product-card">
            
                <img src='kajal3.jpeg' alt='Compact'>
                <span>Kajal<br>Rs.100<br></span>
                <button onclick="return addToCart('mackajal');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='mackajal'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='blush3.jpeg' alt='Toner'>
                <span>Blush<br>Rs.250<br></span>
                <button onclick="return addToCart('macblush');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='macblush'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='highlighter3.jpg' alt='Kajal'>
                <span>Highlighter<br>Rs.450<br></span>
                <button onclick="return addToCart('machighlighter');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='machighlighter'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='nailpolish.jpeg' alt='Nail Polish'>
                <span>Nail Polish<br>Rs.60<br></span>
                <button onclick="return addToCart('nailpolish');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='nailpolish'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>


        <li class="product-card">
            
                <img src='lipgloss.jpeg' alt='EyeShadow'>
                <span>Lipgloss<br>Rs.150<br></span>
                <button onclick="return addToCart('maclipgloss');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='maclipgloss'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>
</nav>   
<div class='logo'>
<img src='loreal.png'>
</div>
<nav class='products-menu '>
    <ul>
        <li class="product-card">
            
                <img src='lorealcompact.jpeg' alt='Compact'>
                <span>Compact<br>Rs.450<br></span>
                <button onclick="return addToCart('lorealcompact');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealcompact'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lorealfoundation.jpeg' alt='Toner'>
                <span>Foundation<br>Rs.250<br></span>
                <button onclick="return addToCart('lorealfoundation');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealfoundation'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='eyeline4.jpeg' alt='Kajal'>
                <span>Eyeliner<br>Rs.250<br></span>
                <button onclick="return addToCart('lorealeyeliner');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealeyeliner'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='contour.jpg' alt='Kajal'>
                <span>Contour<br>Rs.380<br></span>
                <button onclick="return addToCart('contour');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='contour'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='lipstick4.jpg' alt='EyeShadow'>
                <span>Lipstick<br>Rs.150<br></span>
                <button onclick="return addToCart('loreallipstick');">Add to Cart</button>
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='loreallipstick'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>
    <ul>
        <li class="product-card">
            
                <img src='kajal4.jpg' alt='Compact'>
                <span>Kajal<br>Rs.90<br></span>
                <button onclick="return addToCart('lorealkajal');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealkajal'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
        <li class="product-card">
            
                <img src='serum.jpg' alt='EyeShadow'>
                <span>Serum<br>Rs.250<br></span>
                <button onclick="return addToCart('serum');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='serum'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='blush4.jpg' alt='Toner'>
                <span>Blush<br>Rs.250<br></span>
                <button onclick="return addToCart('lorealblush');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealblush'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='highlighter4.jpeg' alt='Kajal'>
                <span>Highlighter<br>Rs.650<br></span>
                <button onclick="return addToCart('lorealhighlighter');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealhighlighter'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>

        <li class="product-card">
            
                <img src='brush.jpeg' alt='EyeShadow'>
                <span>Brush<br>Rs.300<br></span>
                <button onclick="return addToCart('lorealbrush');">Add to Cart</button>
            
            <form action='buy.php' method='post'>
                <input type='hidden' name='pro' value='lorealbrush'>
                <button type='submit' name='but'>BUY NOW</button>
            </form>
        </li>
    </ul>
</nav>   
</body>
</html>
