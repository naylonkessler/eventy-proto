<?php include ROOT.'/App/views/_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            Products
            <a href="/Plugins/Products/Actions/CreateProduct.php">[New product]</a>
        </h1>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($products as $product): ?>
            <div class="section__list-item">
                <h3>
                    #<?php echo $product->id; ?> &mdash;
                    <?php echo $product->name; ?> &mdash;
                    $ <?php echo number_format($product->value, 2); ?>
                    <a href="/Plugins/Products/Actions/DeleteProduct.php?product=<?php echo $product->id; ?>">[Delete]</a>
                </h3>
            </div>
            <?php endforeach; ?>
        </section>
    </section>
</section>

<?php include ROOT.'/App/views/_footer.php'; ?>