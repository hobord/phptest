<?php
echo "<p>Hello ". getenv('PLAYER')."!</p>";

echo "<h2>NFS mount test</h2>";

if ($handle = opendir('./nfs_mount_point')) {
    echo "<h3>./nfs_mount_point/</h3>";
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "$entry<br>";
        }
    }
    closedir($handle);
}


echo "<h2>DB connection test</h2>";

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, name FROM brands";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

echo "<h2>Phpinfo</h2>";

phpinfo();
