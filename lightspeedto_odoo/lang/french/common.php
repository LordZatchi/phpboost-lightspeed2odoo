<?php

/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 01 01
 * @since       PHPBoost 6.0 - 2024 01 01
 */

####################################################
#                       French                     #
####################################################

// Module général
$lang['lightspeedto_odoo.module.title'] = 'Lightspeed vers Odoo';
$lang['lightspeedto_odoo.module.description'] = 'Module de transfert de données CSV de Lightspeed Série K vers Odoo POS';

// Navigation et menus
$lang['lightspeedto_odoo.home'] = 'Accueil';
$lang['lightspeedto_odoo.upload'] = 'Importer CSV';
$lang['lightspeedto_odoo.mappings'] = 'Mappings';
$lang['lightspeedto_odoo.process'] = 'Traitements';
$lang['lightspeedto_odoo.admin.config'] = 'Configuration';

// Page d'accueil
$lang['lightspeedto_odoo.home.title'] = 'Transfert Lightspeed vers Odoo POS';
$lang['lightspeedto_odoo.home.welcome'] = 'Bienvenue dans le module Lightspeed vers Odoo';
$lang['lightspeedto_odoo.home.description'] = 'Bienvenue dans le module de transfert de données de Lightspeed Série K vers Odoo POS. Ce module vous permet d\'importer vos fichiers CSV et de les transférer vers votre système Odoo.';
$lang['lightspeedto_odoo.home.quick_actions'] = 'Actions rapides';
$lang['lightspeedto_odoo.home.upload_new_file'] = 'Importer un nouveau fichier CSV';
$lang['lightspeedto_odoo.home.manage_mappings'] = 'Gérer les mappings';
$lang['lightspeedto_odoo.home.view_processes'] = 'Voir les traitements';
$lang['lightspeedto_odoo.home.configure'] = 'Configurer le module';
$lang['lightspeedto_odoo.home.statistics'] = 'Statistiques';
$lang['lightspeedto_odoo.home.recent_uploads'] = 'Derniers imports';
$lang['lightspeedto_odoo.home.total_uploads'] = 'Total des imports';
$lang['lightspeedto_odoo.home.successful_transfers'] = 'Transferts réussis';
$lang['lightspeedto_odoo.home.failed_transfers'] = 'Transferts échoués';
$lang['lightspeedto_odoo.home.no_recent_uploads'] = 'Aucun import récent';

// Upload CSV
$lang['lightspeedto_odoo.upload.title'] = 'Importer un fichier CSV';
$lang['lightspeedto_odoo.upload.description'] = 'Sélectionnez un fichier CSV exporté depuis Lightspeed Série K pour l\'importer dans le système.';
$lang['lightspeedto_odoo.upload.select_file'] = 'Sélectionner un fichier CSV';
$lang['lightspeedto_odoo.upload.file_requirements'] = 'Exigences du fichier';
$lang['lightspeedto_odoo.upload.format'] = 'Format : CSV uniquement';
$lang['lightspeedto_odoo.upload.max_size'] = 'Taille maximum : 10 MB';
$lang['lightspeedto_odoo.upload.encoding'] = 'Encodage : UTF-8 recommandé';
$lang['lightspeedto_odoo.upload.separator'] = 'Séparateur : virgule (,)';
$lang['lightspeedto_odoo.upload.submit'] = 'Importer le fichier';
$lang['lightspeedto_odoo.upload.success'] = 'Fichier importé avec succès';
$lang['lightspeedto_odoo.upload.error'] = 'Erreur lors de l\'import';
$lang['lightspeedto_odoo.upload.processing'] = 'Traitement en cours...';
$lang['lightspeedto_odoo.upload.auto_mapping'] = 'Mapping automatique détecté';
$lang['lightspeedto_odoo.upload.select_mapping'] = 'Sélectionner un mapping';
$lang['lightspeedto_odoo.upload.preview'] = 'Aperçu du fichier';
$lang['lightspeedto_odoo.upload.rows_detected'] = 'lignes détectées';
$lang['lightspeedto_odoo.upload.columns_detected'] = 'colonnes détectées';

