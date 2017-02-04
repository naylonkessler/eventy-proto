<section class="section">
    <header class="section__header">
        <h2>Sales of contact</h2>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($sales as $sale): ?>
            <div class="section__list-item">
                <h3>
                    #<?php echo $sale->id; ?> &mdash;
                    <?php echo date('m/d/Y H:i', $sale->done_at); ?> &mdash;
                    $ <?php echo number_format($sale->value, 2); ?>
                </h3>
            </div>
            <?php endforeach; ?>
        </section>
    </section>
</section>