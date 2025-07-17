<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.process.processing} - {FILENAME}</h1>
		<div class="controls align-right">
			<a href="{U_DETAILS}" class="button" id="view-details-btn" style="display: none;">
				<i class="fa fa-eye" aria-hidden="true"></i> {@lightspeedto_odoo.process.view_details}
			</a>
		</div>
	</header>

	<div class="content">
		<!-- Zone de progression principale -->
		<div class="content-block">
			<div class="processing-container">
				<div class="processing-header">
					<h2>{@lightspeedto_odoo.process.processing_file}</h2>
					<div class="processing-status">
						<span id="status-text">{@lightspeedto_odoo.process.initializing}</span>
						<div id="processing-spinner" class="spinner">
							<i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
						</div>
					</div>
				</div>

				<!-- Barre de progression principale -->
				<div class="progress-main">
					<div class="progress-info">
						<span id="progress-text">0 / {TOTAL_ROWS} {@lightspeedto_odoo.process.rows}</span>
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
							<div class="stat-label">{@lightspeedto_odoo.process.processed}</div>
						</div>
					</div>

					<div class="stat-card error">
						<div class="stat-icon">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="error-count">0</div>
							<div class="stat-label">{@lightspeedto_odoo.process.errors}</div>
						</div>
					</div>

					<div class="stat-card notice">
						<div class="stat-icon">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="elapsed-time">00:00</div>
							<div class="stat-label">{@lightspeedto_odoo.process.elapsed_time}</div>
						</div>
					</div>

					<div class="stat-card warning">
						<div class="stat-icon">
							<i class="fa fa-tachometer" aria-hidden="true"></i>
						</div>
						<div class="stat-content">
							<div class="stat-value" id="processing-speed">0</div>
							<div class="stat-label">{@lightspeedto_odoo.process.speed}</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Log en temps réel -->
		<div class="content-block">
			<div class="log-container">
				<div class="log-header">
					<h3>{@lightspeedto_odoo.process.log}</h3>
					<div class="log-controls">
						<button type="button" id="toggle-log" class="button small">
							<i class="fa fa-eye-slash" aria-hidden="true"></i> {@lightspeedto_odoo.process.hide_log}
						</button>
						<button type="button" id="clear-log" class="button small">
							<i class="fa fa-trash" aria-hidden="true"></i> {@lightspeedto_odoo.process.clear_log}
						</button>
					</div>
				</div>
				<div id="processing-log" class="log-content">
					<div class="log-entry info">
						<span class="log-time">[<span id="start-time"></span>]</span>
						<span class="log-message">{@lightspeedto_odoo.process.starting}</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Contrôles -->
		<div class="content-block">
			<div class="processing-controls">
				<button type="button" id="pause-btn" class="button warning" style="display: none;">
					<i class="fa fa-pause" aria-hidden="true"></i> {@lightspeedto_odoo.process.pause}
				</button>
				<button type="button" id="resume-btn" class="button submit" style="display: none;">
					<i class="fa fa-play" aria-hidden="true"></i> {@lightspeedto_odoo.process.resume}
				</button>
				<button type="button" id="stop-btn" class="button error" style="display: none;">
					<i class="fa fa-stop" aria-hidden="true"></i> {@lightspeedto_odoo.process.stop}
				</button>
			</div>
		</div>
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	const uploadId = {UPLOAD_ID};
	const totalRows = {TOTAL_ROWS};
	const ajaxUrl = '{U_AJAX_PROCESS}';
	
	let currentBatch = 0;
	let processedRows = 0;
	let errorCount = 0;
	let isProcessing = false;
	let isPaused = false;
	let startTime = Date.now();
	let processingInterval;
	
	// Éléments DOM
	const elements = {
		statusText: document.getElementById('status-text'),
		progressBar: document.getElementById('progress-bar'),
		progressText: document.getElementById('progress-text'),
		progressPercentage: document.getElementById('progress-percentage'),
		processedCount: document.getElementById('processed-count'),
		errorCount: document.getElementById('error-count'),
		elapsedTime: document.getElementById('elapsed-time'),
		processingSpeed: document.getElementById('processing-speed'),
		processingLog: document.getElementById('processing-log'),
		startTime: document.getElementById('start-time'),
		pauseBtn: document.getElementById('pause-btn'),
		resumeBtn: document.getElementById('resume-btn'),
		stopBtn: document.getElementById('stop-btn'),
		toggleLogBtn: document.getElementById('toggle-log'),
		clearLogBtn: document.getElementById('clear-log'),
		viewDetailsBtn: document.getElementById('view-details-btn'),
		spinner: document.getElementById('processing-spinner')
	};
	
	// Initialisation
	init();
	
	function init() {
		elements.startTime.textContent = formatTime(new Date());
		addLogEntry('info', '{@lightspeedto_odoo.process.log.initialized}');
		
		// Démarrer le traitement
		setTimeout(startProcessing, 1000);
		
		// Démarrer le timer
		startTimer();
		
		// Événements
		setupEventListeners();
	}
	
	function setupEventListeners() {
		elements.pauseBtn?.addEventListener('click', pauseProcessing);
		elements.resumeBtn?.addEventListener('click', resumeProcessing);
		elements.stopBtn?.addEventListener('click', stopProcessing);
		elements.toggleLogBtn?.addEventListener('click', toggleLog);
		elements.clearLogBtn?.addEventListener('click', clearLog);
		
		// Prévenir la fermeture accidentelle
		window.addEventListener('beforeunload', function(e) {
			if (isProcessing && !isPaused) {
				e.preventDefault();
				e.returnValue = '{@lightspeedto_odoo.process.warning.close}';
				return e.returnValue;
			}
		});
	}
	
	function startProcessing() {
		isProcessing = true;
		elements.statusText.textContent = '{@lightspeedto_odoo.process.processing_data}';
		elements.pauseBtn.style.display = 'inline-block';
		elements.stopBtn.style.display = 'inline-block';
		
		addLogEntry('success', '{@lightspeedto_odoo.process.log.started}');
		processBatch();
	}
	
	function processBatch() {
		if (!isProcessing || isPaused) return;
		
		const batchUrl = `${ajaxUrl}&batch=${currentBatch}`;
		addLogEntry('info', `{@lightspeedto_odoo.process.log.processing_batch} ${currentBatch + 1}`);
		
		fetch(batchUrl, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
			}
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				processedRows += data.processed_rows;
				errorCount += data.errors;
				
				updateProgress();
				addLogEntry('success', data.message);
				
				if (data.completed) {
					completeProcessing();
				} else {
					currentBatch++;
					// Petite pause entre les batches
					setTimeout(processBatch, 500);
				}
			} else {
				addLogEntry('error', `{@lightspeedto_odoo.process.log.error}: ${data.error}`);
				stopProcessing(true);
			}
		})
		.catch(error => {
			addLogEntry('error', `{@lightspeedto_odoo.process.log.network_error}: ${error.message}`);
			stopProcessing(true);
		});
	}
	
	function updateProgress() {
		const percentage = Math.round((processedRows / totalRows) * 100);
		
		elements.progressBar.style.width = `${percentage}%`;
		elements.progressText.textContent = `${processedRows} / ${totalRows} {@lightspeedto_odoo.process.rows}`;
		elements.progressPercentage.textContent = `${percentage}%`;
		elements.processedCount.textContent = processedRows;
		elements.errorCount.textContent = errorCount;
		
		// Calcul de la vitesse
		const elapsed = (Date.now() - startTime) / 1000;
		const speed = elapsed > 0 ? Math.round(processedRows / elapsed * 60) : 0;
		elements.processingSpeed.textContent = `${speed}/min`;
	}
	
	function completeProcessing() {
		isProcessing = false;
		elements.statusText.textContent = '{@lightspeedto_odoo.process.completed}';
		elements.spinner.style.display = 'none';
		elements.pauseBtn.style.display = 'none';
		elements.stopBtn.style.display = 'none';
		elements.viewDetailsBtn.style.display = 'inline-block';
		
		if (errorCount > 0) {
			addLogEntry('warning', `{@lightspeedto_odoo.process.log.completed_with_errors}: ${errorCount}`);
		} else {
			addLogEntry('success', '{@lightspeedto_odoo.process.log.completed_successfully}');
		}
		
		// Notification
		if ('Notification' in window && Notification.permission === 'granted') {
			new Notification('{@lightspeedto_odoo.process.notification.completed}', {
				body: `${processedRows} {@lightspeedto_odoo.process.notification.rows_processed}`,
				icon: '/templates/__default__/images/favicon.png'
			});
		}
	}
	
	function pauseProcessing() {
		isPaused = true;
		elements.statusText.textContent = '{@lightspeedto_odoo.process.paused}';
		elements.pauseBtn.style.display = 'none';
		elements.resumeBtn.style.display = 'inline-block';
		addLogEntry('warning', '{@lightspeedto_odoo.process.log.paused}');
	}
	
	function resumeProcessing() {
		isPaused = false;
		elements.statusText.textContent = '{@lightspeedto_odoo.process.processing_data}';
		elements.pauseBtn.style.display = 'inline-block';
		elements.resumeBtn.style.display = 'none';
		addLogEntry('info', '{@lightspeedto_odoo.process.log.resumed}');
		processBatch();
	}
	
	function stopProcessing(isError = false) {
		const confirmMessage = isError ? 
			'{@lightspeedto_odoo.process.error_occurred}' : 
			'{@lightspeedto_odoo.process.confirm_stop}';
			
		if (!isError && !confirm(confirmMessage)) {
			return;
		}
		
		isProcessing = false;
		isPaused = false;
		elements.statusText.textContent = isError ? 
			'{@lightspeedto_odoo.process.stopped_error}' : 
			'{@lightspeedto_odoo.process.stopped}';
		elements.spinner.style.display = 'none';
		elements.pauseBtn.style.display = 'none';
		elements.resumeBtn.style.display = 'none';
		elements.stopBtn.style.display = 'none';
		elements.viewDetailsBtn.style.display = 'inline-block';
		
		addLogEntry(isError ? 'error' : 'warning', 
			isError ? '{@lightspeedto_odoo.process.log.stopped_error}' : '{@lightspeedto_odoo.process.log.stopped}');
	}
	
	function startTimer() {
		setInterval(() => {
			const elapsed = Date.now() - startTime;
			elements.elapsedTime.textContent = formatDuration(elapsed);
		}, 1000);
	}
	
	function addLogEntry(type, message) {
		const logEntry = document.createElement('div');
		logEntry.className = `log-entry ${type}`;
		logEntry.innerHTML = `
			<span class="log-time">[${formatTime(new Date())}]</span>
			<span class="log-message">${message}</span>
		`;
		
		elements.processingLog.appendChild(logEntry);
		elements.processingLog.scrollTop = elements.processingLog.scrollHeight;
	}
	
	function toggleLog() {
		const isVisible = elements.processingLog.style.display !== 'none';
		elements.processingLog.style.display = isVisible ? 'none' : 'block';
		elements.toggleLogBtn.innerHTML = isVisible ? 
			'<i class="fa fa-eye" aria-hidden="true"></i> {@lightspeedto_odoo.process.show_log}' :
			'<i class="fa fa-eye-slash" aria-hidden="true"></i> {@lightspeedto_odoo.process.hide_log}';
	}
	
	function clearLog() {
		elements.processingLog.innerHTML = '';
		addLogEntry('info', '{@lightspeedto_odoo.process.log.cleared}');
	}
	
	function formatTime(date) {
		return date.toLocaleTimeString();
	}
	
	function formatDuration(ms) {
		const seconds = Math.floor(ms / 1000);
		const minutes = Math.floor(seconds / 60);
		const remainingSeconds = seconds % 60;
		return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
	}
	
	// Demander la permission pour les notifications
	if ('Notification' in window && Notification.permission === 'default') {
		Notification.requestPermission();
	}
});
//-->
</script>