// Mappings
$lang['lightspeedto_odoo.mappings.title'] = 'Gestion des mappings';
$lang['lightspeedto_odoo.mappings.description'] = 'Les mappings définissent la correspondance entre les colonnes de vos fichiers CSV Lightspeed et les champs Odoo.';
$lang['lightspeedto_odoo.mappings.add'] = 'Nouveau mapping';
$lang['lightspeedto_odoo.mappings.edit'] = 'Modifier le mapping';
$lang['lightspeedto_odoo.mappings.delete'] = 'Supprimer le mapping';
$lang['lightspeedto_odoo.mappings.name'] = 'Nom du mapping';
$lang['lightspeedto_odoo.mappings.description_field'] = 'Description';
$lang['lightspeedto_odoo.mappings.is_default'] = 'Mapping par défaut';
$lang['lightspeedto_odoo.mappings.created_date'] = 'Date de création';
$lang['lightspeedto_odoo.mappings.updated_date'] = 'Dernière modification';
$lang['lightspeedto_odoo.mappings.actions'] = 'Actions';
$lang['lightspeedto_odoo.mappings.no_mappings'] = 'Aucun mapping configuré';
$lang['lightspeedto_odoo.mappings.create_first'] = 'Créer votre premier mapping';
$lang['lightspeedto_odoo.mappings.duplicate'] = 'Dupliquer';
$lang['lightspeedto_odoo.mappings.export'] = 'Exporter';
$lang['lightspeedto_odoo.mappings.import'] = 'Importer';

// Formulaire de mapping
$lang['lightspeedto_odoo.mapping.form.title'] = 'Configuration du mapping';
$lang['lightspeedto_odoo.mapping.form.general'] = 'Informations générales';
$lang['lightspeedto_odoo.mapping.form.name'] = 'Nom du mapping';
$lang['lightspeedto_odoo.mapping.form.name_clue'] = 'Nom descriptif pour identifier ce mapping';
$lang['lightspeedto_odoo.mapping.form.description'] = 'Description';
$lang['lightspeedto_odoo.mapping.form.description_clue'] = 'Description détaillée de ce mapping';
$lang['lightspeedto_odoo.mapping.form.is_default'] = 'Définir comme mapping par défaut';
$lang['lightspeedto_odoo.mapping.form.is_default_clue'] = 'Ce mapping sera sélectionné automatiquement lors des imports';
$lang['lightspeedto_odoo.mapping.form.field_mapping'] = 'Correspondance des champs';
$lang['lightspeedto_odoo.mapping.form.lightspeed_column'] = 'Colonne Lightspeed';
$lang['lightspeedto_odoo.mapping.form.odoo_field'] = 'Champ Odoo';
$lang['lightspeedto_odoo.mapping.form.required'] = 'Obligatoire';
$lang['lightspeedto_odoo.mapping.form.transformation'] = 'Transformation';
$lang['lightspeedto_odoo.mapping.form.add_field'] = 'Ajouter un champ';
$lang['lightspeedto_odoo.mapping.form.remove_field'] = 'Supprimer';
$lang['lightspeedto_odoo.mapping.form.save'] = 'Enregistrer le mapping';
$lang['lightspeedto_odoo.mapping.form.cancel'] = 'Annuler';

// Traitements
$lang['lightspeedto_odoo.process.title'] = 'Historique des traitements';
$lang['lightspeedto_odoo.process.description'] = 'Historique de tous les traitements de transfert de données vers Odoo.';
$lang['lightspeedto_odoo.process.filename'] = 'Fichier';
$lang['lightspeedto_odoo.process.mapping'] = 'Mapping utilisé';
$lang['lightspeedto_odoo.process.status'] = 'Statut';
$lang['lightspeedto_odoo.process.upload_date'] = 'Date d\'import';
$lang['lightspeedto_odoo.process.processed_date'] = 'Date de traitement';
$lang['lightspeedto_odoo.process.progress'] = 'Progression';
$lang['lightspeedto_odoo.process.details'] = 'Détails';
$lang['lightspeedto_odoo.process.retry'] = 'Relancer';
$lang['lightspeedto_odoo.process.download'] = 'Télécharger';
$lang['lightspeedto_odoo.process.no_processes'] = 'Aucun traitement trouvé';

