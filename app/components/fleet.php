<?php 
require 'app/config/db_connection.php'; // Inclure le fichier de connexion

$user_id = 1; // Remplacez par l'ID utilisateur réel ou récupérez-le dynamiquement

function fetchVehicles($pdo, $filters = null) {
    $sql = "SELECT DISTINCT fleet.* FROM fleet 
            LEFT JOIN vehicle_tag ON fleet.id = vehicle_tag.vehicle_id 
            LEFT JOIN tag ON vehicle_tag.tag_id = tag.id 
            LEFT JOIN category ON fleet.category_id = category.id 
            LEFT JOIN theme ON fleet.theme_id = theme.id 
            WHERE 1=1";
    
    $params = [];
    if ($filters) {
        if (!empty($filters['category'])) {
            $categories = explode(',', $filters['category']);
            $sql .= " AND category.id IN (" . implode(',', array_fill(0, count($categories), '?')) . ")";
            $params = array_merge($params, $categories);
        }

        if (!empty($filters['tag'])) {
            $tags = explode(',', $filters['tag']);
            $sql .= " AND tag.id IN (" . implode(',', array_fill(0, count($tags), '?')) . ")";
            $params = array_merge($params, $tags);
        }

        if (!empty($filters['theme'])) {
            $themes = explode(',', $filters['theme']);
            $sql .= " AND theme.id IN (" . implode(',', array_fill(0, count($themes), '?')) . ")";
            $params = array_merge($params, $themes);
        }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function fetchFavorites($pdo, $user_id) {
    $sql_favorites = "SELECT vehicle_id FROM user_favorite_vehicles WHERE user_id = :user_id";
    $stmt_favorites = $pdo->prepare($sql_favorites);
    $stmt_favorites->execute(['user_id' => $user_id]);
    return $stmt_favorites->fetchAll(PDO::FETCH_COLUMN);
}

// For initial page load, fetch all vehicles and favorites
$vehicles = fetchVehicles($pdo);
$favorites = fetchFavorites($pdo, $user_id);
?>

<!-- Filter UI and Vehicle Display -->
<div id="fleet">
    <div class="filter-container">
        <span class="material-symbols-outlined" id="filter-toggle">filter_alt</span>
        <div id="filter-options" class="filter-options hidden">
            <div class="filter-column">
                <form id="category-form">
                    <select name="category" class="select-dropdown filter-checkbox" data-filter-type="category">
                        <option value="" disabled selected>Choose your type of vehicle</option>
                        <?php
                        $categories = $pdo->query("SELECT id, name FROM category")->fetchAll();
                        foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <div class="filter-column">
                <form id="theme-form">
                    <select name="theme" class="select-dropdown filter-checkbox" data-filter-type="theme">
                        <option value="" disabled selected>Choose your theme</option>
                        <?php
                        $themes = $pdo->query("SELECT id, name FROM theme")->fetchAll();
                        foreach ($themes as $theme): ?>
                            <option value="<?= $theme['id'] ?>"><?= htmlspecialchars($theme['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <div class="filter-column">
                <div class="tags-container">
                    <?php
                    $tags = $pdo->query("SELECT id, name FROM tag")->fetchAll();
                    foreach ($tags as $tag): ?>
                        <input type="checkbox" class="filter-checkbox" data-filter-type="tag" id="tag-<?= $tag['id'] ?>" value="<?= $tag['id'] ?>">
                        <label for="tag-<?= $tag['id'] ?>"><?= htmlspecialchars($tag['name']) ?></label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <button id="apply-filters" class="button-alt">Apply Filters</button>
        <button id="clear-filters" class="button-alt">Clear Filters</button>
    </div>

    <div class="vehicle-container">
        <?php foreach ($vehicles as $vehicle): ?>
            <?php $is_favorite = in_array($vehicle['id'], $favorites); ?>
            <div class="vehicle-card">
                <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                <div class="vehicle-image" style="background-image: url('<?= htmlspecialchars($vehicle['image_path']) ?>');">
                    <span class="favorite-heart <?= $is_favorite ? 'favorite' : '' ?>" data-vehicle-id="<?= $vehicle['id'] ?>">&#10084;</span>
                </div>
                <div class="description">
                    <p><?= htmlspecialchars($vehicle['description']) ?></p>
                </div>
                <div class="price">Starting at <?= htmlspecialchars($vehicle['price_per_week']) ?>€ per week</div>
                <div class="button-container">
                    <a href="index.php?page=detail&id=<?= htmlspecialchars($vehicle['id']) ?>" class="button learn-more">Learn more</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cta">
        <p>Ready to hit the road ? <span><a href="index.php?page=booking">book your adventure now</a></span></p>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filter-toggle');
    const filterOptions = document.getElementById('filter-options');
    const applyFiltersButton = document.getElementById('apply-filters');
    const clearFiltersButton = document.getElementById('clear-filters');

    filterToggle.addEventListener('click', function() {
        filterOptions.classList.toggle('hidden');
    });

    applyFiltersButton.addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        const filters = {
            category: null,
            tag: [],
            theme: null
        };

        checkboxes.forEach(checkbox => {
            if (checkbox.tagName.toLowerCase() === 'select' && checkbox.value) {
                if (checkbox.dataset.filterType === 'category') {
                    filters.category = checkbox.value;
                } else if (checkbox.dataset.filterType === 'theme') {
                    filters.theme = checkbox.value;
                }
            } else if (checkbox.checked) {
                filters.tag.push(checkbox.value);
            }
        });

        // Construct the new URL with query parameters
        const params = new URLSearchParams();
        if (filters.category) params.append('category', filters.category);
        if (filters.tag.length) params.append('tag', filters.tag.join(','));
        if (filters.theme) params.append('theme', filters.theme);
        
        const newUrl = `${window.location.pathname}?${params.toString()}`;
        window.history.pushState({ path: newUrl }, '', newUrl);

        fetch(`app/components/catalog_filter.php?${params.toString()}`, {
            method: 'GET',
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('.vehicle-container').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });

    clearFiltersButton.addEventListener('click', function() {
        window.location.href = window.location.pathname;
    });

    const favoriteHearts = document.querySelectorAll('.favorite-heart');
    favoriteHearts.forEach(heart => {
        heart.addEventListener('click', function() {
            const vehicleId = this.dataset.vehicleId;
            const userId = '1'; // Remplacez par l'ID utilisateur réel ou récupérez-le dynamiquement

            fetch('add_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId, vehicle_id: vehicleId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('favorite'); // Ajoute ou enlève la classe 'favorite' pour changer la couleur
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

</script>
