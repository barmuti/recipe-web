<?php
include('connection.php');

class Inventory {
    function __construct() {
        $this->database = new ConnectionDatabase();
    }

    function getAll() {
        $query = "SELECT * FROM inventory WHERE deleted_at IS NULL";
        $data = mysqli_query($this->database->connection, $query);
        $res = [];
        while ($item = mysqli_fetch_array($data)) {
            $res[] = $item;
        }
        $this->database->closeConnection();
        return $res;
    }
    
    function show($id) {
        $query = "SELECT * FROM inventory WHERE id = ?";
        $stmt = $this->database->connection->prepare($query);
        if ($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Ambil data dalam bentuk array asosiatif
            } else {
                return null; // Tidak ada data dengan ID tersebut
            }
        } else {
            die("Error: " . $this->database->connection->error); // Debugging error SQL
        }
    }
    

    function store($user_id, $image, $name, $bahan, $cara) {
        $query = "INSERT INTO inventory (user_id, image, name, bahan, cara) VALUES (?, ?, ?, ?, ?)";
        $process = $this->database->connection->prepare($query);
        if ($process) {
            $process->bind_param('issss', $user_id, $image, $name, $bahan, $cara);
            if (!$process->execute()) {
                die('Error Query: ' . $this->database->connection->error);
            }
        } else {
            die($this->database->connection->errno . ' ' . $this->database->connection->error);
        }
        $process->close();
        $this->database->closeConnection();
        return true;
    }

    function delete($id) {
        $query = "UPDATE inventory SET deleted_at = NOW() WHERE id = ?";
        $process = $this->database->connection->prepare($query);
        if ($process) {
            $process->bind_param('i', $id);
            $process->execute();
        } else {
            die($this->database->connection->errno . ' ' . $this->database->connection->error);
        }
        $process->close();
        $this->database->closeConnection();
        return true;
    }

    function update($id, $image, $name, $bahan, $cara) {
        $query = "UPDATE inventory SET image = ?, name = ?, bahan = ?, cara = ?, updated_at = NOW() WHERE id = ?";
        $process = $this->database->connection->prepare($query);
        if ($process) {
            $process->bind_param('ssssi', $image, $name, $bahan, $cara, $id);
            if (!$process->execute()) {
                die('Error Query: ' . $this->database->connection->error);
            }
        } else {
            die($this->database->connection->errno . ' ' . $this->database->connection->error);
        }
        $process->close();
        $this->database->closeConnection();
        return true;
    }
}
