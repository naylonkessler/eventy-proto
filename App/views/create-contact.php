<?php include '_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>
            New contact
            <a href="/App/Actions/Contacts.php">[Contacts]</a>
        </h1>
    </header>
    <section class="section__body">
        <form action="/App/Actions/StoreContact.php" method="POST">
            <legend>
                Name:<br>
                <input type="text" name="name">
            </legend>
            <legend>
                E-mail:<br>
                <input type="text" name="email">
            </legend>
            <legend>
                Mobile:<br>
                <input type="text" name="mobile">
            </legend>
            <legend>
                Phone:<br>
                <input type="text" name="phone">
            </legend>
            <div class="toolbar">
                <button type="submit">Save contact</button>
            </div>
        </form>
    </section>
</section>

<?php include '_footer.php'; ?>