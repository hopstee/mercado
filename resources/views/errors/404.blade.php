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
@extends('errors.layouts.master')

@section('title', t('Page not found', []))

@section('search')
	@parent
	@include('errors/layouts/inc/search')
@endsection

@section('content')
	@if (!(isset($paddingTopExists) and $paddingTopExists))
		<div class="h-spacer"></div>
	@endif
	<div class="main-container inner-page cel-image">
		<div class="container">
			<div class="section-content">
				<div class="row">

					<div class="col-md-12 page-content">
						<div class="error-page" style="margin: 50px 0px 100px 0px;">
							<img id="errorImage" src="{{ url('images/errors/404.svg') }}">
							<h2 class="headline text-center" > 404</h2>
							<div class="text-center m-l-0" style="margin-top:  5%;">
								<h3 class="m-t-0">{{ t('Page not found') }}!</h3>
								<p>
									<?php
									$defaultErrorMessage = t('Return to <a href="/">homepage</a>');
									?>
									{!! isset($exception) ? ($exception->getMessage() ? $exception->getMessage() : $defaultErrorMessage) : $defaultErrorMessage !!}
								</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /.main-container -->
@endsection
