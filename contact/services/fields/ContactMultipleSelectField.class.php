<?php
/**
 * @copyright   &copy; 2005-2024 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Julien BRISWALTER <j1.seth@phpboost.com>
 * @version     PHPBoost 6.0 - last update: 2021 06 20
 * @since       PHPBoost 4.0 - 2013 07 31
 * @contributor Sebastien LARTIGUE <babsolune@phpboost.com>
*/

class ContactMultipleSelectField extends AbstractContactField
{
	public function __construct()
	{
		parent::__construct();
		$this->set_disable_fields_configuration(array('regex', 'default_value_small', 'default_value_medium'));
		$this->set_name(LangLoader::get_message('user.field.type.multiple.select', 'user-lang'));
	}

	public function display_field(ContactField $field)
	{
		$fieldset = $field->get_fieldset();

		$options = array();
		$default_values = array();
		$i = 0;
		foreach ($field->get_possible_values() as $name => $parameters)
		{
			$options[] = new FormFieldSelectChoiceOption(stripslashes($parameters['title']), $name);

			if ($parameters['is_default'])
			{
				$default_values[] = $name;
			}

			$i++;
		}

		$fieldset->add_field(new FormFieldMultipleSelectChoice($field->get_field_name(), $field->get_name(), $default_values, $options, array('required' => (bool)$field->is_required(), 'description' => $field->get_description())));
	}

	public function get_value(HTMLForm $form, ContactField $field)
	{
		$field_name = $field->get_field_name();
		$array = array();
		if ($form->has_field($field_name))
		{
			foreach ($form->get_value($field_name, array()) as $field => $value)
			{
				$array[] = $value->get_label();
			}
		}
		return $this->serialise_value($array);
	}

	private function serialise_value(Array $array)
	{
		return implode('|', $array);
	}
}
?>
