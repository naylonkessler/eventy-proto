<?php include ROOT.'/App/views/_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            New sale
            <a href="/Plugins/Sales/Actions/Sales.php">[Sales]</a>
        </h1>
    </header>
    <section class="section__body">
        <form action="/Plugins/Sales/Actions/StoreSale.php" method="POST">
            <legend>
                Contato:<br>
                <select name="contact_id">
                    <option value=""></option>
                    <?php foreach ($contacts as $contact): ?>
                    <option value="<?php echo $contact->id; ?>"><?php echo $contact->name ?></option>
                    <?php endforeach; ?>
                </select>
            </legend>
            <legend>
                Date:<br>
                <input type="text" name="done_at" disabled value="<?php echo date('m/d/Y H:i'); ?>">
            </legend>
            <legend>
                Value:<br>
                <input type="text" name="value">
            </legend>

            <?php \Lib\App::$pubSub->publishToRender('sales.render.create-after'); ?>

            <div class="toolbar">
                <button type="submit">Save sale</button>
            </div>
        </form>
    </section>
</section>

<?php include ROOT.'/App/views/_footer.php'; ?>