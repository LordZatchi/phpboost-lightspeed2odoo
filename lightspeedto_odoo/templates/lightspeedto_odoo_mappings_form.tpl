<article class="content-container">
	<header class="section-header">
		<h1>{lightspeedto_odoo.mapping.form.title}</h1>
		<div class="controls align-right">
			<a href="{U_MAPPINGS}" class="button">
				<i class="fa fa-list" aria-hidden="true"></i> {lightspeedto_odoo.mappings.management}
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
					<option value="">{common.choose}</option>
					<option value="SKU">SKU</option>
					<option value="Nom">Nom</option>
					<option value="SKU parent">SKU parent</option>
					<option value="Type">Type</option>
					<option value="Prix par défaut">Prix par défaut</option>
					<option value="Prix du supplément">Prix du supplément</option>
					<option value="Département">Département</option>
					<option value="Code-barres">Code-barres</option>
					<option value="Prix de revient">Prix de revient</option>
					<option value="Contenu (gestion des stocks)">Contenu (gestion des stocks)</option>
					<option value="Poids">Poids</option>
					<option value="Partage">Partage</option>
				</select>
			</td>
			<td>
				<select name="mapping[${rowIndex}][odoo_field]" class="form-control">
					<option value="">{common.choose}</option>
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
				<input type="text" name="mapping[${rowIndex}][transformation]" class="form-control" placeholder="{lightspeedto_odoo.mapping.transformation.placeholder}">
			</td>
			<td>
				<button type="button" class="button bgc error remove-mapping-row">{common.delete}</button>
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
		if (confirm('{lightspeedto_odoo.mapping.field.delete.confirmation}')) {
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
				alert('{lightspeedto_odoo.mapping.error.no_valid_mappings}');
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
						alert('{lightspeedto_odoo.mapping.error.duplicate_lightspeed}: ' + lightspeedField);
						hasDuplicates = true;
						return false;
					}
					if (usedOdooFields.includes(odooField)) {
						alert('{lightspeedto_odoo.mapping.error.duplicate_odoo}: ' + odooField);
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
});
//-->
</script>