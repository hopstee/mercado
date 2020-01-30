
@if (!isset($user->email))
	<div class="h-spacer"></div>
	<div class="container">
		<div class="row">
			<div class="col-xl-12 email-warning">
				<div class="alert alert-warning">
					<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
					{!! t("! Add e-mail for password recovery.") !!}
				</div>
			</div>
		</div>
	</div>
@endif