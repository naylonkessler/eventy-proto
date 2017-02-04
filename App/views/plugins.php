<?php include '_header.php'; ?>

<section class="section">
    <header class="section__header">
        <h1>Plugins</h1>
    </header>
    <section class="section__body">
        <section class="section__list">
            <?php foreach ($plugins as $plugin): ?>
            <div class="section__list-item">
                <h3>
                    <?php echo $plugin->name; ?>
                    <?php if ($plugin->installed): ?>
                    <small>[Installed]</small>
                    <a href="/App/Actions/UninstallPlugin.php?plugin=<?php echo $plugin->key; ?>">
                        <small>[Uninstall]</small>
                    </a>
                    <?php else: ?>
                    <a href="/App/Actions/InstallPlugin.php?plugin=<?php echo $plugin->key; ?>">
                        <small>[Install]</small>
                    </a>
                    <?php endif; ?>
                </h3>
                <p><?php echo $plugin->description; ?></p>
            </div>
            <?php endforeach; ?>
        </section>
    </section>
</section>

<?php include '_footer.php'; ?>