<?php
/**
 * TEST DIRECT DE CRÉATION DE TABLES
 * Placez ce fichier dans /lightspeedto_odoo/test_install.php
 * Puis accédez à http://votresite.com/lightspeedto_odoo/test_install.php
 */

// Inclure PHPBoost
require_once('../kernel/begin.php');

echo "<h1>TEST INSTALLATION LIGHTSPEED TO ODOO</h1>";

try {
    // Test 1: Connexion base de données
    echo "<h2>Test 1: Connexion base de données</h2>";
    $querier = PersistenceContext::get_querier();
    echo "✅ Connexion réussie<br>";
    
    // Test 2: Création tables
    echo "<h2>Test 2: Création des tables</h2>";
    
    $mappings_table = PREFIX . 'lightspeedto_odoo_mappings';
    $uploads_table = PREFIX . 'lightspeedto_odoo_uploads';
    
    // Suppression si existe
    echo "Suppression des tables existantes...<br>";
    $querier->inject("DROP TABLE IF EXISTS " . $mappings_table);
    $querier->inject("DROP TABLE IF EXISTS " . $uploads_table);
    echo "✅ Tables supprimées<br>";
    
    // Création table mappings
    echo "Création table mappings...<br>";
    $querier->inject("CREATE TABLE " . $mappings_table . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        description text,
        mapping_data text NOT NULL,
        is_default tinyint(1) NOT NULL DEFAULT 0,
        created_date int(11) NOT NULL DEFAULT 0,
        updated_date int(11) NOT NULL DEFAULT 0,
        user_id int(11) NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    )");
    echo "✅ Table mappings créée<br>";
    
    // Création table uploads
    echo "Création table uploads...<br>";
    $querier->inject("CREATE TABLE " . $uploads_table . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        filename varchar(255) NOT NULL,
        original_filename varchar(255) NOT NULL,
        file_path varchar(500) NOT NULL,
        file_size int(11) NOT NULL DEFAULT 0,
        mapping_id int(11) NOT NULL DEFAULT 0,
        status varchar(50) NOT NULL DEFAULT 'pending',
        processed_rows int(11) NOT NULL DEFAULT 0,
        total_rows int(11) NOT NULL DEFAULT 0,
        error_count int(11) NOT NULL DEFAULT 0,
        errors_log text,
        upload_date int(11) NOT NULL DEFAULT 0,
        processed_date int(11) DEFAULT 0,
        user_id int(11) NOT NULL DEFAULT 0,
        PRIMARY KEY (id)
    )");
    echo "✅ Table uploads créée<br>";
    
    // Test 3: Insertion données
    echo "<h2>Test 3: Insertion données</h2>";
    
    $result = $querier->insert($mappings_table, array(
        'name' => 'Test Mapping',
        'description' => 'Test description',
        'mapping_data' => '{"test":"value"}',
        'is_default' => 1,
        'created_date' => time(),
        'updated_date' => time(),
        'user_id' => 1
    ));
    
    $last_id = $result->get_last_inserted_id();
    echo "✅ Données insérées avec ID: " . $last_id . "<br>";
    
    // Test 4: Vérification
    echo "<h2>Test 4: Vérification</h2>";
    
    $count_mappings = $querier->count($mappings_table);
    $count_uploads = $querier->count($uploads_table);
    
    echo "Nombre de mappings: " . $count_mappings . "<br>";
    echo "Nombre d'uploads: " . $count_uploads . "<br>";
    
    echo "<h2>🎉 TOUS LES TESTS RÉUSSIS !</h2>";
    echo "<p>Les tables ont été créées avec succès. Le problème vient donc du système d'installation de PHPBoost, pas de nos requêtes SQL.</p>";
    
} catch (Exception $e) {
    echo "<h2>❌ ERREUR</h2>";
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
    echo "<p>Trace: " . $e->getTraceAsString() . "</p>";
}

echo "<hr>";
echo "<p><a href='test_install.php?action=drop'>Supprimer les tables de test</a></p>";

// Action de suppression
if (isset($_GET['action']) && $_GET['action'] == 'drop') {
    try {
        $querier->inject("DROP TABLE IF EXISTS " . $mappings_table);
        $querier->inject("DROP TABLE IF EXISTS " . $uploads_table);
        echo "<p>✅ Tables supprimées</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erreur suppression: " . $e->getMessage() . "</p>";
    }
}
?>
