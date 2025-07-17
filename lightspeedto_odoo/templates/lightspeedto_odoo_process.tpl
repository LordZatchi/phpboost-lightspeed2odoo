<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.process.title}</h1>
		<div class="controls align-right">
			<a href="{U_UPLOAD}" class="button submit">
				<i class="fa fa-upload" aria-hidden="true"></i> {lightspeedto_odoo.upload.new}
			</a>
			<a href="{U_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		# IF C_LIST_MODE #
			# IF C_UPLOADS #
				<div class="content-block">
					<h2>{lightspeedto_odoo.process.uploads_list} ({TOTAL_UPLOADS})</h2>
					<div class="responsive-table">
						<table class="table">
							<thead>
								<tr>
									<th>{common.file}</th>
									<th>{lightspeedto_odoo.upload.mapping}</th>
									<th>{common.status}</th>
									<th>{lightspeedto_odoo.upload.progress}</th>
									<th>{lightspeedto_odoo.upload.errors}</th>
									<th>{common.author}</th>
									<th>{lightspeedto_odoo.upload.date}</th>
									<th>{common.actions}</th>
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
												<em>{lightspeedto_odoo.mapping.none}</em>
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
												<div class="progressbar-container">
													<div class="progressbar">
														<div class="progressbar-value" style="width: {uploads.PROGRESS_PERCENT}%"></div>
													</div>
													<small>{uploads.PROCESSED_ROWS}/{uploads.TOTAL_ROWS}</small>
												</div>
											# ELSE #
												-
											# ENDIF #
										</td>
										<td>
											# IF uploads.ERROR_COUNT #
												<span class="pinned error">{uploads.ERROR_COUNT}</span>
											# ELSE #
												<span class="pinned success">0</span>
											# ENDIF #
										</td>
										<td>
											# IF uploads.C_AUTHOR_EXIST #
												<a href="{uploads.U_AUTHOR_PROFILE}">{uploads.AUTHOR_DISPLAY_NAME}</a>
											# ELSE #
												{user.guest}
											# ENDIF #
										</td>
										<td>{uploads.UPLOAD_DATE}</td>
										<td>
											<div class="controls">
												<a href="{uploads.U_DETAILS}" class="button small" title="{common.see.details}">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
												# IF uploads.C_CAN_PROCESS #
													<a href="{uploads.U_PROCESS}" class="button small submit" title="{lightspeedto_odoo.process.start}">
														<i class="fa fa-play" aria-hidden="true"></i>
													</a>
												# ENDIF #
												# IF uploads.C_CAN_RETRY #
													<a href="{uploads.U_RETRY}" class="button small notice" title="{lightspeedto_odoo.process.retry}">
														<i class="fa fa-refresh" aria-hidden="true"></i>
													</a>
												# ENDIF #
												# IF uploads.C_CAN_DELETE #
													<a href="{uploads.U_DELETE}" class="button small bgc error" title="{common.delete}" data-confirmation="delete-element">
														<i class="fa fa-trash" aria-hidden="true"></i>
													</a>
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
			# ELSE #
				<div class="content-block">
					<div class="cell">
						<div class="cell-body align-center">
							<i class="fa fa-list fa-4x" aria-hidden="true"></i>
							<h3>{lightspeedto_odoo.process.no_uploads}</h3>
							<p>{lightspeedto_odoo.process.no_uploads.description}</p>
							# IF C_CAN_UPLOAD #
								<a href="{U_UPLOAD}" class="button submit">
									<i class="fa fa-upload" aria-hidden="true"></i> {lightspeedto_odoo.upload.first}
								</a>
							# ENDIF #
						</div>
					</div>
				</div>
			# ENDIF #

			<!-- Filtres et statistiques -->
			<div class="content-block">
				<h2>{lightspeedto_odoo.process.filters_stats}</h2>
				<div class="cell-flex cell-columns-2">
					<div class="cell">
						<div class="cell-header">
							<h3>{lightspeedto_odoo.process.filters}</h3>
						</div>
						<div class="cell-body">
							<form method="get" action="{U_PROCESS}">
								<div class="form-element">
									<label for="status">{common.status}:</label>
									<select name="status" id="status" class="form-control">
										<option value="">{common.all}</option>
										<option value="pending" # IF FILTER_STATUS_PENDING # selected# ENDIF #>{lightspeedto_odoo.status.pending}</option>
										<option value="processing" # IF FILTER_STATUS_PROCESSING # selected# ENDIF #>{lightspeedto_odoo.status.processing}</option>
										<option value="completed" # IF FILTER_STATUS_COMPLETED # selected# ENDIF #>{lightspeedto_odoo.status.completed}</option>
										<option value="failed" # IF FILTER_STATUS_FAILED # selected# ENDIF #>{lightspeedto_odoo.status.failed}</option>
									</select>
								</div>
								<div class="form-element">
									<label for="mapping">{lightspeedto_odoo.upload.mapping}:</label>
									<select name="mapping" id="mapping" class="form-control">
										<option value="">{common.all}</option>
										# START filter_mappings #
											<option value="{filter_mappings.ID}" # IF filter_mappings.C_SELECTED # selected# ENDIF #>{filter_mappings.NAME}</option>
										# END filter_mappings #
									</select>
								</div>
								<div class="form-element">
									<button type="submit" class="button submit">{lightspeedto_odoo.process.filter}</button>
									<a href="{U_PROCESS}" class="button">{lightspeedto_odoo.process.reset_filter}</a>
								</div>
							</form>
						</div>
					</div>

					<div class="cell">
						<div class="cell-header">
							<h3>{lightspeedto_odoo.process.statistics}</h3>
						</div>
						<div class="cell-body">
							<dl class="field-list">
								<dt>{lightspeedto_odoo.stats.total_uploads}:</dt>
								<dd>{STATS_TOTAL_UPLOADS}</dd>
								
								<dt>{lightspeedto_odoo.stats.completed}:</dt>
								<dd>{STATS_COMPLETED_UPLOADS}</dd>
								
								<dt>{lightspeedto_odoo.stats.failed}:</dt>
								<dd>{STATS_FAILED_UPLOADS}</dd>
								
								<dt>{lightspeedto_odoo.stats.processed_rows}:</dt>
								<dd>{STATS_TOTAL_PROCESSED_ROWS}</dd>
								
								<dt>{lightspeedto_odoo.stats.success_rate}:</dt>
								<dd>{STATS_SUCCESS_RATE}%</dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		# ENDIF #
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	// Confirmation de suppression
	var deleteLinks = document.querySelectorAll('a[data-confirmation="delete-element"]');
	deleteLinks.forEach(function(link) {
		link.addEventListener('click', function(e) {
			if (!confirm('{lightspeedto_odoo.process.delete.confirmation}')) {
				e.preventDefault();
				return false;
			}
		});
	});

	// Auto-refresh pour les traitements en cours
	var processingRows = document.querySelectorAll('.upload-row .fa-spinner');
	if (processingRows.length > 0) {
		setTimeout(function() {
			window.location.reload();
		}, 5000); // Actualisation toutes les 5 secondes
	}
});
//-->
</script>