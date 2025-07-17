<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.process.details} - {FILENAME}</h1>
		<div class="controls align-right">
			# IF C_CAN_PROCESS #
				<a href="{U_PROCESS}" class="button submit">
					<i class="fa fa-play" aria-hidden="true"></i> {lightspeedto_odoo.process.start}
				</a>
			# ENDIF #
			<a href="{U_BACK}" class="button">
				<i class="fa fa-list" aria-hidden="true"></i> {lightspeedto_odoo.process.back_to_list}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		<!-- Informations générales -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.upload.information}</h2>
			<div class="cell-flex cell-columns-2 cell-tile">
				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.upload.file_info}</h3>
					</div>
					<div class="cell-body">
						<dl class="field-list">
							<dt>{common.file}:</dt>
							<dd>
								<i class="fa fa-file-csv" aria-hidden="true"></i>
								{FILENAME}
							</dd>
							
							<dt>{lightspeedto_odoo.upload.file_size}:</dt>
							<dd>{FILE_SIZE} KB</dd>
							
							<dt>{lightspeedto_odoo.upload.date}:</dt>
							<dd>{UPLOAD_DATE}</dd>
							
							<dt>{common.author}:</dt>
							<dd>
								# IF AUTHOR_DISPLAY_NAME #
									<a href="{U_AUTHOR_PROFILE}">{AUTHOR_DISPLAY_NAME}</a>
								# ELSE #
									{user.guest}
								# ENDIF #
							</dd>
						</dl>
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.process.status_info}</h3>
					</div>
					<div class="cell-body">
						<dl class="field-list">
							<dt>{common.status}:</dt>
							<dd>
								<span class="pinned {STATUS_CSS_CLASS}">
									# IF C_IS_PROCESSING #
										<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
									# ENDIF #
									{STATUS_LABEL}
								</span>
							</dd>
							
							<dt>{lightspeedto_odoo.upload.mapping}:</dt>
							<dd>
								# IF C_HAS_MAPPING #
									<span class="pinned notice">{MAPPING_NAME}</span>
								# ELSE #
									<em>{lightspeedto_odoo.mapping.none}</em>
								# ENDIF #
							</dd>
							
							# IF C_PROCESSED_DATE #
								<dt>{lightspeedto_odoo.process.processed_date}:</dt>
								<dd>{PROCESSED_DATE}</dd>
							# ENDIF #
						</dl>
					</div>
				</div>
			</div>
		</div>

		<!-- Progression et statistiques -->
		# IF TOTAL_ROWS #
			<div class="content-block">
				<h2>{lightspeedto_odoo.process.progress_stats}</h2>
				<div class="cell">
					<div class="cell-body">
						<!-- Barre de progression -->
						<div class="progress-container">
							<div class="progress-info">
								<span>{PROCESSED_ROWS} / {TOTAL_ROWS} {lightspeedto_odoo.process.rows_processed}</span>
								<span class="progress-percentage">{PROGRESS_PERCENT}%</span>
							</div>
							<div class="progressbar-container large">
								<div class="progressbar">
									<div class="progressbar-value" style="width: {PROGRESS_PERCENT}%"></div>
								</div>
							</div>
						</div>

						<!-- Statistiques détaillées -->
						<div class="stats-grid">
							<div class="stat-item">
								<div class="stat-icon success">
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</div>
								<div class="stat-content">
									<div class="stat-value">{PROCESSED_ROWS}</div>
									<div class="stat-label">{lightspeedto_odoo.process.rows_processed}</div>
								</div>
							</div>

							<div class="stat-item">
								<div class="stat-icon error">
									<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								</div>
								<div class="stat-content">
									<div class="stat-value">{ERROR_COUNT}</div>
									<div class="stat-label">{lightspeedto_odoo.process.errors}</div>
								</div>
							</div>

							<div class="stat-item">
								<div class="stat-icon notice">
									<i class="fa fa-percentage" aria-hidden="true"></i>
								</div>
								<div class="stat-content">
									<div class="stat-value">{SUCCESS_RATE}%</div>
									<div class="stat-label">{lightspeedto_odoo.process.success_rate}</div>
								</div>
							</div>

							# IF PROCESSING_TIME #
								<div class="stat-item">
									<div class="stat-icon">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
									</div>
									<div class="stat-content">
										<div class="stat-value">{PROCESSING_TIME}</div>
										<div class="stat-label">{lightspeedto_odoo.process.processing_time}</div>
									</div>
								</div>
							# ENDIF #
						</div>
					</div>
				</div>
			</div>
		# ENDIF #

		<!-- Journal des erreurs -->
		# IF C_HAS_ERRORS #
			<div class="content-block">
				<h2>{lightspeedto_odoo.process.errors_log} ({ERROR_COUNT})</h2>
				<div class="cell">
					<div class="cell-body">
						<div class="errors-container">
							# START errors #
								<div class="error-item">
									<div class="error-header">
										<span class="error-row">Ligne {errors.ROW}</span>
										<span class="error-timestamp">{errors.TIMESTAMP}</span>
									</div>
									<div class="error-message">{errors.MESSAGE}</div>
									# IF errors.DATA #
										<div class="error-data">
											<strong>{lightspeedto_odoo.process.error_data}:</strong>
											<pre><code>{errors.DATA}</code></pre>
										</div>
									# ENDIF #
								</div>
							# END errors #
						</div>

						# IF C_CAN_DOWNLOAD_ERRORS #
							<div class="align-center">
								<a href="{U_DOWNLOAD_ERRORS}" class="button">
									<i class="fa fa-download" aria-hidden="true"></i> {lightspeedto_odoo.process.download_errors_report}
								</a>
							</div>
						# ENDIF #
					</div>
				</div>
			</div>
		# ELSE #
			<div class="content-block">
				<div class="cell">
					<div class="cell-body align-center">
						<i class="fa fa-check-circle fa-4x text-success" aria-hidden="true"></i>
						<h3>{lightspeedto_odoo.process.no_errors}</h3>
						<p>{lightspeedto_odoo.process.no_errors.description}</p>
					</div>
				</div>
			</div>
		# ENDIF #
	</div>
