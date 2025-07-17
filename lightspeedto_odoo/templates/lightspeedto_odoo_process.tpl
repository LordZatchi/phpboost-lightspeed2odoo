<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.process.title}</h1>
		<div class="controls align-right">
			<a href="{U_UPLOAD}" class="button submit">
				<i class="fa fa-upload" aria-hidden="true"></i> {@lightspeedto_odoo.upload.new}
			</a>
			<a href="{U_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {@lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		# IF C_LIST_MODE #
			# IF C_UPLOADS #
				<div class="content-block">
					<h2>{@lightspeedto_odoo.process.uploads_list} ({TOTAL_UPLOADS})</h2>
					<div class="responsive-table">
						<table class="table">
							<thead>
								<tr>
									<th>{@common.file}</th>
									<th>{@lightspeedto_odoo.upload.mapping}</th>
									<th>{@common.status}</th>
									<th>{@lightspeedto_odoo.upload.progress}</th>
									<th>{@lightspeedto_odoo.upload.errors}</th>
									<th>{@common.author}</th>
									<th>{@lightspeedto_odoo.upload.date}</th>
									<th>{@common.actions}</th>
								</tr>
							</thead>
							<tbody>
								# START uploads #
									<tr class="upload-row" data-upload-id="{uploads.ID}">
										<td>
											<div class="file-info">
												<i class="fa fa-file-csv" aria-hidden="true"></i>
												<div>
													<strong>{uploads.FILENAME}</strong><br>
													<small>{uploads.FILE_SIZE} KB</small>
												</div>
											</div>
										</td>
										<td>
											# IF uploads.C_HAS_MAPPING #
												<span class="pinned notice">{uploads.MAPPING_NAME}</span>
											# ELSE #
												<em>{@lightspeedto_odoo.mapping.none}</em>
											# ENDIF #
										</td>
										<td>
											<span class="pinned {uploads.STATUS_CSS_CLASS}">
												# IF uploads.C_IS_PROCESSING #
													<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
												# ENDIF #
												{uploads.STATUS_LABEL}
											</span>
										</td>
										<td>
											# IF uploads.TOTAL_ROWS #
												<div class="progress-container">
													<div class="progressbar-container">
														<div class="progressbar">
															<div class="progressbar-value" style="width: {uploads.PROGRESS_PERCENT}%"></div>
														</div>
													</div>
													<div class="progress-text">
														{uploads.PROCESSED_ROWS} / {uploads.TOTAL_ROWS}
														<span class="small">({uploads.PROGRESS_PERCENT}%)</span>
													</div>
												</div>
											# ELSE #
												<span class="text-muted">-</span>
											# ENDIF #
										</td>
										<td>
											# IF uploads.C_HAS_ERRORS #
												<span class="pinned error">{uploads.ERROR_COUNT}</span>
											# ELSE #
												<span class="text-muted">0</span>
											# ENDIF #
										</td>
										<td>
											# IF uploads.C_AUTHOR_EXISTS #
												# IF uploads.C_AUTHOR_GROUP_COLOR #
													<span style="color: {uploads.AUTHOR_GROUP_COLOR}">
												# ENDIF #
												<a href="{uploads.U_AUTHOR_PROFILE}" class="{uploads.AUTHOR_LEVEL_CLASS}">{uploads.AUTHOR_DISPLAY_NAME}</a>
												# IF uploads.C_AUTHOR_GROUP_COLOR #
													</span>
												# ENDIF #
											# ELSE #
												{@user.guest}
											# ENDIF #
										</td>
										<td>
											<div class="date-info">
												{uploads.UPLOAD_DATE}
												# IF uploads.C_PROCESSED_DATE #
													<br><small class="text-muted">{@lightspeedto_odoo.process.processed}: {uploads.PROCESSED_DATE}</small>
												# ENDIF #
											</div>
										</td>
										<td>
											<div class="controls">
												<a href="{uploads.U_DETAILS}" class="button small" title="{@common.see.details}">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
												# IF uploads.C_CAN_PROCESS #
													<a href="{uploads.U_PROCESS}" class="button small submit" title="{@lightspeedto_odoo.process.start}">
														<i class="fa fa-play" aria-hidden="true"></i>
													</a>
												# ENDIF #
												# IF uploads.C_IS_PROCESSING #
													<button type="button" class="button small warning" onclick="refreshUploadStatus({uploads.ID})" title="{@common.refresh}">
														<i class="fa fa-refresh" aria-hidden="true"></i>
													</button>
												# ENDIF #
											</div>
										</td>
									</tr>
								# END uploads #
							</tbody>
						</table>
					</div>

					# IF C_PAGINATION #
						<div class="align-center">
							{PAGINATION}
						</div>
					# ENDIF #
				</div>

				<!-- Légende des statuts -->
				<div class="content-block">
					<h3>{@lightspeedto_odoo.process.status.legend}</h3>
					<div class="cell-flex cell-columns-2 cell-tile">
						<div class="cell">
							<div class="cell-body">
								<div class="status-legend">
									<div class="legend-item">
										<span class="pinned notice">{@lightspeedto_odoo.status.pending}</span>
										<span>{@lightspeedto_odoo.status.pending.description}</span>
									</div>
									<div class="legend-item">
										<span class="pinned warning">
											<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
											{@lightspeedto_odoo.status.processing}
										</span>
										<span>{@lightspeedto_odoo.status.processing.description}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="cell">
							<div class="cell-body">
								<div class="status-legend">
									<div class="legend-item">
										<span class="pinned success">{@lightspeedto_odoo.status.completed}</span>
										<span>{@lightspeedto_odoo.status.completed.description}</span>
									</div>
									<div class="legend-item">
										<span class="pinned error">{@lightspeedto_odoo.status.error}</span>
										<span>{@lightspeedto_odoo.status.error.description}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			# ELSE #
				<div class="content-block">
					<div class="cell">
						<div class="cell-body align-center">
							<i class="fa fa-cogs fa-4x" aria-hidden="true"></i>
							<h3>{@lightspeedto_odoo.process.no_uploads}</h3>
							<p>{@lightspeedto_odoo.process.no_uploads.description}</p>
							<a href="{U_UPLOAD}" class="button submit">
								<i class="fa fa-upload" aria-hidden="true"></i> {@lightspeedto_odoo.upload.first}
							</a>
						</div>
					</div>
				</div>
			# ENDIF #
		# ENDIF #

		<!-- Conseils et informations -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.process.tips.title}</h2>
			<div class="cell">
				<div class="cell-body">
					<div class="message-helper bgc notice">
						<h4>{@lightspeedto_odoo.process.tips.performance.title}</h4>
						<ul>
							<li>{@lightspeedto_odoo.process.tips.performance.tip1}</li>
							<li>{@lightspeedto_odoo.process.tips.performance.tip2}</li>
							<li>{@lightspeedto_odoo.process.tips.performance.tip3}</li>
						</ul>
					</div>

					<div class="message-helper bgc success">
						<h4>{@lightspeedto_odoo.process.tips.monitoring.title}</h4>
						<ul>
							<li>{@lightspeedto_odoo.process.tips.monitoring.tip1}</li>
							<li>{@lightspeedto_odoo.process.tips.monitoring.tip2}</li>
							<li>{@lightspeedto_odoo.process.tips.monitoring.tip3}</li>
						</ul>
					</div>

					<div class="message-helper bgc warning">
						<h4>{@lightspeedto_odoo.process.tips.errors.title}</h4>
						<ul>
							<li>{@lightspeedto_odoo.process.tips.errors.tip1}</li>
							<li>{@lightspeedto_odoo.process.tips.errors.tip2}</li>
							<li>{@lightspeedto_odoo.process.tips.errors.tip3}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
