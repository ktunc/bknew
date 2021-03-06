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
        Batıkapı Gayrimenkul
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
<?php echo $this->Flash->render(); ?>
<?php echo $this->fetch('content'); ?>
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
