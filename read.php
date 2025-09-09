<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM test_info WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $comments = $row["comments"];
                $created_at = $row["created_at"];
                $updated_at = $row["updated_at"];
            } else{
                // URL doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .wrapper{
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            background-color: #fff;
        }
        .page-header{
            color: #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #4e73df;
        }
        .detail-item{
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #f8f9fc;
        }
        .detail-label{
            font-weight: 600;
            color: #4e73df;
        }
    </style>
</head>
<body style="background-color: #f8f9fc;">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2><i class="bi bi-eye"></i> View Record</h2>
                    </div>
                    <div class="detail-item">
                        <div class="mb-3">
                            <span class="detail-label">ID:</span>
                            <p class="mb-0"><?php echo trim($_GET["id"]); ?></p>
                        </div>
                        <div class="mb-3">
                            <span class="detail-label">Name:</span>
                            <p class="mb-0"><?php echo $name; ?></p>
                        </div>
                        <div class="mb-3">
                            <span class="detail-label">Comments:</span>
                            <p class="mb-0"><?php echo nl2br($comments); ?></p>
                        </div>
                        <div class="mb-3">
                            <span class="detail-label">Created At:</span>
                            <p class="mb-0"><?php echo $created_at; ?></p>
                        </div>
                        <div class="mb-3">
                            <span class="detail-label">Last Updated:</span>
                            <p class="mb-0"><?php echo $updated_at; ?></p>
                        </div>
                    </div>
                    <p>
                        <a href="index.php" class="btn btn-primary">Back</a>
                        <a href="update.php?id=<?php echo $_GET['id']; ?>" class="btn btn-warning">Edit</a>
                    </p>
                </div>
            </div>        
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
