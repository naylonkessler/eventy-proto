<?php include ROOT.'/App/views/_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            Sales
            <a href="/Plugins/Sales/Actions/CreateSale.php">[New sale]</a>
        </h1>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($sales as $sale): ?>
            <div class="section__list-item">
                <h3>
                    #<?php echo $sale->id; ?> &mdash;
                    <?php echo date('m/d/Y H:i', $sale->done_at); ?> &mdash;
                    $ <?php echo number_format($sale->value, 2); ?>
                    <a href="/Plugins/Sales/Actions/ShowSale.php?sale=<?php echo $sale->id; ?>">[Details]</a>
                    <a href="/Plugins/Sales/Actions/DeleteSale.php?sale=<?php echo $sale->id; ?>">[Delete]</a>
                </h3>
            </div>
            <?php endforeach; ?>
        </section>
    </section>
</section>

<?php include ROOT.'/App/views/_footer.php'; ?>