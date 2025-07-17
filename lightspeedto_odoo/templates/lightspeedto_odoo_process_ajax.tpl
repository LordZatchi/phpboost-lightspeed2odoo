<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.process.processing} - {FILENAME}</h1>
		<div class="controls align-right">
			<a href="{U_DETAILS}" class="button" id="view-details-btn" style="display: none;">
				<i class="fa fa-eye" aria-hidden="true"></i> {lightspeedto_odoo.process.view_details}
			</a>
		</div>
	</header>

	<div class="content">
		<!-- Zone de progression principale -->
		<div class="content-block">
			<div class="processing-container">
				<div class="processing-header">
					<h2>{lightspeedto_odoo.process.processing_file}</h2>
					<div class="processing-status">
						<span id="status-text">{lightspeedto_odoo.process.initializing}</span>
						<div id="processing-spinner" class="spinner">
							<i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
						</div>
					</div>
				</div>

				<!-- Barre de progression principale -->
				<div class="progress-main">
					<div class="progress-info">
						<span id="progress-text">0 / {TOTAL_ROWS} {lightspeedto_odoo.process.rows}</span>
						<span id="progress-percentage">0%</span>
					</div>
					<div class="progressbar-container large">
						<div class="progressbar">
							<div id="progress-bar" class="progressbar-value" style="width: 0%"></div>
						</div>
					</div>
				</div>

				<!-- Statistiques en temps réel -->
				<div class="stats-grid">
					<div class="stat-card success">
						<div class="stat-icon">
							<i class="fa fa-check-circle" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="processed-count">0</div>
							<div class="stat-label">{lightspeedto_odoo.process.processed}</div>
						</div>
					</div>

					<div class="stat-card error">
						<div class="stat-icon">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="error-count">0</div>
							<div class="stat-label">{lightspeedto_odoo.process.errors}</div>
						</div>
					</div>

					<div class="stat-card notice">
						<div class="stat-icon">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="elapsed-time">00:00</div>
							<div class="stat-label">{lightspeedto_odoo.process.elapsed_time}</div>
						</div>
					</div>

					<div class="stat-card">
						<div class="stat-icon">
							<i class="fa fa-dashboard" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="processing-speed">0</div>
							<div class="stat-label">{lightspeedto_odoo.process.rows_per_second}</div>
						</div>
					</div>
				</div>

				<!-- Journal en temps réel -->
				<div class="real-time-log">
					<h3>{lightspeedto_odoo.process.real_time_log}</h3>
					<div id="log-container" class="log-container">
						<div class="log-entry info">
							<span class="log-timestamp" id="start-time"></span>
							<span class="log-message">{lightspeedto_odoo.process.log.starting}</span>
						</div>
					</div>
				</div>

				<!-- Actions de contrôle -->
				<div class="processing-controls" id="processing-controls">
					<button type="button" id="pause-btn" class="button notice" style="display: none;">
						<i class="fa fa-pause" aria-hidden="true"></i> {lightspeedto_odoo.process.pause}
					</button>
					<button type="button" id="resume-btn" class="button submit" style="display: none;">
						<i class="fa fa-play" aria-hidden="true"></i> {lightspeedto_odoo.process.resume}
					</button>
					<button type="button" id="cancel-btn" class="button bgc error" style="display: none;">
						<i class="fa fa-stop" aria-hidden="true"></i> {lightspeedto_odoo.process.cancel}
					</button>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	// Variables globales
	var uploadId = {UPLOAD_ID};
	var totalRows = {TOTAL_ROWS};
	var ajaxUrl = '{U_AJAX_PROCESS}';
	var detailsUrl = '{U_DETAILS}';
	
	var startTime = new Date();
	var isPaused = false;
	var isCompleted = false;
	var currentRow = 0;
	var errorCount = 0;
	
	// Éléments DOM
	var statusText = document.getElementById('status-text');
	var progressText = document.getElementById('progress-text');
	var progressPercentage = document.getElementById('progress-percentage');
	var progressBar = document.getElementById('progress-bar');
	var processedCount = document.getElementById('processed-count');
	var errorCountElement = document.getElementById('error-count');
	var elapsedTime = document.getElementById('elapsed-time');
	var processingSpeed = document.getElementById('processing-speed');
	var logContainer = document.getElementById('log-container');
	var viewDetailsBtn = document.getElementById('view-details-btn');
	var pauseBtn = document.getElementById('pause-btn');
	var resumeBtn = document.getElementById('resume-btn');
	var cancelBtn = document.getElementById('cancel-btn');
	
	// Initialisation
	updateElapsedTime();
	setInterval(updateElapsedTime, 1000);
	
	// Afficher l'heure de démarrage
	var startTimeElement = document.getElementById('start-time');
	if (startTimeElement) {
		startTimeElement.textContent = formatTime(startTime);
	}
	
	// Démarrer le traitement
	setTimeout(startProcessing, 1000);
	
	// Événements des boutons de contrôle
	if (pauseBtn) {
		pauseBtn.addEventListener('click', pauseProcessing);
	}
	if (resumeBtn) {
		resumeBtn.addEventListener('click', resumeProcessing);
	}
	if (cancelBtn) {
		cancelBtn.addEventListener('click', cancelProcessing);
	}
	
	function startProcessing() {
		statusText.textContent = '{lightspeedto_odoo.process.processing_data}';
		showControls();
		processNextBatch();
	}
	
	function processNextBatch() {
		if (isPaused || isCompleted) {
			return;
		}
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', ajaxUrl, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					try {
						var response = JSON.parse(xhr.responseText);
						handleProcessingResponse(response);
					} catch (e) {
						handleError('{lightspeedto_odoo.process.error.invalid_response}');
					}
				} else {
					handleError('{lightspeedto_odoo.process.error.network}');
				}
			}
		};
		
		xhr.send('upload_id=' + uploadId + '&current_row=' + currentRow);
	}
	
	function handleProcessingResponse(response) {
		if (response.success) {
			currentRow = response.processed_rows || currentRow;
			errorCount = response.error_count || errorCount;
			
			updateProgress();
			
			if (response.completed) {
				completeProcessing(response);
			} else {
				// Ajouter une entrée au journal
				if (response.log_message) {
					addLogEntry('info', response.log_message);
				}
				
				// Continuer le traitement
				setTimeout(processNextBatch, 500);
			}
		} else {
			handleError(response.message || '{lightspeedto_odoo.process.error.unknown}');
		}
	}
	
	function updateProgress() {
		var percentage = Math.round((currentRow / totalRows) * 100);
		
		progressText.textContent = currentRow + ' / ' + totalRows + ' {lightspeedto_odoo.process.rows}';
		progressPercentage.textContent = percentage + '%';
		progressBar.style.width = percentage + '%';
		processedCount.textContent = currentRow;
		errorCountElement.textContent = errorCount;
		
		// Calcul de la vitesse de traitement
		var elapsed = (new Date() - startTime) / 1000;
		var speed = elapsed > 0 ? Math.round(currentRow / elapsed) : 0;
		processingSpeed.textContent = speed;
	}
	
	function completeProcessing(response) {
		isCompleted = true;
		
		statusText.textContent = '{lightspeedto_odoo.process.completed}';
		hideSpinner();
		hideControls();
		showViewDetailsButton();
		
		var message = response.error_count > 0 ? 
			'{lightspeedto_odoo.process.completed_with_errors}' : 
			'{lightspeedto_odoo.process.completed_successfully}';
		
		addLogEntry('success', message);
		
		// Redirection automatique après 5 secondes
		setTimeout(function() {
			window.location.href = detailsUrl;
		}, 5000);
	}
	
	function handleError(message) {
		isCompleted = true;
		
		statusText.textContent = '{lightspeedto_odoo.process.error}';
		hideSpinner();
		hideControls();
		showViewDetailsButton();
		
		addLogEntry('error', message);
	}
	
	function pauseProcessing() {
		isPaused = true;
		statusText.textContent = '{lightspeedto_odoo.process.paused}';
		pauseBtn.style.display = 'none';
		resumeBtn.style.display = 'inline-block';
		addLogEntry('warning', '{lightspeedto_odoo.process.log.paused}');
	}
	
	function resumeProcessing() {
		isPaused = false;
		statusText.textContent = '{lightspeedto_odoo.process.processing_data}';
		resumeBtn.style.display = 'none';
		pauseBtn.style.display = 'inline-block';
		addLogEntry('info', '{lightspeedto_odoo.process.log.resumed}');
		processNextBatch();
	}
	
	function cancelProcessing() {
		if (confirm('{lightspeedto_odoo.process.cancel.confirmation}')) {
			isCompleted = true;
			
			// Requête d'annulation
			var xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxUrl, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send('upload_id=' + uploadId + '&action=cancel');
			
			statusText.textContent = '{lightspeedto_odoo.process.cancelled}';
			hideSpinner();
			hideControls();
			showViewDetailsButton();
			
			addLogEntry('error', '{lightspeedto_odoo.process.log.cancelled}');
		}
	}
	
	function updateElapsedTime() {
		var elapsed = new Date() - startTime;
		var seconds = Math.floor(elapsed / 1000) % 60;
		var minutes = Math.floor(elapsed / 60000);
		
		elapsedTime.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
	}
	
	function addLogEntry(type, message) {
		var entry = document.createElement('div');
		entry.className = 'log-entry ' + type;
		entry.innerHTML = '<span class="log-timestamp">' + formatTime(new Date()) + '</span>' +
						  '<span class="log-message">' + message + '</span>';
		
		logContainer.appendChild(entry);
		logContainer.scrollTop = logContainer.scrollHeight;
	}
	
	function formatTime(date) {
		return String(date.getHours()).padStart(2, '0') + ':' +
			   String(date.getMinutes()).padStart(2, '0') + ':' +
			   String(date.getSeconds()).padStart(2, '0');
	}
	
	function hideSpinner() {
		var spinner = document.getElementById('processing-spinner');
		if (spinner) {
			spinner.style.display = 'none';
		}
	}
	
	function showControls() {
		pauseBtn.style.display = 'inline-block';
		cancelBtn.style.display = 'inline-block';
	}
	
	function hideControls() {
		pauseBtn.style.display = 'none';
		resumeBtn.style.display = 'none';
		cancelBtn.style.display = 'none';
	}
	
	function showViewDetailsButton() {
		viewDetailsBtn.style.display = 'inline-block';
	}
});
//-->
</script>

