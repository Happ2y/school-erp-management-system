<?php include("./config.php") ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | ERP Model</title>
        <link rel="stylesheet" href="./assets/css/base-styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

<body>
    <div class="container-fluid text-center">

        <?php include("./includes/header.php") ?>

        <div class="wrapper mt-4 mb-5">
            <div id="carousel-update" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#carousel-update" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-update" data-slide-to="1"></li>
                    <li data-target="#carousel-update" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/vendor/slideshow-img-1.jpg" alt="School Preview">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-update" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel-update" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <div class="announcements">
                <div class="text-center">
                    <p>ANNOUNCEMENTS</p>
                </div>
                <ul id="notice" class="text-center p-3">
                    <?php
                    $announcements_query = "SELECT * FROM announcements WHERE active = 1 ORDER BY announcement_id ASC";
                    $response = mysqli_query($conn, $announcements_query);
                    $announcements_details = mysqli_fetch_all($response, MYSQLI_ASSOC);

                    for ($i = 0; $i < sizeof($announcements_details); $i++) {
                        $title = ucwords($announcements_details[$i]["title"]);
                        $descr = $announcements_details[$i]["descr"];
                        $resource = $announcements_details[$i]["resource"];
                        echo "
                            <li class='news-item'>
                                <p class='font-weight-bold'>$title</p>
                                <p>$descr</p>
                                <a href='$resource'>$resource</a>
                            </li>
                            <hr>
                        ";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <br>

        <div class="service-container" id="our-services">
            <h1>Our Services</h1>
            <div class="services">
                <div class="service">
                    <img src="./assets/vendor/slideshow-img-1.jpg" class="img-responsive service-img" alt="">
                    <div class="service-text p-4">
                        <h4>Service Text</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis maiores, vitae quasi magni iusto natus inventore nam ipsam harum saepe dolores autem aut reiciendis nemo nesciunt, accusantium, facere rem ipsum!</p>
                    </div>
                </div>
                <div class="service">
                    <img src="./assets/vendor/slideshow-img-1.jpg" class="img-responsive service-img" alt="">
                    <div class="service-text p-4">
                        <h4>Service Text</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis maiores, vitae quasi magni iusto natus inventore nam ipsam harum saepe dolores autem aut reiciendis nemo nesciunt, accusantium, facere rem ipsum!</p>
                    </div>
                </div>
                <div class="service">
                    <img src="./assets/vendor/slideshow-img-1.jpg" class="img-responsive service-img" alt="">
                    <div class="service-text p-4">
                        <h4>Service Text</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis maiores, vitae quasi magni iusto natus inventore nam ipsam harum saepe dolores autem aut reiciendis nemo nesciunt, accusantium, facere rem ipsum!</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row p-3" id="about-us">
            <div class="col-sx-1"></div>
            <div class="col-xs-10 content pl-4">
                <p style="text-align: justify;"><i>“A computer would deserve to be called intelligent if it could deceive a human into believing that it was
                        human.” ~ Alan Turing</i></p>
                <p style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non ab mollitia voluptas deleniti dolorum ipsum distinctio quis deserunt, tempore voluptatum. Labore enim molestias impedit, deleniti quaerat maiores deserunt cum iure.</p>
                <p style="text-align: justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non ab mollitia voluptas deleniti dolorum ipsum distinctio quis deserunt, tempore voluptatum. Labore enim molestias impedit, deleniti quaerat maiores deserunt cum iure.</p>
                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus iste sequi ea in, nam impedit quis reiciendis sed perspiciatis animi fuga voluptate minima cupiditate nisi voluptatem ut culpa accusantium! Sequi in quae fugiat tempore. Deserunt, ut adipisci ipsum quidem ipsam sed ab voluptates, animi dignissimos tempora saepe veniam mollitia corporis?</p>
                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus iste sequi ea in, nam impedit quis reiciendis sed perspiciatis animi fuga voluptate minima cupiditate nisi voluptatem ut culpa accusantium! Sequi in quae fugiat tempore. Deserunt, ut adipisci ipsum quidem ipsam sed ab voluptates, animi dignissimos tempora saepe veniam mollitia corporis?</p>
                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus iste sequi ea in, nam impedit quis reiciendis sed perspiciatis animi fuga voluptate minima cupiditate nisi voluptatem ut culpa accusantium! Sequi in quae fugiat tempore. Deserunt, ut adipisci ipsum quidem ipsam sed ab voluptates, animi dignissimos tempora saepe veniam mollitia corporis?</p>
                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, maiores rem magnam sint quibusdam fugit labore quod error, ipsa beatae atque minus consequatur. Ipsam pariatur recusandae vero suscipit totam, sapiente impedit ut ex necessitatibus harum labore debitis non dolores nobis nulla tempora exercitationem minus, illo distinctio? Vitae suscipit expedita quas?</p>
                <p><b>Mr. Swaraj Kumar Chaudhary<br>Head of Organization<br>swarajkumarchaudhary1729@gmail.com</b></p>

                </b>
            </div>
        </div>

        <?php include("./includes/footer.php") ?>
    </div>
    </div>

    </div>
</body>

</html>