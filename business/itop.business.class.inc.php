<?php
// Copyright (C) 2010 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

/**
 * Persistent classes for a CMDB
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

require_once('../application/cmdbabstract.class.inc.php');
require_once('../application/template.class.inc.php');

class Organization extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,structure",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "organization",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("code", array("allowed_values"=>null, "sql"=>"code", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('active,inactive'), "sql"=>"status", "default_value"=>"active", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("parent_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"parent_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("parent_name", array("allowed_values"=>null, "extkey_attcode"=>"parent_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'code', 'status', 'parent_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'code', 'status'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'code', 'status'));
		MetaModel::Init_SetZListItems('list', array('status', 'parent_id'));
	}
}
class Location extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,structure",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "location",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/location.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('active,inactive'), "sql"=>"status", "default_value"=>"active", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("org_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"org_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=>"org_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("address", array("allowed_values"=>null, "sql"=>"address", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("country", array("allowed_values"=>null, "sql"=>"country", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("parent_id", array("targetclass"=>"Location", "jointype"=>null, "allowed_values"=>null, "sql"=>"parent_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("parent_name", array("allowed_values"=>null, "extkey_attcode"=>"parent_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'org_id', 'address', 'country', 'parent_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'org_id', 'country'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'org_id', 'country'));
		MetaModel::Init_SetZListItems('list', array('status', 'org_id', 'country'));
	}
}
abstract class Contact extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,structure",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "contact",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('active,inactive'), "sql"=>"status", "default_value"=>"active", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("org_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"org_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=>"org_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEmailAddress("email", array("allowed_values"=>null, "sql"=>"email", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("phone", array("allowed_values"=>null, "sql"=>"phone", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("location_id", array("targetclass"=>"Location", "jointype"=>null, "allowed_values"=>null, "sql"=>"location_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("location_name", array("allowed_values"=>null, "extkey_attcode"=>"location_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("contract_list", array("linked_class"=>"lnkContractToContact", "ext_key_to_me"=>"contact_id", "ext_key_to_remote"=>"contract_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ticket_list", array("linked_class"=>"lnkTicketToContact", "ext_key_to_me"=>"contact_id", "ext_key_to_remote"=>"ticket_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ci_list", array("linked_class"=>"lnkCIToContact", "ext_key_to_me"=>"contact_id", "ext_key_to_remote"=>"ci_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'org_id', 'email', 'phone', 'location_id', 'contract_list', 'ticket_list', 'ci_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id'));
		MetaModel::Init_SetZListItems('list', array('status', 'org_id', 'email', 'phone', 'location_id'));
	}
}
class Person extends Contact
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,structure",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "person",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/person.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("first_name", array("allowed_values"=>null, "sql"=>"first_name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("employee_id", array("allowed_values"=>null, "sql"=>"employee_id", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'org_id', 'email', 'phone', 'location_id', 'contract_list', 'ticket_list', 'ci_list', 'first_name', 'employee_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id', 'first_name', 'employee_id'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id', 'first_name', 'employee_id'));
		MetaModel::Init_SetZListItems('list', array('status', 'org_id', 'email', 'phone', 'location_id', 'first_name', 'employee_id'));
	}
}
class Team extends Contact
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,structure",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "team",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/team.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();


		MetaModel::Init_SetZListItems('details', array('name', 'status', 'org_id', 'email', 'phone', 'location_id', 'contract_list', 'ticket_list', 'ci_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'org_id', 'email', 'phone', 'location_id'));
		MetaModel::Init_SetZListItems('list', array('status', 'org_id', 'email', 'phone', 'location_id'));
	}
}
abstract class Document extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,documentation",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "document",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/document.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum('contract,networkmap,presentation,training,whitePaper,workinginstructions'), "sql"=>"type", "default_value"=>"presentation", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('draft,published,obsolete'), "sql"=>"status", "default_value"=>"draft", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("contract_list", array("linked_class"=>"lnkContractToDoc", "ext_key_to_me"=>"document_id", "ext_key_to_remote"=>"contract_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ticket_list", array("linked_class"=>"lnkTicketToDoc", "ext_key_to_me"=>"document_id", "ext_key_to_remote"=>"ticket_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ci_list", array("linked_class"=>"lnkCIToDoc", "ext_key_to_me"=>"document_id", "ext_key_to_remote"=>"ci_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description', 'type', 'status', 'contract_list', 'ticket_list', 'ci_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description', 'type', 'status'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'type', 'status'));
		MetaModel::Init_SetZListItems('list', array('type', 'status'));
	}
}
class ExternalDoc extends Document
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,documentation",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "externaldoc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/document.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeURL("url", array("target"=>"_blank", "allowed_values"=>null, "sql"=>"url", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description', 'type', 'status', 'contract_list', 'ticket_list', 'ci_list', 'url'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description', 'type', 'status', 'url'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'type', 'status', 'url'));
		MetaModel::Init_SetZListItems('list', array('type', 'status', 'url'));
	}
}
class Note extends Document
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,documentation",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "note",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/document.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeWikiText("note", array("allowed_values"=>null, "sql"=>"note", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description', 'type', 'status', 'contract_list', 'ticket_list', 'ci_list', 'note'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description', 'type', 'status', 'note'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'type', 'status', 'note'));
		MetaModel::Init_SetZListItems('list', array('type', 'status', 'note'));
	}
}
class FileDoc extends Document
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,documentation",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "filedoc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/document.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeBlob("contents", array("depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description', 'type', 'status', 'contract_list', 'ticket_list', 'ci_list', 'contents'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description', 'type', 'status'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'type', 'status'));
		MetaModel::Init_SetZListItems('list', array('type', 'status', 'contents'));
	}
	
	/**
	 * Overload the display of the properties to add a tab (the first one)
	 * with the preview of the document
	 */
	public function DisplayBareProperties(WebPage $oPage)
	{
		$oPage->SetCurrentTab(Dict::S('Class:Document:PreviewTab'));
		$oPage->add($this->DisplayDocumentInline($oPage, 'contents'));
		$oPage->SetCurrentTab(Dict::S('UI:PropertiesTab'));
		parent::DisplayBareProperties($oPage);
		
	}
}
class Licence extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "provider",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "licence",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("provider", array("allowed_values"=>null, "sql"=>"provider", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("product", array("allowed_values"=>null, "sql"=>"product", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("start", array("allowed_values"=>null, "sql"=>"start", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("end", array("allowed_values"=>null, "sql"=>"end", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("key", array("allowed_values"=>null, "sql"=>"key", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("scope", array("allowed_values"=>null, "sql"=>"scope", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('provider', 'product', 'name', 'start', 'end', 'key', 'scope'));
		MetaModel::Init_SetZListItems('advanced_search', array('provider', 'product', 'name', 'start', 'end', 'key', 'scope'));
		MetaModel::Init_SetZListItems('standard_search', array('provider', 'product', 'name', 'start', 'end', 'key', 'scope'));
		MetaModel::Init_SetZListItems('list', array('provider', 'product', 'name', 'start', 'end', 'key', 'scope'));
	}
}
class Subnet extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "subnet",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeIPAddress("ip", array("allowed_values"=>null, "sql"=>"ip", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeIPAddress("ip_mask", array("allowed_values"=>null, "sql"=>"ip_mask", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description', 'ip', 'ip_mask'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description', 'ip', 'ip_mask'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description', 'ip', 'ip_mask'));
		MetaModel::Init_SetZListItems('list', array('description', 'ip', 'ip_mask'));
	}
	public function ComputeValues()
	{
		$sName = $this->Get('ip').'/'.$this->Get('ip_mask');
		$this->Set('name', $sName);
	}
}
class Patch extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "patch",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("target_sw", array("allowed_values"=>null, "sql"=>"target_sw", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("version", array("allowed_values"=>null, "sql"=>"version", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum('security,servicepack,fix'), "sql"=>"type", "default_value"=>"fix", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'target_sw', 'version', 'type'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'target_sw', 'version', 'type'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'target_sw', 'version', 'type'));
		MetaModel::Init_SetZListItems('list', array('target_sw', 'version', 'type'));
	}
}
class Application extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "application",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/software.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description'));
		MetaModel::Init_SetZListItems('list', array('description'));
	}
}
class lnkPatchToCI extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "patch_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkpatchtoci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("patch_id", array("targetclass"=>"Patch", "jointype"=>null, "allowed_values"=>null, "sql"=>"patch_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("patch_name", array("allowed_values"=>null, "extkey_attcode"=>"patch_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"Device", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('patch_id', 'ci_id', 'ci_status'));
		MetaModel::Init_SetZListItems('advanced_search', array('patch_id', 'ci_id'));
		MetaModel::Init_SetZListItems('standard_search', array('patch_id', 'ci_id'));
		MetaModel::Init_SetZListItems('list', array('patch_id', 'ci_id', 'ci_status'));
	}
}
abstract class FunctionalCI extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "functionalci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('implementation,production,obsolete'), "sql"=>"status", "default_value"=>"implementation", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("owner_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"owner_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("owner_name", array("allowed_values"=>null, "extkey_attcode"=>"owner_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("importance", array("allowed_values"=>new ValueSetEnum('low,medium,high'), "sql"=>"importance", "default_value"=>"medium", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("contact_list", array("linked_class"=>"lnkCIToContact", "ext_key_to_me"=>"ci_id", "ext_key_to_remote"=>"contact_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("document_list", array("linked_class"=>"lnkCIToDoc", "ext_key_to_me"=>"ci_id", "ext_key_to_remote"=>"document_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("solution_list", array("linked_class"=>"lnkSolutionToCI", "ext_key_to_me"=>"ci_id", "ext_key_to_remote"=>"solution_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));


		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'contact_list', 'document_list', 'solution_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance'));
	}
}
class ApplicationInstance extends FunctionalCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "applicationinstance",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/application.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("device_id", array("targetclass"=>"Device", "jointype"=>null, "allowed_values"=>null, "sql"=>"device_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("device_name", array("allowed_values"=>null, "extkey_attcode"=>"device_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("licence_id", array("targetclass"=>"Licence", "jointype"=>null, "allowed_values"=>null, "sql"=>"licence_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("licence_name", array("allowed_values"=>null, "extkey_attcode"=>"licence_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("application_id", array("targetclass"=>"Application", "jointype"=>null, "allowed_values"=>null, "sql"=>"application_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("application_name", array("allowed_values"=>null, "extkey_attcode"=>"application_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("version", array("allowed_values"=>null, "sql"=>"version", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'device_id', 'licence_id', 'application_id', 'version', 'description'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'device_id', 'licence_id', 'application_id', 'version', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'device_id', 'licence_id', 'application_id', 'version', 'description'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'device_id', 'licence_id', 'application_id', 'version', 'description'));
	}
}
class DatabaseInstance extends FunctionalCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "databaseinstance",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/database-instance.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("application_id", array("targetclass"=>"ApplicationInstance", "jointype"=>null, "allowed_values"=>null, "sql"=>"application_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("application_name", array("allowed_values"=>null, "extkey_attcode"=>"application_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributePassword("admin_login", array("allowed_values"=>null, "sql"=>"admin_login", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributePassword("admin_password", array("allowed_values"=>null, "sql"=>"admin_password", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'application_id', 'admin_login', 'admin_password', 'description'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'application_id', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'application_id', 'description'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'application_id', 'admin_login', 'admin_password', 'description'));
	}
}
class ApplicationSolution extends FunctionalCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "applicationsolution",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ci_list", array("linked_class"=>"lnkSolutionToCI", "ext_key_to_me"=>"solution_id", "ext_key_to_remote"=>"ci_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("process_list", array("linked_class"=>"lnkProcessToSolution", "ext_key_to_me"=>"solution_id", "ext_key_to_remote"=>"process_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'description', 'ci_list', 'process_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'description'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'description'));
	}
}
class BusinessProcess extends FunctionalCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "businessprocess",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/business-process.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("solution_list", array("linked_class"=>"lnkProcessToSolution", "ext_key_to_me"=>"process_id", "ext_key_to_remote"=>"solution_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'description', 'solution_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'description'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'description'));
	}
}
class ConnectableCI extends FunctionalCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "connectableci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("brand", array("allowed_values"=>null, "sql"=>"brand", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("model", array("allowed_values"=>null, "sql"=>"model", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("serial_number", array("allowed_values"=>null, "sql"=>"serial_number", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("asset_ref", array("allowed_values"=>null, "sql"=>"asset_ref", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
	}
}
class NetworkInterface extends ConnectableCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "networkinterface",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("device_id", array("targetclass"=>"Device", "jointype"=>null, "allowed_values"=>null, "sql"=>"device_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("device_name", array("allowed_values"=>null, "extkey_attcode"=>"device_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("logical_type", array("allowed_values"=>new ValueSetEnum('backup,logical,port,primary,secondary'), "sql"=>"logical_type", "default_value"=>"primary", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("physical_type", array("allowed_values"=>new ValueSetEnum('atm,ethernet,framerelay,vlan'), "sql"=>"physical_type", "default_value"=>"ethernet", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeIPAddress("ip_address", array("allowed_values"=>null, "sql"=>"ip_address", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeIPAddress("ip_mask", array("allowed_values"=>null, "sql"=>"ip_mask", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("mac_address", array("allowed_values"=>null, "sql"=>"mac_address", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("speed", array("allowed_values"=>null, "sql"=>"speed", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("duplex", array("allowed_values"=>new ValueSetEnum('full,half,unknown'), "sql"=>"duplex", "default_value"=>"full", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("connected_if", array("targetclass"=>"NetworkInterface", "jointype"=>null, "allowed_values"=>null, "sql"=>"connected_if", "is_null_allowed"=>true, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("connected_name", array("allowed_values"=>null, "extkey_attcode"=>"connected_if", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("connected_if_device_id", array("allowed_values"=>null, "extkey_attcode"=>"connected_if", "target_attcode"=>"device_id", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'device_id', 'logical_type', 'physical_type', 'ip_address', 'ip_mask', 'mac_address', 'speed', 'duplex', 'connected_if', 'connected_if_device_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'device_id', 'logical_type', 'physical_type', 'ip_address', 'ip_mask', 'mac_address', 'speed', 'duplex', 'connected_if', 'connected_if_device_id'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'device_id', 'logical_type', 'physical_type', 'ip_address', 'ip_mask', 'mac_address', 'speed', 'duplex', 'connected_if', 'connected_if_device_id'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'device_id', 'logical_type', 'physical_type', 'ip_address', 'ip_mask', 'mac_address', 'speed', 'duplex', 'connected_if', 'connected_if_device_id'));
	}
}
class Device extends ConnectableCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "device",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		//MetaModel::Init_AddAttribute(new AttributeLinkedSet("application_list", array("linked_class"=>"ApplicationInstance", "ext_key_to_me"=>"device_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'application_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
	}
}
class PC extends Device
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "pc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/computer.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("cpu", array("allowed_values"=>null, "sql"=>"cpu", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ram", array("allowed_values"=>null, "sql"=>"ram", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("hdd", array("allowed_values"=>null, "sql"=>"hdd", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("os_family", array("allowed_values"=>null, "sql"=>"os_family", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("os_version", array("allowed_values"=>null, "sql"=>"os_version", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
	}
}
class MobileCI extends Device
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "mobileci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/mobile-phone.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();


		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref'));
	}
}
class MobilePhone extends MobileCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "mobilephone",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("number", array("allowed_values"=>null, "sql"=>"number", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("imei", array("allowed_values"=>null, "sql"=>"IMIE", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributePassword("hw_pin", array("allowed_values"=>null, "sql"=>"hw_pin", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'number', 'imei', 'hw_pin'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'number', 'imei'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'number', 'imei'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'number', 'imei', 'hw_pin'));
	}
}
class InfrastructureCI extends Device
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "infrastructureci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeWikiText("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("location_id", array("targetclass"=>"Location", "jointype"=>null, "allowed_values"=>null, "sql"=>"location_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("location_name", array("allowed_values"=>null, "extkey_attcode"=>"location_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("location_details", array("allowed_values"=>null, "sql"=>"location_details", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeIPAddress("management_ip", array("allowed_values"=>null, "sql"=>"management_ip", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("default_gateway", array("allowed_values"=>null, "sql"=>"default_gateway", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway'));
	}
}
class NetworkDevice extends InfrastructureCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "networkdevice",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum('WANaccelerator,firewall,hub,loadbalancer,router,switch'), "sql"=>"type", "default_value"=>"switch", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ios_version", array("allowed_values"=>null, "sql"=>"ios_version", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ram", array("allowed_values"=>null, "sql"=>"ram", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributePassword("snmp_read", array("allowed_values"=>null, "sql"=>"snmp_read", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributePassword("snmp_write", array("allowed_values"=>null, "sql"=>"snmp_write", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'ios_version', 'ram', 'snmp_read', 'snmp_write'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'ios_version', 'ram'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'ios_version', 'ram'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'ios_version', 'ram', 'snmp_read', 'snmp_write'));
	}
}
class Server extends InfrastructureCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "server",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/server.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("cpu", array("allowed_values"=>null, "sql"=>"cpu", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ram", array("allowed_values"=>null, "sql"=>"ram", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("hdd", array("allowed_values"=>null, "sql"=>"hdd", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("os_family", array("allowed_values"=>null, "sql"=>"os_family", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("os_version", array("allowed_values"=>null, "sql"=>"os_version", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'cpu', 'ram', 'hdd', 'os_family', 'os_version'));
	}
}
class Printer extends InfrastructureCI
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "printer",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/printer.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum('Mopier,Printer'), "sql"=>"type", "default_value"=>"Printer", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("technology", array("allowed_values"=>new ValueSetEnum('Laser,Inkjet,Tracer'), "sql"=>"technology", "default_value"=>"Laser", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'technology'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'technology'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'technology'));
		MetaModel::Init_SetZListItems('list', array('status', 'owner_id', 'importance', 'brand', 'model', 'serial_number', 'asset_ref', 'description', 'location_id', 'location_details', 'management_ip', 'default_gateway', 'type', 'technology'));
	}
}
class lnkCIToDoc extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "ci_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcitodoc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"FunctionalCI", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("document_id", array("targetclass"=>"Document", "jointype"=>null, "allowed_values"=>null, "sql"=>"document_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_name", array("allowed_values"=>null, "extkey_attcode"=>"document_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_type", array("allowed_values"=>null, "extkey_attcode"=>"document_id", "target_attcode"=>"type", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_status", array("allowed_values"=>null, "extkey_attcode"=>"document_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ci_id', 'ci_status', 'document_id', 'document_type', 'document_status'));
		MetaModel::Init_SetZListItems('advanced_search', array('ci_id', 'document_id'));
		MetaModel::Init_SetZListItems('standard_search', array('ci_id', 'document_id'));
		MetaModel::Init_SetZListItems('list', array('ci_id', 'ci_status', 'document_id', 'document_type', 'document_status'));
	}
}
class lnkCIToContact extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "ci_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcitocontact",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"icon" => "../business/templates/contact.png",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"FunctionalCI", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_name", array("allowed_values"=>null, "extkey_attcode"=>"contact_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_email", array("allowed_values"=>null, "extkey_attcode"=>"contact_id", "target_attcode"=>"email", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("role", array("allowed_values"=>null, "sql"=>"role", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ci_id', 'ci_status', 'contact_id', 'contact_email', 'role'));
		MetaModel::Init_SetZListItems('advanced_search', array('ci_id', 'contact_id', 'role'));
		MetaModel::Init_SetZListItems('standard_search', array('ci_id', 'contact_id', 'role'));
		MetaModel::Init_SetZListItems('list', array('ci_id', 'ci_status', 'contact_id', 'contact_email', 'role'));
	}
}
class lnkSolutionToCI extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "solution_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnksolutiontoci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("solution_id", array("targetclass"=>"ApplicationSolution", "jointype"=>null, "allowed_values"=>null, "sql"=>"solution_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("solution_name", array("allowed_values"=>null, "extkey_attcode"=>"solution_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"FunctionalCI", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("utility", array("allowed_values"=>null, "sql"=>"utility", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('solution_id', 'ci_id', 'ci_status', 'utility'));
		MetaModel::Init_SetZListItems('advanced_search', array('solution_id', 'ci_id', 'utility'));
		MetaModel::Init_SetZListItems('standard_search', array('solution_id', 'ci_id', 'utility'));
		MetaModel::Init_SetZListItems('list', array('solution_id', 'ci_id', 'ci_status', 'utility'));
	}
}
class lnkProcessToSolution extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,configmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "solution_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkprocesstosolution",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("solution_id", array("targetclass"=>"ApplicationSolution", "jointype"=>null, "allowed_values"=>null, "sql"=>"solution_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("solution_name", array("allowed_values"=>null, "extkey_attcode"=>"solution_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("process_id", array("targetclass"=>"BusinessProcess", "jointype"=>null, "allowed_values"=>null, "sql"=>"process_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("process_name", array("allowed_values"=>null, "extkey_attcode"=>"process_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("reason", array("allowed_values"=>null, "sql"=>"reason", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('solution_id', 'process_id', 'reason'));
		MetaModel::Init_SetZListItems('advanced_search', array('solution_id', 'process_id', 'reason'));
		MetaModel::Init_SetZListItems('standard_search', array('solution_id', 'process_id', 'reason'));
		MetaModel::Init_SetZListItems('list', array('solution_id', 'process_id', 'reason'));
	}
}


class Contract extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "contract",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum(''), "sql"=>"status", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("signed", array("allowed_values"=>null, "sql"=>"signed", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("begin", array("allowed_values"=>null, "sql"=>"begin", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("end", array("allowed_values"=>null, "sql"=>"end", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("cost", array("allowed_values"=>null, "sql"=>"cost", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("cost_currency", array("allowed_values"=>new ValueSetEnum('dollars,euros'), "sql"=>"cost_currency", "default_value"=>"euros", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("cost_unit", array("allowed_values"=>new ValueSetEnum(''), "sql"=>"cost_unit", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("billing_frequency", array("allowed_values"=>null, "sql"=>"billing_frequency", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("contact_list", array("linked_class"=>"lnkContractToContact", "ext_key_to_me"=>"contract_id", "ext_key_to_remote"=>"contact_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("document_list", array("linked_class"=>"lnkContractToDoc", "ext_key_to_me"=>"contract_id", "ext_key_to_remote"=>"document_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ci_list", array("linked_class"=>"lnkContractToCI", "ext_key_to_me"=>"contract_id", "ext_key_to_remote"=>"ci_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'status', 'description', 'signed', 'begin', 'end', 'cost', 'cost_currency', 'cost_unit', 'billing_frequency', 'contact_list', 'document_list', 'ci_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'status', 'description', 'signed', 'begin', 'end', 'cost', 'cost_currency', 'cost_unit', 'billing_frequency'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status', 'description', 'signed', 'begin', 'end', 'cost', 'cost_currency', 'cost_unit', 'billing_frequency'));
		MetaModel::Init_SetZListItems('list', array('status', 'description', 'signed', 'begin', 'end', 'cost', 'cost_currency', 'cost_unit', 'billing_frequency'));
	}
}
class ProviderContract extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "type",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "providercontract",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum(''), "sql"=>"type", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("provider_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"provider_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("provider_name", array("allowed_values"=>null, "extkey_attcode"=>"provider_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ola", array("allowed_values"=>null, "sql"=>"ola", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("coverage", array("allowed_values"=>null, "sql"=>"coverage", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("customer_list", array("linked_class"=>"lnkProviderToCustomer", "ext_key_to_me"=>"provider_id", "ext_key_to_remote"=>"customer_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("sla_list", array("linked_class"=>"lnkContractToSLA", "ext_key_to_me"=>"contract_id", "ext_key_to_remote"=>"sla_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('type', 'provider_id', 'ola', 'coverage', 'customer_list', 'sla_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('type', 'provider_id', 'ola', 'coverage'));
		MetaModel::Init_SetZListItems('standard_search', array('type', 'provider_id', 'ola', 'coverage'));
		MetaModel::Init_SetZListItems('list', array('type', 'provider_id', 'ola', 'coverage'));
	}
}
class CustomerContract extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "type",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "customercontract",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeEnum("type", array("allowed_values"=>new ValueSetEnum(''), "sql"=>"type", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("customer_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"customer_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("customer_name", array("allowed_values"=>null, "extkey_attcode"=>"customer_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('type', 'customer_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('type', 'customer_id'));
		MetaModel::Init_SetZListItems('standard_search', array('type', 'customer_id'));
		MetaModel::Init_SetZListItems('list', array('type', 'customer_id'));
	}
}
class lnkProviderToCustomer extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "provider_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkprovidertocustomer",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("provider_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"provider_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("provider_name", array("allowed_values"=>null, "extkey_attcode"=>"provider_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("customer_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"customer_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("customer_name", array("allowed_values"=>null, "extkey_attcode"=>"customer_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('provider_id', 'customer_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('provider_id', 'customer_id'));
		MetaModel::Init_SetZListItems('standard_search', array('provider_id', 'customer_id'));
		MetaModel::Init_SetZListItems('list', array('provider_id', 'customer_id'));
	}
}
class lnkContractToSLA extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "contract_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcontracttosla",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("contract_id", array("targetclass"=>"Contract", "jointype"=>null, "allowed_values"=>null, "sql"=>"contract_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contract_name", array("allowed_values"=>null, "extkey_attcode"=>"contract_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("sla_id", array("targetclass"=>"SLA", "jointype"=>null, "allowed_values"=>null, "sql"=>"sla_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("sla_name", array("allowed_values"=>null, "extkey_attcode"=>"sla_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("coverage", array("allowed_values"=>new ValueSetEnum('?'), "sql"=>"coverage", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('contract_id', 'sla_id', 'coverage'));
		MetaModel::Init_SetZListItems('advanced_search', array('contract_id', 'sla_id', 'coverage'));
		MetaModel::Init_SetZListItems('standard_search', array('contract_id', 'sla_id', 'coverage'));
		MetaModel::Init_SetZListItems('list', array('contract_id', 'sla_id', 'coverage'));
	}
}
class lnkContractToDoc extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "contract_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcontracttodoc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("contract_id", array("targetclass"=>"Contract", "jointype"=>null, "allowed_values"=>null, "sql"=>"contract_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contract_name", array("allowed_values"=>null, "extkey_attcode"=>"contract_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("document_id", array("targetclass"=>"Document", "jointype"=>null, "allowed_values"=>null, "sql"=>"document_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_name", array("allowed_values"=>null, "extkey_attcode"=>"document_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('contract_id', 'document_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('contract_id', 'document_id'));
		MetaModel::Init_SetZListItems('standard_search', array('contract_id', 'document_id'));
		MetaModel::Init_SetZListItems('list', array('contract_id', 'document_id'));
	}
}
class lnkContractToContact extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "contract_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcontracttocontact",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("contract_id", array("targetclass"=>"Contract", "jointype"=>null, "allowed_values"=>null, "sql"=>"contract_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contract_name", array("allowed_values"=>null, "extkey_attcode"=>"contract_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_name", array("allowed_values"=>null, "extkey_attcode"=>"contact_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('contract_id', 'contact_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('contract_id', 'contact_id'));
		MetaModel::Init_SetZListItems('standard_search', array('contract_id', 'contact_id'));
		MetaModel::Init_SetZListItems('list', array('contract_id', 'contact_id'));
	}
}
class lnkContractToCI extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "contract_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkcontracttoci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("contract_id", array("targetclass"=>"Contract", "jointype"=>null, "allowed_values"=>null, "sql"=>"contract_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contract_name", array("allowed_values"=>null, "extkey_attcode"=>"contract_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"FunctionalCI", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('contract_id', 'ci_id', 'ci_status'));
		MetaModel::Init_SetZListItems('advanced_search', array('contract_id', 'ci_id'));
		MetaModel::Init_SetZListItems('standard_search', array('contract_id', 'ci_id'));
		MetaModel::Init_SetZListItems('list', array('contract_id', 'ci_id', 'ci_status'));
	}
}
class ServiceType extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "servicetype",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("description", array("allowed_values"=>null, "sql"=>"description", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'description'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'description'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'description'));
		MetaModel::Init_SetZListItems('list', array('description'));
	}
}
class Service extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "servicetype_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "service",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("servicetype_id", array("targetclass"=>"ServiceType", "jointype"=>null, "allowed_values"=>null, "sql"=>"servicetype_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("servicetype_name", array("allowed_values"=>null, "extkey_attcode"=>"servicetype_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('servicetype_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('servicetype_id'));
		MetaModel::Init_SetZListItems('standard_search', array('servicetype_id'));
		MetaModel::Init_SetZListItems('list', array('servicetype_id'));
	}
}
class SLA extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "service_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "sla",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("service_id", array("targetclass"=>"Service", "jointype"=>null, "allowed_values"=>null, "sql"=>"service_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("service_name", array("allowed_values"=>null, "extkey_attcode"=>"service_id", "target_attcode"=>"servicetype_name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('service_id', 'name'));
		MetaModel::Init_SetZListItems('advanced_search', array('service_id', 'name'));
		MetaModel::Init_SetZListItems('standard_search', array('service_id', 'name'));
		MetaModel::Init_SetZListItems('list', array('service_id', 'name'));
	}
}
class ServiceLevel extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "servicelevel",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("name", array("allowed_values"=>null, "sql"=>"name", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("metric", array("allowed_values"=>new ValueSetEnum('TTO,TTR'), "sql"=>"metric", "default_value"=>"TTO", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ticket_type", array("allowed_values"=>null, "sql"=>"ticket_type", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("ticket_priorities", array("allowed_values"=>null, "sql"=>"ticket_priorities", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeInteger("value", array("allowed_values"=>null, "sql"=>"value", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('name', 'metric', 'ticket_type', 'ticket_priorities', 'value'));
		MetaModel::Init_SetZListItems('advanced_search', array('name', 'metric', 'ticket_type', 'ticket_priorities', 'value'));
		MetaModel::Init_SetZListItems('standard_search', array('name', 'metric', 'ticket_type', 'ticket_priorities', 'value'));
		MetaModel::Init_SetZListItems('list', array('metric', 'ticket_type', 'ticket_priorities', 'value'));
	}
}
class lnkLevelToSLA extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,servicemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "sla_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkleveltosla",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("sla_id", array("targetclass"=>"SLA", "jointype"=>null, "allowed_values"=>null, "sql"=>"sla_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("sla_name", array("allowed_values"=>null, "extkey_attcode"=>"sla_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("servicelevel_id", array("targetclass"=>"ServiceLevel", "jointype"=>null, "allowed_values"=>null, "sql"=>"servicelevel_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("servicelevel_name", array("allowed_values"=>null, "extkey_attcode"=>"servicelevel_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('sla_id', 'servicelevel_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('sla_id', 'servicelevel_id'));
		MetaModel::Init_SetZListItems('standard_search', array('sla_id', 'servicelevel_id'));
		MetaModel::Init_SetZListItems('list', array('sla_id', 'servicelevel_id'));
	}
}
abstract class Ticket extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,ticketing",
			"key_type" => "autoincrement",
			"name_attcode" => "ref",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "ticket",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("ref", array("allowed_values"=>null, "sql"=>"ref", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("title", array("allowed_values"=>null, "sql"=>"title", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("opened", array("allowed_values"=>null, "sql"=>"opened", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("domain", array("allowed_values"=>new ValueSetEnum('Application,Desktop,Network,Server'), "sql"=>"domain", "default_value"=>"Application", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("workgroup_id", array("targetclass"=>"Team", "jointype"=>null, "allowed_values"=>null, "sql"=>"workgroup_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("workgroup_name", array("allowed_values"=>null, "extkey_attcode"=>"workgroup_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("contact_list", array("linked_class"=>"lnkTicketToDoc", "ext_key_to_me"=>"ticket_id", "ext_key_to_remote"=>"contact_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("document_list", array("linked_class"=>"lnkTicketToContact", "ext_key_to_me"=>"ticket_id", "ext_key_to_remote"=>"document_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeLinkedSetIndirect("ci_list", array("linked_class"=>"lnkTicketToCI", "ext_key_to_me"=>"ticket_id", "ext_key_to_remote"=>"ci_id", "allowed_values"=>null, "count_min"=>0, "count_max"=>0, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ref', 'title', 'opened', 'domain', 'workgroup_id', 'contact_list', 'document_list', 'ci_list'));
		MetaModel::Init_SetZListItems('advanced_search', array('ref', 'title', 'opened', 'domain', 'workgroup_id'));
		MetaModel::Init_SetZListItems('standard_search', array('ref', 'title', 'opened', 'domain', 'workgroup_id'));
		MetaModel::Init_SetZListItems('list', array('ref', 'title', 'opened', 'domain', 'workgroup_id'));
	}
}
class lnkTicketToDoc extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,ticketing",
			"key_type" => "autoincrement",
			"name_attcode" => "ticket_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnktickettodoc",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("ticket_id", array("targetclass"=>"Ticket", "jointype"=>null, "allowed_values"=>null, "sql"=>"ticket_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ticket_ref", array("allowed_values"=>null, "extkey_attcode"=>"ticket_id", "target_attcode"=>"ref", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("document_id", array("targetclass"=>"Document", "jointype"=>null, "allowed_values"=>null, "sql"=>"document_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("document_name", array("allowed_values"=>null, "extkey_attcode"=>"document_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ticket_id', 'document_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('ticket_id', 'document_id'));
		MetaModel::Init_SetZListItems('standard_search', array('ticket_id', 'document_id'));
		MetaModel::Init_SetZListItems('list', array('ticket_id', 'document_id'));
	}
}
class lnkTicketToContact extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,ticketing",
			"key_type" => "autoincrement",
			"name_attcode" => "ticket_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnktickettocontact",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("ticket_id", array("targetclass"=>"Ticket", "jointype"=>null, "allowed_values"=>null, "sql"=>"ticket_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ticket_ref", array("allowed_values"=>null, "extkey_attcode"=>"ticket_id", "target_attcode"=>"ref", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("contact_id", array("targetclass"=>"Contact", "jointype"=>null, "allowed_values"=>null, "sql"=>"contact_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("contact_name", array("allowed_values"=>null, "extkey_attcode"=>"contact_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ticket_id', 'contact_id'));
		MetaModel::Init_SetZListItems('advanced_search', array('ticket_id', 'contact_id'));
		MetaModel::Init_SetZListItems('standard_search', array('ticket_id', 'contact_id'));
		MetaModel::Init_SetZListItems('list', array('ticket_id', 'contact_id'));
	}
}
class lnkTicketToCI extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,ticketing",
			"key_type" => "autoincrement",
			"name_attcode" => "ticket_id",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnktickettoci",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("ticket_id", array("targetclass"=>"Ticket", "jointype"=>null, "allowed_values"=>null, "sql"=>"ticket_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ticket_ref", array("allowed_values"=>null, "extkey_attcode"=>"ticket_id", "target_attcode"=>"ref", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("ci_id", array("targetclass"=>"FunctionalCI", "jointype"=>null, "allowed_values"=>null, "sql"=>"ci_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_name", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("ci_status", array("allowed_values"=>null, "extkey_attcode"=>"ci_id", "target_attcode"=>"status", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('ticket_id', 'ci_id', 'ci_status'));
		MetaModel::Init_SetZListItems('advanced_search', array('ticket_id', 'ci_id'));
		MetaModel::Init_SetZListItems('standard_search', array('ticket_id', 'ci_id'));
		MetaModel::Init_SetZListItems('list', array('ticket_id', 'ci_id', 'ci_status'));
	}
}
class Incident extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,incidentmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "status",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "incident",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('Assigned,Closed,New,Resolved,WorkInProgress'), "sql"=>"status", "default_value"=>"New", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("customer_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"customer_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("customer_name", array("allowed_values"=>null, "extkey_attcode"=>"customer_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("category_id", array("targetclass"=>"ServiceType", "jointype"=>null, "allowed_values"=>null, "sql"=>"category_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("category_name", array("allowed_values"=>null, "extkey_attcode"=>"category_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("service_id", array("targetclass"=>"Service", "jointype"=>null, "allowed_values"=>null, "sql"=>"service_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("service_name", array("allowed_values"=>null, "extkey_attcode"=>"service_id", "target_attcode"=>"servicetype_name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("workgroup_id", array("targetclass"=>"Team", "jointype"=>null, "allowed_values"=>null, "sql"=>"workgroup_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("workgroup_name", array("allowed_values"=>null, "extkey_attcode"=>"workgroup_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("agent_id", array("targetclass"=>"Person", "jointype"=>null, "allowed_values"=>null, "sql"=>"agent_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("agent_name", array("allowed_values"=>null, "extkey_attcode"=>"agent_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("agent_email", array("allowed_values"=>null, "extkey_attcode"=>"agent_id", "target_attcode"=>"email", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("caller_id", array("targetclass"=>"Person", "jointype"=>null, "allowed_values"=>null, "sql"=>"caller_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("workgroup_name", array("allowed_values"=>null, "extkey_attcode"=>"caller_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("priority", array("allowed_values"=>new ValueSetEnum('low,medium,high'), "sql"=>"priority", "default_value"=>"medium", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("started", array("allowed_values"=>null, "sql"=>"started", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("closed", array("allowed_values"=>null, "sql"=>"closed", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("last_update", array("allowed_values"=>null, "sql"=>"last_update", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("action_log", array("allowed_values"=>null, "sql"=>"action_log", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeText("resolution", array("allowed_values"=>null, "sql"=>"resolution", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('status', 'customer_id', 'category_id', 'service_id', 'workgroup_id', 'agent_id', 'agent_email', 'caller_id', 'priority', 'started', 'closed', 'last_update', 'action_log', 'resolution'));
		MetaModel::Init_SetZListItems('advanced_search', array('status', 'customer_id', 'category_id', 'service_id', 'workgroup_id', 'agent_id', 'agent_email', 'caller_id', 'priority', 'started', 'closed', 'last_update', 'action_log', 'resolution'));
		MetaModel::Init_SetZListItems('standard_search', array('status', 'customer_id', 'category_id', 'service_id', 'workgroup_id', 'agent_id', 'agent_email', 'caller_id', 'priority', 'started', 'closed', 'last_update', 'action_log', 'resolution'));
		MetaModel::Init_SetZListItems('list', array('status', 'customer_id', 'category_id', 'service_id', 'workgroup_id', 'agent_id', 'agent_email', 'caller_id', 'priority', 'started', 'closed', 'last_update', 'action_log', 'resolution'));
	}
}
class Change extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,changemgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "reason",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "change",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("reason", array("allowed_values"=>null, "sql"=>"reason", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("status", array("allowed_values"=>new ValueSetEnum('Approved,Assigned,Closed,Implemented,Monitored,New,NotApproved,PlannedScheduled,Rejected,Validated'), "sql"=>"status", "default_value"=>"New", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("caller_id", array("targetclass"=>"Person", "jointype"=>null, "allowed_values"=>null, "sql"=>"caller_id", "is_null_allowed"=>true, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("workgroup_name", array("allowed_values"=>null, "extkey_attcode"=>"caller_id", "target_attcode"=>"name", "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("start", array("allowed_values"=>null, "sql"=>"start", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("end", array("allowed_values"=>null, "sql"=>"end", "default_value"=>"", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeDate("last_update", array("allowed_values"=>null, "sql"=>"last_update", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('reason', 'status', 'caller_id', 'start', 'end', 'last_update'));
		MetaModel::Init_SetZListItems('advanced_search', array('reason', 'status', 'caller_id', 'start', 'end', 'last_update'));
		MetaModel::Init_SetZListItems('standard_search', array('reason', 'status', 'caller_id', 'start', 'end', 'last_update'));
		MetaModel::Init_SetZListItems('list', array('reason', 'status', 'caller_id', 'start', 'end', 'last_update'));
	}
}
class UserRequest extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,callmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "foo",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "userrequest",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("foo", array("allowed_values"=>null, "sql"=>"foo", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('foo'));
		MetaModel::Init_SetZListItems('advanced_search', array('foo'));
		MetaModel::Init_SetZListItems('standard_search', array('foo'));
		MetaModel::Init_SetZListItems('list', array('foo'));
	}
}
class Problem extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,problemmgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "foo",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "problem",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("foo", array("allowed_values"=>null, "sql"=>"foo", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('foo'));
		MetaModel::Init_SetZListItems('advanced_search', array('foo'));
		MetaModel::Init_SetZListItems('standard_search', array('foo'));
		MetaModel::Init_SetZListItems('list', array('foo'));
	}
}
class KnownError extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,knownerrormgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "foo",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "knownerror",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("foo", array("allowed_values"=>null, "sql"=>"foo", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('foo'));
		MetaModel::Init_SetZListItems('advanced_search', array('foo'));
		MetaModel::Init_SetZListItems('standard_search', array('foo'));
		MetaModel::Init_SetZListItems('list', array('foo'));
	}
}
class lnkKnownErrorToProblem extends cmdbAbstractObject
{

	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel,searchable,knownerrormgmt",
			"key_type" => "autoincrement",
			"name_attcode" => "foo",
			"state_attcode" => "",
			"reconc_keys" => array("name"),
			"db_table" => "lnkknownerrortoproblem",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("foo", array("allowed_values"=>null, "sql"=>"foo", "default_value"=>"", "is_null_allowed"=>true, "depends_on"=>array())));

		MetaModel::Init_SetZListItems('details', array('foo'));
		MetaModel::Init_SetZListItems('advanced_search', array('foo'));
		MetaModel::Init_SetZListItems('standard_search', array('foo'));
		MetaModel::Init_SetZListItems('list', array('foo'));
	}
}

//////////////////////////////////////////////////////////////////////////////
// Menu:
//   +----------------------------------------+
//   | My Module                              |
//   +----------------------------------------+
//		+ All items
//			+ ...
//			+ ...
////////////////////////////////////////////////////////////////////////////////////
// Create the top-level group. fRank = 1, means it will be inserted after the group '0', which is usually 'Welcome'

$oAdminMenu = new MenuGroup('UI:AdminToolsMenu', 999);
$iAdminGroup = $oAdminMenu->GetIndex();
new OQLMenuNode('Menu:Class:Organization/Name', 'Menu:Class:Organization/Title', 'SELECT Organization', $iAdminGroup, 10 /* fRank */);
new OQLMenuNode('Menu:Class:Application/Name', 'Menu:Class:Application/Title', 'SELECT Application', $iAdminGroup, 20 /* fRank */);

$oToolsMenu = new MenuGroup('UI:AdvancedToolsMenu', 998);
$iToolsGroup = $oToolsMenu->GetIndex();
new WebPageMenuNode('Menu:Audit', '../pages/audit.php', $iToolsGroup, 33 /* fRank */);


$oConfigManagementGroup = new MenuGroup('Menu:ConfigManagement', 1 /* fRank */);

// Create an entry, based on a custom template, for the Configuration management overview, under the top-level group
new TemplateMenuNode('Menu:ConfigManagement/Overview', '../business/templates/configuration_management_menu.html', $oConfigManagementGroup->GetIndex(), 0 /* fRank */);


$oContactNode = new TemplateMenuNode('Menu:Class:Contact/Name', '../business/templates/contacts_menu.html', $oConfigManagementGroup->GetIndex(), 1 /* fRank */);
new OQLMenuNode('Menu:Class:Person/Name', 'Menu:Class:Person/Title', 'SELECT Person', $oContactNode->GetIndex(), 1 /* fRank */);
new OQLMenuNode('Menu:Class:Team/Name', 'Menu:Class:Team/Title', 'SELECT Team', $oContactNode->GetIndex(), 2 /* fRank */);

new OQLMenuNode('Menu:Class:FileDoc/Name', 'Menu:Class:FileDoc/Title', 'SELECT FileDoc', $oConfigManagementGroup->GetIndex(), 2 /* fRank */);
new OQLMenuNode('Menu:Class:Location/Name', 'Menu:Class:Location/Title', 'SELECT Location', $oConfigManagementGroup->GetIndex(), 3 /* fRank */);


$oCINode = new TemplateMenuNode('Menu:ConfigManagement:CI', '../business/templates/configuration_items_menu.html', $oConfigManagementGroup->GetIndex(), 2 /* fRank */);

new OQLMenuNode('Menu:Class:BusinessProcess/Name', 'Menu:Class:BusinessProcess/Title', 'SELECT BusinessProcess', $oCINode->GetIndex(), 0 /* fRank */);
new OQLMenuNode('Menu:Class:ApplicationSolution/Name', 'Menu:Class:ApplicationSolution/Title', 'SELECT ApplicationSolution', $oCINode->GetIndex(), 1 /* fRank */);

$oSWNode = new TemplateMenuNode('Menu:ConfigManagement:Software', '', $oCINode->GetIndex(), 2 /* fRank */);
new OQLMenuNode('Menu:Class:Licence/Name', 'Menu:Class:Licence/Title', 'SELECT Licence', $oSWNode->GetIndex(), 0 /* fRank */);
new OQLMenuNode('Menu:Class:Patch/Name', 'Menu:Class:Patch/Title', 'SELECT Patch', $oSWNode->GetIndex(), 1 /* fRank */);
new OQLMenuNode('Menu:Class:ApplicationInstance/Name', 'Menu:Class:ApplicationInstance/Title', 'SELECT ApplicationInstance', $oSWNode->GetIndex(), 2 /* fRank */);
new OQLMenuNode('Menu:Class:DatabaseInstance/Name', 'Menu:Class:DatabaseInstance/Title', 'SELECT DatabaseInstance', $oSWNode->GetIndex(), 3 /* fRank */);

$oHWNode = new TemplateMenuNode('Menu:ConfigManagement:Hardware', '', $oCINode->GetIndex(), 3 /* fRank */);
new OQLMenuNode('Menu:Class:Subnet/Name', 'Menu:Class:Subnet/Title', 'SELECT Subnet', $oHWNode->GetIndex(), 0 /* fRank */);
new OQLMenuNode('Menu:Class:NetworkDevice/Name', 'Menu:Class:NetworkDevice/Title', 'SELECT NetworkDevice', $oHWNode->GetIndex(), 1 /* fRank */);
new OQLMenuNode('Menu:Class:Server/Name', 'Menu:Class:Server/Title', 'SELECT Server', $oHWNode->GetIndex(), 2 /* fRank */);
new OQLMenuNode('Menu:Class:Printer/Name', 'Menu:Class:Printer/Title', 'SELECT Printer', $oHWNode->GetIndex(), 3 /* fRank */);
new OQLMenuNode('Menu:Class:MobilePhone/Name', 'Menu:Class:MobilePhone/Title', 'SELECT MobilePhone', $oHWNode->GetIndex(), 4 /* fRank */);
new OQLMenuNode('Menu:Class:PC/Name', 'Menu:Class:PC/Title', 'SELECT PC', $oHWNode->GetIndex(), 5 /* fRank */);




?>
