<?php include '_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            Edit contact
            <a href="/App/Actions/Contacts.php">[Contacts]</a>
        </h1>
    </header>
    <section class="section__body">
        <form action="/App/Actions/UpdateContact.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $contact->id; ?>">
            <legend>
                Name:<br>
                <input type="text" name="name" value="<?php echo $contact->name; ?>">
            </legend>
            <legend>
                E-mail:<br>
                <input type="text" name="email" value="<?php echo $contact->email; ?>">
            </legend>
            <legend>
                Mobile:<br>
                <input type="text" name="mobile" value="<?php echo $contact->mobile; ?>">
            </legend>
            <legend>
                Phone:<br>
                <input type="text" name="phone" value="<?php echo $contact->phone; ?>">
            </legend>
            <div class="toolbar">
                <button type="submit">Save contact</button>
            </div>
        </form>
    </section>
</section>

<?php include '_footer.php'; ?>