<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo $this->Html->url('/');?>img/yonetici/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">İlan</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/ilanlar">İlanlar</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:3">Yeni Arsa İlanı</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:2">Yeni İşyeri İlanı</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:1">Yeni Ev İlanı</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Danışman</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/danismanlar">Danışmanlar</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yenidanisman">Yeni Danışman</a></li>
                </ul>
            </li>
            <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li>
        </ul>

    </div>
</nav>