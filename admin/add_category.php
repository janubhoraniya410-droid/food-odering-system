<?php
  include('sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


        <style>

          #content{

             margin-left: 500px;

          }



            form {
            /* Leave space for sidebar */
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
          

     </style>  
</head>
<body>

<div id='content'>


   <h1>Add Category</h1>


  <form action='cat_process.php' method='post' enctype="multipart/form-data">
 
 

  Category Name : 
  <input type="text" name="cname" id="cname"  required><br><br>
  
  <label>Category Photo :</label>
  <input type="file" name="cphoto" id="cphoto" class="form-control" accept="image/*" required><br><br>
  

  <button type="submit" name="cat_btn" id="cat_btn"  required>submit</button>

  </form>

  </div>


</body>
</html>