<style>
.processing-container {
	max-width: 800px;
	margin: 0 auto;
}

.processing-header {
	text-align: center;
	margin-bottom: 2rem;
}

.processing-status {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 1rem;
	margin-top: 1rem;
}

.spinner {
	color: var(--main-color);
}

.progress-main {
	margin-bottom: 2rem;
}

.progress-info {
	display: flex;
	justify-content: space-between;
	margin-bottom: 0.5rem;
	font-weight: bold;
}

.progressbar-container.large {
	height: 1.5rem;
	border-radius: 0.75rem;
	overflow: hidden;
}

.stats-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
	gap: 1rem;
	margin-bottom: 2rem;
}

.stat-card {
	display: flex;
	align-items: center;
	gap: 1rem;
	padding: 1rem;
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.5rem;
	border: 1px solid rgba(var(--main-rgb), 0.1);
}

.stat-card.success {
	background: rgba(var(--success-rgb), 0.05);
	border-color: rgba(var(--success-rgb), 0.2);
}

.stat-card.error {
	background: rgba(var(--error-rgb), 0.05);
	border-color: rgba(var(--error-rgb), 0.2);
}

.stat-card.notice {
	background: rgba(var(--notice-rgb), 0.05);
	border-color: rgba(var(--notice-rgb), 0.2);
}

