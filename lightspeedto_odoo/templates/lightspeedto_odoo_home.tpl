<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.home.title}</h1>
		<div class="controls align-right">
			# IF C_CAN_UPLOAD #
				<a href="{U_UPLOAD}" class="button submit">
					<i class="fa fa-upload" aria-hidden="true"></i> {lightspeedto_odoo.upload.new}
				</a>
			# ENDIF #
			# IF C_CAN_ADMIN #
				<a href="{U_ADMIN_CONFIG}" class="button">
					<i class="fa fa-cog" aria-hidden="true"></i> {lightspeedto_odoo.config.title}
				</a>
			# ENDIF #
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		<!-- Statistiques générales -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.home.statistics}</h2>
			<div class="cell-flex cell-columns-3 cell-tile">
				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.stats.uploads}</h3>
					</div>
					<div class="cell-body">
						<div class="align-center">
							<span class="text-strong bigger">{TOTAL_UPLOADS}</span><br>
							<small>{lightspeedto_odoo.stats.total_uploads}</small>
						</div>
						<div class="spacer"></div>
						<div class="align-center">
							# IF PENDING_UPLOADS #
								<span class="text-strong notice">{PENDING_UPLOADS}</span><br>
								<small>{lightspeedto_odoo.stats.pending}</small>
							# ELSE #
								<span class="text-strong">{PENDING_UPLOADS}</span><br>
								<small>{lightspeedto_odoo.stats.pending}</small>
							# ENDIF #
						</div>
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.stats.data}</h3>
					</div>
					<div class="cell-body">
						<div class="align-center">
							<span class="text-strong bigger">{TOTAL_PROCESSED_ROWS}</span><br>
							<small>{lightspeedto_odoo.stats.processed_rows}</small>
						</div>
						<div class="spacer"></div>
						<div class="align-center">
							<span class="text-strong">{TOTAL_MAPPINGS}</span><br>
							<small>{lightspeedto_odoo.stats.mappings}</small>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Actions rapides -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.home.quick_actions}</h2>
			<div class="cell-flex cell-columns-2 cell-tile">
				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.upload.title}</h3>
					</div>
					<div class="cell-body">
						<p>{lightspeedto_odoo.upload.description}</p>
						# IF C_CAN_UPLOAD #
							<div class="align-center">
								<a href="{U_UPLOAD}" class="button submit">
									<i class="fa fa-upload" aria-hidden="true"></i> {lightspeedto_odoo.upload.start}
								</a>
							</div>
						# ELSE #
							<div class="message-helper bgc warning">
								{lightspeedto_odoo.upload.no_permission}
							</div>
						# ENDIF #
					</div>
				</div>

				<div class="cell">
					<div class="cell-header">
						<h3>{lightspeedto_odoo.mappings.title}</h3>
					</div>
					<div class="cell-body">
						<p>{lightspeedto_odoo.mappings.description}</p>
						<div class="align-center">
							<a href="{U_MAPPINGS}" class="button">
								<i class="fa fa-cogs" aria-hidden="true"></i> {lightspeedto_odoo.mappings.manage}
							</a>
							# IF C_CAN_ADD_MAPPING #
								<a href="{U_ADD_MAPPING}" class="button submit">
									<i class="fa fa-plus" aria-hidden="true"></i> {lightspeedto_odoo.mapping.add}
								</a>
							# ENDIF #
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Uploads récents -->
		# IF C_RECENT_UPLOADS #
			<div class="content-block">
				<h2>{lightspeedto_odoo.home.recent_uploads}</h2>
				<div class="responsive-table">
					<table class="table">
						<thead>
							<tr>
								<th>{common.file}</th>
								<th>{lightspeedto_odoo.upload.mapping}</th>
								<th>{common.status}</th>
								<th>{lightspeedto_odoo.upload.progress}</th>
								<th>{lightspeedto_odoo.upload.date}</th>
								<th>{common.actions}</th>
							</tr>
						</thead>
						<tbody>
							# START recent_uploads #
								<tr>
									<td>
										<div class="file-info">
											<i class="fa fa-file-csv" aria-hidden="true"></i>
											{recent_uploads.FILENAME}
										</div>
									</td>
									<td>
										# IF recent_uploads.C_HAS_MAPPING #
											{recent_uploads.MAPPING_NAME}
										# ELSE #
											<em>{lightspeedto_odoo.mapping.none}</em>
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
										<a href="{recent_uploads.U_DETAILS}" class="button small" title="{common.see.details}">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
										# IF recent_uploads.C_CAN_PROCESS #
											<a href="{recent_uploads.U_PROCESS}" class="button small submit" title="{lightspeedto_odoo.process.start}">
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
						{lightspeedto_odoo.process.view_all}
					</a>
				</div>
			</div>
		# ENDIF #

		<!-- Guide de démarrage -->
		<div class="content-block">
			<h2>{lightspeedto_odoo.home.getting_started}</h2>
			<div class="cell">
				<div class="cell-body">
					<ol>
						<li>
							<strong>{lightspeedto_odoo.guide.step1}:</strong> 
							{lightspeedto_odoo.guide.step1.description}
							# IF C_CAN_ADMIN #
								<a href="{U_ADMIN_CONFIG}" class="small-button">
									{lightspeedto_odoo.guide.configure}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{lightspeedto_odoo.guide.step2}:</strong> 
							{lightspeedto_odoo.guide.step2.description}
							# IF C_CAN_ADD_MAPPING #
								<a href="{U_ADD_MAPPING}" class="small-button">
									{lightspeedto_odoo.guide.create_mapping}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{lightspeedto_odoo.guide.step3}:</strong> 
							{lightspeedto_odoo.guide.step3.description}
							# IF C_CAN_UPLOAD #
								<a href="{U_UPLOAD}" class="small-button">
									{lightspeedto_odoo.guide.upload_file}
								</a>
							# ENDIF #
						</li>
						<li>
							<strong>{lightspeedto_odoo.guide.step4}:</strong> 
							{lightspeedto_odoo.guide.step4.description}
						</li>
					</ol>

					<div class="message-helper bgc notice">
						<h4>{lightspeedto_odoo.home.help.title}</h4>
						<p>{lightspeedto_odoo.home.help.description}</p>
						<ul>
							<li><a href="{U_MAPPINGS}">{lightspeedto_odoo.home.help.mappings}</a></li>
							<li><a href="{U_UPLOAD}">{lightspeedto_odoo.home.help.upload}</a></li>
							<li><a href="{U_PROCESS}">{lightspeedto_odoo.home.help.process}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>