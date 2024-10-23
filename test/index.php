<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">PHP Example</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <a class="nav-link" href="connect.php">Connect MySQL</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-3">
        <nav class="alert alert-primary" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Index</li>
            </ol>
        </nav>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <img src="images/laravel.png" class="card-img-top" alt="Laravel Programming">
                    <div class="card-body">
                        <h5 class="card-title">Laravel Programming</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="images/dot-net.png" class="card-img-top" alt=".NET Programming">
                    <div class="card-body">
                        <h5 class="card-title">.NET Programming</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="images/spring-boot.png" class="card-img-top" alt="Spring Boot Programming">
                    <div class="card-body">
                        <h5 class="card-title">Spring Boot Programming</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="images/angular.png" class="card-img-top" alt="Angular Programming">
                    <div class="card-body">
                        <h5 class="card-title">Angular Programming</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        session_start();

        // Hàm lấy danh sách khóa học từ database
        function getCourses() {
            if (isset($_SESSION['server']) && isset($_SESSION['database']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
                try {
                    $conn = new mysqli(
                        $_SESSION['server'],
                        $_SESSION['username'],
                        $_SESSION['password'],
                        $_SESSION['database']
                    );

                    if ($conn->connect_error) {
                        throw new Exception("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM Course";
                    $result = $conn->query($sql);
                    
                    $courses = [];
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $courses[] = $row;
                        }
                    }

                    $conn->close();
                    return $courses;

                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    return [];
                }
            } else {
                echo '<div class="alert alert-warning">Please connect to database first at <a href="connect.php">connect page</a></div>';
                return [];
            }
        }

        // Xử lý ghi file
        if (isset($_POST['submit'])) {
            $filename = $_POST['filename'];
            if (empty($filename)) {
                echo '<div class="alert alert-danger">Please enter a filename</div>';
            } else {
                // Lấy danh sách khóa học để ghi vào file
                $courses = getCourses();
                
                // Chuyển mảng courses thành chuỗi JSON
                $content = json_encode($courses, JSON_PRETTY_PRINT);
                
                // Thêm đuôi .txt nếu chưa có
                if (!str_ends_with($filename, '.txt')) {
                    $filename .= '.txt';
                }

                // Ghi file
                try {
                    if (file_put_contents($filename, $content) !== false) {
                        echo '<div class="alert alert-success">File written successfully!</div>';
                    } else {
                        throw new Exception("Error writing file");
                    }
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                }
            }
        }

        // Lấy danh sách khóa học để hiển thị
        $courses = getCourses();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Phần head giữ nguyên -->
        </head>
        <body>
            <!-- Phần header giữ nguyên -->

            <div class="container my-3">
                <!-- Phần breadcrumb giữ nguyên -->

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach($courses as $course): ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($course['ImageUrl']); ?>" 
                                class="card-img-top" 
                                alt="<?php echo htmlspecialchars($course['title']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($course['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <hr>
                <form class="row" method="POST">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class


                ?>
        <hr>
        <form class="row" method="POST" enctype="multipart/form-data">
            <div class="col">
                <div class="form-floating mb-3">
                    <input value="data" type="text" class="form-control" id="server" placeholder="File name" name="filename">
                    <label for="data">File name</label>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Write file</button>
            </div>
            <div class="col">
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>