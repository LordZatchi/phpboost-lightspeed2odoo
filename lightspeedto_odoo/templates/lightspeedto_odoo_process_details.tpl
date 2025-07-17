<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.process.details} - {FILENAME}</h1>
		<div class="controls align-right">
			# IF C_CAN_PROCESS #
				<a href="{U_PROCESS}" class="button submit">
					<i class="fa fa-play" aria-hidden="true"></i> {@lightspeedto_odoo.process.start}
				</a>
			# ENDIF #
			<a href="{U_BACK}" class="button">
				<i class="fa fa-list" aria-hidden="true"></i> {@lightspeedto_odoo.process.back_to_list}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		<!-- Informations générales -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.upload.information}</h2>
			<div class="cell-flex cell-columns-2 cell-tile">
				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.upload.file_info}</h3>
					</div>
					<div class="cell-body">
						<dl class="field-list">
							<dt>{@common.file}:</dt>
							<dd>
								<i class="fa fa-file-csv" aria-hidden="true"></i>
								{FILENAME}
							</dd>
							
							<dt>{@lightspeedto_odoo.upload.file_size}:</dt>
							<dd>{FILE_SIZE} KB</dd>
							
							<dt>{@lightspeedto_odoo.upload.date}:</dt>
							<dd>{UPLOAD_DATE}</dd>
							
							<dt>{@common.author}:</dt>
							<dd>
								# IF AUTHOR_DISPLAY_NAME #
									<a href="{U_AUTHOR_PROFILE}">{AUTHOR_DISPLAY_NAME}</a>
								# ELSE #
									{@user.guest}
								# ENDIF #
							</dd>
						</dl>
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.process.status_info}</h3>
					</div>
					<div class="cell-body">
						<dl class="field-list">
							<dt>{@common.status}:</dt>
							<dd>
								<span class="pinned {STATUS_CSS_CLASS}">
									# IF C_IS_PROCESSING #
										<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
									# ENDIF #
									{STATUS_LABEL}
								</span>
							</dd>
							
							<dt>{@lightspeedto_odoo.upload.mapping}:</dt>
							<dd>
								# IF C_HAS_MAPPING #
									<span class="pinned notice">{MAPPING_NAME}</span>
								# ELSE #
									<em>{@lightspeedto_odoo.mapping.none}</em>
								# ENDIF #
							</dd>
							
							# IF C_PROCESSED_DATE #
								<dt>{@lightspeedto_odoo.process.processed_date}:</dt>
								<dd>{PROCESSED_DATE}</dd>
							# ENDIF #
						</dl>
					</div>
				</div>
			</div>
		</div>

		<!-- Progression -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.process.progress}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="progress-section">
						<div class="progress-header">
							<h3>{@lightspeedto_odoo.process.data_processing}</h3>
							<span class="progress-percentage">{PROGRESS_PERCENT}%</span>
						</div>
						
						<div class="progressbar-container large">
							<div class="progressbar">
								<div class="progressbar-value" style="width: {PROGRESS_PERCENT}%"></div>
							</div>
						</div>
						
						<div class="progress-stats">
							<div class="cell-flex cell-columns-3">
								<div class="cell align-center">
									<div class="stat-value success">{PROCESSED_ROWS}</div>
									<div class="stat-label">{@lightspeedto_odoo.process.processed_rows}</div>
								</div>
								<div class="cell align-center">
									<div class="stat-value">{TOTAL_ROWS}</div>
									<div class="stat-label">{@lightspeedto_odoo.process.total_rows}</div>
								</div>
								<div class="cell align-center">
									<div class="stat-value error">{ERROR_COUNT}</div>
									<div class="stat-label">{@lightspeedto_odoo.process.errors}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Journal des erreurs -->
		# IF C_HAS_ERROR_LOG #
			<div class="content-block">
				<h2>{@lightspeedto_odoo.process.error_log} ({ERROR_COUNT})</h2>
				<div class="responsive-table">
					<table class="table">
						<thead>
							<tr>
								<th>{@lightspeedto_odoo.process.row_number}</th>
								<th>{@lightspeedto_odoo.process.error_message}</th>
								<th>{@lightspeedto_odoo.process.data}</th>
							</tr>
						</thead>
						<tbody>
							# START errors #
								<tr>
									<td>
										# IF errors.ROW #
											<span class="pinned notice">#{errors.ROW}</span>
										# ELSE #
											<span class="text-muted">-</span>
										# ENDIF #
									</td>
									<td>
										<span class="text-error">{errors.MESSAGE}</span>
									</td>
									<td>
										# IF errors.DATA #
											<details>
												<summary>{@lightspeedto_odoo.process.show_data}</summary>
												<pre class="language-json"><code>{errors.DATA}</code></pre>
											</details>
										# ELSE #
											<span class="text-muted">-</span>
										# ENDIF #
									</td>
								</tr>
							# END errors #
						</tbody>
					</table>
				</div>
			</div>
		# ENDIF #

		<!-- Actions -->
		<div class="content-block">
			<h2>{@common.actions}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="cell-flex cell-columns-2">
						<div class="cell">
							<h4>{@lightspeedto_odoo.process.available_actions}</h4>
							<div class="actions-list">
								# IF C_CAN_PROCESS #
									<div class="action-item">
										<a href="{U_PROCESS}" class="button submit">
											<i class="fa fa-play" aria-hidden="true"></i>
											{@lightspeedto_odoo.process.start}
										</a>
										<p class="action-description">{@lightspeedto_odoo.process.start.description}</p>
									</div>
								# ENDIF #
								
								# IF C_IS_PROCESSING #
									<div class="action-item">
										<button type="button" class="button warning" onclick="refreshStatus()">
											<i class="fa fa-refresh" aria-hidden="true"></i>
											{@lightspeedto_odoo.process.refresh_status}
										</button>
										<p class="action-description">{@lightspeedto_odoo.process.refresh_status.description}</p>
									</div>
								# ENDIF #
								
								# IF C_HAS_ERRORS #
									<div class="action-item">
										<button type="button" class="button" onclick="downloadErrorReport()">
											<i class="fa fa-download" aria-hidden="true"></i>
											{@lightspeedto_odoo.process.download_error_report}
										</button>
										<p class="action-description">{@lightspeedto_odoo.process.download_error_report.description}</p>
									</div>
								# ENDIF #
							</div>
						</div>
						
						<div class="cell">
							<h4>{@lightspeedto_odoo.process.troubleshooting}</h4>
							<div class="troubleshooting-tips">
								# IF C_HAS_ERRORS #
									<div class="message-helper bgc error">
										<h5>{@lightspeedto_odoo.process.troubleshooting.errors.title}</h5>
										<ul>
											<li>{@lightspeedto_odoo.process.troubleshooting.errors.tip1}</li>
											<li>{@lightspeedto_odoo.process.troubleshooting.errors.tip2}</li>
											<li>{@lightspeedto_odoo.process.troubleshooting.errors.tip3}</li>
										</ul>
									</div>
								# ENDIF #
								
								# IF C_IS_PROCESSING #
									<div class="message-helper bgc notice">
										<h5>{@lightspeedto_odoo.process.troubleshooting.processing.title}</h5>
										<p>{@lightspeedto_odoo.process.troubleshooting.processing.description}</p>
									</div>
								# ENDIF #
								
								<div class="message-helper bgc success">
									<h5>{@lightspeedto_odoo.process.troubleshooting.general.title}</h5>
									<ul>
										<li>{@lightspeedto_odoo.process.troubleshooting.general.tip1}</li>
										<li>{@lightspeedto_odoo.process.troubleshooting.general.tip2}</li>
										<li>{@lightspeedto_odoo.process.troubleshooting.general.tip3}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
