<?php
/**
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Admin;

use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\ReportsRequest as StoreRequest;
use App\Http\Requests\Admin\ReportsRequest as UpdateRequest;

class ReportsController extends PanelController
{
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\ReportSend');
		$this->xPanel->setRoute(admin_uri('reports'));
		$this->xPanel->setEntityNameStrings(trans('admin::messages.reports'), trans('admin::messages.reports'));
		$this->xPanel->orderBy('id', 'ASC');
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_delete_btn', 'bulkDeleteBtn', 'end');
		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
			'name'  => 'id',
			'label' => '',
			'type'  => 'checkbox',
			'orderable' => false,
		]);
		$this->xPanel->addColumn([
			'name'  => 'post_id',
			'label' => '',
			'label' => trans("admin::messages.Post id"),
		]);
		$this->xPanel->addColumn([
			'name'  => 'user_id',
			'label' => '',
			'label' => trans("admin::messages.User Id"),
		]);
		$this->xPanel->addColumn([
			'name'  => 'report_type_id',
			'label' => trans("admin::messages.reason"),
			'type'          => 'model_function',
			'function_name' => 'getNameHtml',
		]);
		$this->xPanel->addColumn([
			'name'  => 'from_phone',
			'label' => '',
			'label' => trans("admin::messages.From Phone"),
		]);
		$this->xPanel->addColumn([
			'name'  => 'from_email',
			'label' => '',
			'label' => trans("admin::messages.From Email"),
		]);
		$this->xPanel->addColumn([
			'name'  => 'report_at',
			'label' => '',
			'label' => trans("admin::messages.Report At"),
		]);

		// FIELDS
		$this->xPanel->addField([
			'name'  => 'post_id',
			'label' => trans('admin::messages.Post id'),
			'type'  => 'text',
		]);
		$this->xPanel->addField([
			'name'  => 'report_type_id',
			'label' => trans('admin::messages.Report type'),
			'type'  => 'text',
		]);
		$this->xPanel->addField([
			'name'  => 'from_phone',
			'label' => trans('admin::messages.From Phone'),
			'type'  => 'text',
		]);
		$this->xPanel->addField([
			'name'  => 'from_email',
			'label' => trans('admin::messages.From Email'),
			'type'  => 'text',
		]);
		$this->xPanel->addField([
			'name'  => 'report_at',
			'label' => trans('admin::messages.Report At'),
			'type'  => 'text',
		]);
		$this->xPanel->addField([
			'name'  => 'user_id',
			'label' => trans("admin::messages.User Id"),
			'type'  => 'text',
		]);
			
		}

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}
	
	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
