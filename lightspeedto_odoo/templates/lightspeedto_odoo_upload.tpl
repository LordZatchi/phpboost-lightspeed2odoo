<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.upload.title}</h1>
		<div class="controls align-right">
			<a href="{U_MAPPINGS}" class="button">
				<i class="fa fa-cogs" aria-hidden="true"></i> {lightspeedto_odoo.mappings.management}
			</a>
			<a href="{U_HOME}" class="button">
				<i class="fa fa-home" aria-hidden="true"></i> {lightspeedto_odoo.home.title}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		# IF C_CAN_UPLOAD #
			<!-- Formulaire d'upload -->
			<div class="content-block">
				<h2>{lightspeedto_odoo.upload.form.title}</h2>
				{UPLOAD_FORM}
			</div>

			<!-- Instructions -->
			<div class="content-block">
				<h2>{lightspeedto_odoo.upload.instructions.title}</h2>
				<div class="cell">
					<div class="cell-body">
						<h3>{lightspeedto_odoo.upload.csv_format}</h3>
						<p>{lightspeedto_odoo.upload.csv_format.description}</p>
						<ul>
							<li>{lightspeedto_odoo.upload.csv_format.encoding}</li>
							<li>{lightspeedto_odoo.upload.csv_format.separator}</li>
							<li>{lightspeedto_odoo.upload.csv_format.headers}</li>
							<li>{lightspeedto_odoo.upload.csv_format.size}</li>
						</ul>

						<h3>{lightspeedto_odoo.upload.supported_fields}</h3>
						<p>{lightspeedto_odoo.upload.supported_fields.description}</p>
						<div class="cell-flex cell-columns-2">
							<div class="cell">
								<h4>Lightspeed (Série K)</h4>
								<div class="responsive-table">
									<table class="table">
										<thead>
											<tr>
												<th>{lightspeedto_odoo.field.name}</th>
												<th>{lightspeedto_odoo.field.description}</th>
											</tr>
										</thead>
										<tbody>
											<tr><td><code>sku</code></td><td>{lightspeedto_odoo.field.sku}</td></tr>
											<tr><td><code>title</code></td><td>{lightspeedto_odoo.field.title}</td></tr>
											<tr><td><code>barcode</code></td><td>{lightspeedto_odoo.field.barcode}</td></tr>
											<tr><td><code>price</code></td><td>{lightspeedto_odoo.field.price}</td></tr>
											<tr><td><code>cost_per_item</code></td><td>{lightspeedto_odoo.field.cost}</td></tr>
											<tr><td><code>inventory_quantity</code></td><td>{lightspeedto_odoo.field.quantity}</td></tr>
											<tr><td><code>weight</code></td><td>{lightspeedto_odoo.field.weight}</td></tr>
											<tr><td><code>vendor</code></td><td>{lightspeedto_odoo.field.vendor}</td></tr>
											<tr><td><code>type</code></td><td>{lightspeedto_odoo.field.category}</td></tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="cell">
								<h4>Odoo POS</h4>
								<div class="responsive-table">
									<table class="table">
										<thead>
											<tr>
												<th>{lightspeedto_odoo.field.name}</th>
												<th>{lightspeedto_odoo.field.description}</th>
											</tr>
										</thead>
										<tbody>
											<tr><td><code>default_code</code></td><td>{lightspeedto_odoo.field.internal_ref}</td></tr>
											<tr><td><code>name</code></td><td>{lightspeedto_odoo.field.product_name}</td></tr>
											<tr><td><code>barcode</code></td><td>{lightspeedto_odoo.field.barcode}</td></tr>
											<tr><td><code>list_price</code></td><td>{lightspeedto_odoo.field.sale_price}</td></tr>
											<tr><td><code>standard_price</code></td><td>{lightspeedto_odoo.field.cost_price}</td></tr>
											<tr><td><code>qty_available</code></td><td>{lightspeedto_odoo.field.stock_qty}</td></tr>
											<tr><td><code>weight</code></td><td>{lightspeedto_odoo.field.weight}</td></tr>
											<tr><td><code>categ_id</code></td><td>{lightspeedto_odoo.field.category}</td></tr>
											<tr><td><code>available_in_pos</code></td><td>{lightspeedto_odoo.field.pos_available}</td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<h3>{lightspeedto_odoo.upload.process.title}</h3>
						<p>{lightspeedto_odoo.upload.process.description}</p>
						<ol>
							<li>{lightspeedto_odoo.upload.process.step1}</li>
							<li>{lightspeedto_odoo.upload.process.step2}</li>
							<li>{lightspeedto_odoo.upload.process.step3}</li>
							<li>{lightspeedto_odoo.upload.process.step4}</li>
							<li>{lightspeedto_odoo.upload.process.step5}</li>
						</ol>
					</div>
				</div>
			</div>

			<!-- Exemples de CSV -->
			<div class="content-block">
				<h2>{lightspeedto_odoo.upload.examples.title}</h2>
				<div class="cell">
					<div class="cell-body">
						<h3>{lightspeedto_odoo.upload.examples.lightspeed}</h3>
						<p>{lightspeedto_odoo.upload.examples.lightspeed.description}</p>
						<pre class="language-csv"><code>sku,title,barcode,price,cost_per_item,inventory_quantity,weight,vendor,type