// Statuts de traitement
$lang['lightspeedto_odoo.status.pending'] = 'En attente';
$lang['lightspeedto_odoo.status.processing'] = 'En cours';
$lang['lightspeedto_odoo.status.completed'] = 'Terminé';
$lang['lightspeedto_odoo.status.failed'] = 'Échoué';
$lang['lightspeedto_odoo.status.cancelled'] = 'Annulé';
$lang['lightspeedto_odoo.status.paused'] = 'En pause';

// Détails de traitement
$lang['lightspeedto_odoo.process.details.title'] = 'Détails du traitement';
$lang['lightspeedto_odoo.process.details.general_info'] = 'Informations générales';
$lang['lightspeedto_odoo.process.details.file_info'] = 'Informations du fichier';
$lang['lightspeedto_odoo.process.details.original_filename'] = 'Nom du fichier original';
$lang['lightspeedto_odoo.process.details.file_size'] = 'Taille du fichier';
$lang['lightspeedto_odoo.process.details.total_rows'] = 'Nombre total de lignes';
$lang['lightspeedto_odoo.process.details.processed_rows'] = 'Lignes traitées';
$lang['lightspeedto_odoo.process.details.error_count'] = 'Nombre d\'erreurs';
$lang['lightspeedto_odoo.process.details.success_rate'] = 'Taux de réussite';
$lang['lightspeedto_odoo.process.details.processing_time'] = 'Temps de traitement';
$lang['lightspeedto_odoo.process.details.errors_log'] = 'Journal des erreurs';
$lang['lightspeedto_odoo.process.details.no_errors'] = 'Aucune erreur détectée';
$lang['lightspeedto_odoo.process.details.download_errors'] = 'Télécharger le rapport d\'erreurs';

// Configuration admin
$lang['lightspeedto_odoo.config.title'] = 'Configuration du module';
$lang['lightspeedto_odoo.config.description'] = 'Configuration des paramètres de connexion à Odoo et autres réglages du module.';
$lang['lightspeedto_odoo.config.odoo_connection'] = 'Connexion Odoo';
$lang['lightspeedto_odoo.config.odoo_url'] = 'URL du serveur Odoo';
$lang['lightspeedto_odoo.config.odoo_url_clue'] = 'URL complète de votre serveur Odoo (ex: https://monodoo.com)';
$lang['lightspeedto_odoo.config.odoo_database'] = 'Base de données';
$lang['lightspeedto_odoo.config.odoo_database_clue'] = 'Nom de la base de données Odoo';
$lang['lightspeedto_odoo.config.odoo_username'] = 'Nom d\'utilisateur';
$lang['lightspeedto_odoo.config.odoo_username_clue'] = 'Nom d\'utilisateur Odoo avec les droits d\'écriture sur les produits';
$lang['lightspeedto_odoo.config.odoo_password'] = 'Mot de passe';
$lang['lightspeedto_odoo.config.odoo_password_clue'] = 'Mot de passe de l\'utilisateur Odoo';
$lang['lightspeedto_odoo.config.odoo_api_key'] = 'Clé API (optionnel)';
$lang['lightspeedto_odoo.config.odoo_api_key_clue'] = 'Clé API Odoo si vous en utilisez une à la place du mot de passe';
$lang['lightspeedto_odoo.config.module_settings'] = 'Paramètres du module';
$lang['lightspeedto_odoo.config.max_file_size'] = 'Taille maximum des fichiers (MB)';
$lang['lightspeedto_odoo.config.max_file_size_clue'] = 'Taille maximum autorisée pour les fichiers CSV importés';
$lang['lightspeedto_odoo.config.batch_size'] = 'Taille des lots de traitement';
$lang['lightspeedto_odoo.config.batch_size_clue'] = 'Nombre de lignes traitées en une fois (recommandé: 100)';
$lang['lightspeedto_odoo.config.timeout'] = 'Timeout de connexion (secondes)';
$lang['lightspeedto_odoo.config.timeout_clue'] = 'Délai maximum d\'attente pour les requêtes vers Odoo';
$lang['lightspeedto_odoo.config.enable_logging'] = 'Activer les logs détaillés';
$lang['lightspeedto_odoo.config.enable_logging_clue'] = 'Enregistrer tous les détails des traitements (peut ralentir les performances)';
$lang['lightspeedto_odoo.config.test_connection'] = 'Tester la connexion';
$lang['lightspeedto_odoo.config.save'] = 'Enregistrer la configuration';
$lang['lightspeedto_odoo.config.connection_success'] = 'Connexion à Odoo réussie !';
$lang['lightspeedto_odoo.config.connection_failed'] = 'Échec de la connexion à Odoo';

