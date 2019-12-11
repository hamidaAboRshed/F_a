<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fahes Admin</title>
    <meta name="description" content="Fahes Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo base_url();?>/assets/images/logo/favicon.png" alt="Logo">
    <link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/logo/favicon.png" alt="Logo">

    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/icons/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                <a href="<?php echo site_url('Welcome');?>">
                    <img class="align-content" src="<?php echo base_url();?>/assets/images/logo/logo.png" alt="Logo">
                     </a>
                </div>
                <div class="login-form">
                <?php echo form_open('User/login', $attributes = array()); ?>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" placeholder="Email" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <?php echo validation_errors('<p class="error">');?>
                        <p class="error">
                                
                            <?php if ($bool) {
                                    echo $string;
                                } 
                            ?>
                        </p>
                            <?php 
                                echo '<p class="error">'.$this->session->userdata('login_error').'</p>';
                                $this->session->unset_userdata('login_error');
                            ?>
                        <button type="submit" class="btn btn-secondary btn-flat m-b-30 m-t-30">Sign in</button>
                       
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url()?>assets/js/javaScript/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/javaScript/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/javaScript/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/javaScript/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
