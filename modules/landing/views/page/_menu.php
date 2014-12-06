<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$this->createUrl("/")?>"><?=r()->name?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden"><a href="#page-top"></a></li>
              
                <li><a href="#info">info</a></li>
                <?php if(r()->user->isGuest):?>
                <li><a href="<?=$this->createUrl("/users/page/login")?>">Login</a></li>
                <?php else:?>
                <li><a href="<?=$this->createUrl("/users/page/logout")?>">Logout</a></li>
                <li><a href="<?=$this->createUrl("/users/page/profile")?>">Profile</a></li>
                <?php endif;?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
