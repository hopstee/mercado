{{--
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
--}}
@extends('layouts.master')

@section('content')
	@include('common.spacer')
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				@if (Session::has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif
				
				<div class="col-md-3 page-sidebar">
					@include('account.inc.sidebar')
				</div>
				<!--/.page-sidebar-->
				
				<div class="col-md-9 page-content">
					<div class="inner-box inner-box-dif">
						<h2 class="title-2 title-2-mob"> {{ t('Conversations') }} </h2>
						
						<div style="clear:both"></div>
						
						<?php
						if (isset($conversation) && !empty($conversation) > 0):
						
							// Conversation URLs
							$consUrl = lurl(trans('routes.conversations'));
							$conDelAllUrl = lurl(trans('routes.v-pers-conversations-delete-id',['id'=>$conversation->id]));
						?>
						<div class="table-responsive">
							<form name="listForm" method="POST" action="{{ $conDelAllUrl }}">
								{!! csrf_field() !!}
{{--								<div class="table-action table-action-dif">--}}
{{--									<label for="checkAll" class="btn-archive">--}}
{{--										<button type="submit" class="btn btn-sm btn-default delete-action btn-default-cab">--}}
{{--											{{ t('Ignore') }}--}}
{{--										</button>--}}
{{--									</label>--}}
{{--									<div class="table-search pull-right col-sm-7 table-search-cab">--}}
{{--										<div class="form-group">--}}
{{--											<div class="row row-dif">--}}
{{--												<label class="col-sm-5 control-label text-right">{{ t('Search') }} <br>--}}
{{--													<a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>--}}
{{--												</label>--}}
{{--												<div class="col-sm-7 searchpan padding-2 search-mob">--}}
{{--													<input type="text" class="form-control" id="filter" placeholder="Search">--}}
{{--												</div>--}}
{{--												<div class="flexcol-button padding-2">--}}
{{--													<button class="btn btn-block btn-primary">--}}
{{--														<img src="/images/search.svg">--}}
{{--													</button>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</div>--}}

								<?php
									$link = substr($conversation->message, stripos($conversation->message, "| http") + 2);
									$mes = substr($conversation->message, 0, stripos($conversation->message, " |"));
								?>

								<table id="addManageTable" class="table table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
									<thead>
									<tr>
										<th class="message-header" data-sort-ignore="true" colspan="3">
											<a href="{{ $consUrl }}"><i class="unib-larrow"></i> {{ t('Back') }}</a> &nbsp;|&nbsp;
											{{ t("Conversation") }} #{{ $conversation->id }} &nbsp;|&nbsp;
											<a href="{{ $link }}">{{ $conversation->subject }}</a>
										</th>
									</tr>
									</thead>
									<tbody>
									<!-- Main Conversation -->
									<tr>
										<td colspan="3">
											<strong>{{ t("Sender's Name") }}:</strong> {{ $conversation->from_name ?? 'Unregistered user' }}<br>
											<!-- R.S -->
											<!-- <strong>{{ t("Sender's Email") }}:</strong> {{ $conversation->from_email ?? '--' }}<br> -->
											<strong>{{ t("Sender's Phone") }}:</strong> {{ $conversation->from_phone ?? '--' }}<br>
											<hr>
{{--											{!! nl2br($conversation->message) !!}--}}
											{{ $mes }}
											@if (!empty($conversation->filename) and $disk->exists($conversation->filename))
												<br><br><a class="btn btn-info" href="{{ fileUrl($conversation->filename) }}">{{ t('Download') }}</a>
													{{ t('Reply') }}
												</a>
											@endif
										</td>
									</tr>
									<!-- All Conversation's Messages -->
									<?php
									if (isset($messages) && $messages->count() > 0):
										foreach($messages as $key => $message):
									?>
									<tr>
										@if ($message->from_user_id == auth()->user()->id)
{{--											<td class="add-img-selector cel-borderless">--}}
{{--												<div class="checkbox" style="width:2%">--}}
{{--													<label><input type="checkbox" name="entries[]" value="{{ $message->id }}"></label>--}}
{{--												</div>--}}
{{--											</td>--}}
											<td class="cel-borderless reply-message" style="width:94%;">
												<div style="word-break:break-word;">
													<strong>
														<!-- <i class="unir-arrow_top"></i> {{ $message->from_name . ' (' . $message->created_at->formatLocalized(config('settings.app.default_datetime_format')) . ')' }}: -->
														<i class="unir-arrow_top"></i> {{ $message->from_name . ' (' . date('d M Y H:i', strtotime($message->created_at)) . ')' }}:
													</strong><br>
{{--													{!! nl2br($mes) !!}--}}
													{{ substr($message->message, 0, stripos($message->message, " |")) }}
													@if (!empty($message->filename) and $disk->exists($message->filename))
														<br><br><a class="btn btn-info" href="{{ fileUrl($message->filename) }}">{{ t('Download') }}</a>
													@endif
												</div>
											</td>
{{--											<td class="action-td" style="width:10%">--}}
{{--												<div>--}}
{{--													<p>--}}
														<?php $conDelUrl = lurl('account/conversations/' . $conversation->id . '/messages/' . $message->id . '/delete'); ?>
{{--														<a class="btn btn-danger btn-sm delete-action" href="{{ $conDelUrl }}">--}}
{{--															<i class="fa fa-trash"></i> {{ t('Delete') }}--}}
{{--														</a>--}}
{{--													</p>--}}
{{--												</div>--}}
{{--											</td>--}}
										@else
											<td colspan="3">
												<div style="word-break:break-word;">
													<strong>
														<!-- <i class="unir-arrow_top"></i> {{ $message->from_name . ' (' . $message->created_at->formatLocalized(config('settings.app.default_datetime_format')) . ')' }}: -->
														<i class="unir-arrow_top"></i> {{ $message->from_name . ' (' . date('d M Y H:i', strtotime($message->created_at)) . ')' }}:
													</strong><br>
{{--													{!! nl2br($message->message) !!}--}}
													{{ substr($message->message, 0, stripos($message->message, " |")) }}
													@if (!empty($message->filename) and $disk->exists($message->filename))
														<br><br><a class="btn btn-info" href="{{ fileUrl($message->filename) }}">{{ t('Download') }}</a>
													@endif
												</div>
											</td>
										@endif
									</tr>
									<?php endforeach; ?>
									<?php endif; ?>
									</tbody>
								</table>
								<div class="conversation-delete-btn">
									<button type="submit" class="btn btn-default btn-default-cab btn-grey btn-delete">
										{{ t('Delete') }}
									</button>
								</div>
								
								@if (isset($messages) && $messages->count() > 0)
{{--								<div class="table-action">--}}
{{--									<label for="checkAll">--}}
{{--										<input type="checkbox" id="checkAll">--}}
{{--										{{ t('Select') }}: {{ t('All') }} |--}}
{{--										<button type="submit" class="btn btn-sm btn-default delete-action btn-default-cab">--}}
{{--											<i class="fa fa-trash"></i> {{ t('Delete') }}--}}
{{--										</button>--}}
{{--									</label>--}}
{{--								</div>--}}
								@endif
								
							</form>
						</div>
						
						<nav>
							{{ (isset($messages)) ? $messages->links() : '' }}
						</nav>
						<?php endif; ?>
						
						<div style="clear:both"></div>
					
					</div>
				</div>
				<!--/.page-content-->
				
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->
	
	@if (isset($conversation) && $conversation->count() > 0)
		@include('account.inc.reply-message')
	@endif

@endsection

@section('after_scripts')
	<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$(function () {
			$('#addManageTable').footable().bind('footable_filtering', function (e) {
				var selected = $('.filter-status').find(':selected').text();
				if (selected && selected.length > 0) {
					e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
					e.clear = !e.filter;
				}
			});
			
			$('.clear-filter').click(function (e) {
				e.preventDefault();
				$('.filter-status').val('');
				$('table.demo').trigger('footable_clear_filter');
			});
			
			$('#checkAll').click(function () {
				checkAll(this);
			});
			
			$('a.delete-action, button.delete-action').click(function(e)
			{
				e.preventDefault(); /* prevents the submit or reload */
				var confirmation = confirm("{{ t('confirm_this_action') }}");

				if (confirmation) {
					if( $(this).is('a') ){
						var url = $(this).attr('href');
						if (url !== 'undefined') {
							redirect(url);
						}
					} else {
						$('form[name=listForm]').submit();
					}
				}

				return false;
			});
		});
	</script>
	<!-- include custom script for ads table [select all checkbox]  -->
	<script>
		function checkAll(bx) {
			var chkinput = document.getElementsByTagName('input');
			for (var i = 0; i < chkinput.length; i++) {
				if (chkinput[i].type == 'checkbox') {
					chkinput[i].checked = bx.checked;
				}
			}
		}
	</script>
@endsection