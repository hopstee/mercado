<?php if (isset($conversation) and !empty($conversation)): ?>
<div class="modal fade" id="replyTo{{ $conversation->id }}" tabindex="-1" role="dialog" aria-labelledby="replyTo{{ $conversation->id }}Label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-dif">
				<h4 class="modal-title" id="replyTo{{ $conversation->id }}Label">
				@if (auth()->user()->id == $conversation->to_user_id)
					{{ t('Reply to') . ' "' . $conversation->from_name . '"' }}
				@else
					{{ t('Reply to') . ' "' . $conversation->to_name . '"' }}
				@endif
				</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="unir-close"></i></span></button>
			</div>
			<form role="form" method="POST" action="{{ lurl(trans('routes.v-conversations-reply',['id'=>$conversation->id])) }}">
				{!! csrf_field() !!}
				<div class="modal-body enable-long-words modal-body-dif">
					@if (isset($errors) and $errors->any())
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

							<ul class="list list-error">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<!-- message -->
					<?php $messageError = (isset($errors) and $errors->has('message')) ? ' is-invalid' : ''; ?>
					<div class="form-group required">
						<label for="message" class="control-label">
							{{ t('Message') }} <sup>*</sup>
						</label>
						<textarea id="message"
								  name="message"
								  class="form-control required{{ $messageError }}"
								  placeholder="{{ t('Message...') }}"
								  rows="5"
								  maxlength="6000"
						>{{ old('message') }}</textarea>
						<small id="textarea-feedback" class="form-text text-muted"></small>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="submit" class="btn btn-default pull-right btn-dif btn-green">{{ t('Send') }}</button>
					<button type="button" class="btn btn-default btn-default-dif btn-modal btn-grey" data-dismiss="modal">{{ t('Cancel') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif; ?>

@section('after_scripts')
	@parent
	
	@if (isset($conversation) and !empty($conversation))
	<script>
		$(document).ready(function () {
			@if ($errors->any())
				$('#replyTo{{ $conversation->id }}').modal();
			@endif
		});
		var textarea_max = 6000;
		$("#textarea-feedback").html(textarea_max + "{{ t('characters left') }}");
		$('#message').keyup(function() {
			var textarea_length = $('#message').val().length,
					textarea_remaining = textarea_max - textarea_length;

			if (textarea_length === 0) {
				$('#textarea-feedback').html(textarea_max + "{{ t('characters left') }}");
			} else {
				$('#textarea-feedback').html(textarea_remaining + "{{ t('characters left') }}");
			}
		});
	</script>
	@endif
@endsection