// Messages d'erreur
$lang['lightspeedto_odoo.error.file_not_found'] = 'Fichier non trouvé';
$lang['lightspeedto_odoo.error.file_too_large'] = 'Le fichier est trop volumineux';
$lang['lightspeedto_odoo.error.invalid_format'] = 'Format de fichier invalide';
$lang['lightspeedto_odoo.error.upload_failed'] = 'Échec de l\'upload';
$lang['lightspeedto_odoo.error.parsing_failed'] = 'Erreur lors de l\'analyse du fichier CSV';
$lang['lightspeedto_odoo.error.no_mapping'] = 'Aucun mapping disponible';
$lang['lightspeedto_odoo.error.invalid_mapping'] = 'Mapping invalide ou corrompu';
$lang['lightspeedto_odoo.error.odoo_connection'] = 'Erreur de connexion à Odoo';
$lang['lightspeedto_odoo.error.odoo_authentication'] = 'Erreur d\'authentification Odoo';
$lang['lightspeedto_odoo.error.odoo_api'] = 'Erreur de l\'API Odoo';
$lang['lightspeedto_odoo.error.processing'] = 'Erreur lors du traitement';
$lang['lightspeedto_odoo.error.permission_denied'] = 'Permissions insuffisantes';
$lang['lightspeedto_odoo.error.timeout'] = 'Délai d\'attente dépassé';
$lang['lightspeedto_odoo.error.unknown'] = 'Erreur inconnue';

// Messages de succès
$lang['lightspeedto_odoo.success.upload'] = 'Fichier uploadé avec succès';
$lang['lightspeedto_odoo.success.mapping_saved'] = 'Mapping enregistré avec succès';
$lang['lightspeedto_odoo.success.mapping_deleted'] = 'Mapping supprimé avec succès';
$lang['lightspeedto_odoo.success.config_saved'] = 'Configuration enregistrée avec succès';
$lang['lightspeedto_odoo.success.processing_started'] = 'Traitement démarré avec succès';
$lang['lightspeedto_odoo.success.processing_completed'] = 'Traitement terminé avec succès';

// Messages d'avertissement
$lang['lightspeedto_odoo.warning.no_default_mapping'] = 'Aucun mapping par défaut défini';
$lang['lightspeedto_odoo.warning.large_file'] = 'Fichier volumineux, le traitement peut prendre du temps';
$lang['lightspeedto_odoo.warning.overwrite_default'] = 'Cela remplacera le mapping par défaut existant';
$lang['lightspeedto_odoo.warning.delete_mapping'] = 'Êtes-vous sûr de vouloir supprimer ce mapping ?';
$lang['lightspeedto_odoo.warning.connection_not_tested'] = 'La connexion à Odoo n\'a pas été testée';
$lang['lightspeedto_odoo.warning.processing_in_progress'] = 'Un traitement est déjà en cours';

// Autorisations
$lang['lightspeedto_odoo.authorizations.read'] = 'Consulter';
$lang['lightspeedto_odoo.authorizations.write'] = 'Importer des fichiers';
$lang['lightspeedto_odoo.authorizations.manage_mappings'] = 'Gérer les mappings';
$lang['lightspeedto_odoo.authorizations.admin'] = 'Administrer le module';

// Aide et documentation
$lang['lightspeedto_odoo.help.title'] = 'Aide et documentation';
$lang['lightspeedto_odoo.help.getting_started'] = 'Premiers pas';
$lang['lightspeedto_odoo.help.upload_process'] = 'Processus d\'import';
$lang['lightspeedto_odoo.help.mapping_creation'] = 'Création de mappings';
$lang['lightspeedto_odoo.help.troubleshooting'] = 'Résolution de problèmes';
$lang['lightspeedto_odoo.help.faq'] = 'Questions fréquentes';

