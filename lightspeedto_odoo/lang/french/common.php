<?php

/**
 * @copyright   &copy; 2024 LordZatchi
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
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
$lang['lightspeedto_odoo.home.statistics'] = 'Statistiques';
$lang['lightspeedto_odoo.home.recent_uploads'] = 'Derniers imports';
$lang['lightspeedto_odoo.home.getting_started'] = 'Guide de démarrage';
$lang['lightspeedto_odoo.home.help.title'] = 'Aide et documentation';
$lang['lightspeedto_odoo.home.help.description'] = 'Consultez les sections suivantes pour plus d\'informations :';
$lang['lightspeedto_odoo.home.help.mappings'] = 'Gérer les mappings de champs';
$lang['lightspeedto_odoo.home.help.upload'] = 'Importer des fichiers CSV';
$lang['lightspeedto_odoo.home.help.process'] = 'Historique des traitements';

// Upload CSV
$lang['lightspeedto_odoo.upload.title'] = 'Importer un fichier CSV';
$lang['lightspeedto_odoo.upload.description'] = 'Sélectionnez un fichier CSV exporté depuis Lightspeed Série K pour l\'importer dans le système.';
$lang['lightspeedto_odoo.upload.form.title'] = 'Formulaire d\'import';
$lang['lightspeedto_odoo.upload.new'] = 'Nouvel import';
$lang['lightspeedto_odoo.upload.start'] = 'Commencer l\'import';
$lang['lightspeedto_odoo.upload.first'] = 'Premier import';
$lang['lightspeedto_odoo.upload.file'] = 'Fichier CSV';
$lang['lightspeedto_odoo.upload.mapping'] = 'Mapping à utiliser';
$lang['lightspeedto_odoo.upload.date'] = 'Date d\'import';
$lang['lightspeedto_odoo.upload.file_size'] = 'Taille du fichier';
$lang['lightspeedto_odoo.upload.information'] = 'Informations de l\'import';
$lang['lightspeedto_odoo.upload.file_info'] = 'Informations du fichier';
$lang['lightspeedto_odoo.upload.progress'] = 'Progression';
$lang['lightspeedto_odoo.upload.errors'] = 'Erreurs';
$lang['lightspeedto_odoo.upload.no_permission'] = 'Vous n\'avez pas les permissions pour importer des fichiers.';
$lang['lightspeedto_odoo.upload.uploading'] = 'Import en cours...';

// Instructions d'upload
$lang['lightspeedto_odoo.upload.instructions.title'] = 'Instructions d\'import';
$lang['lightspeedto_odoo.upload.csv_format'] = 'Format CSV requis';
$lang['lightspeedto_odoo.upload.csv_format.description'] = 'Votre fichier CSV doit respecter les contraintes suivantes :';
$lang['lightspeedto_odoo.upload.csv_format.encoding'] = 'Encodage UTF-8 recommandé';
$lang['lightspeedto_odoo.upload.csv_format.separator'] = 'Séparateur : virgule (,) ou point-virgule (;)';
$lang['lightspeedto_odoo.upload.csv_format.headers'] = 'Première ligne contenant les en-têtes';
$lang['lightspeedto_odoo.upload.csv_format.size'] = 'Taille maximum : 10 MB';

// Champs supportés
$lang['lightspeedto_odoo.upload.supported_fields'] = 'Champs supportés';
$lang['lightspeedto_odoo.upload.supported_fields.description'] = 'Liste des champs reconnus pour le mapping entre Lightspeed et Odoo :';

// Processus d'upload
$lang['lightspeedto_odoo.upload.process.title'] = 'Processus d\'import';
$lang['lightspeedto_odoo.upload.process.description'] = 'L\'import se déroule en plusieurs étapes :';
$lang['lightspeedto_odoo.upload.process.step1'] = 'Sélection du fichier CSV et du mapping';
$lang['lightspeedto_odoo.upload.process.step2'] = 'Validation du format et des données';
$lang['lightspeedto_odoo.upload.process.step3'] = 'Traitement et mapping des champs';
$lang['lightspeedto_odoo.upload.process.step4'] = 'Envoi des données vers Odoo';
$lang['lightspeedto_odoo.upload.process.step5'] = 'Génération du rapport de traitement';

// Exemples
$lang['lightspeedto_odoo.upload.examples.title'] = 'Exemples de fichiers';
$lang['lightspeedto_odoo.upload.examples.lightspeed'] = 'Exemple CSV Lightspeed';
$lang['lightspeedto_odoo.upload.examples.lightspeed.description'] = 'Exemple de structure d\'un fichier CSV exporté depuis Lightspeed Série K :';
$lang['lightspeedto_odoo.upload.examples.mapping'] = 'Exemple de mapping';
$lang['lightspeedto_odoo.upload.examples.mapping.description'] = 'Exemple de correspondance entre les champs Lightspeed et Odoo :';

// Prévisualisation
$lang['lightspeedto_odoo.upload.preview.headers'] = 'En-têtes détectés';
$lang['lightspeedto_odoo.upload.preview.rows'] = 'Nombre de lignes';

// Erreurs d'upload
$lang['lightspeedto_odoo.upload.error.no_file'] = 'Veuillez sélectionner un fichier à importer.';
$lang['lightspeedto_odoo.upload.error.invalid_extension'] = 'Seuls les fichiers CSV sont autorisés.';
$lang['lightspeedto_odoo.upload.error.file_too_large'] = 'Le fichier est trop volumineux. Taille maximum autorisée : 10 MB.';
$lang['lightspeedto_odoo.upload.error.not_csv'] = 'Le fichier sélectionné n\'est pas un fichier CSV valide.';

// Avertissements d'upload
$lang['lightspeedto_odoo.upload.warning.no_mapping'] = 'Aucun mapping sélectionné. Voulez-vous continuer ? Le mapping devra être défini plus tard.';

// Mappings
$lang['lightspeedto_odoo.mappings.title'] = 'Gestion des mappings';
$lang['lightspeedto_odoo.mappings.description'] = 'Les mappings définissent la correspondance entre les colonnes de vos fichiers CSV Lightspeed et les champs Odoo.';
$lang['lightspeedto_odoo.mappings.management'] = 'Gestion des mappings';
$lang['lightspeedto_odoo.mappings.manage'] = 'Gérer les mappings';
$lang['lightspeedto_odoo.mappings.list'] = 'Liste des mappings';
$lang['lightspeedto_odoo.mappings.none'] = 'Aucun mapping configuré';
$lang['lightspeedto_odoo.mappings.none.description'] = 'Vous devez créer au moins un mapping pour pouvoir traiter vos fichiers CSV.';

// Actions sur les mappings
$lang['lightspeedto_odoo.mapping.add'] = 'Nouveau mapping';
$lang['lightspeedto_odoo.mapping.edit'] = 'Modifier le mapping';
$lang['lightspeedto_odoo.mapping.delete'] = 'Supprimer le mapping';
$lang['lightspeedto_odoo.mapping.create_first'] = 'Créer votre premier mapping';
$lang['lightspeedto_odoo.mapping.none'] = 'Aucun mapping';
$lang['lightspeedto_odoo.mapping.default'] = 'Par défaut';
$lang['lightspeedto_odoo.mapping.is_default'] = 'Mapping par défaut';
$lang['lightspeedto_odoo.mapping.is_default.description'] = 'Ce mapping sera utilisé automatiquement pour les nouveaux imports.';
$lang['lightspeedto_odoo.mapping.configuration'] = 'Configuration du mapping';
$lang['lightspeedto_odoo.mapping.fields'] = 'Correspondance des champs';
$lang['lightspeedto_odoo.mapping.explanation'] = 'Définissez la correspondance entre les colonnes de vos fichiers Lightspeed et les champs Odoo. Chaque ligne représente une correspondance.';
$lang['lightspeedto_odoo.mapping.created_date'] = 'Date de création';
$lang['lightspeedto_odoo.mapping.updated_date'] = 'Dernière modification';

// Champs de mapping
$lang['lightspeedto_odoo.mapping.lightspeed_field'] = 'Champ Lightspeed';
$lang['lightspeedto_odoo.mapping.odoo_field'] = 'Champ Odoo';
$lang['lightspeedto_odoo.mapping.transformation'] = 'Transformation';
$lang['lightspeedto_odoo.mapping.transformation.placeholder'] = 'Ex: uppercase, float, trim...';
$lang['lightspeedto_odoo.mapping.add_field'] = 'Ajouter un champ';

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

// Erreurs de mapping
$lang['lightspeedto_odoo.mapping.error.no_valid_mappings'] = 'Vous devez définir au moins une correspondance de champs valide.';
$lang['lightspeedto_odoo.mapping.error.duplicate_lightspeed'] = 'Le champ Lightspeed est déjà utilisé';
$lang['lightspeedto_odoo.mapping.error.duplicate_odoo'] = 'Le champ Odoo est déjà utilisé';
$lang['lightspeedto_odoo.mapping.field.delete.confirmation'] = 'Êtes-vous sûr de vouloir supprimer cette correspondance de champs ?';

// Suppression de mapping
$lang['lightspeedto_odoo.mapping.delete.confirmation'] = 'Êtes-vous sûr de vouloir supprimer le mapping "{name}" ?';
$lang['lightspeedto_odoo.mapping.delete.confirmation.simple'] = 'Êtes-vous sûr de vouloir supprimer ce mapping ?';
$lang['lightspeedto_odoo.mapping.delete.warning.uploads'] = 'Attention : {count} import(s) utilise(nt) ce mapping. En le supprimant, ces imports n\'auront plus de mapping associé.';
$lang['lightspeedto_odoo.mapping.delete.warning.default'] = 'Ce mapping est défini comme mapping par défaut. En le supprimant, aucun mapping ne sera sélectionné automatiquement.';

// Informations sur les mappings
$lang['lightspeedto_odoo.mappings.info.title'] = 'À propos des mappings';
$lang['lightspeedto_odoo.mappings.info.what_is'] = 'Qu\'est-ce qu\'un mapping ?';
$lang['lightspeedto_odoo.mappings.info.description'] = 'Un mapping définit la correspondance entre les colonnes de vos fichiers CSV Lightspeed et les champs de produits dans Odoo. Il permet au système de savoir quelle donnée CSV correspond à quel champ Odoo.';
$lang['lightspeedto_odoo.mappings.info.default'] = 'Mapping par défaut';
$lang['lightspeedto_odoo.mappings.info.default.description'] = 'Le mapping marqué comme "par défaut" sera automatiquement sélectionné lors de nouveaux imports. Vous pouvez avoir un seul mapping par défaut.';
$lang['lightspeedto_odoo.mappings.info.transformations'] = 'Transformations de données';
$lang['lightspeedto_odoo.mappings.info.transformations.description'] = 'Vous pouvez appliquer des transformations aux données avant leur envoi vers Odoo :';

// Guide de mapping
$lang['lightspeedto_odoo.mappings.guide.title'] = 'Guide de création de mapping';
$lang['lightspeedto_odoo.mappings.guide.step1'] = 'Étape 1 : Nommer votre mapping';
$lang['lightspeedto_odoo.mappings.guide.step1.description'] = 'Donnez un nom descriptif à votre mapping (ex: "Mapping produits standard")';
$lang['lightspeedto_odoo.mappings.guide.step2'] = 'Étape 2 : Correspondances de champs';
$lang['lightspeedto_odoo.mappings.guide.step2.description'] = 'Pour chaque champ Lightspeed, sélectionnez le champ Odoo correspondant';
$lang['lightspeedto_odoo.mappings.guide.step3'] = 'Étape 3 : Transformations (optionnel)';
$lang['lightspeedto_odoo.mappings.guide.step3.description'] = 'Appliquez des transformations si nécessaire (majuscules, conversion numérique, etc.)';
$lang['lightspeedto_odoo.mappings.guide.step4'] = 'Étape 4 : Définir comme défaut (optionnel)';
$lang['lightspeedto_odoo.mappings.guide.step4.description'] = 'Cochez cette option si ce mapping doit être utilisé par défaut';
$lang['lightspeedto_odoo.mappings.guide.step5'] = 'Étape 5 : Sauvegarder';
$lang['lightspeedto_odoo.mappings.guide.step5.description'] = 'Enregistrez votre mapping pour pouvoir l\'utiliser lors des imports';

// Conseils pour les mappings
$lang['lightspeedto_odoo.mappings.guide.tips.title'] = 'Conseils utiles';
$lang['lightspeedto_odoo.mappings.guide.tips.tip1'] = 'Créez des mappings spécifiques selon vos types de produits';
$lang['lightspeedto_odoo.mappings.guide.tips.tip2'] = 'Testez vos mappings avec un petit fichier avant de traiter de gros volumes';
$lang['lightspeedto_odoo.mappings.guide.tips.tip3'] = 'Utilisez les transformations pour adapter le format des données';
$lang['lightspeedto_odoo.mappings.guide.tips.tip4'] = 'Sauvegardez vos mappings : ils peuvent être réutilisés pour tous vos imports';

// Traitements (Process)
$lang['lightspeedto_odoo.process.title'] = 'Historique des traitements';
$lang['lightspeedto_odoo.process.description'] = 'Historique de tous les traitements de transfert de données vers Odoo.';
$lang['lightspeedto_odoo.process.uploads_list'] = 'Liste des imports';
$lang['lightspeedto_odoo.process.no_uploads'] = 'Aucun traitement trouvé';
$lang['lightspeedto_odoo.process.no_uploads.description'] = 'Aucun fichier n\'a encore été importé. Commencez par importer votre premier fichier CSV.';
$lang['lightspeedto_odoo.process.view_all'] = 'Voir tous les traitements';
$lang['lightspeedto_odoo.process.back_to_list'] = 'Retour à la liste';

// Statuts de traitement
$lang['lightspeedto_odoo.status.pending'] = 'En attente';
$lang['lightspeedto_odoo.status.processing'] = 'En cours';
$lang['lightspeedto_odoo.status.completed'] = 'Terminé';
$lang['lightspeedto_odoo.status.failed'] = 'Échoué';
$lang['lightspeedto_odoo.status.error'] = 'Erreur';
$lang['lightspeedto_odoo.status.cancelled'] = 'Annulé';
$lang['lightspeedto_odoo.status.paused'] = 'En pause';

// Actions de traitement
$lang['lightspeedto_odoo.process.start'] = 'Démarrer le traitement';
$lang['lightspeedto_odoo.process.retry'] = 'Relancer';
$lang['lightspeedto_odoo.process.pause'] = 'Mettre en pause';
$lang['lightspeedto_odoo.process.resume'] = 'Reprendre';
$lang['lightspeedto_odoo.process.cancel'] = 'Annuler';
$lang['lightspeedto_odoo.process.delete.confirmation'] = 'Êtes-vous sûr de vouloir supprimer ce traitement ?';

// Détails de traitement
$lang['lightspeedto_odoo.process.details'] = 'Détails du traitement';
$lang['lightspeedto_odoo.process.status_info'] = 'Informations du statut';
$lang['lightspeedto_odoo.process.processed_date'] = 'Date de traitement';
$lang['lightspeedto_odoo.process.progress_stats'] = 'Progression et statistiques';
$lang['lightspeedto_odoo.process.rows_processed'] = 'lignes traitées';
$lang['lightspeedto_odoo.process.errors'] = 'Erreurs';
$lang['lightspeedto_odoo.process.success_rate'] = 'Taux de réussite';
$lang['lightspeedto_odoo.process.processing_time'] = 'Temps de traitement';
$lang['lightspeedto_odoo.process.errors_log'] = 'Journal des erreurs';
$lang['lightspeedto_odoo.process.no_errors'] = 'Aucune erreur détectée';
$lang['lightspeedto_odoo.process.no_errors.description'] = 'Le traitement s\'est déroulé sans erreur. Toutes les données ont été transférées avec succès vers Odoo.';
$lang['lightspeedto_odoo.process.error_data'] = 'Données concernées';
$lang['lightspeedto_odoo.process.download_errors_report'] = 'Télécharger le rapport d\'erreurs';

// Messages d'erreur de traitement
$lang['lightspeedto_odoo.process.error.no_mapping'] = 'Aucun mapping défini pour ce fichier. Veuillez d\'abord définir un mapping.';
$lang['lightspeedto_odoo.process.error.odoo_not_configured'] = 'La connexion à Odoo n\'est pas configurée. Veuillez configurer les paramètres de connexion.';

// Traitement en temps réel (AJAX)
$lang['lightspeedto_odoo.process.processing'] = 'Traitement en cours';
$lang['lightspeedto_odoo.process.processing_file'] = 'Traitement du fichier en cours';
$lang['lightspeedto_odoo.process.initializing'] = 'Initialisation du traitement...';
$lang['lightspeedto_odoo.process.processing_data'] = 'Traitement des données en cours...';
$lang['lightspeedto_odoo.process.completed'] = 'Traitement terminé';
$lang['lightspeedto_odoo.process.completed_successfully'] = 'Traitement terminé avec succès !';
$lang['lightspeedto_odoo.process.completed_with_errors'] = 'Traitement terminé avec des erreurs';
$lang['lightspeedto_odoo.process.error'] = 'Erreur lors du traitement';
$lang['lightspeedto_odoo.process.paused'] = 'Traitement en pause';
$lang['lightspeedto_odoo.process.cancelled'] = 'Traitement annulé';
$lang['lightspeedto_odoo.process.rows'] = 'lignes';
$lang['lightspeedto_odoo.process.processed'] = 'Traitées';
$lang['lightspeedto_odoo.process.elapsed_time'] = 'Temps écoulé';
$lang['lightspeedto_odoo.process.rows_per_second'] = 'Lignes/sec';
$lang['lightspeedto_odoo.process.view_details'] = 'Voir les détails';
$lang['lightspeedto_odoo.process.real_time_log'] = 'Journal en temps réel';
$lang['lightspeedto_odoo.process.refreshing'] = 'Actualisation...';
$lang['lightspeedto_odoo.process.refresh_status'] = 'Actualiser le statut';
$lang['lightspeedto_odoo.process.refresh_status.description'] = 'Actualise le statut du traitement en cours';

// Messages de confirmation pour le traitement
$lang['lightspeedto_odoo.process.cancel.confirmation'] = 'Êtes-vous sûr de vouloir annuler ce traitement ? Cette action ne peut pas être annulée.';

// Messages du journal temps réel
$lang['lightspeedto_odoo.process.log.starting'] = 'Démarrage du traitement...';
$lang['lightspeedto_odoo.process.log.paused'] = 'Traitement mis en pause par l\'utilisateur';
$lang['lightspeedto_odoo.process.log.resumed'] = 'Traitement repris';
$lang['lightspeedto_odoo.process.log.cancelled'] = 'Traitement annulé par l\'utilisateur';

// Erreurs AJAX
$lang['lightspeedto_odoo.process.error.invalid_response'] = 'Réponse du serveur invalide';
$lang['lightspeedto_odoo.process.error.network'] = 'Erreur de connexion réseau';
$lang['lightspeedto_odoo.process.error.unknown'] = 'Erreur inconnue lors du traitement';

// Filtres et statistiques de traitement
$lang['lightspeedto_odoo.process.filters_stats'] = 'Filtres et statistiques';
$lang['lightspeedto_odoo.process.filters'] = 'Filtres';
$lang['lightspeedto_odoo.process.filter'] = 'Filtrer';
$lang['lightspeedto_odoo.process.reset_filter'] = 'Réinitialiser les filtres';
$lang['lightspeedto_odoo.process.statistics'] = 'Statistiques';

// Dépannage du traitement
$lang['lightspeedto_odoo.process.troubleshooting'] = 'Dépannage';
$lang['lightspeedto_odoo.process.troubleshooting.errors.title'] = 'En cas d\'erreurs';
$lang['lightspeedto_odoo.process.troubleshooting.errors.tip1'] = 'Vérifiez que votre mapping correspond bien à la structure de votre fichier CSV';
$lang['lightspeedto_odoo.process.troubleshooting.errors.tip2'] = 'Assurez-vous que les données sont dans le bon format (nombres, dates, etc.)';
$lang['lightspeedto_odoo.process.troubleshooting.errors.tip3'] = 'Consultez le journal des erreurs pour plus de détails';
$lang['lightspeedto_odoo.process.troubleshooting.processing.title'] = 'Traitement en cours';
$lang['lightspeedto_odoo.process.troubleshooting.processing.description'] = 'Le traitement peut prendre plusieurs minutes selon la taille de votre fichier. Ne fermez pas cette page.';
$lang['lightspeedto_odoo.process.troubleshooting.general.title'] = 'Conseils généraux';
$lang['lightspeedto_odoo.process.troubleshooting.general.tip1'] = 'Testez d\'abord avec un petit fichier pour valider votre mapping';
$lang['lightspeedto_odoo.process.troubleshooting.general.tip2'] = 'Vérifiez que la connexion à Odoo est active';
$lang['lightspeedto_odoo.process.troubleshooting.general.tip3'] = 'Contactez l\'administrateur en cas de problème persistant';

// Configuration
$lang['lightspeedto_odoo.config.title'] = 'Configuration du module';
$lang['lightspeedto_odoo.config.description'] = 'Configuration des paramètres de connexion à Odoo et autres réglages du module.';
$lang['lightspeedto_odoo.config.information'] = 'Informations sur la configuration';

// Configuration Odoo
$lang['lightspeedto_odoo.config.odoo.connection'] = 'Connexion Odoo';
$lang['lightspeedto_odoo.config.odoo.url'] = 'URL du serveur Odoo';
$lang['lightspeedto_odoo.config.odoo.url.clue'] = 'URL complète de votre serveur Odoo (ex: https://moninstance.odoo.com)';
$lang['lightspeedto_odoo.config.odoo.db'] = 'Base de données';
$lang['lightspeedto_odoo.config.odoo.db.clue'] = 'Nom de la base de données Odoo à utiliser';
$lang['lightspeedto_odoo.config.odoo.username'] = 'Nom d\'utilisateur';
$lang['lightspeedto_odoo.config.odoo.username.clue'] = 'Nom d\'utilisateur Odoo avec les droits d\'écriture sur les produits';
$lang['lightspeedto_odoo.config.odoo.password'] = 'Mot de passe';
$lang['lightspeedto_odoo.config.odoo.password.clue'] = 'Mot de passe de l\'utilisateur Odoo';
$lang['lightspeedto_odoo.config.odoo.api_key'] = 'Clé API (optionnel)';
$lang['lightspeedto_odoo.config.odoo.api_key.clue'] = 'Clé API Odoo si vous en utilisez une à la place du mot de passe';

// Prérequis Odoo
$lang['lightspeedto_odoo.config.odoo.requirements'] = 'Prérequis Odoo';
$lang['lightspeedto_odoo.config.odoo.server_requirements'] = 'Prérequis serveur';
$lang['lightspeedto_odoo.config.odoo.version_requirement'] = 'Odoo 14.0 ou version supérieure';
$lang['lightspeedto_odoo.config.odoo.api_access'] = 'Accès API XML-RPC activé';
$lang['lightspeedto_odoo.config.odoo.user_permissions'] = 'Utilisateur avec droits sur les produits';
$lang['lightspeedto_odoo.config.odoo.network_access'] = 'Accès réseau entre les serveurs';
$lang['lightspeedto_odoo.config.odoo.modules_required'] = 'Modules Odoo requis';
$lang['lightspeedto_odoo.config.odoo.module_sale'] = 'Module de vente';
$lang['lightspeedto_odoo.config.odoo.module_pos'] = 'Module Point de Vente (POS)';
$lang['lightspeedto_odoo.config.odoo.module_stock'] = 'Module de gestion des stocks';
$lang['lightspeedto_odoo.config.odoo.module_product'] = 'Module de gestion des produits';

// Sécurité et authentification
$lang['lightspeedto_odoo.config.security'] = 'Sécurité';
$lang['lightspeedto_odoo.config.authentication.title'] = 'Authentification';
$lang['lightspeedto_odoo.config.authentication.description'] = 'Méthodes d\'authentification supportées pour la connexion à Odoo :';
$lang['lightspeedto_odoo.config.api_key.recommended'] = 'Clé API (recommandé)';
$lang['lightspeedto_odoo.config.api_key.description'] = 'L\'utilisation d\'une clé API est plus sécurisée que le mot de passe :';
$lang['lightspeedto_odoo.config.api_key.step1'] = 'Connectez-vous à votre instance Odoo';
$lang['lightspeedto_odoo.config.api_key.step2'] = 'Allez dans Paramètres > Utilisateurs & Sociétés > Utilisateurs';
$lang['lightspeedto_odoo.config.api_key.step3'] = 'Sélectionnez votre utilisateur et générez une clé API';
$lang['lightspeedto_odoo.config.api_key.step4'] = 'Copiez la clé et collez-la dans le champ ci-dessus';
$lang['lightspeedto_odoo.config.password.warning'] = 'Mot de passe (non recommandé)';
$lang['lightspeedto_odoo.config.password.description'] = 'L\'utilisation du mot de passe est moins sécurisée et pourra être dépréciée dans les futures versions d\'Odoo.';

// Guide de configuration
$lang['lightspeedto_odoo.config.setup_guide'] = 'Guide de configuration';
$lang['lightspeedto_odoo.config.guide.step1.title'] = 'Étape 1 : URL du serveur';
$lang['lightspeedto_odoo.config.guide.step1.description'] = 'Saisissez l\'URL complète de votre serveur Odoo :';
$lang['lightspeedto_odoo.config.guide.step1.note'] = 'N\'oubliez pas le protocole https:// ou http://';
$lang['lightspeedto_odoo.config.guide.step2.title'] = 'Étape 2 : Base de données';
$lang['lightspeedto_odoo.config.guide.step2.description'] = 'Indiquez le nom de votre base de données Odoo :';
$lang['lightspeedto_odoo.config.guide.step2.example'] = 'Exemple';
$lang['lightspeedto_odoo.config.guide.step3.title'] = 'Étape 3 : Identifiants';
$lang['lightspeedto_odoo.config.guide.step3.description'] = 'Configurez les identifiants d\'accès avec les permissions suivantes :';
$lang['lightspeedto_odoo.config.guide.step3.permission1'] = 'Lecture et écriture sur les produits';
$lang['lightspeedto_odoo.config.guide.step3.permission2'] = 'Accès aux catégories de produits';
$lang['lightspeedto_odoo.config.guide.step3.permission3'] = 'Accès au module Point de Vente (si utilisé)';
$lang['lightspeedto_odoo.config.guide.step4.title'] = 'Étape 4 : Test de connexion';
$lang['lightspeedto_odoo.config.guide.step4.description'] = 'Testez la connexion pour valider vos paramètres :';
$lang['lightspeedto_odoo.config.test_now'] = 'Tester maintenant';

// Test de connexion
$lang['lightspeedto_odoo.config.test_connection'] = 'Tester la connexion';
$lang['lightspeedto_odoo.config.test_connection.description'] = 'Testez vos paramètres de connexion à Odoo avant de sauvegarder la configuration.';
$lang['lightspeedto_odoo.config.test.button'] = 'Tester la connexion Odoo';
$lang['lightspeedto_odoo.config.test.testing'] = 'Test en cours...';
$lang['lightspeedto_odoo.config.test.in_progress'] = 'Test de connexion en cours, veuillez patienter...';
$lang['lightspeedto_odoo.config.test.success'] = 'Connexion réussie !';
$lang['lightspeedto_odoo.config.test.success.description'] = 'La connexion à Odoo fonctionne correctement. Vous pouvez sauvegarder la configuration.';
$lang['lightspeedto_odoo.config.test.failed'] = 'Échec de la connexion';
$lang['lightspeedto_odoo.config.test.error'] = 'Erreur de connexion';
$lang['lightspeedto_odoo.config.test.error.parse'] = 'Erreur lors de l\'analyse de la réponse';
$lang['lightspeedto_odoo.config.test.error.network'] = 'Erreur de connexion réseau';
$lang['lightspeedto_odoo.config.test.error.unknown'] = 'Erreur inconnue lors du test';
$lang['lightspeedto_odoo.config.test.details'] = 'Détails de la connexion';
$lang['lightspeedto_odoo.config.test.suggestions'] = 'Suggestions';

// Dépannage de la configuration
$lang['lightspeedto_odoo.config.troubleshooting.title'] = 'Dépannage';
$lang['lightspeedto_odoo.config.troubleshooting.common_issues'] = 'Problèmes courants';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed'] = 'Si la connexion échoue :';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.description'] = 'Vérifiez les points suivants :';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution1'] = 'L\'URL du serveur est correcte et accessible';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution2'] = 'Le nom de la base de données est exact';
$lang['lightspeedto_odoo.config.troubleshooting.connection_failed.solution3'] = 'Le serveur Odoo est en ligne et fonctionne';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed'] = 'Si l\'authentification échoue :';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.description'] = 'Problème avec les identifiants :';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution1'] = 'Vérifiez l\'exactitude du nom d\'utilisateur et du mot de passe';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution2'] = 'Vérifiez que l\'utilisateur a les droits nécessaires';
$lang['lightspeedto_odoo.config.troubleshooting.authentication_failed.solution3'] = 'Essayez de vous connecter directement à Odoo avec ces identifiants';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied'] = 'Si les permissions sont refusées :';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.description'] = 'L\'utilisateur n\'a pas les droits suffisants :';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution1'] = 'Vérifiez que l\'utilisateur a les droits d\'écriture sur les produits';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution2'] = 'Contactez votre administrateur Odoo';
$lang['lightspeedto_odoo.config.troubleshooting.permission_denied.solution3'] = 'Vérifiez que la clé API n\'a pas expiré';
$lang['lightspeedto_odoo.config.troubleshooting.slow_performance'] = 'Si les performances sont lentes :';
$lang['lightspeedto_odoo.config.troubleshooting.slow_performance.description'] = 'Optimisations possibles :';
$lang['lightspeedto_odoo.config.troubleshooting.slow_performance.solution1'] = 'Réduisez la taille des lots de traitement';
$lang['lightspeedto_odoo.config.troubleshooting.slow_performance.solution2'] = 'Vérifiez la charge du serveur Odoo';
$lang['lightspeedto_odoo.config.troubleshooting.slow_performance.solution3'] = 'Traitez de plus petits fichiers';

// Paramètres avancés
$lang['lightspeedto_odoo.config.advanced_settings'] = 'Paramètres avancés';
$lang['lightspeedto_odoo.config.advanced.warning'] = 'Attention';
$lang['lightspeedto_odoo.config.advanced.description'] = 'Ces paramètres sont destinés aux utilisateurs expérimentés. Modifiez-les uniquement si vous savez ce que vous faites.';
$lang['lightspeedto_odoo.config.batch_processing'] = 'Traitement par lots';
$lang['lightspeedto_odoo.config.batch_processing.description'] = 'Configuration du traitement des données par lots pour optimiser les performances :';
$lang['lightspeedto_odoo.config.batch_size'] = 'Taille des lots';
$lang['lightspeedto_odoo.config.rows_per_batch'] = 'lignes par lot';
$lang['lightspeedto_odoo.config.cleanup_settings'] = 'Nettoyage automatique';
$lang['lightspeedto_odoo.config.cleanup_settings.description'] = 'Configuration du nettoyage automatique des anciens fichiers :';
$lang['lightspeedto_odoo.config.cleanup_days'] = 'Conserver les fichiers';
$lang['lightspeedto_odoo.config.days'] = 'jours';
$lang['lightspeedto_odoo.config.timeout_settings'] = 'Délais d\'attente';
$lang['lightspeedto_odoo.config.timeout_settings.description'] = 'Configuration des délais d\'attente pour les requêtes :';
$lang['lightspeedto_odoo.config.request_timeout'] = 'Timeout des requêtes';
$lang['lightspeedto_odoo.config.seconds'] = 'secondes';

// Validation des champs de configuration
$lang['lightspeedto_odoo.config.validation.invalid_url'] = 'URL invalide. Utilisez le format : https://monodoo.com';
$lang['lightspeedto_odoo.config.validation.invalid_database'] = 'Nom de base de données invalide. Utilisez uniquement des lettres, chiffres, tirets et underscores.';
$lang['lightspeedto_odoo.config.validation.invalid_username'] = 'Nom d\'utilisateur trop court. Minimum 3 caractères.';

// Paramètres du module
$lang['lightspeedto_odoo.config.module_settings'] = 'Paramètres du module';
$lang['lightspeedto_odoo.config.max_file_size'] = 'Taille maximum des fichiers (MB)';
$lang['lightspeedto_odoo.config.max_file_size.clue'] = 'Taille maximum autorisée pour les fichiers CSV importés';
$lang['lightspeedto_odoo.config.timeout'] = 'Timeout de connexion (secondes)';
$lang['lightspeedto_odoo.config.timeout.clue'] = 'Délai maximum d\'attente pour les requêtes vers Odoo';
$lang['lightspeedto_odoo.config.enable_logging'] = 'Activer les logs détaillés';
$lang['lightspeedto_odoo.config.enable_logging.clue'] = 'Enregistrer tous les détails des traitements (peut ralentir les performances)';
$lang['lightspeedto_odoo.config.auto_detect_mapping'] = 'Détection automatique du mapping';
$lang['lightspeedto_odoo.config.auto_detect_mapping.clue'] = 'Tenter de détecter automatiquement le mapping selon les en-têtes CSV';

// Messages de succès et erreur de configuration
$lang['lightspeedto_odoo.config.save'] = 'Enregistrer la configuration';
$lang['lightspeedto_odoo.config.connection_success'] = 'Connexion à Odoo réussie !';
$lang['lightspeedto_odoo.config.connection_failed'] = 'Échec de la connexion à Odoo';

// Autorisations
$lang['lightspeedto_odoo.authorizations.read'] = 'Lecture';
$lang['lightspeedto_odoo.authorizations.write'] = 'Écriture';
$lang['lightspeedto_odoo.authorizations.moderation'] = 'Modération';
$lang['lightspeedto_odoo.authorizations.admin'] = 'Administration';

// Champs de données - Lightspeed
$lang['lightspeedto_odoo.field.name'] = 'Nom du champ';
$lang['lightspeedto_odoo.field.description'] = 'Description';
$lang['lightspeedto_odoo.field.sku'] = 'SKU / Référence produit';
$lang['lightspeedto_odoo.field.title'] = 'Nom du produit';
$lang['lightspeedto_odoo.field.barcode'] = 'Code-barres';
$lang['lightspeedto_odoo.field.price'] = 'Prix de vente';
$lang['lightspeedto_odoo.field.cost'] = 'Prix de revient';
$lang['lightspeedto_odoo.field.quantity'] = 'Quantité en stock';
$lang['lightspeedto_odoo.field.weight'] = 'Poids';
$lang['lightspeedto_odoo.field.vendor'] = 'Fournisseur';
$lang['lightspeedto_odoo.field.category'] = 'Catégorie';

// Champs de données - Odoo
$lang['lightspeedto_odoo.field.internal_ref'] = 'Référence interne';
$lang['lightspeedto_odoo.field.product_name'] = 'Nom du produit';
$lang['lightspeedto_odoo.field.sale_price'] = 'Prix de vente';
$lang['lightspeedto_odoo.field.cost_price'] = 'Prix de revient';
$lang['lightspeedto_odoo.field.stock_qty'] = 'Quantité en stock';
$lang['lightspeedto_odoo.field.pos_available'] = 'Disponible en POS';

// Champs de produits Odoo détaillés
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
$lang['lightspeedto_odoo.transformation.name'] = 'Nom';
$lang['lightspeedto_odoo.transformation.description'] = 'Description';
$lang['lightspeedto_odoo.transformation.example'] = 'Exemple';
$lang['lightspeedto_odoo.transformation.none'] = 'Aucune';
$lang['lightspeedto_odoo.transformation.uppercase'] = 'Majuscules';
$lang['lightspeedto_odoo.transformation.lowercase'] = 'Minuscules';
$lang['lightspeedto_odoo.transformation.trim'] = 'Supprimer les espaces';
$lang['lightspeedto_odoo.transformation.number'] = 'Convertir en nombre';
$lang['lightspeedto_odoo.transformation.float'] = 'Convertir en décimal';
$lang['lightspeedto_odoo.transformation.int'] = 'Convertir en entier';
$lang['lightspeedto_odoo.transformation.bool'] = 'Convertir en booléen';
$lang['lightspeedto_odoo.transformation.custom'] = 'Transformation personnalisée';

// Statistiques
$lang['lightspeedto_odoo.stats.uploads'] = 'Imports';
$lang['lightspeedto_odoo.stats.total_uploads'] = 'Total des imports';
$lang['lightspeedto_odoo.stats.pending'] = 'En attente';
$lang['lightspeedto_odoo.stats.completed'] = 'Terminés';
$lang['lightspeedto_odoo.stats.failed'] = 'Échoués';
$lang['lightspeedto_odoo.stats.data'] = 'Données';
$lang['lightspeedto_odoo.stats.processed_rows'] = 'Lignes traitées';
$lang['lightspeedto_odoo.stats.mappings'] = 'Mappings';
$lang['lightspeedto_odoo.stats.success_rate'] = 'Taux de réussite';

// Mini menu
$lang['lightspeedto_odoo.mini.total_uploads'] = 'Total imports';
$lang['lightspeedto_odoo.mini.completed'] = 'Terminés';
$lang['lightspeedto_odoo.mini.processed_rows'] = 'Lignes traitées';
$lang['lightspeedto_odoo.mini.pending'] = 'En attente';
$lang['lightspeedto_odoo.mini.processing'] = 'En cours';
$lang['lightspeedto_odoo.mini.upload'] = 'Importer';
$lang['lightspeedto_odoo.mini.mappings'] = 'Mappings';
$lang['lightspeedto_odoo.mini.process'] = 'Traitements';

// Guide utilisateur
$lang['lightspeedto_odoo.guide.step1'] = 'Étape 1 : Configuration';
$lang['lightspeedto_odoo.guide.step1.description'] = 'Configurez les paramètres de connexion à votre serveur Odoo';
$lang['lightspeedto_odoo.guide.step2'] = 'Étape 2 : Créer un mapping';
$lang['lightspeedto_odoo.guide.step2.description'] = 'Définissez la correspondance entre les colonnes Lightspeed et les champs Odoo';
$lang['lightspeedto_odoo.guide.step3'] = 'Étape 3 : Importer un fichier CSV';
$lang['lightspeedto_odoo.guide.step3.description'] = 'Uploadez votre fichier CSV exporté depuis Lightspeed';
$lang['lightspeedto_odoo.guide.step4'] = 'Étape 4 : Traitement';
$lang['lightspeedto_odoo.guide.step4.description'] = 'Le système traite automatiquement votre fichier et transfère les données vers Odoo';
$lang['lightspeedto_odoo.guide.configure'] = 'Configurer';
$lang['lightspeedto_odoo.guide.create_mapping'] = 'Créer un mapping';
$lang['lightspeedto_odoo.guide.upload_file'] = 'Importer un fichier';

// Messages d'erreur généraux
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

// SEO et métadonnées
$lang['lightspeedto_odoo.seo.description'] = 'Module PHPBoost pour transférer les données CSV de Lightspeed Série K vers Odoo POS avec système de mapping configurable.';
$lang['lightspeedto_odoo.seo.description.mapping.form'] = 'Créer ou modifier un mapping de correspondance entre les champs Lightspeed et Odoo.';
$lang['lightspeedto_odoo.seo.description.process'] = 'Historique et détails des traitements de transfert de données vers Odoo.';
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
