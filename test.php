<?php

/**
 * TEST SQL pour module Lightspeed → Odoo
 * Vérifie si les requêtes SQL s'exécutent correctement
 */

// Active l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔧 TEST SQL - Module Lightspeed → Odoo</h1>";
echo "<style>
body { font-family: Arial; margin: 20px; }
.success { color: green; font-weight: bold; }
.error { color: red; font-weight: bold; }
.info { color: blue; }
.sql { background: #f5f5f5; padding: 10px; margin: 10px 0; border-left: 4px solid #ccc; }
</style>";

// Inclusion PHPBoost
try {
    require_once('./kernel/begin.php');
    echo "<p class='success'>✅ PHPBoost inclus avec succès</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ Erreur inclusion PHPBoost: " . $e->getMessage() . "</p>";
    die();
}

// Variables de tables
$prefix = PREFIX;
$mappings_table = $prefix . 'lightspeedto_odoo_mappings';
$uploads_table = $prefix . 'lightspeedto_odoo_uploads';

echo "<h2>📋 Informations de base</h2>";
echo "<p class='info'>Préfixe BDD: <strong>" . $prefix . "</strong></p>";
echo "<p class='info'>Table mappings: <strong>" . $mappings_table . "</strong></p>";
echo "<p class='info'>Table uploads: <strong>" . $uploads_table . "</strong></p>";

// Test connexion BDD
echo "<h2>🔌 Test connexion base de données</h2>";
try {
    $db = PersistenceContext::get_querier();
    $dbms = PersistenceContext::get_dbms_utils();
    echo "<p class='success'>✅ Connexion base de données OK</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ Erreur connexion BDD: " . $e->getMessage() . "</p>";
    die();
}

// Fonction pour tester une requête
function test_query($description, $query, $db)
{
    echo "<h3>" . $description . "</h3>";
    echo "<div class='sql'><strong>SQL:</strong> " . $query . "</div>";

    try {
        $result = $db->query($query);
        echo "<p class='success'>✅ Requête exécutée avec succès</p>";
        return true;
    } catch (Exception $e) {
        echo "<p class='error'>❌ Erreur: " . $e->getMessage() . "</p>";
        return false;
    }
}

// Test 1: Vérifier si les tables existent déjà
echo "<h2>🔍 Vérification existence des tables</h2>";

$check_mappings = "SHOW TABLES LIKE '" . $mappings_table . "'";
$check_uploads = "SHOW TABLES LIKE '" . $uploads_table . "'";

try {
    $result_mappings = $db->query($check_mappings);
    $mappings_exists = ($result_mappings->get_rows_count() > 0);

    $result_uploads = $db->query($check_uploads);
    $uploads_exists = ($result_uploads->get_rows_count() > 0);

    echo "<p class='info'>Table mappings existe: " . ($mappings_exists ? "OUI" : "NON") . "</p>";
    echo "<p class='info'>Table uploads existe: " . ($uploads_exists ? "OUI" : "NON") . "</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ Erreur vérification tables: " . $e->getMessage() . "</p>";
}

// Test 2: Supprimer les tables si elles existent
echo "<h2>🗑️ Suppression des tables existantes</h2>";

if (isset($mappings_exists) && $mappings_exists) {
    test_query("Suppression table mappings", "DROP TABLE IF EXISTS " . $mappings_table, $db);
}

if (isset($uploads_exists) && $uploads_exists) {
    test_query("Suppression table uploads", "DROP TABLE IF EXISTS " . $uploads_table, $db);
}

// Test 3: Création de la table mappings
echo "<h2>🏗️ Création table mappings</h2>";

$create_mappings = "CREATE TABLE " . $mappings_table . " (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    mapping_data TEXT NOT NULL,
    is_default TINYINT(1) NOT NULL DEFAULT 0,
    created_date INT(11) NOT NULL DEFAULT 0,
    updated_date INT(11) NOT NULL DEFAULT 0,
    user_id INT(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY is_default (is_default)
)";

$mappings_created = test_query("Création table mappings", $create_mappings, $db);

// Test 4: Création de la table uploads
echo "<h2>🏗️ Création table uploads</h2>";

$create_uploads = "CREATE TABLE " . $uploads_table . " (
    id INT(11) NOT NULL AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    original_filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT(11) NOT NULL DEFAULT 0,
    mapping_id INT(11) NOT NULL DEFAULT 0,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    processed_rows INT(11) NOT NULL DEFAULT 0,
    total_rows INT(11) NOT NULL DEFAULT 0,
    error_count INT(11) NOT NULL DEFAULT 0,
    errors_log TEXT,
    upload_date INT(11) NOT NULL DEFAULT 0,
    processed_date INT(11) DEFAULT NULL,
    user_id INT(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY mapping_id (mapping_id),
    KEY status (status),
    KEY upload_date (upload_date)
)";

$uploads_created = test_query("Création table uploads", $create_uploads, $db);

// Test 5: Insertion de données de test
if ($mappings_created) {
    echo "<h2>📝 Insertion mapping par défaut</h2>";

    $insert_mapping = "INSERT INTO " . $mappings_table . " 
        (name, description, mapping_data, is_default, created_date, updated_date, user_id) 
        VALUES (
            'Mapping Lightspeed par défaut',
            'Mapping par défaut pour les exports Lightspeed Série K',
            '" . json_encode(array(
        'ItemID' => 'default_code',
        'Description' => 'name',
        'Price' => 'list_price',
        'Cost' => 'standard_price',
        'UPC' => 'barcode',
        'Category' => 'categ_id'
    )) . "',
            1,
            " . time() . ",
            " . time() . ",
            1
        )";

    test_query("Insertion mapping par défaut", $insert_mapping, $db);
}

