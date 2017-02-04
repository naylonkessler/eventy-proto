<section class="section">
    <header class="section__header">
        <h2>Sale items</h2>
    </header>
    <section class="section__body">
        <?php foreach (range(1, 3) as $idx): ?>
        <div>
            <select name="products[<?php echo $idx; ?>][product_id]">
                <option value=""></option>
                <?php foreach ($products as $product): ?>
                <option value="<?php echo $product->id; ?>"><?php echo $product->name ?></option>
                <?php endforeach; ?>
            </select>
            <input disabled type="text" name="products[<?php echo $idx; ?>][unit_value]" placeholder="Unit value">
            <input type="text" name="products[<?php echo $idx; ?>][quantity]" placeholder="Quantity">
            <input type="text" name="products[<?php echo $idx; ?>][value]" placeholder="Value">
        </div>
        <?php endforeach; ?>
    </section>
</section>