<?php include '_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            Contacts
            <a href="/App/Actions/CreateContact.php">[New contact]</a>
        </h1>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($contacts as $contact): ?>
            <div class="section__list-item">
                <h3>
                    <?php echo $contact->name; ?>
                    <a href="/App/Actions/ShowContact.php?contact=<?php echo $contact->id; ?>">[Details]</a>
                    <a href="/App/Actions/EditContact.php?contact=<?php echo $contact->id; ?>">[Edit]</a>
                    <a href="/App/Actions/DeleteContact.php?contact=<?php echo $contact->id; ?>">[Delete]</a>
                </h3>
                <p>
                    <?php echo implode(' / ', array_filter([$contact->email, $contact->mobile, $contact->phone])); ?>
                    <?php \Lib\App::$pubSub->publishToRender('contacts.render.list-item-after', $contact); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </section>
    </section>
</section>

<?php include '_footer.php'; ?>