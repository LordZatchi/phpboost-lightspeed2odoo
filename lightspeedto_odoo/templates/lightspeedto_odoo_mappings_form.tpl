<article class="content-container">
	<header class="section-header">
		<h1>{@lightspeedto_odoo.mapping.form.title}</h1>
		<div class="controls align-right">
			<a href="{U_MAPPINGS}" class="button">
				<i class="fa fa-list" aria-hidden="true"></i> {@lightspeedto_odoo.mappings.management}
			</a>
		</div>
	</header>

	# INCLUDE MESSAGE_HELPER #

	<div class="content">
		{FORM}
	</div>
</article>

<script>
<!--
document.addEventListener('DOMContentLoaded', function() {
	var mappingContainer = document.getElementById('mapping-container');
	var mappingRowsContainer = document.getElementById('mapping-rows');
	var addMappingButton = document.getElementById('add-mapping-row');
	var rowIndex = 0;

	// Compter les lignes existantes
	if (mappingRowsContainer) {
		rowIndex = mappingRowsContainer.querySelectorAll('.mapping-row').length;
	}

	// Ajouter une nouvelle ligne de mapping
	if (addMappingButton) {
		addMappingButton.addEventListener('click', function() {
			addMappingRow();
		});
	}

	// Gérer la suppression des lignes existantes
	setupRemoveButtons();

	function addMappingRow() {
		var newRow = document.createElement('tr');
		newRow.className = 'mapping-row';
		newRow.dataset.index = rowIndex;

		newRow.innerHTML = `
			<td>
				<select name="mapping[${rowIndex}][lightspeed_field]" class="form-control">
					<option value="">{@common.choose}</option>
					<option value="item_id">item_id</option>
					<option value="handle">handle</option>
					<option value="variant_id">variant_id</option>
					<option value="sku">sku</option>
					<option value="barcode">barcode</option>
					<option value="title">title</option>
					<option value="vendor">vendor</option>
					<option value="type">type</option>
					<option value="price">price</option>
					<option value="compare_at_price">compare_at_price</option>
					<option value="inventory_quantity">inventory_quantity</option>
					<option value="weight">weight</option>
					<option value="cost_per_item">cost_per_item</option>
					<option value="status">status</option>
				</select>
			</td>
			<td>
				<select name="mapping[${rowIndex}][odoo_field]" class="form-control">
					<option value="">{@common.choose}</option>
					<option value="name">name</option>
					<option value="default_code">default_code</option>
					<option value="barcode">barcode</option>
					<option value="categ_id">categ_id</option>
					<option value="list_price">list_price</option>
					<option value="standard_price">standard_price</option>
					<option value="type">type</option>
					<option value="weight">weight</option>
					<option value="active">active</option>
					<option value="available_in_pos">available_in_pos</option>
					<option value="to_weight">to_weight</option>
					<option value="pos_categ_id">pos_categ_id</option>
				</select>
			</td>
			<td>
				<input type="text" name="mapping[${rowIndex}][transformation]" class="form-control" placeholder="{@lightspeedto_odoo.mapping.transformation.placeholder}">
			</td>
			<td>
				<button type="button" class="button bgc error remove-mapping-row">{@common.delete}</button>
			</td>
		`;

		mappingRowsContainer.appendChild(newRow);
		rowIndex++;

		// Attacher l'événement de suppression à la nouvelle ligne
		var removeButton = newRow.querySelector('.remove-mapping-row');
		removeButton.addEventListener('click', function() {
			removeMappingRow(newRow);
		});

		// Scroll vers la nouvelle ligne
		newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
	}

	function removeMappingRow(row) {
		if (confirm('{@lightspeedto_odoo.mapping.field.delete.confirmation}')) {
			row.remove();
			
			// S'assurer qu'il reste au moins une ligne
			var remainingRows = mappingRowsContainer.querySelectorAll('.mapping-row');
			if (remainingRows.length === 0) {
				addMappingRow();
			}
		}
	}

	function setupRemoveButtons() {
		var removeButtons = document.querySelectorAll('.remove-mapping-row');
		removeButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				var row = button.closest('.mapping-row');
				removeMappingRow(row);
			});
		});
	}

	// Validation du formulaire
	var form = document.querySelector('form');
	if (form) {
		form.addEventListener('submit', function(e) {
			var mappingRows = mappingRowsContainer.querySelectorAll('.mapping-row');
			var validMappings = 0;

			mappingRows.forEach(function(row) {
				var lightspeedField = row.querySelector('select[name*="lightspeed_field"]').value;
				var odooField = row.querySelector('select[name*="odoo_field"]').value;
				
				if (lightspeedField && odooField) {
					validMappings++;
				}
			});

			if (validMappings === 0) {
				e.preventDefault();
				alert('{@lightspeedto_odoo.mapping.error.no_valid_mappings}');
				return false;
			}

			// Vérifier les doublons
			var usedLightspeedFields = [];
			var usedOdooFields = [];
			var hasDuplicates = false;

			mappingRows.forEach(function(row) {
				var lightspeedField = row.querySelector('select[name*="lightspeed_field"]').value;
				var odooField = row.querySelector('select[name*="odoo_field"]').value;
				
				if (lightspeedField && odooField) {
					if (usedLightspeedFields.includes(lightspeedField)) {
						alert('{@lightspeedto_odoo.mapping.error.duplicate_lightspeed}: ' + lightspeedField);
						hasDuplicates = true;
						return false;
					}
					if (usedOdooFields.includes(odooField)) {
						alert('{@lightspeedto_odoo.mapping.error.duplicate_odoo}: ' + odooField);
						hasDuplicates = true;
						return false;
					}
					
					usedLightspeedFields.push(lightspeedField);
					usedOdooFields.push(odooField);
				}
			});

			if (hasDuplicates) {
				e.preventDefault();
				return false;
			}
		});
	}

	// Auto-suggestion de mappings
	setupAutoSuggestion();

	function setupAutoSuggestion() {
		var lightspeedSelects = document.querySelectorAll('select[name*="lightspeed_field"]');
		lightspeedSelects.forEach(function(select) {
			select.addEventListener('change', function() {
				var lightspeedField = this.value;
				var row = this.closest('.mapping-row');
				var odooSelect = row.querySelector('select[name*="odoo_field"]');
				
				// Suggestions automatiques
				var suggestions = {
					'sku': 'default_code',
					'title': 'name',
					'barcode': 'barcode',
					'price': 'list_price',
					'cost_per_item': 'standard_price',
					'inventory_quantity': 'qty_available',
					'weight': 'weight',
					'vendor': 'vendor_id',
					'type': 'categ_id'
				};

				if (suggestions[lightspeedField] && !odooSelect.value) {
					// Vérifier que le champ Odoo suggéré n'est pas déjà utilisé
					var allOdooSelects = document.querySelectorAll('select[name*="odoo_field"]');
					var isUsed = false;
					
					allOdooSelects.forEach(function(otherSelect) {
						if (otherSelect !== odooSelect && otherSelect.value === suggestions[lightspeedField]) {
							isUsed = true;
						}
					});
					
					if (!isUsed) {
						odooSelect.value = suggestions[lightspeedField];
						// Effet visuel pour montrer la suggestion
						odooSelect.style.backgroundColor = '#e8f5e8';
						setTimeout(function() {
							odooSelect.style.backgroundColor = '';
						}, 1000);
					}
				}
			});
		});
	}

	// Aide contextuelle pour les transformations
	setupTransformationHelp();

	function setupTransformationHelp() {
		var transformationInputs = document.querySelectorAll('input[name*="transformation"]');
		transformationInputs.forEach(function(input) {
			// Ajouter un tooltip ou aide
			input.title = '{@lightspeedto_odoo.mapping.transformation.help}';
			
			// Ajouter des suggestions communes
			input.addEventListener('focus', function() {
				if (!this.dataset.helpAdded) {
					var helpDiv = document.createElement('div');
					helpDiv.className = 'field-description small';
					helpDiv.innerHTML = '{@lightspeedto_odoo.mapping.transformation.common}: <code>trim</code>, <code>uppercase</code>, <code>lowercase</code>, <code>float</code>, <code>int</code>, <code>bool</code>';
					this.parentNode.appendChild(helpDiv);
					this.dataset.helpAdded = 'true';
				}
			});
		});
	}
});
//-->
</script>

<style>
.mapping-row td {
	vertical-align: middle;
}

.mapping-row select,
.mapping-row input {
	width: 100%;
}

#mapping-container .table {
	margin-bottom: 1em;
}

.field-description {
	margin-top: 0.5em;
	color: #666;
}

.mapping-row:hover {
	background-color: rgba(var(--main-rgb), 0.05);
}

.remove-mapping-row {
	white-space: nowrap;
}

@media (max-width: 768px) {
	#mapping-container .table,
	#mapping-container .table thead,
	#mapping-container .table tbody,
	#mapping-container .table th,
	#mapping-container .table td,
	#mapping-container .table tr {
		display: block;
	}
	
	#mapping-container .table thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	#mapping-container .table tr {
		border: 1px solid #ccc;
		margin-bottom: 10px;
		padding: 10px;
	}
	
	#mapping-container .table td {
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50% !important;
		margin-bottom: 5px;
	}
	
	#mapping-container .table td:before {
		content: attr(data-label);
		position: absolute;
		left: 6px;
		width: 45%;
		padding-right: 10px;
		white-space: nowrap;
		font-weight: bold;
	}
}
</style>