// Troubleshooting détaillé
$lang['lightspeedto_odoo.config.troubleshooting.title'] = 'Résolution des problèmes';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed'] = 'Si la connexion échoue :';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution1'] = 'Vérifiez l\'URL du serveur Odoo';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution2'] = 'Vérifiez le nom de la base de données';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution3'] = 'Vérifiez les identifiants de connexion';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution4'] = 'Assurez-vous que le serveur est accessible';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed'] = 'Si l\'authentification échoue :';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution1'] = 'Vérifiez le nom d\'utilisateur et le mot de passe';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution2'] = 'Vérifiez que l\'utilisateur a les droits nécessaires';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution3'] = 'Essayez de vous connecter directement à Odoo avec ces identifiants';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied'] = 'Si les permissions sont refusées :';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution1'] = 'Vérifiez que l\'utilisateur a les droits d\'écriture sur les produits';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution2'] = 'Contactez votre administrateur Odoo';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution3'] = 'Vérifiez que la clé API n\'a pas expiré';

// Validation en temps réel
$lang['lightspeedto_odoo.validation.url_required'] = 'L\'URL du serveur Odoo est requise';
$lang['lightspeedto_odoo.validation.url_invalid'] = 'L\'URL du serveur Odoo est invalide';
$lang['lightspeedto_odoo.validation.database_required'] = 'Le nom de la base de données est requis';
$lang['lightspeedto_odoo.validation.username_required'] = 'Le nom d\'utilisateur est requis';
$lang['lightspeedto_odoo.validation.password_or_api_key_required'] = 'Le mot de passe ou la clé API est requis';
$lang['lightspeedto_odoo.validation.file_required'] = 'Veuillez sélectionner un fichier';
$lang['lightspeedto_odoo.validation.file_extension'] = 'Seuls les fichiers CSV sont autorisés';
$lang['lightspeedto_odoo.validation.mapping_name_required'] = 'Le nom du mapping est requis';
$lang['lightspeedto_odoo.validation.mapping_fields_required'] = 'Au moins un champ doit être mappé';

// Mini menu
$lang['lightspeedto_odoo.mini_menu.title'] = 'Lightspeed → Odoo';
$lang['lightspeedto_odoo.mini_menu.pending_uploads'] = 'Imports en attente';
$lang['lightspeedto_odoo.mini_menu.processing'] = 'En cours de traitement';
$lang['lightspeedto_odoo.mini_menu.recent_success'] = 'Derniers succès';
$lang['lightspeedto_odoo.mini_menu.recent_errors'] = 'Erreurs récentes';
$lang['lightspeedto_odoo.mini_menu.quick_upload'] = 'Import rapide';
$lang['lightspeedto_odoo.mini_menu.view_all'] = 'Voir tout';

// Champs de produits Odoo
$lang['lightspeedto_odoo.odoo_fields.name'] = 'Nom du produit';
$lang['lightspeedto_odoo.odoo_fields.default_code'] = 'Référence interne';
$lang['lightspeedto_odoo.odoo_fields.barcode'] = 'Code-barres';
$lang['lightspeedto_odoo.odoo_fields.list_price'] = 'Prix de vente';
$lang['lightspeedto_odoo.odoo_fields.standard_price'] = 'Coût';
$lang['lightspeedto_odoo.odoo_fields.categ_id'] = 'Catégorie';
$lang['lightspeedto_odoo.odoo_fields.description'] = 'Description';
$lang['lightspeedto_odoo.odoo_fields.description_sale'] = 'Description de vente';
$lang['lightspeedto_odoo.odoo_fields.active'] = 'Actif';
$lang['lightspeedto_odoo.odoo_fields.sale_ok'] = 'Peut être vendu';
$lang['lightspeedto_odoo.odoo_fields.purchase_ok'] = 'Peut être acheté';
$lang['lightspeedto_odoo.odoo_fields.type'] = 'Type de produit';
$lang['lightspeedto_odoo.odoo_fields.weight'] = 'Poids';
$lang['lightspeedto_odoo.odoo_fields.volume'] = 'Volume';
$lang['lightspeedto_odoo.odoo_fields.taxes_id'] = 'Taxes client';
$lang['lightspeedto_odoo.odoo_fields.supplier_taxes_id'] = 'Taxes fournisseur';