PROD001,"Produit Test 1",1234567890123,29.99,15.50,100,0.5,"Fournisseur A","Électronique"
PROD002,"Produit Test 2",1234567890124,49.99,25.00,50,1.2,"Fournisseur B","Accessoires"</code></pre>

						<h3>{lightspeedto_odoo.upload.examples.mapping}</h3>
						<p>{lightspeedto_odoo.upload.examples.mapping.description}</p>
						<div class="responsive-table">
							<table class="table">
								<thead>
									<tr>
										<th>{lightspeedto_odoo.mapping.lightspeed_field}</th>
										<th>{lightspeedto_odoo.mapping.odoo_field}</th>
										<th>{lightspeedto_odoo.mapping.transformation}</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><code>sku</code></td>
										<td><code>default_code</code></td>
										<td>-</td>
									</tr>
									<tr>
										<td><code>title</code></td>
										<td><code>name</code></td>
										<td>-</td>
									</tr>
									<tr>
										<td><code>barcode</code></td>
										<td><code>barcode</code></td>
										<td>-</td>
									</tr>
									<tr>
										<td><code>price</code></td>
										<td><code>list_price</code></td>
										<td><code>float</code></td>
									</tr>
									<tr>
										<td><code>cost_per_item</code></td>
										<td><code>standard_price</code></td>
										<td><code>float</code></td>
									</tr>
									<tr>
										<td><code>inventory_quantity</code></td>
										<td><code>qty_available</code></td>
										<td><code>int</code></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		# ELSE #
			<div class="message-helper bgc error">
				{lightspeedto_odoo.upload.no_permission}
			</div>
		# ENDIF #
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	// Validation du formulaire d'upload
	var uploadForm = document.querySelector('form[enctype="multipart/form-data"]');
	if (uploadForm) {
		uploadForm.addEventListener('submit', function(e) {
			var fileInput = uploadForm.querySelector('input[type="file"]');
			var mappingSelect = uploadForm.querySelector('select[name*="mapping"]');
			
			if (!fileInput || !fileInput.files.length) {
				e.preventDefault();
				alert('{lightspeedto_odoo.upload.error.no_file}');
				return false;
			}
			
			var file = fileInput.files[0];
			
			// Vérification de l'extension
			var allowedExtensions = ['csv'];
			var fileName = file.name.toLowerCase();
			var fileExtension = fileName.split('.').pop();
			
			if (!allowedExtensions.includes(fileExtension)) {
				e.preventDefault();
				alert('{lightspeedto_odoo.upload.error.invalid_extension}');
				return false;
			}
			
			// Vérification de la taille
			var maxSize = 10 * 1024 * 1024; // 10MB
			if (file.size > maxSize) {
				e.preventDefault();
				alert('{lightspeedto_odoo.upload.error.file_too_large}');
				return false;
			}
			
			// Affichage d'un indicateur de progression
			var submitButton = uploadForm.querySelector('button[type="submit"]');
			if (submitButton) {
				submitButton.disabled = true;
				submitButton.innerHTML = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> {lightspeedto_odoo.upload.uploading}';
			}
		});
	}

	// Prévisualisation du fichier sélectionné
	var fileInput = document.querySelector('input[type="file"]');
	if (fileInput) {
		fileInput.addEventListener('change', function(e) {
			var file = e.target.files[0];
			if (file) {
				var fileInfo = document.getElementById('file-info');
				if (fileInfo) {
					fileInfo.innerHTML = '<strong>' + file.name + '</strong> (' + formatFileSize(file.size) + ')';
					fileInfo.style.display = 'block';
				}
			}
		});
	}

	function formatFileSize(bytes) {
		if (bytes === 0) return '0 Bytes';
		var k = 1024;
		var sizes = ['Bytes', 'KB', 'MB', 'GB'];
		var i = Math.floor(Math.log(bytes) / Math.log(k));
		return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
	}
});
//-->
</script>