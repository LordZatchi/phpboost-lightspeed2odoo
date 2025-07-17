<div id="module-mini-lightspeedto_odoo" class="cell-mini# IF C_HIDDEN_WITH_SMALL_SCREENS # hidden-small-screens# ENDIF #">
	<div class="cell">
		<div class="cell-header">
			<h6 class="cell-name">
				<a href="{U_HOME}">
					<i class="fa fa-exchange" aria-hidden="true"></i>
					{lightspeedto_odoo.module.title}
				</a>
			</h6>
		</div>
		
		<div class="cell-body">
			<div class="cell-content">
				<!-- Statistiques rapides -->
				<div class="mini-stats">
					<div class="mini-stat-item">
						<div class="mini-stat-icon">
							<i class="fa fa-upload" aria-hidden="true"></i>
						</div>
						<div class="mini-stat-content">
							<div class="mini-stat-value">{TOTAL_UPLOADS}</div>
							<div class="mini-stat-label">{lightspeedto_odoo.mini.total_uploads}</div>
						</div>
					</div>

					<div class="mini-stat-item">
						<div class="mini-stat-icon success">
							<i class="fa fa-check-circle" aria-hidden="true"></i>
						</div>
						<div class="mini-stat-content">
							<div class="mini-stat-value">{COMPLETED_UPLOADS}</div>
							<div class="mini-stat-label">{lightspeedto_odoo.mini.completed}</div>
						</div>
					</div>

					<div class="mini-stat-item">
						<div class="mini-stat-icon notice">
							<i class="fa fa-database" aria-hidden="true"></i>
						</div>
						<div class="mini-stat-content">
							<div class="mini-stat-value">{TOTAL_PROCESSED_ROWS}</div>
							<div class="mini-stat-label">{lightspeedto_odoo.mini.processed_rows}</div>
						</div>
					</div>
				</div>

				<!-- Alertes -->
				<div class="mini-alerts">
					# IF C_HAS_PENDING #
						<div class="mini-alert warning">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<span>{PENDING_UPLOADS} {lightspeedto_odoo.mini.pending}</span>
						</div>
					# ENDIF #

					# IF C_HAS_PROCESSING #
						<div class="mini-alert processing">
							<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
							<span>{PROCESSING_UPLOADS} {lightspeedto_odoo.mini.processing}</span>
						</div>
					# ENDIF #
				</div>

				<!-- Actions rapides -->
				<div class="mini-actions">
					# IF C_CAN_UPLOAD #
						<a href="{U_UPLOAD}" class="mini-action upload">
							<i class="fa fa-upload" aria-hidden="true"></i>
							<span>{lightspeedto_odoo.mini.upload}</span>
						</a>
					# ENDIF #

					<a href="{U_MAPPINGS}" class="mini-action mappings">
						<i class="fa fa-cogs" aria-hidden="true"></i>
						<span>{lightspeedto_odoo.mini.mappings}</span>
					</a>

					<a href="{U_PROCESS}" class="mini-action process">
						<i class="fa fa-list" aria-hidden="true"></i>
						<span>{lightspeedto_odoo.mini.process}</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
#module-mini-lightspeedto_odoo {
	min-width: 250px;
}

.mini-stats {
	display: flex;
	flex-direction: column;
	gap: 0.5rem;
	margin-bottom: 1rem;
}

.mini-stat-item {
	display: flex;
	align-items: center;
	gap: 0.75rem;
	padding: 0.5rem;
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.25rem;
}

.mini-stat-icon {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 2rem;
	height: 2rem;
	border-radius: 50%;
	background: rgba(var(--main-rgb), 0.1);
	color: var(--main-color);
	font-size: 0.875rem;
}

.mini-stat-icon.success {
	background: rgba(var(--success-rgb), 0.1);
	color: var(--success-color);
}

.mini-stat-icon.notice {
	background: rgba(var(--notice-rgb), 0.1);
	color: var(--notice-color);
}

.mini-stat-content {
	flex: 1;
}

.mini-stat-value {
	font-weight: bold;
	font-size: 1.1rem;
	color: var(--main-color);
}

.mini-stat-label {
	font-size: 0.75rem;
	color: #666;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

.mini-alerts {
	display: flex;
	flex-direction: column;
	gap: 0.5rem;
	margin-bottom: 1rem;
}

.mini-alert {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	padding: 0.5rem;
	border-radius: 0.25rem;
	font-size: 0.875rem;
}

.mini-alert.warning {
	background: rgba(var(--warning-rgb), 0.1);
	color: var(--warning-color);
}

.mini-alert.processing {
	background: rgba(var(--notice-rgb), 0.1);
	color: var(--notice-color);
}

.mini-actions {
	display: flex;
	flex-direction: column;
	gap: 0.5rem;
}

.mini-action {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	padding: 0.5rem;
	text-decoration: none;
	color: var(--main-color);
	background: rgba(var(--main-rgb), 0.05);
	border-radius: 0.25rem;
	transition: background-color 0.2s ease;
}

.mini-action:hover {
	background: rgba(var(--main-rgb), 0.1);
	text-decoration: none;
}

.mini-action i {
	width: 1rem;
	text-align: center;
}

.mini-action span {
	flex: 1;
	font-size: 0.875rem;
}
</style>