<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /public/login.php');
    exit;
}

$message = '';
$messageType = '';

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if (USE_SUPABASE) {
        require_once __DIR__ . '/../config/supabase.php';
    }
    
    if ($action === 'update_vehicle') {
        $id = intval($_POST['id']);
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = floatval($_POST['price'] ?? 0);
        $available = isset($_POST['available']) ? true : false;
        $featured = isset($_POST['featured']) ? 1 : 0;
        $category_id = !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
        
        try {
            if (USE_SUPABASE) {
                $result = supabaseUpdate('vehicle', $id, [
                    'name' => $name,
                    'description' => $description,
                    'price_per_week' => $price,
                    'available' => $available,
                    'featured' => $featured,
                    'category_id' => $category_id
                ]);
                if ($result !== false) {
                    $message = 'Véhicule mis à jour avec succès';
                    $messageType = 'success';
                } else {
                    $message = 'Erreur lors de la mise à jour';
                    $messageType = 'error';
                }
            } else {
                $pdo = getDBConnection();
                $stmt = $pdo->prepare("
                    UPDATE fleet 
                    SET name = :name, description = :description, price_per_week = :price, 
                        available = :available, featured = :featured, category_id = :category_id 
                    WHERE id = :id
                ");
                $stmt->execute([
                    'id' => $id,
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'available' => $available ? 1 : 0,
                    'featured' => $featured,
                    'category_id' => $category_id
                ]);
                $message = 'Véhicule mis à jour avec succès';
                $messageType = 'success';
            }
        } catch (Exception $e) {
            $message = 'Erreur lors de la mise à jour: ' . $e->getMessage();
            $messageType = 'error';
        }
    } elseif ($action === 'delete_vehicle') {
        $id = intval($_POST['id']);
        try {
            if (USE_SUPABASE) {
                $result = supabaseDelete('vehicle', $id);
                if ($result !== false) {
                    $message = 'Véhicule supprimé avec succès';
                    $messageType = 'success';
                } else {
                    $message = 'Erreur lors de la suppression';
                    $messageType = 'error';
                }
            } else {
                $pdo = getDBConnection();
                $stmt = $pdo->prepare("DELETE FROM fleet WHERE id = :id");
                $stmt->execute(['id' => $id]);
                $message = 'Véhicule supprimé avec succès';
                $messageType = 'success';
            }
        } catch (Exception $e) {
            $message = 'Erreur lors de la suppression: ' . $e->getMessage();
            $messageType = 'error';
        }
    } elseif ($action === 'add_vehicle') {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = floatval($_POST['price'] ?? 0);
        $available = isset($_POST['available']) ? true : false;
        $featured = isset($_POST['featured']) ? 1 : 0;
        $category_id = !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
        
        try {
            if (USE_SUPABASE) {
                $result = supabaseInsert('vehicle', [
                    'name' => $name,
                    'description' => $description,
                    'price_per_week' => $price,
                    'available' => $available,
                    'featured' => $featured,
                    'category_id' => $category_id
                ]);
                if ($result !== false && !empty($result)) {
                    $message = 'Véhicule ajouté avec succès';
                    $messageType = 'success';
                } else {
                    $message = 'Erreur lors de l\'ajout';
                    $messageType = 'error';
                }
            } else {
                $pdo = getDBConnection();
                $stmt = $pdo->prepare("
                    INSERT INTO fleet (name, description, price_per_week, available, featured, category_id) 
                    VALUES (:name, :description, :price, :available, :featured, :category_id)
                ");
                $stmt->execute([
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'available' => $available ? 1 : 0,
                    'featured' => $featured,
                    'category_id' => $category_id
                ]);
                $message = 'Véhicule ajouté avec succès';
                $messageType = 'success';
            }
        } catch (Exception $e) {
            $message = 'Erreur lors de l\'ajout: ' . $e->getMessage();
            $messageType = 'error';
        }
    }
}

// Récupérer tous les véhicules
$vehicles = [];
$categories = [];

if (USE_SUPABASE) {
    require_once __DIR__ . '/../config/supabase.php';
    try {
        $vehicles = supabaseGetAll('vehicle', []);
        $categories = supabaseGetAll('category', []);
    } catch (Exception $e) {
        error_log("Erreur: " . $e->getMessage());
    }
} else {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM fleet ORDER BY id");
            $vehicles = $stmt->fetchAll();
            
            $catStmt = $pdo->query("SELECT * FROM category ORDER BY name");
            $categories = $catStmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Erreur: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office - WildCampers</title>
    <link rel="stylesheet" href="/style/global.css">
    <link rel="stylesheet" href="/style/admin.css">
</head>
<body>
    <header class="admin-header">
        <div class="admin-header-content">
            <h1>Back Office - WildCampers</h1>
            <div class="admin-header-actions">
                <span class="admin-user">Connecté en tant que: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                <a href="/index.php?page=home" class="button button--secondary">Retour au site</a>
                <a href="/public/logout.php" class="button button--secondary">Déconnexion</a>
            </div>
        </div>
    </header>
    
    <main class="admin-main">
        <?php if ($message): ?>
            <div class="admin-message admin-message--<?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <section class="admin-section">
            <div class="admin-section-header">
                <h2>Gestion des véhicules</h2>
                <button class="button button--primary" onclick="toggleAddForm()">+ Ajouter un véhicule</button>
            </div>
            
            <!-- Formulaire d'ajout -->
            <div id="addForm" class="admin-form-container" style="display: none;">
                <h3>Ajouter un véhicule</h3>
                <form method="POST" class="admin-form">
                    <input type="hidden" name="action" value="add_vehicle">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Prix par semaine (€)</label>
                            <input type="number" name="price" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Catégorie</label>
                            <select name="category_id">
                                <option value="">Aucune</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="available" checked> Disponible
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="featured"> En vedette
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="button button--primary">Ajouter</button>
                        <button type="button" class="button button--secondary" onclick="toggleAddForm()">Annuler</button>
                    </div>
                </form>
            </div>
            
            <!-- Liste des véhicules -->
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix/semaine</th>
                            <th>Disponible</th>
                            <th>En vedette</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <tr>
                                <td><?php echo $vehicle['id']; ?></td>
                                <td><?php echo htmlspecialchars($vehicle['name']); ?></td>
                                <td class="description-cell"><?php echo htmlspecialchars(substr($vehicle['description'] ?? '', 0, 50)) . '...'; ?></td>
                                <td><?php echo number_format($vehicle['price_per_week'], 2); ?> €</td>
                                <td><?php echo ($vehicle['available'] ?? false) ? '✓' : '✗'; ?></td>
                                <td><?php echo ($vehicle['featured'] ?? 0) ? '✓' : '✗'; ?></td>
                                <td><?php echo $vehicle['category_id'] ?? '-'; ?></td>
                                <td class="actions-cell">
                                    <button class="button button--small" onclick="editVehicle(<?php echo htmlspecialchars(json_encode($vehicle)); ?>)">Modifier</button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule?');">
                                        <input type="hidden" name="action" value="delete_vehicle">
                                        <input type="hidden" name="id" value="<?php echo $vehicle['id']; ?>">
                                        <button type="submit" class="button button--small button--danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <!-- Modal d'édition -->
    <div id="editModal" class="admin-modal" style="display: none;">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h3>Modifier le véhicule</h3>
                <button class="admin-modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form method="POST" id="editForm" class="admin-form">
                <input type="hidden" name="action" value="update_vehicle">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="name" id="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label>Prix par semaine (€)</label>
                        <input type="number" name="price" id="edit_price" step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="edit_description" rows="3" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select name="category_id" id="edit_category_id">
                            <option value="">Aucune</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="available" id="edit_available"> Disponible
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="featured" id="edit_featured"> En vedette
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button button--primary">Enregistrer</button>
                    <button type="button" class="button button--secondary" onclick="closeEditModal()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function toggleAddForm() {
            const form = document.getElementById('addForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
        
        function editVehicle(vehicle) {
            document.getElementById('edit_id').value = vehicle.id;
            document.getElementById('edit_name').value = vehicle.name;
            document.getElementById('edit_description').value = vehicle.description || '';
            document.getElementById('edit_price').value = vehicle.price_per_week;
            document.getElementById('edit_category_id').value = vehicle.category_id || '';
            document.getElementById('edit_available').checked = vehicle.available === true || vehicle.available == 1;
            document.getElementById('edit_featured').checked = vehicle.featured == 1;
            document.getElementById('editModal').style.display = 'flex';
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
        
        // Fermer la modal en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>
