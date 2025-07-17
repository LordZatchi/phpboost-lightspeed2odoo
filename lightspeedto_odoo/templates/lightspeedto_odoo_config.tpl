<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.config.title}</h1>
		<div class="controls align-right">
			<a href="{U_MODULE_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		{CONFIG_FORM}
		
		<!-- Test de connexion -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.config.test_connection}</h2>
			<div class="cell">
				<div class="cell-body">
					<p>{lightspeedto_odoo.config.test_connection.description}</p>
					
					<div id="test-connection-container">
						<button type="button" id="test-connection-btn" class="button submit">
							<i class="fa fa-plug" aria-hidden="true"></i> {lightspeedto_odoo.config.test_connection}
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
			<h2>{lightspeedto_odoo.config.information}</h2>
			<div class="cell-flex cell-columns-2">
				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.config.odoo.requirements}</h3>
					</div>
					<div class="cell-body">
						<h4>{lightspeedto_odoo.config.odoo.server_requirements}</h4>
						<ul>
							<li>{lightspeedto_odoo.config.odoo.version_requirement}</li>
							<li>{lightspeedto_odoo.config.odoo.api_access}</li>
							<li>{lightspeedto_odoo.config.odoo.user_permissions}</li>
							<li>{lightspeedto_odoo.config.odoo.network_access}</li>
						</ul>

						<h4>{lightspeedto_odoo.config.odoo.modules_required}</h4>
						<ul>
							<li><code>sale</code> - {lightspeedto_odoo.config.odoo.module_sale}</li>
							<li><code>point_of_sale</code> - {lightspeedto_odoo.config.odoo.module_pos}</li>
							<li><code>stock</code> - {lightspeedto_odoo.config.odoo.module_stock}</li>
							<li><code>product</code> - {lightspeedto_odoo.config.odoo.module_product}</li>
						</ul>
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.config.security}</h3>
					</div>
					<div class="cell-body">
						<h4>{lightspeedto_odoo.config.authentication.title}</h4>
						<p>{lightspeedto_odoo.config.authentication.description}</p>
						
						<div class="message-helper bgc notice">
							<h5>{lightspeedto_odoo.config.api_key.recommended}</h5>
							<p>{lightspeedto_odoo.config.api_key.description}</p>
							<ol>
								<li>{lightspeedto_odoo.config.api_key.step1}</li>
								<li>{lightspeedto_odoo.config.api_key.step2}</li>
								<li>{lightspeedto_odoo.config.api_key.step3}</li>
								<li>{lightspeedto_odoo.config.api_key.step4}</li>
							</ol>
						</div>

						<div class="message-helper bgc warning">
							<h5>{lightspeedto_odoo.config.password.warning}</h5>
							<p>{lightspeedto_odoo.config.password.description}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Guide de configuration -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.config.setup_guide}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="setup-steps">
						<div class="step">
							<div class="step-number">1</div>
							<div class="step-content">
								<h4>{lightspeedto_odoo.config.guide.step1.title}</h4>
								<p>{lightspeedto_odoo.config.guide.step1.description}</p>
								<div class="step-details">
									<code>https://votre-instance.odoo.com</code><br>
									<small>{lightspeedto_odoo.config.guide.step1.note}</small>
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">2</div>
							<div class="step-content">
								<h4>{lightspeedto_odoo.config.guide.step2.title}</h4>
								<p>{lightspeedto_odoo.config.guide.step2.description}</p>
								<div class="step-details">
									<strong>{lightspeedto_odoo.config.guide.step2.example}:</strong> mycompany_db
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">3</div>
							<div class="step-content">
								<h4>{lightspeedto_odoo.config.guide.step3.title}</h4>
								<p>{lightspeedto_odoo.config.guide.step3.description}</p>
								<div class="step-details">
									<ul>
										<li>{lightspeedto_odoo.config.guide.step3.permission1}</li>
										<li>{lightspeedto_odoo.config.guide.step3.permission2}</li>
										<li>{lightspeedto_odoo.config.guide.step3.permission3}</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="step">
							<div class="step-number">4</div>
							<div class="step-content">
								<h4>{lightspeedto_odoo.config.guide.step4.title}</h4>
								<p>{lightspeedto_odoo.config.guide.step4.description}</p>
								<div class="step-details">
									<button type="button" onclick="document.getElementById('test-connection-btn').click()" class="button submit small">
										{lightspeedto_odoo.config.test_now}
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
			<h2>{lightspeedto_odoo.config.troubleshooting.title}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="troubleshooting-section">
						<h3>{lightspeedto_odoo.config.troubleshooting.common_issues}</h3>
						
						<div class="issue-item">
							<h4>{lightspeedto_odoo.config.troubleshooting.connection_failed}</h4>
							<p>{lightspeedto_odoo.config.troubleshooting.connection_failed.description}</p>
							<ul>
								<li>{lightspeedto_odoo.config.troubleshooting.connection_failed.solution1}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.connection_failed.solution2}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.connection_failed.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{lightspeedto_odoo.config.troubleshooting.authentication_failed}</h4>
							<p>{lightspeedto_odoo.config.troubleshooting.authentication_failed.description}</p>
							<ul>
								<li>{lightspeedto_odoo.config.troubleshooting.authentication_failed.solution1}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.authentication_failed.solution2}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.authentication_failed.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{lightspeedto_odoo.config.troubleshooting.permission_denied}</h4>
							<p>{lightspeedto_odoo.config.troubleshooting.permission_denied.description}</p>
							<ul>
								<li>{lightspeedto_odoo.config.troubleshooting.permission_denied.solution1}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.permission_denied.solution2}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.permission_denied.solution3}</li>
							</ul>
						</div>

						<div class="issue-item">
							<h4>{lightspeedto_odoo.config.troubleshooting.slow_performance}</h4>
							<p>{lightspeedto_odoo.config.troubleshooting.slow_performance.description}</p>
							<ul>
								<li>{lightspeedto_odoo.config.troubleshooting.slow_performance.solution1}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.slow_performance.solution2}</li>
								<li>{lightspeedto_odoo.config.troubleshooting.slow_performance.solution3}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Paramètres avancés -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.config.advanced_settings}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="message-helper bgc warning">
						<h4>{lightspeedto_odoo.config.advanced.warning}</h4>
						<p>{lightspeedto_odoo.config.advanced.description}</p>
					</div>

					<div class="advanced-settings">
						<h4>{lightspeedto_odoo.config.batch_processing}</h4>
						<p>{lightspeedto_odoo.config.batch_processing.description}</p>
						<div class="setting-item">
							<label>{lightspeedto_odoo.config.batch_size}:</label>
							<span>{BATCH_SIZE} {lightspeedto_odoo.config.rows_per_batch}</span>
						</div>

						<h4>{lightspeedto_odoo.config.cleanup_settings}</h4>
						<p>{lightspeedto_odoo.config.cleanup_settings.description}</p>
						<div class="setting-item">
							<label>{lightspeedto_odoo.config.cleanup_days}:</label>
							<span>{CLEANUP_DAYS} {lightspeedto_odoo.config.days}</span>
						</div>

						<h4>{lightspeedto_odoo.config.timeout_settings}</h4>
						<p>{lightspeedto_odoo.config.timeout_settings.description}</p>
						<div class="setting-item">
							<label>{lightspeedto_odoo.config.request_timeout}:</label>
							<span>{REQUEST_TIMEOUT} {lightspeedto_odoo.config.seconds}</span>
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
	var testButton = document.getElementById('test-connection-btn');
	var testResults = document.getElementById('test-results');
	var testOutput = document.getElementById('test-output');

	if (testButton) {
		testButton.addEventListener('click', function() {
			testOdooConnection();
		});
	}

	function testOdooConnection() {
		testButton.disabled = true;
		testButton.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> {lightspeedto_odoo.config.test.testing}';
		
		testResults.style.display = 'block';
		testOutput.innerHTML = '<div class="message-helper bgc notice">{lightspeedto_odoo.config.test.in_progress}</div>';

		// Récupération des valeurs du formulaire
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

		// Requête AJAX vers le test de connexion
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '{U_TEST_CONNECTION}', true);
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				testButton.disabled = false;
				testButton.innerHTML = '<i class="fa fa-plug" aria-hidden="true"></i> {lightspeedto_odoo.config.test_connection}';
				
				if (xhr.status === 200) {
					try {
						var response = JSON.parse(xhr.responseText);
						displayTestResults(response);
					} catch (e) {
						displayTestError('{lightspeedto_odoo.config.test.error.parse}');
					}
				} else {
					displayTestError('{lightspeedto_odoo.config.test.error.network}');
				}
			}
		};
		xhr.send(formData);
	}

	function displayTestResults(response) {
		var html = '';
		
		if (response.success) {
			html += '<div class="message-helper bgc success">';
			html += '<h4>{lightspeedto_odoo.config.test.success}</h4>';
			html += '<p>{lightspeedto_odoo.config.test.success.description}</p>';
			html += '</div>';
			
			if (response.details) {
				html += '<div class="test-details">';
				html += '<h5>{lightspeedto_odoo.config.test.details}:</h5>';
				html += '<ul>';
				for (var key in response.details) {
					html += '<li><strong>' + key + ':</strong> ' + response.details[key] + '</li>';
				}
				html += '</ul>';
				html += '</div>';
			}
		} else {
			html += '<div class="message-helper bgc error">';
			html += '<h4>{lightspeedto_odoo.config.test.error}</h4>';
			html += '<p>' + (response.message || '{lightspeedto_odoo.config.test.error.unknown}') + '</p>';
			html += '</div>';
			
			if (response.suggestions && response.suggestions.length > 0) {
				html += '<div class="test-suggestions">';
				html += '<h5>{lightspeedto_odoo.config.test.suggestions}:</h5>';
				html += '<ul>';
				response.suggestions.forEach(function(suggestion) {
					html += '<li>' + suggestion + '</li>';
				});
				html += '</ul>';
				html += '</div>';
			}
		}
		
		testOutput.innerHTML = html;
	}

	function displayTestError(message) {
		testOutput.innerHTML = '<div class="message-helper bgc error">' + message + '</div>';
	}
});
//-->
</script>