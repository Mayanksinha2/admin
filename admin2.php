<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- import bootstrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" /> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- import popper.js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- import javascript cdn -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- CSS stylesheet -->
    <script src="https://kit.fontawesome.com/0d6b327ba7.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style type="text/css">
        body {
            height: 100%;
        }

        #green {
            height: none;
            text-align: center;
            color: white;
        }

        a {
            text-decoration: none;
            color: red;
        }

        nav {
            height: 100px;
            width: none;
        }

        .eventname {
            text-align: center;
        }

        button {
            font-size: 16px;
        }

        .view {
            background-color: rgb(71, 156, 196);
            padding-left: 18px;
            padding-right: 18px;
        }

        .edit {
            background-color: rgb(22, 109, 10);
            padding-left: 18px;
            padding-right: 18px;
        }

        .delete {
            background-color: rgb(233, 73, 73);
            padding-left: 20px;
            padding-right: 20px;
        }

        i {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- top navbar -->
    <nav class="bg-success">
        <h1 class="text-white pt-4 text-center">Axiom Career Growth Event</h1>
    </nav>
    <!-- h-100 takes the full height of the body-->
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-2 bg-success" id="green">
                <!-- Navigation links in sidebar-->
                <a class="nav-item nav-link h3 text-white" href="#">Home</a>
            </div>
            <?php
                    $conn = mysqli_connect('localhost','root','','axiom') or die("connection Failed:" . mysqli_connect_error());

                    $limit = 4;
                    if(isset($_GET["page"])){
                        $page = $_GET["page"];  
                    }
                    else{
                        $page = 2;
                    }
                    $Offset = ($page -1) * $limit;
                    $sql = "SELECT * FROM `carrier` ORDER BY id DESC LIMIT {$Offset}, {$limit}";
                    $result = mysqli_query($conn, $sql) or die("Query Failed"); 
                     if(mysqli_num_rows($result) > 0){
             ?> 
                <!-- Contains the main content of the webpage -->
            <div class="col-10 mt-3" style="text-align: justify;">

                <table class="table table-bordered table-dark " style="width:900px;line-height:40px;">
                    <tr>
                        <th colspan="6">
                            <h2>Registered User<h2>
                        </th>
                        <th colspan="3">
                            <h2> Actions <h2>
                        </th>
                    </tr>
                    <tr>
                        <th> id </th>
                        <th> name </th>
                        <th> contact </th>
                        <th> email </th>
                        <th>collegeName </th>
                        <!--th> gender </th>-->
                        <th colspan="3"> Operation </th>

                    </tr>
                        <?php     
                            while ($row = mysqli_fetch_assoc($result)) {
                            $resultCheck = mysqli_num_rows($result);
                        ?> 
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['CollegeName']; ?></td>
                            <td><a href="view.php?id=<?PHP echo $row["id"]; ?>"><button class="view"><i class="fa-solid fa-eye"></i></button></a></td>
                            <td><a href="demo.php?id=<?php echo $row["id"]; ?>"><button class="edit"><i class="fa-solid fa-pen-to-square"></i></button></a></td>
                            <td><a href="delete_user.php?id=<?php echo $row["id"]; ?>"><button class="delete"><i class="fa-solid fa-trash-can"></i></button></a></td>
                        </tr>
                    
                
                    <?php
                    }
                     ?>
                </table>
                <?php 
                } 
                  $sql1 = "SELECT * FROM `carrier`";
                  $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                  if(mysqli_num_rows($result1) > 0){

                      $total_records = mysqli_num_rows($result1);
                      $total_page = ceil($total_records / $limit);

                      echo '<ul class="pagination admin-pagination">';
                      for($i = 1; $i <= $total_page; $i++){
                          if($i == $page){
                              $active = "active";
                          }
                          else{
                              $active = "";
                          }

                          echo '<li class="'.$active.' page-item"><a class="page-link" herf="admin2.php?page='.$i.'" >'.$i.'</a></li>';
                      }
                      echo '</ul>';
                  }
                ?>
            </div>  
        </div>      
    </div>  
 
</body>
</html>