<style>
.processing-container {
	background: #f8f9fa;
	border-radius: 0.5rem;
	padding: 2rem;
	margin-bottom: 2rem;
}

.processing-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 2rem;
}

.processing-status {
	display: flex;
	align-items: center;
	gap: 1rem;
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
	align-items: center;
	margin-bottom: 1rem;
	font-weight: bold;
}

.progressbar-container.large {
	height: 2rem;
	border-radius: 1rem;
	overflow: hidden;
}

.progressbar-container.large .progressbar {
	height: 100%;
}

.stats-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
	gap: 1rem;
}

.stat-card {
	display: flex;
	align-items: center;
	gap: 1rem;
	padding: 1rem;
	border-radius: 0.5rem;
	border: 2px solid transparent;
}

.stat-card.success {
	background: rgba(var(--success-rgb), 0.1);
	border-color: var(--success-color);
}

.stat-card.error {
	background: rgba(var(--error-rgb), 0.1);
	border-color: var(--error-color);
}

.stat-card.notice {
	background: rgba(var(--notice-rgb), 0.1);
	border-color: var(--notice-color);
}

.stat-card.warning {
	background: rgba(var(--warning-rgb), 0.1);
	border-color: var(--warning-color);
}

.stat-icon {
	font-size: 2rem;
}

