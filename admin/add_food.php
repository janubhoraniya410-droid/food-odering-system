<?php include("sidebar.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Item</title>

    <style>

    #content{
         margin-left: 500px;
      } 

    form {
           padding: 30px;
            
            margin-bottom: 20;
            background: #f8f9fa;
            height: 60%;
             width: 600;
            /* Center Content */
            display: flex;
            flex-direction: column;
            align-items: center;
    }
    form h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }
    button {
        margin-top: 20px;
        background: #28a745;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background: #218838;
    }
    h1{
        disply : center;
    }

     h1 {
    text-align: center;
    margin-bottom: 25px;
    margin-top:20;
    font-size: 26px;
    font-weight: bold;
    color: #fff;
    background: #132537ff;   
    padding: 12px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

    
    </style>
</head>
<body>

<div id='content'>

<h1>Add Food Item</h1>

    <form action="addfood_code.php" method="post" enctype="multipart/form-data">
        

        <label>Category</label>
        <select name="cid" required>
            <option value="">Choose category</option>
            <?php
                $query = "SELECT * FROM category";
                $rs = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($rs)) {
                    echo "<option value='".$row['cid']."'>".$row['cname']."</option>";
                }
            ?>
        </select>

        <label>Item Name :</label>
        <input type="text" name="name" required />

        <label>Description :</label>
        <input type="text" name="des" required />

        <label>Item Image :</label>
        <input type="file" class="form-control" name="image" required />

        <label>Price :</label>
        <input type="text" name="price" required />

        <label>Not Available</label>
        <input type="checkbox" name="not_available" /> Check if not available

        <button type="submit" name="add_btn">Submit</button>
    </form>
            </div>
</body>
</html>
