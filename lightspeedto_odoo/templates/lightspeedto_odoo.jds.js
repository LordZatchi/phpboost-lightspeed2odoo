/**
 * LightspeedtoOdoo Module JavaScript
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - 2024 12 20
 */

var LightspeedtoOdoo = (function() {
    'use strict';

    // Configuration
    var config = {
        apiTimeout: 30000,
        uploadChunkSize: 1024 * 1024, // 1MB
        maxFileSize: 50 * 1024 * 1024, // 50MB
        allowedExtensions: ['.csv'],
        processingRefreshInterval: 5000 // 5 seconds
    };

    // État global
    var state = {
        isProcessing: false,
        currentUploadId: null,
        processingInterval: null,
        uploadProgress: 0
    };

    // Utilitaires
    var utils = {
        /**
         * Formatage des tailles de fichier
         */
        formatFileSize: function(bytes) {
            if (bytes === 0) return '0 B';
            var k = 1024;
            var sizes = ['B', 'KB', 'MB', 'GB'];
            var i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        /**
         * Formatage du temps
         */
        formatTime: function(date) {
            return date.toLocaleTimeString();
        },

        /**
         * Formatage de la durée
         */
        formatDuration: function(ms) {
            var seconds = Math.floor(ms / 1000);
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return minutes.toString().padStart(2, '0') + ':' + 
                   remainingSeconds.toString().padStart(2, '0');
        },

        /**
         * Validation d'email
         */
        isValidEmail: function(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        },

        /**
         * Validation d'URL
         */
        isValidUrl: function(url) {
            try {
                new URL(url);
                return url.startsWith('http://') || url.startsWith('https://');
            } catch (e) {
                return false;
            }
        },

        /**
         * Debounce function
         */
        debounce: function(func, wait) {
            var timeout;
            return function executedFunction() {
                var context = this;
                var args = arguments;
                var later = function() {
                    timeout = null;
                    func.apply(context, args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        /**
         * Show notification
         */
        showNotification: function(message, type, duration) {
            type = type || 'info';
            duration = duration || 5000;

            // Utiliser les notifications système si disponibles
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('LightspeedtoOdoo', {
                    body: message,
                    icon: '/templates/__default__/images/favicon.png'
                });
            }

            // Notification dans la page
            var notification = document.createElement('div');
            notification.className = 'lightspeedto-odoo-notification ' + type;
            notification.innerHTML = message;
            
            document.body.appendChild(notification);
            
            setTimeout(function() {
                notification.classList.add('show');
            }, 100);

            setTimeout(function() {
                notification.classList.remove('show');
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 300);
            }, duration);
        }
    };

    // Module de gestion des uploads
    var uploadManager = {
        /**
         * Initialisation du gestionnaire d'upload
         */
        init: function() {
            this.setupFileDropZone();
            this.setupFileInput();
            this.setupFormValidation();
        },

        /**
         * Configuration de la zone de drop
         */
        setupFileDropZone: function() {
            var dropZone = document.querySelector('.file-upload-area');
            if (!dropZone) return;

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('dragover');
                
                var files = e.dataTransfer.files;
                if (files.length > 0) {
                    uploadManager.handleFileSelection(files[0]);
                }
            });

            dropZone.addEventListener('click', function() {
                var fileInput = document.getElementById('csv-file-input');
                if (fileInput) {
                    fileInput.click();
                }
            });
        },

        /**
         * Configuration de l'input file
         */
        setupFileInput: function() {
            var fileInput = document.getElementById('csv-file-input');
            if (!fileInput) return;

            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    uploadManager.handleFileSelection(e.target.files[0]);
                }
            });
        },

        /**
         * Gestion de la sélection de fichier
         */
        handleFileSelection: function(file) {
            // Validation du fichier
            var validation = this.validateFile(file);
            if (!validation.valid) {
                utils.showNotification(validation.message, 'error');
                return;
            }

            // Prévisualisation du fichier
            this.previewFile(file);
        },

        /**
         * Validation du fichier
         */
        validateFile: function(file) {
            var result = { valid: true, message: '' };

            // Vérification de l'extension
            var extension = '.' + file.name.split('.').pop().toLowerCase();
            if (config.allowedExtensions.indexOf(extension) === -1) {
                result.valid = false;
                result.message = 'Type de fichier non autorisé. Seuls les fichiers CSV sont acceptés.';
                return result;
            }

            // Vérification de la taille
            if (file.size > config.maxFileSize) {
                result.valid = false;
                result.message = 'Fichier trop volumineux. Taille maximale : ' + utils.formatFileSize(config.maxFileSize);
                return result;
            }

            return result;
        },

        /**
         * Prévisualisation du fichier CSV
         */
        previewFile: function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var csv = e.target.result;
                var lines = csv.split('\n');
                
                if (lines.length > 0) {
                    var headers = lines[0].split(',').map(function(header) {
                        return header.trim().replace(/['"]/g, '');
                    });
                    
                    uploadManager.displayPreview({
                        filename: file.name,
                        size: file.size,
                        headers: headers,
                        rows: lines.length - 1
                    });
                }
            };
            
            reader.readAsText(file);
        },

        /**
         * Affichage de la prévisualisation
         */
        displayPreview: function(fileInfo) {
            var previewContainer = document.getElementById('file-preview');
            if (!previewContainer) {
                previewContainer = document.createElement('div');
                previewContainer.id = 'file-preview';
                previewContainer.className = 'lightspeedto-odoo-alert info';
                
                var uploadArea = document.querySelector('.file-upload-area');
                if (uploadArea) {
                    uploadArea.parentNode.insertBefore(previewContainer, uploadArea.nextSibling);
                }
            }

            var headersHtml = fileInfo.headers.map(function(header) {
                return '<span class="csv-header">' + header + '</span>';
            }).join('');

            previewContainer.innerHTML = 
                '<h4><i class="fa fa-file-csv"></i> Aperçu du fichier</h4>' +
                '<p><strong>Fichier :</strong> ' + fileInfo.filename + '</p>' +
                '<p><strong>Taille :</strong> ' + utils.formatFileSize(fileInfo.size) + '</p>' +
                '<p><strong>Lignes :</strong> ' + fileInfo.rows + '</p>' +
                '<p><strong>Colonnes détectées :</strong></p>' +
                '<div class="csv-headers">' + headersHtml + '</div>';
        },

        /**
         * Configuration de la validation du formulaire
         */
        setupFormValidation: function() {
            var form = document.querySelector('form[enctype="multipart/form-data"]');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                var fileInput = form.querySelector('input[type="file"]');
                var mappingSelect = form.querySelector('select[name*="mapping"]');
                
                if (!fileInput || !fileInput.files.length) {
                    e.preventDefault();
                    utils.showNotification('Veuillez sélectionner un fichier CSV.', 'error');
                    return false;
                }
                
                if (mappingSelect && !mappingSelect.value) {
                    var confirmResult = confirm('Aucun mapping sélectionné. Un mapping automatique sera tenté. Continuer ?');
                    if (!confirmResult) {
                        e.preventDefault();
                        return false;
                    }
                }
                
                // Afficher l'indicateur de progression
                uploadManager.showUploadProgress();
            });
        },

        /**
         * Affichage de la progression d'upload
         */
        showUploadProgress: function() {
            var submitButton = document.querySelector('form input[type="submit"], form button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Upload en cours...';
            }
        }
    };

    // Module de gestion des mappings
    var mappingManager = {
        /**
         * Initialisation du gestionnaire de mappings
         */
        init: function() {
            this.setupMappingForm();
            this.setupAutoSuggestion();
            this.setupDynamicRows();
        },

        /**
         * Configuration du formulaire de mapping
         */
        setupMappingForm: function() {
            var form = document.querySelector('.mapping-form');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                if (!mappingManager.validateMappingForm()) {
                    e.preventDefault();
                    return false;
                }
            });
        },

        /**
         * Validation du formulaire de mapping
         */
        validateMappingForm: function() {
            var mappingRows = document.querySelectorAll('.mapping-row');
            var validMappings = 0;
            var usedLightspeedFields = [];
            var usedOdooFields = [];

            mappingRows.forEach(function(row) {
                var lightspeedField = row.querySelector('select[name*="lightspeed_field"]').value;
                var odooField = row.querySelector('select[name*="odoo_field"]').value;
                
                if (lightspeedField && odooField) {
                    if (usedLightspeedFields.indexOf(lightspeedField) !== -1) {
                        utils.showNotification('Champ Lightspeed dupliqué : ' + lightspeedField, 'error');
                        return false;
                    }
                    if (usedOdooFields.indexOf(odooField) !== -1) {
                        utils.showNotification('Champ Odoo dupliqué : ' + odooField, 'error');
                        return false;
                    }
                    
                    usedLightspeedFields.push(lightspeedField);
                    usedOdooFields.push(odooField);
                    validMappings++;
                }
            });

            if (validMappings === 0) {
                utils.showNotification('Au moins un mapping valide est requis.', 'error');
                return false;
            }

            return true;
        },

        /**
         * Configuration de l'auto-suggestion
         */
        setupAutoSuggestion: function() {
            // Suggestions automatiques basées sur les noms de champs
            var suggestions = {
                'sku': 'default_code',
                'title': 'name',
                'name': 'name',
                'barcode': 'barcode',
                'price': 'list_price',
                'cost_per_item': 'standard_price',
                'cost': 'standard_price',
                'inventory_quantity': 'qty_available',
                'quantity': 'qty_available',
                'weight': 'weight',
                'vendor': 'vendor_id',
                'type': 'categ_id',
                'category': 'categ_id'
            };

            document.addEventListener('change', function(e) {
                if (e.target.matches('select[name*="lightspeed_field"]')) {
                    var lightspeedField = e.target.value.toLowerCase();
                    var row = e.target.closest('.mapping-row');
                    var odooSelect = row.querySelector('select[name*="odoo_field"]');
                    
                    if (suggestions[lightspeedField] && !odooSelect.value) {
                        // Vérifier que le champ suggéré n'est pas déjà utilisé
                        var isUsed = false;
                        var allOdooSelects = document.querySelectorAll('select[name*="odoo_field"]');
                        
                        allOdooSelects.forEach(function(select) {
                            if (select !== odooSelect && select.value === suggestions[lightspeedField]) {
                                isUsed = true;
                            }
                        });
                        
                        if (!isUsed) {
                            odooSelect.value = suggestions[lightspeedField];
                            // Effet visuel
                            odooSelect.style.backgroundColor = '#e8f5e8';
                            setTimeout(function() {
                                odooSelect.style.backgroundColor = '';
                            }, 1000);
                        }
                    }
                }
            });
        },

        /**
         * Configuration des lignes dynamiques
         */
        setupDynamicRows: function() {
            var addButton = document.getElementById('add-mapping-row');
            if (addButton) {
                addButton.addEventListener('click', this.addMappingRow);
            }

            // Configuration des boutons de suppression existants
            document.addEventListener('click', function(e) {
                if (e.target.matches('.remove-mapping-row')) {
                    mappingManager.removeMappingRow(e.target.closest('.mapping-row'));
                }
            });
        },

        /**
         * Ajout d'une ligne de mapping
         */
        addMappingRow: function() {
            var container = document.getElementById('mapping-rows');
            if (!container) return;

            var rowIndex = container.querySelectorAll('.mapping-row').length;
            var newRow = document.createElement('tr');
            newRow.className = 'mapping-row';
            newRow.dataset.index = rowIndex;

            newRow.innerHTML = mappingManager.generateRowHTML(rowIndex);
            container.appendChild(newRow);

            // Scroll vers la nouvelle ligne
            newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
        },

        /**
         * Suppression d'une ligne de mapping
         */
        removeMappingRow: function(row) {
            if (confirm('Supprimer cette correspondance de champ ?')) {
                row.remove();
                
                // S'assurer qu'il reste au moins une ligne
                var remainingRows = document.querySelectorAll('.mapping-row');
                if (remainingRows.length === 0) {
                    mappingManager.addMappingRow();
                }
            }
        },

        /**
         * Génération du HTML pour une ligne
         */
        generateRowHTML: function(index) {
            var lightspeedOptions = [
                'item_id', 'handle', 'variant_id', 'sku', 'barcode', 'title', 
                'vendor', 'type', 'price', 'compare_at_price', 'inventory_quantity',
                'weight', 'cost_per_item', 'status'
            ];
            
            var odooOptions = [
                'name', 'default_code', 'barcode', 'categ_id', 'list_price',
                'standard_price', 'type', 'weight', 'active', 'available_in_pos',
                'to_weight', 'pos_categ_id'
            ];

            var lightspeedHTML = '<option value="">Choisir...</option>';
            lightspeedOptions.forEach(function(option) {
                lightspeedHTML += '<option value="' + option + '">' + option + '</option>';
            });

            var odooHTML = '<option value="">Choisir...</option>';
            odooOptions.forEach(function(option) {
                odooHTML += '<option value="' + option + '">' + option + '</option>';
            });

            return '<td><select name="mapping[' + index + '][lightspeed_field]" class="form-control">' + lightspeedHTML + '</select></td>' +
                   '<td><select name="mapping[' + index + '][odoo_field]" class="form-control">' + odooHTML + '</select></td>' +
                   '<td><input type="text" name="mapping[' + index + '][transformation]" class="form-control" placeholder="Transformation optionnelle"></td>' +
                   '<td><button type="button" class="button bgc error remove-mapping-row">Supprimer</button></td>';
        }
    };

    // Module de gestion du traitement
    var processingManager = {
        /**
         * Initialisation
         */
        init: function() {
            this.setupProcessingMonitor();
            this.setupAutoRefresh();
        },

        /**
         * Configuration du moniteur de traitement
         */
        setupProcessingMonitor: function() {
            var processButtons = document.querySelectorAll('.process-btn');
            processButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    processingManager.startProcessing(button.getAttribute('href'));
                });
            });
        },

        /**
         * Démarrage du traitement
         */
        startProcessing: function(url) {
            if (state.isProcessing) {
                utils.showNotification('Un traitement est déjà en cours.', 'warning');
                return;
            }

            state.isProcessing = true;
            window.location.href = url;
        },

        /**
         * Configuration du rafraîchissement automatique
         */
        setupAutoRefresh: function() {
            var processingRows = document.querySelectorAll('.status-badge.processing');
            
            if (processingRows.length > 0) {
                state.processingInterval = setInterval(function() {
                    processingManager.refreshProcessingStatus();
                }, config.processingRefreshInterval);
            }
        },

        /**
         * Rafraîchissement du statut de traitement
         */
        refreshProcessingStatus: function() {
            var processingRows = document.querySelectorAll('.upload-row');
            
            processingRows.forEach(function(row) {
                var statusBadge = row.querySelector('.status-badge.processing');
                if (statusBadge) {
                    var uploadId = row.dataset.uploadId;
                    if (uploadId) {
                        processingManager.updateRowStatus(uploadId, row);
                    }
                }
            });
        },

        /**
         * Mise à jour du statut d'une ligne
         */
        updateRowStatus: function(uploadId, row) {
            fetch('/lightspeedto_odoo/ajax_status.php?id=' + uploadId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        processingManager.updateRowDisplay(row, data.upload);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du rafraîchissement:', error);
                });
        },

        /**
         * Mise à jour de l'affichage d'une ligne
         */
        updateRowDisplay: function(row, uploadData) {
            var statusBadge = row.querySelector('.status-badge');
            var progressBar = row.querySelector('.progressbar-value');
            var progressText = row.querySelector('.progress-text');

            if (statusBadge) {
                statusBadge.className = 'status-badge ' + uploadData.status;
                statusBadge.textContent = uploadData.status_label;
            }

            if (progressBar && uploadData.total_rows > 0) {
                var percentage = Math.round((uploadData.processed_rows / uploadData.total_rows) * 100);
                progressBar.style.width = percentage + '%';
                
                if (progressText) {
                    progressText.textContent = uploadData.processed_rows + ' / ' + uploadData.total_rows + ' (' + percentage + '%)';
                }
            }

            // Arrêter le rafraîchissement si terminé
            if (uploadData.status === 'completed' || uploadData.status === 'error') {
                var processingBadges = document.querySelectorAll('.status-badge.processing');
                if (processingBadges.length === 0 && state.processingInterval) {
                    clearInterval(state.processingInterval);
                    state.processingInterval = null;
                }
            }
        }
    };

    // Module de test de connexion
    var connectionTester = {
        /**
         * Test de la connexion Odoo
         */
        testConnection: function(formData) {
            return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/lightspeedto_odoo/admin/test_connection.php', true);
                xhr.timeout = config.apiTimeout;
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                resolve(response);
                            } catch (e) {
                                reject(new Error('Réponse invalide du serveur'));
                            }
                        } else {
                            reject(new Error('Erreur de connexion: ' + xhr.status));
                        }
                    }
                };
                
                xhr.ontimeout = function() {
                    reject(new Error('Timeout de connexion'));
                };
                
                xhr.onerror = function() {
                    reject(new Error('Erreur réseau'));
                };
                
                xhr.send(formData);
            });
        }
    };

    // Module de validation des formulaires
    var formValidator = {
        /**
         * Validation d'URL Odoo
         */
        validateOdooUrl: function(url) {
            if (!url) return { valid: false, message: 'URL requise' };
            if (!utils.isValidUrl(url)) return { valid: false, message: 'URL invalide' };
            if (!url.includes('odoo')) return { valid: false, message: 'L\'URL doit contenir "odoo"' };
            return { valid: true };
        },

        /**
         * Validation de nom de base de données
         */
        validateDatabase: function(database) {
            if (!database) return { valid: false, message: 'Nom de base requis' };
            if (!/^[a-zA-Z0-9_-]+$/.test(database)) return { valid: false, message: 'Caractères invalides' };
            return { valid: true };
        },

        /**
         * Validation d'utilisateur
         */
        validateUsername: function(username) {
            if (!username) return { valid: false, message: 'Nom d\'utilisateur requis' };
            if (username.length < 3) return { valid: false, message: 'Minimum 3 caractères' };
            return { valid: true };
        },

        /**
         * Configuration de la validation en temps réel
         */
        setupRealtimeValidation: function() {
            var fields = [
                { selector: 'input[name*="odoo_url"]', validator: this.validateOdooUrl },
                { selector: 'input[name*="odoo_database"]', validator: this.validateDatabase },
                { selector: 'input[name*="odoo_username"]', validator: this.validateUsername }
            ];

            fields.forEach(function(field) {
                var element = document.querySelector(field.selector);
                if (element) {
                    element.addEventListener('blur', function() {
                        var result = field.validator(this.value);
                        formValidator.toggleFieldValidation(this, result.valid, result.message);
                    });
                }
            });
        },

        /**
         * Basculer la validation d'un champ
         */
        toggleFieldValidation: function(field, isValid, message) {
            // Supprimer les anciens messages
            var existingMessage = field.parentNode.querySelector('.field-validation');
            if (existingMessage) {
                existingMessage.remove();
            }

            // Classes de validation
            field.classList.remove('is-valid', 'is-invalid');
            field.classList.add(isValid ? 'is-valid' : 'is-invalid');

            // Message d'erreur
            if (!isValid && message) {
                var messageDiv = document.createElement('div');
                messageDiv.className = 'field-validation form-text error';
                messageDiv.textContent = message;
                field.parentNode.appendChild(messageDiv);
            }
        }
    };

    // API publique
    return {
        /**
         * Initialisation du module
         */
        init: function() {
            // Demander les permissions de notification
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission();
            }

            // Initialiser les sous-modules
            uploadManager.init();
            mappingManager.init();
            processingManager.init();
            formValidator.setupRealtimeValidation();

            // Event listeners globaux
            this.setupGlobalEvents();
        },

        /**
         * Configuration des événements globaux
         */
        setupGlobalEvents: function() {
            // Prévenir la fermeture accidentelle pendant traitement
            window.addEventListener('beforeunload', function(e) {
                if (state.isProcessing) {
                    e.preventDefault();
                    e.returnValue = 'Un traitement est en cours. Êtes-vous sûr de vouloir quitter ?';
                    return e.returnValue;
                }
            });

            // Gestion des erreurs globales
            window.addEventListener('error', function(e) {
                console.error('Erreur JavaScript:', e.error);
            });
        },

        /**
         * Test de connexion Odoo
         */
        testOdooConnection: function(formData) {
            return connectionTester.testConnection(formData);
        },

        /**
         * Utilitaires publics
         */
        utils: utils,

        /**
         * Configuration
         */
        config: config,

        /**
         * État
         */
        state: state
    };
})();

// Initialisation automatique quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    LightspeedtoOdoo.init();
});

// Export pour utilisation globale
if (typeof window !== 'undefined') {
    window.LightspeedtoOdoo = LightspeedtoOdoo;
}