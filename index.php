<?php
require_once "config.php";

// Initialize variables
$name = $comments = "";
$name_err = $comments_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }
    
    // Validate comments
    $input_comments = trim($_POST["comments"]);
    if (empty($input_comments)) {
        $comments_err = "Please enter comments.";     
    } else {
        $comments = $input_comments;
    }
    
    // Check input errors before inserting in database
    if (empty($name_err) && empty($comments_err)) {
        $sql = "INSERT INTO test_info (name, comments) VALUES (?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $param_name, $param_comments);
            
            // Set parameters
            $param_name = $name;
            $param_comments = $comments;
            
            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devops |CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .wrapper {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            background-color: #fff;
        }
        .table-responsive {
            margin-top: 30px;
        }
        .btn-custom {
            margin: 5px;
            border-radius: 20px;
            padding: 5px 15px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-edit {
            background-color: #4e73df;
            color: white;
        }
        .btn-delete {
            background-color: #e74a3b;
            color: white;
        }
        .btn-edit:hover, .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        .page-header {
            color: #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #4e73df;
        }
    </style>
</head>
<body style="background-color: #f8f9fc;">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2><i class="bi bi-journal-text"></i> Create New Entry</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group mb-4">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control <?php echo (!empty($comments_err)) ? 'is-invalid' : ''; ?>"><?php echo $comments; ?></textarea>
                            <span class="invalid-feedback"><?php echo $comments_err;?></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Comments</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include config file
                        require_once "config.php";
                        
                        // Attempt select query execution
                        $sql = "SELECT * FROM test_info ORDER BY created_at DESC";
                        if($result = $conn->query($sql)){
                            if($result->num_rows > 0){
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['comments'] . "</td>";
                                        echo "<td>" . $row['created_at'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="btn btn-sm btn-info btn-custom" title="View Record"><i class="bi bi-eye"></i></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="btn btn-sm btn-warning btn-custom" title="Update Record"><i class="bi bi-pencil"></i></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" class="btn btn-sm btn-danger btn-custom" title="Delete Record" onclick="return confirm(\'Are you sure you want to delete this record?\')"><i class="bi bi-trash"></i></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                // Free result set
                                $result->free();
                            } else{
                                echo "<tr><td colspan='5' class='text-center'><em>No records were found.</em></td></tr>";
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        
                        // Close connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
