<?php
$db = new PDO("mysql:host=localhost;dbname=form-wizard","root","");
if(isset($_POST['save'])){
    $id = uniqid();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sites = $_POST['sites'];
    $category = $_POST['category'];
    $stat1 = $db->prepare("insert into about values(?,?,?,?,?)");
    $stat1->bindParam(1, $id);
    $stat1->bindParam(2, $name);
    $stat1->bindParam(3, $email);
    $stat1->bindParam(4, $phone);
    $stat1->bindParam(5, $address);
    $stat1->execute();
    $stat2 = $db->prepare("insert into account values(?,?,?)");
    $stat2->bindParam(1, $id);
    $stat2->bindParam(2, $username);
    $stat2->bindParam(3, $password);
    $stat2->execute();
    $stat3 = $db->prepare("insert into website values(?,?,?,?,?)");
    $stat3->bindParam(1, $id);
    $stat3->bindParam(2, $title);
    $stat3->bindParam(3, $description);
    $stat3->bindParam(4, $sites);
    $stat3->bindParam(5, $category);
    $stat3->execute();
    header('Location: save.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Form Wizard with jQuery and PHP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    
    <div class="container-fluid">
        <p><br/></p>
        <h3>Data Manager</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Website</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $db->prepare("select a.id, a.name, a.email, a.phone, a.address, b.username, c.title, c.description, c.website, c.category from about a, account b, website c where a.id=b.id and a.id=c.id and b.id=c.id");
                $stmt->execute();
                while($row = $stmt->fetch()){
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['website'] ?></td>
                    <td><?php echo $row['category'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <p class="text-center">
            <br/>
            <a href="index.html" class="btn btn-primary">Back to homepage</a>
        </p>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>