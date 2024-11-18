<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="login-form.css">
    </head>

    <body style="background-image:url('Images/background.jpg');background-size: cover;">
        <form action="register-process.php" method="post">
            <div class="container">
                <div class="container form bg-white pt-5 mt-4 mb-3">
                    <p class="text-center login-heading hide-me">sign up</p>
                    <div class="row hide-me">
                        <div class="col mt-4 pl-5 pr-5">
                            <p class="username">Username</p>
                            <div class="row mt-4">
                                <div class="col-2 text-center pt-1 pr-0">
                                    <i class="fa fa-user-o" aria-hidden="true" id="user"></i>
                                </div>
                                <div class="col-10 pl-0">
                                    <input type="text" placeholder="Type your username" class='first-name' name="username">
                                </div>
                            </div>
                            <hr class="hr-1">
                            <div class="first-name-hide"></div>
                        </div>
                    </div>
                    <div class="row hide-me">
                        <div class="col mt-4 pl-5 pr-5">
                            <p class="username">Email</p>
                            <div class="row mt-4">
                                <div class="col-2 text-center pt-1 pr-0">
                                    <i class="fa fa-envelope-o" aria-hidden="true" id="user"></i>
                                </div>
                                <div class="col-10 pl-0">
                                    <input type="text" placeholder="Type your username" class='email' name="email">
                                </div>
                            </div>
                            <hr class="hr-1">
                            <div class="email-hide"></div>
                        </div>
                    </div>
                    <div class="row hide-me">
                        <div class="col mt-4 pl-5 pr-5">
                            <p class="username">Password</p>
                            <div class="row mt-4">
                                <div class="col-2 text-center pt-1 pr-0">
                                    <i class="fa fa-lock" aria-hidden="true" id="lock"></i>
                                </div>
                                <div class="col-10 pl-0">
                                    <input type="password" placeholder="Type your password" class="password-signup" name="password">
                                </div>
                            </div>
                            <hr class="hr-2">
                            <div class="password-signup-hide"></div>
                        </div>
                    </div>
                    <div class="row hide-me">
                        <div class="col mt-4 pl-5 pr-5">
                            <p class="username">Confirm-password</p>
                            <div class="row mt-4">
                                <div class="col-2 text-center pt-1 pr-0">
                                    <i class="fa fa-lock" aria-hidden="true" id="lock"></i>
                                </div>
                                <div class="col-10 pl-0">
                                    <input type="password" placeholder="Type your password" class="confirm-password-signup">
                                </div>
                            </div>
                            <hr class="hr-2">
                            <div class="confirm-password-signup-hide"></div>
                        </div>
                    </div>
                    <div class="row mt-4 hide-me">
                        <div class="col pl-5 pr-5">
                            <span>
                                <button type="submit" class="btn btn-block text-white signup-button">
                                    sign up
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="row mt-5 hide-me">
                        <div class="col text-center">
                            <span style="text-transform: capitalize;font-family: Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141)">already have an account</span>
                        </div>
                        <div class="col-12 text-center pt-3">
                            <a href="login.php"><span class="login-page">login</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>

    </html>