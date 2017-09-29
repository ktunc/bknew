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
        'site/bootstrap.min',
        'site/batikapi',
        'yonetici/plugins/sweetalert/sweetalert'
    ));

    echo $this->Html->script(array(
        'site/jquery-3.1.1.min',
        'site/bootstrap.min',
        'blockUI'
    ));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php echo $this->element('loader'); ?>
    <div class="container-fluid">
        <?php echo $this->element('site/header'); ?>
    </div>
	<div class="container-fluid">
		<div class="row">
            <div class="hidden-xs hidden-sm col-md-3 menuclass">
                <?php echo $this->element('site/menu'); ?>
            </div>
            <div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
                <?php echo $this->element('site/menumobile'); ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9">
                <?php echo $this->Flash->render(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
<?php echo $this->element('site/detayli_arama'); ?>
<script type="text/javascript">
$(document).ready(function(){
    $('.headerlogo').width($('.menuclass').width());
});

$(window).resize(function () {
    $('.headerlogo').width($('.menuclass').width());
});
</script>
</body>
</html>