.stat-card.success .stat-icon {
	color: var(--success-color);
}

.stat-card.error .stat-icon {
	color: var(--error-color);
}

.stat-card.notice .stat-icon {
	color: var(--notice-color);
}

.stat-card.warning .stat-icon {
	color: var(--warning-color);
}

.stat-value {
	font-size: 2rem;
	font-weight: bold;
	margin-bottom: 0.25rem;
}

.stat-label {
	font-size: 0.875rem;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	opacity: 0.8;
}

.log-container {
	background: #fff;
	border: 1px solid #dee2e6;
	border-radius: 0.5rem;
	overflow: hidden;
}

.log-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 1rem;
	background: #f8f9fa;
	border-bottom: 1px solid #dee2e6;
}

.log-controls {
	display: flex;
	gap: 0.5rem;
}

.log-content {
	max-height: 300px;
	overflow-y: auto;
	padding: 1rem;
	font-family: 'Courier New', monospace;
	font-size: 0.875rem;
	line-height: 1.4;
}

.log-entry {
	margin-bottom: 0.5rem;
	padding: 0.25rem 0.5rem;
	border-radius: 0.25rem;
}

.log-entry.info {
	background: rgba(var(--notice-rgb), 0.1);
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

.log-time {
	color: #666;
	margin-right: 0.5rem;
}

.processing-controls {
	display: flex;
	justify-content: center;
	gap: 1rem;
	padding: 1rem;
}

@media (max-width: 768px) {
	.processing-header {
		flex-direction: column;
		gap: 1rem;
		text-align: center;
	}
	
	.progress-info {
		flex-direction: column;
		gap: 0.5rem;
		text-align: center;
	}
	
	.stats-grid {
		grid-template-columns: 1fr;
	}
	
	.log-header {
		flex-direction: column;
		gap: 1rem;
	}
	
	.processing-controls {
		flex-direction: column;
		align-items: center;
	}
}
</style>