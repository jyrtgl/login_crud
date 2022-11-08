<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

    <meta username="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Users List</title>
</head>
<body>
  <?php
    require_once "userslist_function.php";
  ?>
  <?php
    $result=$db->query("SELECT * FROM users")or die($db->error);
  ?>
  <?php
    if(isset($_POST['search'])){
            $search = $_POST['search'];
            $result=$db->query("SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%'") or die ($db ->error());
        }
  ?>
  <!-- Search -->
  <nav class="navbar navbar-dark bg-light">
    <h3><a href="index.php"><i class="fa fa-home">&nbsp;&nbsp;</i>USER LIST</a></h3>
    <form action="userslist.php" method="post">
          <div class="form-group">
            <input type="text" placeholder="Search" name="search" value="<?php echo $search; ?>">
            <button type="submit"><i class="fa fa-search"></i></button><br>
          </div>
    </form>
  </nav><br>
  <!-- End Search -->
  <!-- Input -->
  <div class="row justify-content-center">
  <form action="userslist_function.php" method="post">
    <?php if($update==true){?>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <label>Username: </label>&nbsp;&nbsp;&nbsp;<input type="text" name="username" required value="<?php echo $username; ?>"><br>
      <label>Email: </label>&nbsp;&nbsp;&nbsp;<input type="email" name="email" required value="<?php echo $email; ?>"><br>
      <label>Password: </label>&nbsp;&nbsp;&nbsp;<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[^\w])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters" required><br>
      <button type="submit" name="update" class="btn btn-warning">Update</button>
    <?php } ?>
      </div>
  </form><br>
  </div>
  <!-- End of Input -->
    <!-- SESSION -->
    <div class="d-flex justify-content-center">
    <?php
    if(isset($_SESSION['message'])){?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
    <?php } ?>
    </div>
  </div><br>
    <!-- End of SESSION -->
  <!-- TABLE -->
  <table class="table">
    <thread>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th colspan="3">Actions</th>
      </tr>
    </thread>
      <?php
        if($result->num_rows>0){  
              while($row=$result->fetch_assoc()){?>
    <tr>
      <?php $rowcount=$rowcount+1; ?>
        <td><?php echo $row['username'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['password'];?></td>
        <td>
                <a href="userslist.php?edit=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
                <a href="userslist_function.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
            </td>
      </tr>
        <?php } ?>
        <?php }else{ ?>
            <h1>SORRY NO RESULT!</h1>
        <?php } ?>
  </table>
<!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>