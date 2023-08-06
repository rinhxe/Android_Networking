<?php
// Establish a connection to the MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'du_an_1';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve Data (Read)
if ($_SERVER["REQUEST_METHOD"] === "GET" && strpos($_SERVER['REQUEST_URI'], "api.php/get") !== false) {
    $query = "SELECT * FROM room";
    $result = $conn->query($query);

    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

// Add Data (Create)
if (strpos($_SERVER['REQUEST_URI'], "api.php/add") !== false) {
    if (
        isset($_GET["roomName"]) && 
        isset($_GET["kindOfRoomId"]) && 
        isset($_GET["status"]) 
   
    ) {
        $roomName =isset($_GET['roomName']) ? $_GET['roomName'] : '';
        $kindOfRoomId = isset($_GET['kindOfRoomId']) ? $_GET['kindOfRoomId'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        
        
        // Kiểm tra xem dữ liệu đã tồn tại trong cơ sở dữ liệu chưa
        $checkQuery = "SELECT COUNT(*) FROM room WHERE name_room = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->bind_param("i", $roomName);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count == 0) {
            $insertQuery = "INSERT INTO room (name_room, kind_of_room_id, status) VALUES ('$roomName', '$kindOfRoomId', '$status')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Dữ liệu đã tồn tại";
        }
    } else {
        echo "Dữ liệu truyền vào thiếu";
    
    }
}

// Update Data (Update)
if (strpos($_SERVER['REQUEST_URI'], "api.php/update") !== false) {
    if (
        isset($_GET["roomId"]) && 
        isset($_GET["roomName"]) && 
        isset($_GET["kindOfRoomId"]) && 
        isset($_GET["status"]) 
   
    ) {
        $room_id = isset($_GET['roomId']) ? $_GET['roomId'] : '';
        $roomName =isset($_GET['roomName']) ? $_GET['roomName'] : '';
        $kindOfRoomId = isset($_GET['kindOfRoomId']) ? $_GET['kindOfRoomId'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        
        
        // Kiểm tra xem dữ liệu đã tồn tại trong cơ sở dữ liệu chưa
        $checkQuery = "SELECT COUNT(*) FROM room WHERE name_room = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->bind_param("i", $roomName);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count != 0) {
            $updateQuery = "UPDATE room SET name_room='$roomName', kind_of_room_id='$kindOfRoomId', status=$status' WHERE room_id='$roomId'";
            if ($conn->query($insertQuery) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Dữ liệu chưa tồn tại";
        }
    } else {
        echo "Dữ liệu truyền vào thiếu";
    
    }
}

// Delete Data (Delete)
if (strpos($_SERVER['REQUEST_URI'], "api.php/delete") !== false) {
    // Delete Data (Delete)
    $room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';

    if (!empty($room_id)) {
        // Check if the room exists before attempting to delete
        $checkQuery = "SELECT * FROM room WHERE room_id = $room_id";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // The room exists, proceed with the deletion
            $deleteQuery = "DELETE FROM room WHERE room_id = $room_id";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Xóa dữ liệu thành công";
            } else {
                echo "Lỗi xóa dữ liệu: " . $conn->error;
            }
        } else {
            echo "Phòng không tồn tại";
        }
    } else {
        echo "Vui lòng cung cấp room_id để xóa dữ liệu";
    }
}

// Close the database connection
$conn->close();
?>