// Transformations de données
$lang['lightspeedto_odoo.transformation.none'] = 'Aucune';
$lang['lightspeedto_odoo.transformation.uppercase'] = 'Majuscules';
$lang['lightspeedto_odoo.transformation.lowercase'] = 'Minuscules';
$lang['lightspeedto_odoo.transformation.trim'] = 'Supprimer les espaces';
$lang['lightspeedto_odoo.transformation.number'] = 'Convertir en nombre';
$lang['lightspeedto_odoo.transformation.boolean'] = 'Convertir en booléen';
$lang['lightspeedto_odoo.transformation.date'] = 'Convertir en date';
$lang['lightspeedto_odoo.transformation.custom'] = 'Transformation personnalisée';

// AJAX et temps réel
$lang['lightspeedto_odoo.ajax.processing'] = 'Traitement en cours...';
$lang['lightspeedto_odoo.ajax.completed'] = 'Traitement terminé';
$lang['lightspeedto_odoo.ajax.error'] = 'Erreur lors du traitement';
$lang['lightspeedto_odoo.ajax.progress'] = 'Progression : {PROGRESS}%';
$lang['lightspeedto_odoo.ajax.rows_processed'] = '{PROCESSED} lignes sur {TOTAL} traitées';
$lang['lightspeedto_odoo.ajax.estimated_time'] = 'Temps estimé restant : {TIME}';
$lang['lightspeedto_odoo.ajax.pause'] = 'Mettre en pause';
$lang['lightspeedto_odoo.ajax.resume'] = 'Reprendre';
$lang['lightspeedto_odoo.ajax.cancel'] = 'Annuler';

// Guide utilisateur
$lang['lightspeedto_odoo.guide.title'] = 'Guide utilisateur';
$lang['lightspeedto_odoo.guide.step1'] = 'Étape 1 : Configuration';
$lang['lightspeedto_odoo.guide.step1.desc'] = 'Configurez les paramètres de connexion à votre serveur Odoo';
$lang['lightspeedto_odoo.guide.step2'] = 'Étape 2 : Créer un mapping';
$lang['lightspeedto_odoo.guide.step2.desc'] = 'Définissez la correspondance entre les colonnes Lightspeed et les champs Odoo';
$lang['lightspeedto_odoo.guide.step3'] = 'Étape 3 : Importer un fichier CSV';
$lang['lightspeedto_odoo.guide.step3.desc'] = 'Uploadez votre fichier CSV exporté depuis Lightspeed';
$lang['lightspeedto_odoo.guide.step4'] = 'Étape 4 : Traitement';
$lang['lightspeedto_odoo.guide.step4.desc'] = 'Le système traite automatiquement votre fichier et transfère les données vers Odoo';

// SEO et métadonnées
$lang['lightspeedto_odoo.seo.description'] = 'Module PHPBoost pour transférer les données CSV de Lightspeed Série K vers Odoo POS avec système de mapping configurable.';
$lang['lightspeedto_odoo.seo.keywords'] = 'lightspeed, odoo, pos, csv, import, export, mapping, transfert, données';

// Pagination et navigation
$lang['lightspeedto_odoo.pagination.previous'] = 'Précédent';
$lang['lightspeedto_odoo.pagination.next'] = 'Suivant';
$lang['lightspeedto_odoo.pagination.first'] = 'Premier';
$lang['lightspeedto_odoo.pagination.last'] = 'Dernier';
$lang['lightspeedto_odoo.pagination.page'] = 'Page';
$lang['lightspeedto_odoo.pagination.of'] = 'sur';
$lang['lightspeedto_odoo.pagination.results'] = 'résultats';

