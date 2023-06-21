<?php
include 'submit.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Notch Transit</title>

    <link rel="shortcut icon" href="./img/logo.jpg">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    
    <!-- Import Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="" crossorigin="anonymous"></script>

    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Add Bootstrap JavaScript and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- Add custom JavaScript -->
    <script src="scripts/scripts.js" defer></script>
    <script type="module" src="./scripts/firebase.js"></script>
    <script src="https://kit.fontawesome.com/0fc7af2ffc.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="clearfix"></header>
    <main>
        <section id="careers" class="d-flex text-center text-white row">
            <div id="myTopNav" class="container" style="height: fit-content;">
                <nav class="navbar navbar-expand-lg navbar-expand-sm navbar-top  navbar-fixed navbar-opaque">
                    <a class="navbar-brand" href="index.html"><img src="img/logo-transparent.png" style="height: 80px; padding-top: 10px; padding-bottom: 8px;" alt=""></a>
                    <div class="container nav-container">
                        <ul class="nav navbar-nav order-2 nav-no-opacity">
                            <li class="nav-item">
                                <h1 class="display-6"><a href="index.html" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>Home</span></a></h1>
                            </li>
                            <li class="nav-item">
                                <h1 class="display-6"><a href="about-us.html" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>About Us</span></a></h1>
                            </li>
                            <li class="nav-item">
                                <h1 class="display-6"><a href="services.html" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>Services</span></a></h1>
                            </li>
                            <li class="nav-item">
                                <h1 class="display-6"><a href="careers.php" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>Careers</span></a></h1>
                            </li>
                            <li class="nav-item">
                                <h1 class="display-6"><a href="gallery.html" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>Gallery</span></a></h1>
                            </li>
                            <li class="nav-item">
                                <h1 class="display-6"><a href="contact-us.html" class="nav-link" aria-expanded="false" aria-haspopup="true"><span>Contact Us</span></a></h1>
                            </li>
                        </ul>
                        <div class="container" style="width: fit-content; margin-right:0;">
                            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars" style="z-index: 4;"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="container" style="padding-left: 3%; padding-right: 3%; height: fit-content;">
                <article>
                    <header class="entry-header ast-no-thumbnail">
                        <h1 class="display-3" itemprop="headline" style="padding-left: 5px; padding-top: 10px; color: #c1a367; font-style: italic; text-shadow: 2px 4px 4px #9e7e3f;">Join Our Fleet</h1>
                    </header>
                    <div class="container" itemprop="text" style="display: flex; flex-wrap: wrap; padding-top: 2%; margin-bottom: 10px;">
                        <div style="width: 100%; height: auto; display: flex; background-color: #c1a367; border-radius: 10px;">
                            <div class="col-lg contact-content">
                                <div class="contact-content-holder" style="padding: 10px; margin-bottom: 10px;">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <!-- Display submission status -->
                                        <?php if(!empty($statusMsg)){ ?>
                                            <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
                                        <?php }  ?>
                                        <div class="mb-3">
                                            <label for="inputFirstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="John" value="<?php echo !empty($postData['inputFirstName'])?$postData['inputFirstName']:''; ?>"> 
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputLastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="Doe"  value="<?php echo !empty($postData['inputLastName'])?$postData['inputLastName']:''; ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="inputEmail" class="form-label">Email</label>
                                          <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="john.doe@hotmail.com"  value="<?php echo !empty($postData['inputEmail'])?$postData['inputEmail']:''; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inptuFile">Resume/CV Upload</label>
                                            <input type="file" name="attachment" class="form-control" id="inputFile">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>
</body>
</html>
