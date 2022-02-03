<?php
$conn= mysqli_connect('localhost', 'root', '', 'carrental');
if (!$conn) {
    die('Connection error : ' . mysqli_connect_error());
}
$table='CREATE TABLE IF NOT EXISTS `car` (
    `booking_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `rent_date` date NOT NULL,
    `no_of_seat` varchar(50) NOT NULL,
    `rent_rate` varchar(20) NOT NULL,
     `car` varchar(20) NOT NULL,
      `name` varchar(20) NOT NULL
  )';
  $create_table = mysqli_query($conn, $table);

  if(isset($_POST['add'])) {
    $err_msg .= (empty('$_POST[rdate]')) ? '<p>Please select  Date</p>' : '';
    $err_msg .= (empty('$_POST[seat]')) ? '<p>Please enter  No. of seat</p>' : '';
    $err_msg .= (empty('$_POST[rate]')) ? '<p>Please enter  Rate</p>' : '';
    $err_msg .= (empty('$_POST[car]')) ? '<p>Please enter  name of car</p>' : '';
    $err_msg .= (empty('$_POST[name]')) ? '<p>Please enter  name of person</p>' : '';


    if (strlen($err_msg) == 0) {
    $sql="insert into car(rent_date,no_of_seat,rent_rate,car,name) values ('$_POST[rdate]','$_POST[seat]','$_POST[rate]','$_POST[car]','$_POST[name]')";
    $result= mysqli_query($conn, $sql);
    if($result) {
        echo "<script>alert('Details Added Successfully')</script>";
        echo "<script>window.location.href=window.location.href</script>";    
    } 
  }   
}
  ?>
  <html>
    <head>
       <title>Car Rental System</title>
       <style type="text/css">
      th {
        text-align: left;
    }
    </style>
    </head>
    <body>
        <center>
        <form method="post" action="">
        <table>
          <tr>
             <th><h1 align="center">Add New Car Rental Details</h1></th>
           </tr>
            <tr>
              <th>Name of Person</th>
              <td><input Type="text" name="name"></td>
            </tr>
             <tr>
              <th>Name of Car</th>
              <td><input Type="text" name="car"></td>
            </tr>
            <tr>
              <th>Rent Date</th>
              <td><input Type="date" name="rdate"></td>
            </tr>
            <tr>
              <th>No. of seat</th>
              <td><input Type="text" name="seat"></td>
            </tr>
            <tr>
              <th>Rate</th>
              <td><input Type="text" name="rate"></td>
            </tr>
            <tr>
                        <th colspan="2" style="text-align: center;">
                            <input type="submit" value="Add" name="add">
                        </th>
                    </tr>
                </table>
            </form>
            <br><br>
            <form method="post">
                <b>Search  using date:</b>
                <input type="date" name="rdate">
                <input type="submit" name="search" value="Search">
            </form>
            <?php if (isset($_POST['search'])) {
            ?>
            <h1 align="center"> Rental Details</h1>
            <table border="1">
                <?php
                        $sql1="select * from car where rent_date='$_POST[rdate]'";
                        $res= mysqli_query($conn, $sql1);
                        ?>  
                <tr>
                    <th>Name Of Car</th>
                    <th>Name Of Person</th>

                    <th>Booking Id</th>
                    <th>Rent Date</th>
                    <th>No. Of Seat</th>
                    <th>Rate</th>
                </tr>
                <?php 
                while($row=mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td><?php echo $row['car']?></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['booking_id']?></td>
                        <td><?php echo $row['rent_date']?></td>
                        <td><?php echo $row['no_of_seat']?></td>
                        <td><?php echo $row['rent_rate']?></td>
                    </tr>
                    <?php
                }
            }
                ?>
            </table>
        </body>
</html>