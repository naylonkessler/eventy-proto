<section class="section">
    <header class="section__header">
        <h2>Sale items</h2>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($items as $item): ?>
            <div class="section__list-item">
                <h3>
                    #<?php echo $item->id; ?> &mdash;
                    <?php echo value('name', $item->product); ?> &mdash;
                    <?php echo $item->quantity; ?> &mdash;
                    $ <?php echo number_format($item->value, 2); ?>
                </h3>
            </div>
            <?php endforeach; ?>
            <?php if ( ! $items): ?>
            <p>No items found for this sale.</p>
            <?php endif; ?>
        </section>
    </section>
</section>