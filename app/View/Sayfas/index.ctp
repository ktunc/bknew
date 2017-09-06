<?php
echo $this->Html->css('sortable');
?>
<section class="sortableblock">
    <ul class="sortable grid">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
        <li>Item 5</li>
        <li>Item 6</li>
    </ul>
</section>
<?php
echo $this->Html->script('site/jquery.sortable.min');
?>
<script type="text/javascript">
    $(function() {
//        $('.sortable').sortable().bind('sortupdate', function() {
//            var i = 1;
//            $('.sortable li').each(function(){
//                alert(i+' - '+$(this).data('item'));
//                i++;
//            });
//        });
        $('.sortable').sortable();
    });
</script>
