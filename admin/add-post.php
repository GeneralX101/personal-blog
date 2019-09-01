<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $cat = $_POST['selectcat'];
        $description = $_POST['description'];

        $sql = "INSERT INTO posts(title,category,description) VALUES(:title,:cat,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog posted successfully')</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - Admin</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    </head>

    <body id="page-top">
        <div id="wrapper">

            <!-- sidebar -->
            <?php include 'includes/sidebar.php'; ?>

            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">

                    <!-- header -->
                    <?php include 'includes/header.php'; ?>

                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Add a Post</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <div class="row mb-3 d-none">
                                    <div class="col">
                                        <div class="card text-white bg-primary shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Performance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-success shadow">
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="m-0">Performance</p>
                                                        <p class="m-0"><strong>65.2%</strong></p>
                                                    </div>
                                                    <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                                </div>
                                                <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                                                                                                  since
                                                                                                                  last
                                                                                                                  month
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Add a post</p>
                                            </div>
                                            <div class="card-body">
                                                <form>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group"><label
                                                                        for="title"><strong>Title</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="Enter title" name="title" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <label for="selectcat"><strong>Select
                                                                                           Category</strong></label>
                                                            <select class="form-control" name="selectcat" required>
                                                                <option value="">-- Select --</option>
                                                                <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                                                $query = $dbh->prepare($ret);
                                                                //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $result) {
                                                                        ?>
                                                                        <option value="<?php echo htmlentities($result->id); ?>">
                                                                            <?php echo htmlentities($result->catname); ?>
                                                                        </option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <label for="exampleFormControlFile1">Insert image</label>
                                                            <input type="file" class="form-control-file"
                                                                   id="exampleFormControlFile1">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group"><label for="signature"><strong>Description</strong><br></label><textarea
                                                                            class="form-control" rows="4"
                                                                            name="signature" required></textarea></div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary btn-sm" type="submit"
                                                                            name="submit">Post
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Add a post</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data">

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group"><label
                                                                        for="title"><strong>Title</strong></label><input
                                                                        class="form-control" type="text"
                                                                        placeholder="Enter Title" name="title" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="selectcat"><strong>Select Category</strong></label>
                                                                <div class="">
                                                                    <select class="form-control" name="selectcat"
                                                                            required>
                                                                        <option value="">-- Select --</option>
                                                                        <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                                                        $query = $dbh->prepare($ret);
                                                                        //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                                                        $query->execute();
                                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                        if ($query->rowCount() > 0) {
                                                                            foreach ($results as $result) {
                                                                                ?>
                                                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                                                    <?php echo htmlentities($result->catname); ?>
                                                                                </option>
                                                                            <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group" style="width: 564px;"><label
                                                                        for="signature"><strong>Description</strong><br></label><textarea
                                                                        class="form-control form-control-lg" rows="4"
                                                                        name="description"
                                                                        style="height: 300px;" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="submit"
                                                                        name="submit">
                                                                    Post
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="card shadow"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">


                            </div>
                        </div>
                        <div class="card shadow mb-5"></div>
                    </div>
                </div>

                <!-- Footer -->
                <?php include 'includes/footer.php'; ?>

            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-charts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="assets/js/theme.js"></script>
    </body>

    </html>
<?php } ?>