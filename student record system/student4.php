<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Student record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <form method="POST" action="edit_student.php">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        First Name: <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>" required><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>
        Phone: <input type="text" name="phone" value="<?php echo $student['phone']; ?>"><br>
        <input type="submit" value="Update Student">
    </form>
</body>
</html>
