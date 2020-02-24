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

			<div class="row clearfix mid-position">

				@if (isset($errors) and $errors->any())
					<div class="col-md-12">
						<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="unir-close"></i></button>
							<h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5> -->
							<ul class="list list-error">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>

                    @if (Session::has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif
				@endif

				<div class="col-md-8">
					<div class="inner-box category-content category-content-dif col-dif">

                        <div class="card card-default">
                            <div class="ads-header">
                                <h3>
                                    <strong> {{ t('This user has been banned.') }} </strong>
                                </h3>
                            </div>

                            <form role="form" method="POST" action="{{ lurl( trans('routes.v-unban-request', ['phone'=>$phone]),$phone) }}">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <div class="card-body">
                                        <!-- phone -->
                                        <div class="form-group required">
                                            <span> 
                                                {!! t('By tap "Send request" you want to unban account with phone number ') !!}
                                                <label for="phone" class="control-label" style="margin-bottom: 0px;">{{ $phone }}</label>.
                                                {!! t('We will process your request in next 48 hours. For any questions send message in Contact Us page.') !!}
                                            </span>
                                            <div class="input-group">
                                                <input id="phone" name="phone" type="hidden" value="{{ $phone }}">
                                            </div>
                                        </div>

                                        <!-- email -->
                                        @if (auth()->check() and isset(auth()->user()->email))
                                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                        @else
                                        <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                                            <input  name="email" type="hidden" maxlength="33" class="form-control{{ $emailError }}" value="banned@unifun.com">
                                        @endif

                                        @include('layouts.inc.tools.recaptcha', ['label' => true])
                                        <input type="hidden" name="abuseForm" value="1">

                                        <div class="form-group form-group-dif">
                                            <button type="submit" class="btn btn-green btn-lg btn-dif btn-rep"  style="padding: 0px;">{{ t('Send request') }}</button>
                                            <a href="{{ rawurldecode(URL::previous()) }}" class="btn btn-default btn-default-dif btn-lg btn-rep btn-grey">{{ t('Back') }}</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('after_scripts')
	<script src="{{ url('assets/js/form-validation.js') }}">
	</script>
@endsection
