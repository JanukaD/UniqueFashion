<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `products` WHERE CONCAT(`Product_name`, `Product_price`, `Product_type`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `products` LIMIT 50";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "unique_fashions");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Details | Unique Fashions</title>
		<link href="./styles/mainstyle.css" rel="stylesheet" type="text/css" >
		<link href="./styles/style.css" rel="stylesheet" type="text/css" >
		<style>
			table, th, td {
                border: 0.1px solid black;
				width:800px;
			} 
		</style>
	</head>
    <body>
        <div class="container">

			<div class="header" style="background-image:url(Images/f2.jpg)";>
				<h1>Unique Fashions</h1>
				<img class="img" src="Images/fashion.png">
				<img class="img1" src="Images/fashion.png">
			</div>

			<div class="nav" style="background-image:url(Images/f1.jpg)";>
				<h2>"Style is a way to say who you are without having to speak."</h2>
				<h3>Welcome to the Unique Fashions!!! <a href="Admin index.php" style="text-decoration: none";>(Sign Out)</a></h3>
			</div>
			
			<div class="lnav" style="background-image:url(Images/f4.jpg)";>
				<button class="button">Categories</button>
      
				<ul>
					<li>
						<a href="Admin Page.php">Add Products</a>
					</li><br><br><br>
			
					<li>
						<a href="Update.php">Update Products</a>
					</li><br><br><br>

					<li>
						<a href="Delete.php">Delete Products</a>
					</li><br><br><br>
			
					<li>
						<a href="Details.php">Products Details</a>
					</li><br><br><br>
					
					<li>
						<a href="Feedbackview.php">Feedback Details</a>
					</li><br><br><br>
				</ul>

				<br><br><br>
				<img class="img2" src="Images/details.png">
			</div>
			
			<div class="cont" style="background-image:url(Images/f5.jpg);background-size:cover";>
				<br>
				
        <form action="Details.php" method="post" align = "center">
            <input type="text" name="valueToSearch" placeholder="Product Type To Search"><br><br>
            <input type="submit" name="search" value="Filter">
             <a href="details.php"> Back</a><br><br>
            
            <table align = "center">
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Type</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['Product_name'];?></td>
                    <td><?php echo $row['Product_price'];?></td>
                    <td><?php echo $row['Product_type'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
					</div>
		</div>
    </body>
</html>