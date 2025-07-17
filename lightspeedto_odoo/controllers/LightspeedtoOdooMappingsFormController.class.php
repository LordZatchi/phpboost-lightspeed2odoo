<?php
/**
 * @copyright   &copy; 2024
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      LordZatchi <zatchbell68@gmail.com>
 * @version     PHPBoost 6.0 - last update: 2024 12 20
 * @since       PHPBoost 6.0 - 2024 12 20
*/

class LightspeedtoOdooMappingFormController extends ModuleController
{
	private $lang;
	private $form;
	private $submit_button;
	private $mapping;
	private $is_new_mapping;

	public function __construct()
	{
		$this->lang = LangLoader::get_all_langs('lightspeedto_odoo');
	}

	public function execute(HTTPRequestCustom $request)
	{
		$this->check_authorizations();
		$this->init($request);
		
		if ($this->submit_button->has_been_submited() && $this->form->validate())
		{
			$this->save($request);
			$this->redirect();
		}
		
		$this->build_view();
		return $this->generate_response();
	}

	private function init(HTTPRequestCustom $request)
	{
		$id = $request->get_getint('id', 0);
		$this->is_new_mapping = ($id === 0);

		if (!$this->is_new_mapping)
		{
			try {
				$this->mapping = PersistenceContext::get_querier()->select_single_row(
					LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
					array('*'),
					'WHERE id = :id',
					array('id' => $id)
				);
			} catch (RowNotFoundException $e) {
				$error_controller = PHPBoostErrors::unexisting_element();
				DispatchManager::redirect($error_controller);
			}
		}

		$this->build_form();
	}

	private function check_authorizations()
	{
		if (!LightspeedtoOdooAuthorizationsService::check_authorizations()->write())
		{
			$error_controller = PHPBoostErrors::user_not_authorized();
			DispatchManager::redirect($error_controller);
		}
	}

	private function build_form()
	{
		$form = new HTMLForm(__CLASS__);
		$form->set_layout_title($this->is_new_mapping ? $this->lang['lightspeedto_odoo.mapping.add'] : $this->lang['lightspeedto_odoo.mapping.edit']);

		$fieldset = new FormFieldsetHTMLHeading('mapping_config', $this->lang['lightspeedto_odoo.mapping.configuration']);
		$form->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldTextEditor('name', $this->lang['common.name'], $this->get_mapping('name'), array('required' => true),
			array(new FormFieldConstraintNotEmpty())));

		$fieldset->add_field(new FormFieldRichTextEditor('description', $this->lang['common.description'], $this->get_mapping('description')));

		$fieldset->add_field(new FormFieldCheckbox('is_default', $this->lang['lightspeedto_odoo.mapping.is_default'], $this->get_mapping('is_default'), array(
			'description' => $this->lang['lightspeedto_odoo.mapping.is_default.description']
		)));

		// Section de mapping des champs
		$fieldset_mapping = new FormFieldsetHTMLHeading('field_mapping', $this->lang['lightspeedto_odoo.mapping.fields']);
		$form->add_fieldset($fieldset_mapping);

		// Récupération des champs Lightspeed disponibles (exemple basé sur l'export.csv)
		$lightspeed_fields = $this->get_lightspeed_fields();
		$odoo_fields = $this->get_odoo_fields();

		$mapping_data = $this->get_mapping_data();

		$fieldset_mapping->add_field(new FormFieldFree('mapping_explanation', '', 
			'<div class="message-helper bgc notice">' . $this->lang['lightspeedto_odoo.mapping.explanation'] . '</div>'));

		// Création dynamique des champs de mapping
		$mapping_html = '<div id="mapping-container">';
		$mapping_html .= '<table class="table">';
		$mapping_html .= '<thead><tr>';
		$mapping_html .= '<th>' . $this->lang['lightspeedto_odoo.mapping.lightspeed_field'] . '</th>';
		$mapping_html .= '<th>' . $this->lang['lightspeedto_odoo.mapping.odoo_field'] . '</th>';
		$mapping_html .= '<th>' . $this->lang['lightspeedto_odoo.mapping.transformation'] . '</th>';
		$mapping_html .= '<th>' . $this->lang['common.actions'] . '</th>';
		$mapping_html .= '</tr></thead><tbody id="mapping-rows">';