function refreshUploadStatus(uploadId) {
	var row = document.querySelector('.upload-row[data-upload-id="' + uploadId + '"]');
	if (!row) return;

	var refreshButton = row.querySelector('.button.warning');
	if (refreshButton) {
		refreshButton.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
		refreshButton.disabled = true;
	}

	fetch(window.location.href, {
		method: 'GET',
		headers: {
			'X-Refresh-Upload': uploadId
		}
	})
	.then(response => response.text())
	.then(html => {
		// Extraire la ligne mise à jour
		var tempDiv = document.createElement('div');
		tempDiv.innerHTML = html;
		var newRow = tempDiv.querySelector('.upload-row[data-upload-id="' + uploadId + '"]');
		
		if (newRow) {
			row.innerHTML = newRow.innerHTML;
		}
	})
	.catch(error => {
		console.error('Erreur lors du rafraîchissement:', error);
	})
	.finally(() => {
		if (refreshButton) {
			refreshButton.innerHTML = '<i class="fa fa-refresh" aria-hidden="true"></i>';
			refreshButton.disabled = false;
		}
	});
}

// Auto-refresh pour les uploads en cours
document.addEventListener('DOMContentLoaded', function() {
	var processingUploads = document.querySelectorAll('.upload-row .pinned.warning');
	
	if (processingUploads.length > 0) {
		// Rafraîchir toutes les 30 secondes s'il y a des uploads en cours
		setInterval(function() {
			processingUploads.forEach(function(statusElement) {
				var row = statusElement.closest('.upload-row');
				if (row) {
					var uploadId = row.dataset.uploadId;
					refreshUploadStatus(uploadId);
				}
			});
		}, 30000); // 30 secondes
	}
});
//-->
</script>

<style>
.upload-row:hover {
	background-color: rgba(var(--main-rgb), 0.05);
}

.file-info {
	display: flex;
	align-items: center;
	gap: 0.5rem;
}

.file-info i {
	font-size: 1.5em;
	color: var(--success-color);
}

.progress-container {
	min-width: 120px;
}

.progressbar-container {
	margin-bottom: 0.25rem;
}

.progress-text {
	font-size: 0.875em;
	text-align: center;
}

.date-info {
	font-size: 0.875em;
}

.status-legend {
	display: flex;
	flex-direction: column;
	gap: 0.5rem;
}

.legend-item {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	font-size: 0.875em;
}

.controls {
	white-space: nowrap;
}

.controls .button {
	margin-right: 0.25rem;
}

@media (max-width: 768px) {
	.file-info {
		flex-direction: column;
		align-items: flex-start;
		gap: 0.25rem;
	}
	
	.progress-container {
		min-width: auto;
	}
	
	.controls {
		display: flex;
		flex-wrap: wrap;
		gap: 0.25rem;
	}
}
</style>