.stat-icon {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 2.5rem;
	height: 2.5rem;
	border-radius: 50%;
	background: rgba(var(--main-rgb), 0.1);
	color: var(--main-color);
	font-size: 1.125rem;
}

.stat-card.success .stat-icon {
	background: rgba(var(--success-rgb), 0.2);
	color: var(--success-color);
}

.stat-card.error .stat-icon {
	background: rgba(var(--error-rgb), 0.2);
	color: var(--error-color);
}

.stat-card.notice .stat-icon {
	background: rgba(var(--notice-rgb), 0.2);
	color: var(--notice-color);
}

.stat-content {
	flex: 1;
}

.stat-value {
	font-size: 1.5rem;
	font-weight: bold;
	margin-bottom: 0.25rem;
}

.stat-label {
	font-size: 0.875rem;
	color: #666;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

.real-time-log {
	margin-bottom: 2rem;
}

.log-container {
	max-height: 300px;
	overflow-y: auto;
	border: 1px solid #dee2e6;
	border-radius: 0.5rem;
	background: #f8f9fa;
	padding: 1rem;
}

.log-entry {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	padding: 0.5rem;
	margin-bottom: 0.5rem;
	border-radius: 0.25rem;
	font-size: 0.875rem;
}

.log-entry.info {
	background: rgba(var(--main-rgb), 0.1);
}

.log-entry.success {
	background: rgba(var(--success-rgb), 0.1);
}

.log-entry.warning {
	background: rgba(var(--warning-rgb), 0.1);
}

.log-entry.error {
	background: rgba(var(--error-rgb), 0.1);
}

.log-timestamp {
	color: #666;
	font-family: monospace;
	font-size: 0.8rem;
}

.log-message {
	flex: 1;
}

.processing-controls {
	text-align: center;
	gap: 1rem;
}

.processing-controls .button {
	margin: 0 0.5rem;
}

@media (max-width: 768px) {
	.stats-grid {
		grid-template-columns: 1fr;
	}
	
	.progress-info {
		flex-direction: column;
		text-align: center;
		gap: 0.5rem;
	}
	
	.processing-controls .button {
		display: block;
		margin: 0.5rem auto;
		width: 200px;
	}
}
</style>