// Test 6: Vérification finale
echo "<h2>✅ Vérification finale</h2>";

try {
    // Compter les enregistrements
    $count_mappings = $db->query("SELECT COUNT(*) as count FROM " . $mappings_table)->fetch();
    $count_uploads = $db->query("SELECT COUNT(*) as count FROM " . $uploads_table)->fetch();

    echo "<p class='success'>✅ Table mappings: " . $count_mappings['count'] . " enregistrement(s)</p>";
    echo "<p class='success'>✅ Table uploads: " . $count_uploads['count'] . " enregistrement(s)</p>";

    // Afficher le contenu de la table mappings
    if ($count_mappings['count'] > 0) {
        echo "<h3>📋 Contenu table mappings:</h3>";
        $mappings_data = $db->query("SELECT * FROM " . $mappings_table);
        while ($row = $mappings_data->fetch()) {
            echo "<div class='sql'>";
            echo "<strong>ID:</strong> " . $row['id'] . "<br>";
            echo "<strong>Nom:</strong> " . $row['name'] . "<br>";
            echo "<strong>Description:</strong> " . $row['description'] . "<br>";
            echo "<strong>Par défaut:</strong> " . ($row['is_default'] ? 'OUI' : 'NON') . "<br>";
            echo "</div>";
        }
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ Erreur vérification finale: " . $e->getMessage() . "</p>";
}

echo "<h2>🎯 RÉSUMÉ</h2>";
echo "<p><strong>Tables créées avec succès:</strong> " .
    (($mappings_created ? "mappings " : "") . ($uploads_created ? "uploads" : "")) . "</p>";

if ($mappings_created && $uploads_created) {
    echo "<p class='success'><strong>🎉 SUCCÈS ! Les requêtes SQL s'exécutent correctement.</strong></p>";
    echo "<p class='info'>Le problème n'est pas dans les requêtes SQL mais probablement dans l'installation du module PHPBoost.</p>";
} else {
    echo "<p class='error'><strong>❌ PROBLÈME ! Les requêtes SQL ne s'exécutent pas correctement.</strong></p>";
    echo "<p class='info'>Vérifiez les permissions de la base de données et l'utilisateur MySQL.</p>";
}

echo "<hr>";
echo "<p><strong>📧 Copiez le résultat de ce test et envoyez-le moi !</strong></p>";