</article>

<style>
.progress-container {
	margin-bottom: 2rem;
}

.progress-info {
	display: flex;
	justify-content: space-between;
	margin-bottom: 0.5rem;
	font-weight: bold;
}

.progress-percentage {
	color: var(--main-color);
}

.progressbar-container.large {
	height: 1rem;
}

.stats-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
	gap: 1rem;
	margin-top: 1rem;
}

.stat-item {
	display: flex;
	align-items: center;
	gap: 1rem;
	padding: 1rem;
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.5rem;
}

.stat-icon {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 3rem;
	height: 3rem;
	border-radius: 50%;
	background: rgba(var(--main-rgb), 0.1);
	color: var(--main-color);
	font-size: 1.25rem;
}

.stat-icon.success {
	background: rgba(var(--success-rgb), 0.1);
	color: var(--success-color);
}

.stat-icon.error {
	background: rgba(var(--error-rgb), 0.1);
	color: var(--error-color);
}

.stat-icon.notice {
	background: rgba(var(--notice-rgb), 0.1);
	color: var(--notice-color);
}

.stat-content {
	flex: 1;
}

.stat-value {
	font-size: 1.5rem;
	font-weight: bold;
	color: var(--main-color);
	margin-bottom: 0.25rem;
}

.stat-label {
	font-size: 0.875rem;
	color: #666;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

.errors-container {
	max-height: 400px;
	overflow-y: auto;
}

.error-item {
	border: 1px solid #dee2e6;
	border-radius: 0.5rem;
	margin-bottom: 1rem;
	background: #fff;
}

.error-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0.75rem 1rem;
	background: rgba(var(--error-rgb), 0.1);
	border-bottom: 1px solid #dee2e6;
}

.error-row {
	font-weight: bold;
	color: var(--error-color);
}

.error-timestamp {
	font-size: 0.875rem;
	color: #666;
}

.error-message {
	padding: 1rem;
	font-weight: 500;
}

.error-data {
	padding: 0 1rem 1rem;
}

.error-data pre {
	background: #f8f9fa;
	border: 1px solid #dee2e6;
	border-radius: 0.25rem;
	padding: 0.5rem;
	margin-top: 0.5rem;
	font-size: 0.875rem;
	overflow-x: auto;
}
</style>