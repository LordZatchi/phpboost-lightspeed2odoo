<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.config.title}</h1>
		<div class="controls align-right">
			<a href="{U_MODULE_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {@lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		{CONFIG_FORM}
		
		<!-- Test de connexion -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.config.test_connection}</h2>
			<div class="cell">
				<div class="cell-body">
					<p>{@lightspeedto_odoo.config.test_connection.description}</p>
					
					<div id="test-connection-container">
						<button type="button" id="test-connection-btn" class="button submit">
							<i class="fa fa-plug" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_connection}
						</button>
						
						<div id="test-results" class="test-results" style="display: none;">
							<div id="test-output"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Informations sur la configuration -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.config.information}</h2>
			<div class="cell-flex cell-columns-2">
				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.config.odoo.requirements}</h3>
					</div>
					<div class="cell-body">
						<h4>{@lightspeedto_odoo.config.odoo.server_requirements}</h4>
						<ul>
							<li>{@lightspeedto_odoo.config.odoo.version_requirement}</li>
							<li>{@lightspeedto_odoo.config.odoo.api_access}</li>
							<li>{@lightspeedto_odoo.config.odoo.user_permissions}</li>
							<li>{@lightspeedto_odoo.config.odoo.network_access}</li>
						</ul>

						<h4>{@lightspeedto_odoo.config.odoo.modules_required}</h4>
						<ul>
							<li><code>sale</code> - {@lightspeedto_odoo.config.odoo.module_sale}</li>
							<li><code>point_of_sale</code> - {@lightspeedto_odoo.config.odoo.module_pos}</li>
							<li><code>stock</code> - {@lightspeedto_odoo.config.odoo.module_stock}</li>
							<li><code>product</code> - {@lightspeedto_odoo.config.odoo.module_product}</li>
						</ul>
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.config.security}</h3>
					</div>
					<div class="cell-body">
						<h4>{@lightspeedto_odoo.config.authentication.title}</h4>
						<p>{@lightspeedto_odoo.config.authentication.description}</p>
						
						<div class="message-helper bgc notice">
							<h5>{@lightspeedto_odoo.config.api_key.recommended}</h5>
							<p>{@lightspeedto_odoo.config.api_key.description}</p>
							<ol>
								<li>{@lightspeedto_odoo.config.api_key.step1}</li>
								<li>{@lightspeedto_odoo.config.api_key.step2}</li>
								<li>{@lightspeedto_odoo.config.api_key.step3}</li>
								<li>{@lightspeedto_odoo.config.api_key.step4}</li>
							</ol>
						</div>

						<div class="message-helper bgc warning">
							<h5>{@lightspeedto_odoo.config.password.warning}</h5>
							<p>{@lightspeedto_odoo.config.password.description}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Guide de configuration -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.config.setup_guide}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="setup-steps">
						<div class="step">
							<div class="step-number">1</div>
							<div class="step-content">
								<h4>{@lightspeedto_odoo.config.guide.step1.title}</h4>
								<p>{@lightspeedto_odoo.config.guide.step1.description}</p>
								<div class="step-details">
									<code>https://votre-instance.odoo.com</code><br>
									<small>{@lightspeedto_odoo.config.guide.step1.note}</small>
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">2</div>
							<div class="step-content">
								<h4>{@lightspeedto_odoo.config.guide.step2.title}</h4>
								<p>{@lightspeedto_odoo.config.guide.step2.description}</p>
								<div class="step-details">
									<strong>{@lightspeedto_odoo.config.guide.step2.example}:</strong> mycompany_db
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">3</div>
							<div class="step-content">
								<h4>{@lightspeedto_odoo.config.guide.step3.title}</h4>
								<p>{@lightspeedto_odoo.config.guide.step3.description}</p>
								<div class="step-details">
									<ul>
										<li>{@lightspeedto_odoo.config.guide.step3.permission1}</li>
										<li>{@lightspeedto_odoo.config.guide.step3.permission2}</li>
										<li>{@lightspeedto_odoo.config.guide.step3.permission3}</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">4</div>
							<div class="step-content">
								<h4>{@lightspeedto_odoo.config.guide.step4.title}</h4>
								<p>{@lightspeedto_odoo.config.guide.step4.description}</p>
								<div class="step-details">
									<button type="button" onclick="document.getElementById('test-connection-btn').click()" class="button submit small">
										{@lightspeedto_odoo.config.test_now}
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Dépannage -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.config.troubleshooting.title}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="troubleshooting-section">
						<h3>{@lightspeedto_odoo.config.troubleshooting.common_issues}</h3>
						
						<div class="issue-item">
							<h4>{@lightspeedto_odoo.config.troubleshooting.connection_failed}</h4>
							<p>{@lightspeedto_odoo.config.troubleshooting.connection_failed.description}</p>
							<ul>
								<li>{@lightspeedto_odoo.config.troubleshooting.connection_failed.solution1}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.connection_failed.solution2}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.connection_failed.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{@lightspeedto_odoo.config.troubleshooting.authentication_failed}</h4>
							<p>{@lightspeedto_odoo.config.troubleshooting.authentication_failed.description}</p>
							<ul>
								<li>{@lightspeedto_odoo.config.troubleshooting.authentication_failed.solution1}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.authentication_failed.solution2}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.authentication_failed.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{@lightspeedto_odoo.config.troubleshooting.permission_denied}</h4>
							<p>{@lightspeedto_odoo.config.troubleshooting.permission_denied.description}</p>
							<ul>
								<li>{@lightspeedto_odoo.config.troubleshooting.permission_denied.solution1}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.permission_denied.solution2}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.permission_denied.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{@lightspeedto_odoo.config.troubleshooting.slow_performance}</h4>
							<p>{@lightspeedto_odoo.config.troubleshooting.slow_performance.description}</p>
							<ul>
								<li>{@lightspeedto_odoo.config.troubleshooting.slow_performance.solution1}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.slow_performance.solution2}</li>
								<li>{@lightspeedto_odoo.config.troubleshooting.slow_performance.solution3}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Paramètres avancés -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.config.advanced_settings}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="message-helper bgc warning">
						<h4>{@lightspeedto_odoo.config.advanced.warning}</h4>
						<p>{@lightspeedto_odoo.config.advanced.description}</p>
					</div>

					<div class="advanced-settings">
						<h4>{@lightspeedto_odoo.config.batch_processing}</h4>
						<p>{@lightspeedto_odoo.config.batch_processing.description}</p>
						<div class="setting-item">
							<label>{@lightspeedto_odoo.config.batch_size}:</label>
							<span>{BATCH_SIZE} {@lightspeedto_odoo.config.rows_per_batch}</span>
						</div>

						<h4>{@lightspeedto_odoo.config.cleanup_settings}</h4>
						<p>{@lightspeedto_odoo.config.cleanup_settings.description}</p>
						<div class="setting-item">
							<label>{@lightspeedto_odoo.config.cleanup_days}:</label>
							<span>{CLEANUP_DAYS} {@lightspeedto_odoo.config.days}</span>
						</div>

						<h4>{@lightspeedto_odoo.config.timeout_settings}</h4>
						<p>{@lightspeedto_odoo.config.timeout_settings.description}</p>
						<div class="setting-item">
							<label>{@lightspeedto_odoo.config.api_timeout}:</label>
							<span>{API_TIMEOUT} {@lightspeedto_odoo.config.seconds}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	var testConnectionBtn = document.getElementById('test-connection-btn');
	var testResults = document.getElementById('test-results');
	var testOutput = document.getElementById('test-output');

	if (testConnectionBtn) {
		testConnectionBtn.addEventListener('click', function() {
			testOdooConnection();
		});
	}

	function testOdooConnection() {
		// Désactiver le bouton et afficher le spinner
		testConnectionBtn.disabled = true;
		testConnectionBtn.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> {@lightspeedto_odoo.config.testing}';
		
		// Afficher la zone de résultats
		testResults.style.display = 'block';
		testOutput.innerHTML = '<div class="message-helper bgc notice">{@lightspeedto_odoo.config.test_in_progress}</div>';

		// Récupérer les valeurs du formulaire
		var formData = new FormData();
		var form = document.querySelector('form');
		if (form) {
			var inputs = form.querySelectorAll('input, select, textarea');
			inputs.forEach(function(input) {
				if (input.name && input.value) {
					formData.append(input.name, input.value);
				}
			});
		}

		// Ajouter l'action de test
		formData.append('test_connection', '1');

		// Effectuer le test
		fetch(window.location.href, {
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			displayTestResults(data);
		})
		.catch(error => {
			displayTestResults({
				success: false,
				message: '{@lightspeedto_odoo.config.test_error}: ' + error.message
			});
		})
		.finally(() => {
			// Réactiver le bouton
			testConnectionBtn.disabled = false;
			testConnectionBtn.innerHTML = '<i class="fa fa-plug" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_connection}';
		});
	}

	function displayTestResults(data) {
		var resultClass = data.success ? 'success' : 'error';
		var resultIcon = data.success ? 'fa-check' : 'fa-times';
		
		var html = `<div class="message-helper bgc ${resultClass}">
			<h4><i class="fa ${resultIcon}" aria-hidden="true"></i> ${data.success ? '{@lightspeedto_odoo.config.test_success}' : '{@lightspeedto_odoo.config.test_failed}'}</h4>
			<p>${data.message}</p>`;

		if (data.details) {
			html += '<div class="test-details"><h5>{@lightspeedto_odoo.config.test_details}:</h5><ul>';
			for (var key in data.details) {
				html += `<li><strong>${key}:</strong> ${data.details[key]}</li>`;
			}
			html += '</ul></div>';
		}

		html += '</div>';

		if (!data.success && data.suggestions) {
			html += '<div class="message-helper bgc warning">';
			html += '<h5>{@lightspeedto_odoo.config.suggestions}:</h5><ul>';
			data.suggestions.forEach(function(suggestion) {
				html += `<li>${suggestion}</li>`;
			});
			html += '</ul></div>';
		}

		testOutput.innerHTML = html;
	}

	// Validation en temps réel des champs
	setupFieldValidation();

	function setupFieldValidation() {
		var urlField = document.querySelector('input[name*="odoo_url"]');
		var databaseField = document.querySelector('input[name*="odoo_database"]');
		var usernameField = document.querySelector('input[name*="odoo_username"]');

		if (urlField) {
			urlField.addEventListener('blur', function() {
				validateUrl(this);
			});
		}

		if (databaseField) {
			databaseField.addEventListener('blur', function() {
				validateDatabase(this);
			});
		}

		if (usernameField) {
			usernameField.addEventListener('blur', function() {
				validateUsername(this);
			});
		}
	}

	function validateUrl(field) {
		var value = field.value.trim();
		var isValid = value && (value.startsWith('http://') || value.startsWith('https://'));
		
		toggleFieldValidation(field, isValid, isValid ? '' : '{@lightspeedto_odoo.config.validation.invalid_url}');
	}

	function validateDatabase(field) {
		var value = field.value.trim();
		var isValid = value && /^[a-zA-Z0-9_-]+$/.test(value);
		
		toggleFieldValidation(field, isValid, isValid ? '' : '{@lightspeedto_odoo.config.validation.invalid_database}');
	}

	function validateUsername(field) {
		var value = field.value.trim();
		var isValid = value && value.length >= 3;
		
		toggleFieldValidation(field, isValid, isValid ? '' : '{@lightspeedto_odoo.config.validation.invalid_username}');
	}

	function toggleFieldValidation(field, isValid, message) {
		// Supprimer les anciens messages
		var existingMessage = field.parentNode.querySelector('.field-validation');
		if (existingMessage) {
			existingMessage.remove();
		}

		// Ajouter la classe de validation
		field.classList.remove('field-valid', 'field-invalid');
		field.classList.add(isValid ? 'field-valid' : 'field-invalid');

		// Ajouter le message d'erreur si nécessaire
		if (!isValid && message) {
			var messageDiv = document.createElement('div');
			messageDiv.className = 'field-validation error';
			messageDiv.textContent = message;
			field.parentNode.appendChild(messageDiv);
		}
	}

	// Auto-complétion et suggestions
	setupAutoComplete();

	function setupAutoComplete() {
		var urlField = document.querySelector('input[name*="odoo_url"]');
		if (urlField) {
			urlField.addEventListener('input', function() {
				var value = this.value.toLowerCase();
				if (value && !value.startsWith('http')) {
					if (value.includes('.odoo.com')) {
						this.value = 'https://' + value;
					} else if (!value.includes('.')) {
						// Suggérer l'auto-complétion pour les instances Odoo.com
						showSuggestion(this, value + '.odoo.com');
					}
				}
			});
		}
	}

	function showSuggestion(field, suggestion) {
		// Implémentation simple de suggestion
		var existingSuggestion = field.parentNode.querySelector('.field-suggestion');
		if (existingSuggestion) {
			existingSuggestion.remove();
		}

		var suggestionDiv = document.createElement('div');
		suggestionDiv.className = 'field-suggestion';
		suggestionDiv.innerHTML = `<small>{@lightspeedto_odoo.config.suggestion}: <a href="#" onclick="applySuggestion('${field.name}', '${suggestion}'); return false;">${suggestion}</a></small>`;
		field.parentNode.appendChild(suggestionDiv);
	}

	window.applySuggestion = function(fieldName, value) {
		var field = document.querySelector(`input[name="${fieldName}"]`);
		if (field) {
			field.value = 'https://' + value;
			field.focus();
			field.dispatchEvent(new Event('blur'));
		}
		
		var suggestion = field.parentNode.querySelector('.field-suggestion');
		if (suggestion) {
			suggestion.remove();
		}
	};
});
//-->
</script>

