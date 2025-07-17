<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.module.title}</h1>
		<div class="controls align-right">
			# IF C_CAN_UPLOAD #
				<a href="{U_UPLOAD}" class="button submit">
					<i class="fa fa-upload" aria-hidden="true"></i> {@lightspeedto_odoo.upload.title}
				</a>
			# ENDIF #
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		<div class="content-block">
			<h2>{@lightspeedto_odoo.home.welcome}</h2>
			<p>{@lightspeedto_odoo.home.description}</p>
		</div>

		<!-- Statistiques générales -->
		<div class="cell-flex cell-columns-3 cell-tile">
			<div class="cell">
				<div class="cell-header">
					<h3>{@lightspeedto_odoo.stats.uploads}</h3>
				</div>
				<div class="cell-body">
					<div class="align-center">
						<span class="text-strong bigger">{TOTAL_UPLOADS}</span><br>
						<small>{@lightspeedto_odoo.stats.total_uploads}</small>
					</div>
					<div class="spacer"></div>
					<div class="cell-flex cell-columns-2">
						<div class="cell align-center">
							<span class="text-strong success">{COMPLETED_UPLOADS}</span><br>
							<small>{@lightspeedto_odoo.stats.completed}</small>
						</div>
						<div class="cell align-center">
							# IF ERROR_UPLOADS #
								<span class="text-strong error">{ERROR_UPLOADS}</span><br>
								<small>{@lightspeedto_odoo.stats.errors}</small>
							# ELSE #
								<span class="text-strong">{ERROR_UPLOADS}</span><br>
								<small>{@lightspeedto_odoo.stats.errors}</small>
							# ENDIF #
						</div>
					</div>
				</div>
			</div>

			<div class="cell">
				<div class="cell-header">
					<h3>{@lightspeedto_odoo.stats.processing}</h3>
				</div>
				<div class="cell-body">
					<div class="align-center">
						# IF PROCESSING_UPLOADS #
							<span class="text-strong warning">{PROCESSING_UPLOADS}</span><br>
							<small>{@lightspeedto_odoo.stats.in_progress}</small>
						# ELSE #
							<span class="text-strong">{PROCESSING_UPLOADS}</span><br>
							<small>{@lightspeedto_odoo.stats.in_progress}</small>
						# ENDIF #
					</div>
					<div class="spacer"></div>
					<div class="align-center">
						# IF PENDING_UPLOADS #
							<span class="text-strong notice">{PENDING_UPLOADS}</span><br>
							<small>{@lightspeedto_odoo.stats.pending}</small>
						# ELSE #
							<span class="text-strong">{PENDING_UPLOADS}</span><br>
							<small>{@lightspeedto_odoo.stats.pending}</small>
						# ENDIF #
					</div>
				</div>
			</div>

			<div class="cell">
				<div class="cell-header">
					<h3>{@lightspeedto_odoo.stats.data}</h3>
				</div>
				<div class="cell-body">
					<div class="align-center">
						<span class="text-strong bigger">{TOTAL_PROCESSED_ROWS}</span><br>
						<small>{@lightspeedto_odoo.stats.processed_rows}</small>
					</div>
					<div class="spacer"></div>
					<div class="align-center">
						<span class="text-strong">{TOTAL_MAPPINGS}</span><br>
						<small>{@lightspeedto_odoo.stats.mappings}</small>
					</div>
				</div>
			</div>
		</div>

		<!-- Actions rapides -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.home.quick_actions}</h2>
			<div class="cell-flex cell-columns-2 cell-tile">
				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.upload.title}</h3>
					</div>
					<div class="cell-body">
						<p>{@lightspeedto_odoo.upload.description}</p>
						# IF C_CAN_UPLOAD #
							<div class="align-center">
								<a href="{U_UPLOAD}" class="button submit">
									<i class="fa fa-upload" aria-hidden="true"></i> {@lightspeedto_odoo.upload.start}
								</a>
							</div>
						# ELSE #
							<div class="message-helper bgc warning">
								{@lightspeedto_odoo.upload.no_permission}
							</div>
						# ENDIF #
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{@lightspeedto_odoo.mappings.title}</h3>
					</div>
					<div class="cell-body">
						<p>{@lightspeedto_odoo.mappings.description}</p>
						<div class="align-center">
							<a href="{U_MAPPINGS}" class="button">
								<i class="fa fa-cogs" aria-hidden="true"></i> {@lightspeedto_odoo.mappings.manage}
							</a>
							# IF C_CAN_ADD_MAPPING #
								<a href="{U_ADD_MAPPING}" class="button submit">
									<i class="fa fa-plus" aria-hidden="true"></i> {@lightspeedto_odoo.mapping.add}
								</a>
							# ENDIF #
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- État de la configuration Odoo -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.home.odoo_status}</h2>
			<div class="cell">
				<div class="cell-body">
					# IF C_ODOO_CONFIGURED #
						<div class="message-helper bgc success">
							<i class="fa fa-check" aria-hidden="true"></i> {@lightspeedto_odoo.config.odoo.configured}
							# IF C_CONNECTION_TESTED #
								<br><small>{@lightspeedto_odoo.config.odoo.last_test}: {LAST_TEST_DATE}</small>
							# ENDIF #
						</div>
						# IF C_CAN_ADMIN #
							<div class="align-center">
								<a href="{U_TEST_CONNECTION}" class="button" onclick="testOdooConnection(); return false;">
									<i class="fa fa-plug" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_connection}
								</a>
								<a href="{U_ADMIN_CONFIG}" class="button">
									<i class="fa fa-cog" aria-hidden="true"></i> {@form.configuration}
								</a>
							</div>
						# ENDIF #
					# ELSE #
						<div class="message-helper bgc warning">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {@lightspeedto_odoo.config.odoo.not_configured}
						</div>
						# IF C_CAN_ADMIN #
							<div class="align-center">
								<a href="{U_ADMIN_CONFIG}" class="button submit">
									<i class="fa fa-cog" aria-hidden="true"></i> {@lightspeedto_odoo.config.configure_now}
								</a>
							</div>
						# ENDIF #
					# ENDIF #
				</div>
			</div>
		</div>

		<!-- Uploads récents -->
		# IF C_RECENT_UPLOADS #
			<div class="content-block">
				<h2>{@lightspeedto_odoo.home.recent_uploads}</h2>
				<div class="responsive-table">
					<table class="table">
						<thead>
							<tr>
								<th>{@common.file}</th>
								<th>{@lightspeedto_odoo.upload.mapping}</th>
								<th>{@common.status}</th>
								<th>{@lightspeedto_odoo.upload.progress}</th>
								<th>{@common.date}</th>
								<th>{@common.actions}</th>
							</tr>
						</thead>
						<tbody>
							# START recent_uploads #
								<tr>
									<td>
										<i class="fa fa-file-csv" aria-hidden="true"></i>
										{recent_uploads.FILENAME}
									</td>
									<td>
										# IF recent_uploads.C_HAS_MAPPING #
											{recent_uploads.MAPPING_NAME}
										# ELSE #
											<em>{@lightspeedto_odoo.mapping.none}</em>
										# ENDIF #
									</td>
									<td>
										<span class="pinned {recent_uploads.STATUS_CLASS}">
											{recent_uploads.STATUS_LABEL}
										</span>
									</td>
									<td>
										# IF recent_uploads.TOTAL_ROWS #
											<div class="progressbar-container">
												<div class="progressbar">
													<div class="progressbar-value" style="width: {recent_uploads.PROGRESS_PERCENT}%"></div>
												</div>
												<small>{recent_uploads.PROCESSED_ROWS}/{recent_uploads.TOTAL_ROWS}</small>
											</div>
										# ELSE #
											-
										# ENDIF #
									</td>
									<td>{recent_uploads.UPLOAD_DATE}</td>
									<td>
										<a href="{recent_uploads.U_DETAILS}" class="button small" title="{@common.see.details}">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
										# IF recent_uploads.C_CAN_PROCESS #
											<a href="{recent_uploads.U_PROCESS}" class="button small submit" title="{@lightspeedto_odoo.process.start}">
												<i class="fa fa-play" aria-hidden="true"></i>
											</a>
										# ENDIF #
									</td>
								</tr>
							# END recent_uploads #
						</tbody>
					</table>
				</div>
				<div class="align-center">
					<a href="{U_ALL_UPLOADS}" class="button">
						{@lightspeedto_odoo.process.view_all}
					</a>
				</div>
			</div>
		# ENDIF #

		<!-- Guide de démarrage -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.home.getting_started}</h2>
			<div class="cell">
				<div class="cell-body">
					<ol>
						<li>
							<strong>{@lightspeedto_odoo.guide.step1}:</strong> 
							{@lightspeedto_odoo.guide.step1.description}
							# IF C_CAN_ADMIN #
								<a href="{U_ADMIN_CONFIG}" class="small-button">
									{@lightspeedto_odoo.guide.configure}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{@lightspeedto_odoo.guide.step2}:</strong> 
							{@lightspeedto_odoo.guide.step2.description}
							# IF C_CAN_ADD_MAPPING #
								<a href="{U_ADD_MAPPING}" class="small-button">
									{@lightspeedto_odoo.guide.create_mapping}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{@lightspeedto_odoo.guide.step3}:</strong> 
							{@lightspeedto_odoo.guide.step3.description}
							# IF C_CAN_UPLOAD #
								<a href="{U_UPLOAD}" class="small-button">
									{@lightspeedto_odoo.guide.upload_csv}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{@lightspeedto_odoo.guide.step4}:</strong> 
							{@lightspeedto_odoo.guide.step4.description}
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
function testOdooConnection() {
	var button = document.querySelector('a[onclick*="testOdooConnection"]');
	var originalText = button.innerHTML;
	
	button.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> {@lightspeedto_odoo.config.testing}';
	button.classList.add('disabled');
	
	fetch('{U_TEST_CONNECTION}', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		}
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			button.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_success}';
			button.classList.remove('disabled');
			button.classList.add('success');
		} else {
			button.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_error}';
			button.classList.remove('disabled');
			button.classList.add('error');
			alert('{@lightspeedto_odoo.config.test_error}: ' + (data.message || '{@lightspeedto_odoo.config.unknown_error}'));
		}
		
		setTimeout(() => {
			button.innerHTML = originalText;
			button.classList.remove('success', 'error');
		}, 3000);
	})
	.catch(error => {
		button.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i> {@lightspeedto_odoo.config.test_error}';
		button.classList.remove('disabled');
		button.classList.add('error');
		alert('{@lightspeedto_odoo.config.connection_error}: ' + error.message);
		
		setTimeout(() => {
			button.innerHTML = originalText;
			button.classList.remove('error');
		}, 3000);
	});
}
//-->
</script>