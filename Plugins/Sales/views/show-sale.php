<?php include ROOT.'/App/views/_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            Sale #<?php echo $sale->id; ?>
            <a href="/Plugins/Sales/Actions/Sales.php">[Sales]</a>
        </h1>
    </header>
    <section class="section__body">
        <?php \Lib\App::$pubSub->publishToRender('sales.render.show-before', $sale); ?>
        <section>
            <p>Contact: <?php echo value('name', $sale->contact); ?></p>
            <p>Date: <?php echo date('m/d/Y H:i', $sale->done_at); ?></p>
            <p>Value: $ <?php echo number_format($sale->value, 2); ?></p>
        </section>
        <?php \Lib\App::$pubSub->publishToRender('sales.render.show-after', $sale); ?>
    </section>
</section>

<?php include ROOT.'/App/views/_footer.php'; ?>