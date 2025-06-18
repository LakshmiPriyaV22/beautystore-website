<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #ffe3ec, #e0c3fc);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 60px auto;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 50px 40px;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .checkmark {
            font-size: 60px;
            color: #22c55e;
            margin-bottom: 20px;
        }

        h1 {
            color: #b620e0;
            margin-bottom: 10px;
            font-size: 32px;
        }

        p {
            font-size: 18px;
            color: #444;
            margin: 10px 0 30px;
        }

        .highlight {
            color: #9333ea;
            font-weight: 600;
        }

        form {
            margin-top: 20px;
        }

        input[type='submit'] {
            background: linear-gradient(to right, #d946ef, #9333ea);
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type='submit']:hover {
            background: linear-gradient(to right, #7e22ce, #c026d3);
        }

        .back-link {
            display: block;
            margin-top: 20px;
            font-size: 16px;
            color: #6b21a8;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="checkmark">
        <i class="fas fa-check-circle"></i>
    </div>
    <h1>Order Confirmed!</h1>
    <p>Thank you, <span class="highlight"><?php echo $_SESSION['user']; ?></span>, your order has been placed successfully.</p>
    <p>Your beauty products are on their way to you! 💄</p>

    <form action="menu.php" method="post">
        <input type="submit" value="Continue Shopping">
    </form>

    <a class="back-link" href="cart.php">View Your Order Summary</a>
</div>

</body>
</html>





<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$da=date("y-m-d");
$con = mysqli_connect($server, $user, $pass, $db);
if (!$con) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$na=$_SESSION['user'];
$qa = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0; 
$pro = isset($_POST['product']) ? htmlspecialchars($_POST['product'], ENT_QUOTES, 'UTF-8') : '';
$sql = "SELECT * FROM products WHERE name = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $pro);
    $stmt->execute();
    $result = $stmt->get_result();
$user = $_SESSION['user'];
$payment = $_POST['pay'];  // 'cod' or 'online'

// Assuming you already fetched cart details


    if ($row = $result->fetch_assoc()) {
        $qu = (int)$row['quantity'];
        if ($qa > $qu) {
            echo "<p style='color: red;'>Error: Insufficient stock. Available quantity: " . $qu . "</p>";
        } else {
            $pr = $row['name'];
            $q = (int)$row['quantity'];
            $p = (float)$row['price'];
        $a = $qa * $p;
            $quans = $qu - $qa;
            $sql2 = "UPDATE products SET quantity = ? WHERE name = ?";
            $sql0="INSERT INTO `makeup`.`orders` (`user`, `product`, `price`, `quantity`, `amount`,`date`,`payment_type`) VALUES ('$na', '$pr', '$p', '$qa', '$a','$da','$payment');";
                                                                 mysqli_query($con,$sql0);
            $stmt2 = $con->prepare($sql2);
            if ($stmt2) {
                $stmt2->bind_param("is", $quans, $pro);
                if ($stmt2->execute()) {
                    echo"";
                } else {
                    echo "<p style='color: red;'>Error: Could not update stock.</p>";
                }
                $stmt2->close();
            } else {
                echo "<p style='color: red;'>Error preparing update query.</p>";
            }
        }

}
    $result->free();
    $stmt->close();
} else {
    echo "<p style='color: red;'>Error preparing query: " . $con->error . "</p>";
}
$con->close();
if (isset($_POST['gi'])) {
    $server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";

$con = mysqli_connect($server, $user, $pass, $db);
if (!$con) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$payment = $_POST['pay'];
$na= $_SESSION['user'];
	$sql30="SELECT *FROM `cart` WHERE `user`='$na'";
	$ts=0;
	$a=0;
	if($res=mysqli_query($con,$sql30))
	{
		if(mysqli_num_rows($res)>0)
		{
			while($row=mysqli_fetch_array($res))
			{
				$pr=$row['product'];
				$q=$row['quantity'];
				$p=$row['price'];
				$a=$q*$p;
				$sql1="SELECT * FROM products WHERE name='$pr'";
				if($res1=mysqli_query($con,$sql1))
	     			{
					if(mysqli_num_rows($res1)>0)
					{
						while($row1=mysqli_fetch_array($res1))
						{
					     		$ppr=$row1['quantity'];
							$qa1=$ppr-$q;
							$sq12 = "UPDATE products SET quantity = '$qa1' WHERE name = '$pr' AND quantity = '$ppr';";
							if(mysqli_query($con,$sq12))
							{
								$ts=$ts+$a;
								$sql5="INSERT INTO `makeup`.`orders` (`user`, `product`, `price`, `quantity`, `amount`,`date`,`payment_type`) VALUES('$na', '$pr', '$p', '$q', '$a','$da','$payment');";
                                                                 if(mysqli_query($con,$sql5))
								{
								}
								else
								{
		
								}      				
							}
							else
							{
								echo "";
							}	
						}
	
					}
			   	}

			}
	    }
        else    
        {
            echo "";
        }
 

	}
    $sql4="DELETE FROM cart WHERE user='$na';";
	        if(mysqli_query($con,$sql4))
	        {
			echo "";
		}
		else
		{
			echo "";
		}
	}



?>

