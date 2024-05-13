
    <h3>Grid of Cards</h3>

    <?php foreach ($items as $item): ?>
        <div class="card">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
            <h2><?php echo $item['title']; ?></h2>
            <p><?php echo $item['description']; ?></p>
        </div>
    <?php endforeach; ?>
