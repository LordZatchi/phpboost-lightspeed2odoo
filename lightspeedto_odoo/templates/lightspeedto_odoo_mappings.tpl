<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.mappings.management}</h1>
		<div class="controls align-right">
			# IF C_CAN_ADD #
				<a href="{U_ADD_MAPPING}" class="button submit">
					<i class="fa fa-plus" aria-hidden="true"></i> {@lightspeedto_odoo.mapping.add}
				</a>
			# ENDIF #
			<a href="{U_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {@lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		# IF C_MAPPINGS #
			<div class="content-block">
				<h2>{@lightspeedto_odoo.mappings.list} ({TOTAL_MAPPINGS})</h2>
				<div class="responsive-table">
					<table class="table">
						<thead>
							<tr>
								<th>{@common.name}</th>
								<th>{@common.description}</th>
								<th>{@lightspeedto_odoo.mapping.fields_count}</th>
								<th>{@common.author}</th>
								<th>{@lightspeedto_odoo.mapping.created_date}</th>
								<th>{@lightspeedto_odoo.mapping.updated_date}</th>
								<th>{@common.actions}</th>
							</tr>
						</thead>
						<tbody>
							# START mappings #
								<tr# IF mappings.C_IS_DEFAULT # class="bgc success"# ENDIF #>
									<td>
										<strong>{mappings.NAME}</strong>
										# IF mappings.C_IS_DEFAULT #
											<span class="pinned success small">{@lightspeedto_odoo.mapping.default}</span>
										# ENDIF #
									</td>
									<td>
										# IF mappings.C_HAS_DESCRIPTION #
											{mappings.DESCRIPTION}
										# ELSE #
											<em>{@common.no.description}</em>
										# ENDIF #
									</td>
									<td>
										<span class="pinned notice">{mappings.FIELDS_COUNT}</span>
									</td>
									<td>
										# IF mappings.C_AUTHOR_EXISTS #
											# IF mappings.C_AUTHOR_GROUP_COLOR #
												<span style="color: {mappings.AUTHOR_GROUP_COLOR}">
											# ENDIF #
											<a href="{mappings.U_AUTHOR_PROFILE}" class="{mappings.AUTHOR_LEVEL_CLASS}">{mappings.AUTHOR_DISPLAY_NAME}</a>
											# IF mappings.C_AUTHOR_GROUP_COLOR #
												</span>
											# ENDIF #
										# ELSE #
											{@user.guest}
										# ENDIF #
									</td>
									<td>{mappings.CREATED_DATE}</td>
									<td>{mappings.UPDATED_DATE}</td>
									<td>
										<div class="controls">
											# IF mappings.C_CAN_EDIT #
												<a href="{mappings.U_EDIT}" class="button small" title="{@common.edit}">
													<i class="fa fa-edit" aria-hidden="true"></i>
												</a>
											# ENDIF #
											# IF mappings.C_CAN_DELETE #
												<a href="{mappings.U_DELETE}" class="button small bgc error" title="{@common.delete}" data-confirmation="delete-element">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											# ENDIF #
										</div>
									</td>
								</tr>
							# END mappings #
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
						<i class="fa fa-cogs fa-4x" aria-hidden="true"></i>
						<h3>{@lightspeedto_odoo.mappings.none}</h3>
						<p>{@lightspeedto_odoo.mappings.none.description}</p>
						# IF C_CAN_ADD #
							<a href="{U_ADD_MAPPING}" class="button submit">
								<i class="fa fa-plus" aria-hidden="true"></i> {@lightspeedto_odoo.mapping.create_first}
							</a>
						# ENDIF #
					</div>
				</div>
			</div>
		# ENDIF #

		<!-- Informations sur les mappings -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.mappings.info.title}</h2>
			<div class="cell">
				<div class="cell-body">
					<h3>{@lightspeedto_odoo.mappings.info.what_is}</h3>
					<p>{@lightspeedto_odoo.mappings.info.description}</p>

					<h3>{@lightspeedto_odoo.mappings.info.default}</h3>
					<p>{@lightspeedto_odoo.mappings.info.default.description}</p>

					<h3>{@lightspeedto_odoo.mappings.info.transformations}</h3>
					<p>{@lightspeedto_odoo.mappings.info.transformations.description}</p>
					<div class="responsive-table">
						<table class="table">
							<thead>
								<tr>
									<th>{@lightspeedto_odoo.transformation.name}</th>
									<th>{@lightspeedto_odoo.transformation.description}</th>
									<th>{@lightspeedto_odoo.transformation.example}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><code>uppercase</code></td>
									<td>{@lightspeedto_odoo.transformation.uppercase}</td>
									<td>"produit" → "PRODUIT"</td>
								</tr>
								<tr>
									<td><code>lowercase</code></td>
									<td>{@lightspeedto_odoo.transformation.lowercase}</td>
									<td>"PRODUIT" → "produit"</td>
								</tr>
								<tr>
									<td><code>trim</code></td>
									<td>{@lightspeedto_odoo.transformation.trim}</td>
									<td>" produit " → "produit"</td>
								</tr>
								<tr>
									<td><code>float</code></td>
									<td>{@lightspeedto_odoo.transformation.float}</td>
									<td>"29.99" → 29.99</td>
								</tr>
								<tr>
									<td><code>int</code></td>
									<td>{@lightspeedto_odoo.transformation.int}</td>
									<td>"100" → 100</td>
								</tr>
								<tr>
									<td><code>bool</code></td>
									<td>{@lightspeedto_odoo.transformation.bool}</td>
									<td>"true" → true</td>
								</tr>
								<tr>
									<td><code>{value} EUR</code></td>
									<td>{@lightspeedto_odoo.transformation.custom}</td>
									<td>"29.99" → "29.99 EUR"</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Guide de création de mapping -->
		<div class="content-block">
			<h2>{@lightspeedto_odoo.mappings.guide.title}</h2>
			<div class="cell">
				<div class="cell-body">
					<ol>
						<li>
							<strong>{@lightspeedto_odoo.mappings.guide.step1}:</strong>
							{@lightspeedto_odoo.mappings.guide.step1.description}
						</li>
						<li>
							<strong>{@lightspeedto_odoo.mappings.guide.step2}:</strong>
							{@lightspeedto_odoo.mappings.guide.step2.description}
						</li>
						<li>
							<strong>{@lightspeedto_odoo.mappings.guide.step3}:</strong>
							{@lightspeedto_odoo.mappings.guide.step3.description}
						</li>
						<li>
							<strong>{@lightspeedto_odoo.mappings.guide.step4}:</strong>
							{@lightspeedto_odoo.mappings.guide.step4.description}
						</li>
						<li>
							<strong>{@lightspeedto_odoo.mappings.guide.step5}:</strong>
							{@lightspeedto_odoo.mappings.guide.step5.description}
						</li>
					</ol>

					<div class="message-helper bgc notice">
						<h4>{@lightspeedto_odoo.mappings.guide.tips.title}</h4>
						<ul>
							<li>{@lightspeedto_odoo.mappings.guide.tips.tip1}</li>
							<li>{@lightspeedto_odoo.mappings.guide.tips.tip2}</li>
							<li>{@lightspeedto_odoo.mappings.guide.tips.tip3}</li>
							<li>{@lightspeedto_odoo.mappings.guide.tips.tip4}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	// Confirmation de suppression
	var deleteLinks = document.querySelectorAll('a[data-confirmation="delete-element"]');
	deleteLinks.forEach(function(link) {
		link.addEventListener('click', function(e) {
			if (!confirm('{@lightspeedto_odoo.mapping.delete.confirmation.simple}')) {
				e.preventDefault();
				return false;
			}
		});
	});
});
//-->
</script>