		// Ajout des mappings existants
		if (!empty($mapping_data) && is_array($mapping_data))
		{
			foreach ($mapping_data as $index => $mapping)
			{
				$mapping_html .= $this->generate_mapping_row($index, $mapping, $lightspeed_fields, $odoo_fields);
			}
		}
		else
		{
			// Ajout d'une ligne vide par défaut
			$mapping_html .= $this->generate_mapping_row(0, array(), $lightspeed_fields, $odoo_fields);
		}

		$mapping_html .= '</tbody></table>';
		$mapping_html .= '<div class="align-center">';
		$mapping_html .= '<button type="button" id="add-mapping-row" class="button submit">' . $this->lang['lightspeedto_odoo.mapping.add_field'] . '</button>';
		$mapping_html .= '</div></div>';

		$fieldset_mapping->add_field(new FormFieldFree('field_mappings', '', $mapping_html));

		$this->submit_button = new FormButtonDefaultSubmit();
		$form->add_button($this->submit_button);
		$form->add_button(new FormButtonReset());

		$this->form = $form;
	}

	private function generate_mapping_row($index, $mapping = array(), $lightspeed_fields = array(), $odoo_fields = array())
	{
		$lightspeed_options = '<option value="">' . $this->lang['common.choose'] . '</option>';
		foreach ($lightspeed_fields as $field)
		{
			$selected = (isset($mapping['lightspeed_field']) && $mapping['lightspeed_field'] == $field) ? ' selected' : '';
			$lightspeed_options .= '<option value="' . $field . '"' . $selected . '>' . $field . '</option>';
		}

		$odoo_options = '<option value="">' . $this->lang['common.choose'] . '</option>';
		foreach ($odoo_fields as $field)
		{
			$selected = (isset($mapping['odoo_field']) && $mapping['odoo_field'] == $field) ? ' selected' : '';
			$odoo_options .= '<option value="' . $field . '"' . $selected . '>' . $field . '</option>';
		}

		$transformation = isset($mapping['transformation']) ? htmlspecialchars($mapping['transformation']) : '';

		$html = '<tr class="mapping-row" data-index="' . $index . '">';
		$html .= '<td><select name="mapping[' . $index . '][lightspeed_field]" class="form-control">' . $lightspeed_options . '</select></td>';
		$html .= '<td><select name="mapping[' . $index . '][odoo_field]" class="form-control">' . $odoo_options . '</select></td>';
		$html .= '<td><input type="text" name="mapping[' . $index . '][transformation]" value="' . $transformation . '" class="form-control" placeholder="' . $this->lang['lightspeedto_odoo.mapping.transformation.placeholder'] . '"></td>';
		$html .= '<td><button type="button" class="button bgc error remove-mapping-row">' . $this->lang['common.delete'] . '</button></td>';
		$html .= '</tr>';

		return $html;
	}

	private function get_lightspeed_fields()
	{
		// Champs basés sur l'export.csv fourni en exemple
		return array(
			'item_id',
			'handle',
			'variant_id',
			'sku',
			'barcode',
			'title',
			'vendor',
			'type',
			'price',
			'compare_at_price',
			'inventory_quantity',
			'inventory_policy',
			'fulfillment_service',
			'requires_shipping',
			'taxable',
			'weight',
			'weight_unit',
			'image_src',
			'variant_image',
			'gift_card',
			'seo_title',
			'seo_description',
			'google_shopping_category',
			'google_shopping_gender',
			'google_shopping_age_group',
			'variant_grams',
			'variant_inventory_tracker',
			'variant_inventory_qty',
			'variant_inventory_policy',
			'variant_fulfillment_service',
			'variant_price',
			'variant_compare_at_price',
			'variant_requires_shipping',
			'variant_taxable',
			'variant_barcode',
			'variant_weight_unit',
			'variant_tax_code',
			'cost_per_item',
			'status'
		);
	}

	private function get_odoo_fields()
	{
		// Champs Odoo POS typiques
		return array(
			'name',
			'default_code',
			'barcode',
			'categ_id',
			'list_price',
			'standard_price',
			'type',
			'description',
			'description_sale',
			'weight',
			'volume',
			'taxes_id',
			'supplier_taxes_id',
			'tracking',
			'route_ids',
			'available_in_pos',
			'to_weight',
			'pos_categ_id',
			'image_1920',
			'active'
		);
	}

	private function get_mapping($field)
	{
		if ($this->is_new_mapping)
		{
			return '';
		}

		switch ($field)
		{
			case 'name':
				return $this->mapping['name'];
			case 'description':
				return $this->mapping['description'];
			case 'is_default':
				return $this->mapping['is_default'];
			default:
				return '';
		}
	}

	private function get_mapping_data()
	{
		if ($this->is_new_mapping || empty($this->mapping['mapping_data']))
		{
			return array();
		}
		
		return json_decode($this->mapping['mapping_data'], true);
	}

	private function save(HTTPRequestCustom $request)
	{
		$name = $this->form->get_value('name');
		$description = $this->form->get_value('description');
		$is_default = $this->form->get_value('is_default');

		// Traitement des mappings de champs
		$mapping_data = array();
		$mapping_post = $request->get_postvalue('mapping', array());
		
		if (is_array($mapping_post))
		{
			foreach ($mapping_post as $mapping)
			{
				if (!empty($mapping['lightspeed_field']) && !empty($mapping['odoo_field']))
				{
					$mapping_data[] = array(
						'lightspeed_field' => $mapping['lightspeed_field'],
						'odoo_field' => $mapping['odoo_field'],
						'transformation' => isset($mapping['transformation']) ? trim($mapping['transformation']) : ''
					);
				}
			}
		}

		// Si ce mapping est défini par défaut, on retire le statut par défaut des autres
		if ($is_default)
		{
			PersistenceContext::get_querier()->update(
				LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table,
				array('is_default' => 0),
				'WHERE 1=1'
			);
		}

		$now = time();

		if ($this->is_new_mapping)
		{
			$result = PersistenceContext::get_querier()->insert(LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table, array(
				'name' => $name,
				'description' => $description,
				'mapping_data' => json_encode($mapping_data),
				'is_default' => $is_default,
				'created_date' => $now,
				'updated_date' => $now,
				'user_id' => AppContext::get_current_user()->get_id()
			));

			HooksService::execute_hook_action('add', 'lightspeedto_odoo', array(
				'id' => $result->get_last_inserted_id(),
				'title' => $name,
				'url' => LightspeedtoOdooUrlBuilder::mappings()->rel()
			));
		}
		else
		{
			PersistenceContext::get_querier()->update(LightspeedtoOdooSetup::$lightspeedto_odoo_mappings_table, array(
				'name' => $name,
				'description' => $description,
				'mapping_data' => json_encode($mapping_data),
				'is_default' => $is_default,
				'updated_date' => $now
			), 'WHERE id = :id', array('id' => $this->mapping['id']));

			HooksService::execute_hook_action('edit', 'lightspeedto_odoo', array(
				'id' => $this->mapping['id'],
				'title' => $name,
				'url' => LightspeedtoOdooUrlBuilder::mappings()->rel()
			));
		}
	}

	private function redirect()
	{
		AppContext::get_response()->redirect(LightspeedtoOdooUrlBuilder::mappings(), 
			LangLoader::get_message('warning.process.success', 'warning-lang'));
	}

	private function build_view()
	{
		$view = new FileTemplate('lightspeedto_odoo/lightspeedto_odoo_mapping_form.tpl');
		$view->add_lang($this->lang);
		$view->put('FORM', $this->form->display());
		$this->view = $view;
	}

	private function generate_response()
	{
		$page_title = $this->is_new_mapping ? $this->lang['lightspeedto_odoo.mapping.add'] : $this->lang['lightspeedto_odoo.mapping.edit'];
		
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();

		$graphical_environment->set_page_title($page_title, $this->lang['lightspeedto_odoo.module.title']);
		$graphical_environment->get_seo_meta_data()->set_description($this->lang['lightspeedto_odoo.seo.description.mapping.form']);
		$graphical_environment->get_seo_meta_data()->set_canonical_url(
			$this->is_new_mapping ? 
			LightspeedtoOdooUrlBuilder::mapping_form() : 
			LightspeedtoOdooUrlBuilder::mapping_form($this->mapping['id'])
		);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['lightspeedto_odoo.module.title'], LightspeedtoOdooUrlBuilder::home());
		$breadcrumb->add($this->lang['lightspeedto_odoo.mappings.management'], LightspeedtoOdooUrlBuilder::mappings());
		$breadcrumb->add($page_title, '');

		return $response;
	}
}
?>