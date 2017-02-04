<?php include '_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            <?php echo $contact->name; ?>
            <a href="/App/Actions/Contacts.php">[Contacts]</a>
        </h1>
    </header>
    <section class="section__body">
        <?php \Lib\App::$pubSub->publishToRender('contacts.render.show-before', $contact); ?>
        <section>
            <p>E-mail: <?php echo $contact->email; ?></p>
            <p>Mobile: <?php echo $contact->mobile; ?></p>
            <p>Phone: <?php echo $contact->phone; ?></p>
        </section>
        <?php \Lib\App::$pubSub->publishToRender('contacts.render.show-after', $contact); ?>
    </section>
</section>

<?php include '_footer.php'; ?>