function refreshStatus() {
	var button = document.querySelector('button[onclick="refreshStatus()"]');
	var originalText = button.innerHTML;
	
	button.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> {@lightspeedto_odoo.process.refreshing}';
	button.disabled = true;
	
	// Recharger la page pour obtenir le statut mis à jour
	setTimeout(function() {
		window.location.reload();
	}, 1000);
}

function downloadErrorReport() {
	var uploadId = '{ID}';
	var filename = '{FILENAME}';
	
	// Préparer les données d'erreur pour le téléchargement
	var errors = [];
	# START errors #
		errors.push({
			row: '{errors.ROW}',
			message: '{errors.MESSAGE}',
			data: '{errors.DATA}'
		});
	# END errors #
	
	// Créer un CSV avec les erreurs
	var csvContent = "data:text/csv;charset=utf-8,";
	csvContent += "Ligne,Message d'erreur,Données\n";
	
	errors.forEach(function(error) {
		var row = error.row || 'N/A';
		var message = error.message.replace(/"/g, '""');
		var data = error.data.replace(/"/g, '""');
		csvContent += `"${row}","${message}","${data}"\n`;
	});
	
	// Télécharger le fichier
	var encodedUri = encodeURI(csvContent);
	var link = document.createElement("a");
	link.setAttribute("href", encodedUri);
	link.setAttribute("download", "errors_" + filename.replace('.csv', '') + ".csv");
	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
}

// Auto-refresh si le traitement est en cours
# IF C_IS_PROCESSING #
	document.addEventListener('DOMContentLoaded', function() {
		// Rafraîchir automatiquement toutes les 15 secondes
		setInterval(function() {
			window.location.reload();
		}, 15000);
	});
# ENDIF #
//-->
</script>

<style>
.field-list {
	margin: 0;
}

.field-list dt {
	font-weight: bold;
	margin-top: 0.5rem;
	margin-bottom: 0.25rem;
}

.field-list dd {
	margin-left: 0;
	margin-bottom: 0.25rem;
	padding-left: 1rem;
}

.progress-section {
	padding: 1rem;
	border: 1px solid rgba(var(--main-rgb), 0.2);
	border-radius: 0.25rem;
}

.progress-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 1rem;
}

.progress-percentage {
	font-size: 1.5em;
	font-weight: bold;
	color: var(--success-color);
}

.progressbar-container.large {
	height: 2rem;
	margin-bottom: 1rem;
}

.progressbar-container.large .progressbar {
	height: 100%;
}

.progress-stats {
	margin-top: 1rem;
}

.stat-value {
	font-size: 2em;
	font-weight: bold;
	margin-bottom: 0.25rem;
}

.stat-value.success {
	color: var(--success-color);
}

.stat-value.error {
	color: var(--error-color);
}

.stat-label {
	font-size: 0.875em;
	color: #666;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

.actions-list {
	display: flex;
	flex-direction: column;
	gap: 1rem;
}

.action-item {
	padding: 1rem;
	border: 1px solid rgba(var(--main-rgb), 0.2);
	border-radius: 0.25rem;
}

.action-description {
	margin: 0.5rem 0 0 0;
	font-size: 0.875em;
	color: #666;
}

.troubleshooting-tips {
	display: flex;
	flex-direction: column;
	gap: 1rem;
}

.text-error {
	color: var(--error-color);
	font-weight: 500;
}

details {
	margin-top: 0.5rem;
}

summary {
	cursor: pointer;
	font-weight: bold;
	color: var(--main-color);
}

summary:hover {
	text-decoration: underline;
}

details[open] summary {
	margin-bottom: 0.5rem;
}

pre code {
	font-size: 0.8em;
	max-height: 200px;
	overflow-y: auto;
}

@media (max-width: 768px) {
	.progress-header {
		flex-direction: column;
		gap: 0.5rem;
		text-align: center;
	}
	
	.field-list dd {
		padding-left: 0;
	}
	
	.stat-value {
		font-size: 1.5em;
	}
}
</style>