<style>
.test-results {
	margin-top: 1rem;
}

.test-details {
	margin-top: 1rem;
	padding: 1rem;
	background: rgba(255, 255, 255, 0.5);
	border-radius: 0.25rem;
}

.test-details ul {
	margin: 0.5rem 0 0 0;
	padding-left: 1.5rem;
}

.setup-steps {
	display: flex;
	flex-direction: column;
	gap: 2rem;
}

.step {
	display: flex;
	align-items: flex-start;
	gap: 1rem;
}

.step-number {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 3rem;
	height: 3rem;
	background: var(--main-color);
	color: white;
	border-radius: 50%;
	font-weight: bold;
	font-size: 1.25rem;
	flex-shrink: 0;
}

.step-content h4 {
	margin: 0 0 0.5rem 0;
	color: var(--main-color);
}

.step-details {
	margin-top: 1rem;
	padding: 1rem;
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.25rem;
	border-left: 4px solid var(--main-color);
}

.troubleshooting-section {
	display: flex;
	flex-direction: column;
	gap: 1.5rem;
}

.issue-item {
	padding: 1rem;
	border: 1px solid rgba(var(--main-rgb), 0.2);
	border-radius: 0.25rem;
}

.issue-item h4 {
	margin: 0 0 0.5rem 0;
	color: var(--error-color);
}

.issue-item ul {
	margin: 0.5rem 0 0 0;
	padding-left: 1.5rem;
}

.advanced-settings {
	display: flex;
	flex-direction: column;
	gap: 1rem;
}

.setting-item {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0.5rem;
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.25rem;
}

.setting-item label {
	font-weight: bold;
}

.field-validation {
	margin-top: 0.25rem;
	font-size: 0.875rem;
}

.field-validation.error {
	color: var(--error-color);
}

.field-suggestion {
	margin-top: 0.25rem;
	font-size: 0.875rem;
	color: var(--main-color);
}

.field-valid {
	border-color: var(--success-color) !important;
}

.field-invalid {
	border-color: var(--error-color) !important;
}

@media (max-width: 768px) {
	.step {
		flex-direction: column;
		text-align: center;
	}
	
	.step-number {
		align-self: center;
	}
	
	.setting-item {
		flex-direction: column;
		gap: 0.5rem;
		text-align: center;
	}
}
</style>