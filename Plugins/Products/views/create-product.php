<?php include ROOT.'/App/views/_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            New product
            <a href="/Plugins/Products/Actions/Products.php">[Products]</a>
        </h1>
    </header>
    <section class="section__body">
        <form action="/Plugins/Products/Actions/StoreProduct.php" method="POST">
            <legend>
                Name:<br>
                <input type="text" name="name">
            </legend>
            <legend>
                Value:<br>
                <input type="text" name="value">
            </legend>
            <div class="toolbar">
                <button type="submit">Save product</button>
            </div>
        </form>
    </section>
</section>

<?php include ROOT.'/App/views/_footer.php'; ?>