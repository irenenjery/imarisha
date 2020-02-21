<?php require 'connectdb-controller.php'; ?> 

<?php 
$sql = 'SELECT * FROM member_temp';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '{"name": ' . $row["username"] . 
        		 ', "email": ' . $row["email"] . 
        		 '}<br>';
    }
} else {
    echo "0 results";
}

?>