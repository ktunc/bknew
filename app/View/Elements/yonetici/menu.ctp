<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img width="100%" src="<?php echo $this->Html->url('/');?>img/logo.png" />
                             </span>
                </div>
            </li>
            <li>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">İlan</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/ilanlar">İlanlar</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:3">Yeni Arsa İlanı</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:2">Yeni İşyeri İlanı</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yeniilan/tur:1">Yeni Konut İlanı</a></li>
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
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Haber</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/haberler">Haberler</a></li>
                    <li><a href="<?php echo $this->Html->url('/');?>yoneticis/yenihaber">Yeni Haber</a></li>
                </ul>
            </li>
<!--            <li>-->
<!--                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>-->
<!--            </li>-->
        </ul>

    </div>
</nav>