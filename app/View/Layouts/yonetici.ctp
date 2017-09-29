<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array(
            'font-awesome.min',
            'yonetici/bootstrap.min',
            'yonetici/style',
            'yonetici/animate',
            'yonetici/plugins/sweetalert/sweetalert'
    ));

    echo $this->Html->script(array(
            'yonetici/jquery-3.1.1.min',
            'yonetici/bootstrap.min',
            'blockUI'
    ));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="fixed-sidebar fixed-nav fixed-nav-basic">
<?php echo $this->element('loader'); ?>
<div id="wrapper">

    <?php echo $this->element('yonetici/menu'); ?>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <?php if($this->Session->check('userCheck')){ ?>
                        <a href="<?php echo $this->Html->url('/');?>yoneticis/cikis">
                            <i class="fa fa-sign-out"></i> Çıkış
                        </a>
                        <?php } ?>
                    </li>
                </ul>

            </nav>
        </div>
<!--        <div class="row wrapper border-bottom white-bg page-heading">-->
<!--            <div class="col-sm-4">-->
<!--                <h2>This is main title</h2>-->
<!--                <ol class="breadcrumb">-->
<!--                    <li>-->
<!--                        <a href="index-2.html">This is</a>-->
<!--                    </li>-->
<!--                    <li class="active">-->
<!--                        <strong>Breadcrumb</strong>-->
<!--                    </li>-->
<!--                </ol>-->
<!--            </div>-->
<!--            <div class="col-sm-8">-->
<!--                <div class="title-action">-->
<!--                    <a href="#" class="btn btn-primary">This is action area</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="wrapper wrapper-content">
            <?php echo $this->fetch('content'); ?>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

    </div>
</div>
<?php echo $this->element('sql_dump'); ?>

<?php
echo $this->Html->script(array(
        'yonetici/plugins/metisMenu/jquery.metisMenu',
        'yonetici/plugins/slimscroll/jquery.slimscroll.min',
        'yonetici/inspinia',
        'yonetici/plugins/pace/pace.min',
        'yonetici/plugins/sweetalert/sweetalert.min'
));
?>

<script>
    $(document).ready(function() {

    });
</script>
<script>
//    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//    })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');
//
//    ga('create', 'UA-4625583-2', 'webapplayers.com');
//    ga('send', 'pageview');

</script>
</body>
</html>