// Actions de masse
$lang['lightspeedto_odoo.bulk.select_all'] = 'Tout sélectionner';
$lang['lightspeedto_odoo.bulk.select_none'] = 'Tout désélectionner';
$lang['lightspeedto_odoo.bulk.actions'] = 'Actions sur la sélection';
$lang['lightspeedto_odoo.bulk.delete'] = 'Supprimer les éléments sélectionnés';
$lang['lightspeedto_odoo.bulk.retry'] = 'Relancer les traitements sélectionnés';
$lang['lightspeedto_odoo.bulk.export'] = 'Exporter la sélection';

// Formats de date
$lang['lightspeedto_odoo.date.format'] = 'd/m/Y H:i:s';
$lang['lightspeedto_odoo.date.format.short'] = 'd/m/Y';
$lang['lightspeedto_odoo.date.format.time'] = 'H:i:s';

// Messages de confirmation
$lang['lightspeedto_odoo.confirm.delete_mapping'] = 'Êtes-vous sûr de vouloir supprimer ce mapping ?';
$lang['lightspeedto_odoo.confirm.delete_upload'] = 'Êtes-vous sûr de vouloir supprimer cet upload ?';
$lang['lightspeedto_odoo.confirm.cancel_process'] = 'Êtes-vous sûr de vouloir annuler ce traitement ?';
$lang['lightspeedto_odoo.confirm.retry_process'] = 'Êtes-vous sûr de vouloir relancer ce traitement ?';

// Infobulles et aides
$lang['lightspeedto_odoo.tooltip.default_mapping'] = 'Ce mapping sera utilisé automatiquement lors des nouveaux imports';
$lang['lightspeedto_odoo.tooltip.required_field'] = 'Ce champ est obligatoire pour la création de produits dans Odoo';
$lang['lightspeedto_odoo.tooltip.transformation'] = 'Transformation à appliquer aux données avant l\'envoi vers Odoo';
$lang['lightspeedto_odoo.tooltip.batch_size'] = 'Un nombre plus élevé est plus rapide mais consomme plus de mémoire';
$lang['lightspeedto_odoo.tooltip.api_key'] = 'Laissez vide si vous utilisez un mot de passe classique';

// Messages système
$lang['lightspeedto_odoo.system.module_not_configured'] = 'Le module n\'est pas encore configuré. Veuillez configurer la connexion à Odoo.';
$lang['lightspeedto_odoo.system.no_mapping_available'] = 'Aucun mapping disponible. Veuillez créer au moins un mapping.';
$lang['lightspeedto_odoo.system.processing_disabled'] = 'Le traitement est temporairement désactivé.';
$lang['lightspeedto_odoo.system.maintenance_mode'] = 'Le module est en mode maintenance.';

// Labels génériques
$lang['lightspeedto_odoo.label.yes'] = 'Oui';
$lang['lightspeedto_odoo.label.no'] = 'Non';
$lang['lightspeedto_odoo.label.enabled'] = 'Activé';
$lang['lightspeedto_odoo.label.disabled'] = 'Désactivé';
$lang['lightspeedto_odoo.label.optional'] = 'Optionnel';
$lang['lightspeedto_odoo.label.required'] = 'Requis';
$lang['lightspeedto_odoo.label.recommended'] = 'Recommandé';
$lang['lightspeedto_odoo.label.advanced'] = 'Avancé';

// Tree links (liens dans l'arbre de navigation)
$lang['lightspeedto_odoo.tree_links.home'] = 'Accueil Lightspeed→Odoo';
$lang['lightspeedto_odoo.tree_links.upload'] = 'Importer CSV';
$lang['lightspeedto_odoo.tree_links.mappings'] = 'Gérer les mappings';
$lang['lightspeedto_odoo.tree_links.process'] = 'Historique des traitements';
$lang['lightspeedto_odoo.tree_links.config'] = 'Configuration';
$lang['lightspeedto_odoo.tree_links.documentation'] = 'Documentation';

// Extensions PHPBoost
$lang['lightspeedto_odoo.extension.feeds'] = 'Flux RSS des imports';
$lang['lightspeedto_odoo.extension.sitemap'] = 'Plan du site - Lightspeed vers Odoo';
$lang['lightspeedto_odoo.extension.home_page'] = 'Page d\'accueil - Module Lightspeed vers Odoo';
