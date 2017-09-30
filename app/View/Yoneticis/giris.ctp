<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
<!--            <h2 class="text-white">GDA Hukuk & Danışmanlık</h2>-->
        </div>
        <img src="<?php echo $this->webroot;?>img/logo.png" width="100%"/>
        <form class="m-t" role="form" enctype="multipart/form-data" method="post" action="<?php echo $this->Html->url('/');?>yoneticis/login">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Kullanıcı Adı" required="">
            </div>
            <div class="form-group">
                <input type="password" name="pass" class="form-control" placeholder="Şifre" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Giriş</button>
<!---->
<!--            <a href="#"><small>Forgot password?</small></a>-->
<!--            <p class="text-muted text-center"><small>Do not have an account?</small></p>-->
        </form>
        <p class="m-t"> <small>Batıkapı Gayrimenkul &copy; <?php echo date('Y') ?></small> </p>
    </div>
</div>