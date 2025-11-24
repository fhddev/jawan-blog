<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Blog - Installation</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/admin_assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="/admin_assets/css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                
                                    <h4 class="text-center">Create Admin Account</h4>
        
                                    <form class="mt-5 mb-3 login-input" action="http://127.0.0.1:8000/admin/install_submit" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Full Name" name="full_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="picture_path" class="form-label">Profile Picture</label>
                                            <input class="form-control" type="file" id="formFile" name="picture_path">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Job Title" name="job_title" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="bio" required placeholder="bio" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Facebook Account Link" name="facebook_link" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="X Account Link" name="x_link" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Github Account Link" name="github_link" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Website Link" name="website_link" required>
                                        </div>
                                        
                                        <button class="btn login-form__btn submit w-100">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/admin_assets/plugins/common/common.min.js"></script>
    <script src="/admin_assets/js/custom.min.js"></script>
    <script src="/admin_assets/js/settings.js"></script>
    <script src="/admin_assets/js/gleek.js"></script>
    <script src="/admin_assets/js/styleSwitcher.js"></script>
</body>
</html>