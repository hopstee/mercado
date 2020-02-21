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

@section('wizard')
    @if( !auth()->check() )
        @include('layouts.alert_warning')
    @endif
    @include('post.createOrEdit.multiSteps.inc.wizard')
@endsection

@section('content')
	@include('common.spacer')
    <div class="main-container">
        <div class="container deletedPhoto">
            <div class="row">


                <div id="deletedPhoto">
                </div>


                @include('post.inc.notification')

                <div class="col-md-12 page-content top-card">
                    <div class="inner-box category-content-dif">
<!-- 
{{--                        <h2 class="title-2"><strong><i class="icon-camera-1"></i> {{ t('Photos') }}</strong></h2>--}}
                        <h2 class="title-2 title-2-dif">
                            <strong></i> {{ t('Photos') }}</strong>
                        </h2> -->

                        <div class="row">
                            <div class="col-md-8">
                                {{--<h2 class="title-2"><strong><i class="icon-camera-1"></i> {{ t('Photos') }}</strong></h2>--}}
{{--                                <h2 class="title-2 title-2-dif">--}}
{{--                                    <strong></i> {{ t('Photos') }}</strong>--}}
{{--                                </h2>--}}
                                <form class="form-horizontal" id="postForm" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <fieldset>
                                        <div class="col-xl-12 col-xl-12-dif">
                                            @if (isset($picturesLimit) and is_numeric($picturesLimit) and $picturesLimit > 0)
                                                <!-- Pictures -->
                                                <?php $picturesError = (isset($errors) and $errors->has('pictures')) ? ' is-invalid' : ''; ?>
    {{--                                                <div id="picturesBloc" class="form-group row">--}}

                                                    <!-- <div class="ads-header">
                                                        <h3>
                                                            <strong> {{ t('Add photo') }} </strong>
                                                        </h3>
                                                    </div> -->

                                                    <div class="inner-ads-box inner-ads-box-dif">
        {{--                                                    <div class="col-md-8"></div>--}}
                                                        <div class="col-md-12 text-center pt-2 col-md-12-dif" style="position: relative; float: {!! (config('lang.direction')=='rtl') ? 'left' : 'right' !!};">
                                                            <div {!! (config('lang.direction')=='rtl') ? 'dir="rtl"' : '' !!} class="file-loading">
                                                                <input title=" " id="pictureField" name="pictures[]" type="file" multiple class="file picimg{{ $picturesError }}">
                                                            </div>
                                                            <small id="add-photo-text" class="form-text text-muted">
                                                                {{ t('Add up to :pictures_number pictures. Use real pictures of your product, not catalogs.', [
                                                                    'pictures_number' => $picturesLimit
                                                                ]) }}
                                                            </small>
                                                        </div>
        {{--                                                </div>--}}
                                                    </div>
                                            @endif
                                            <div id="uploadError mt-2" style="display: none;"></div>
                                            <div id="uploadSuccess" class="alert alert-success fade show mt-2" style="display: none;"></div>
                                            <!-- Button -->
                                            <div class="form-group row mt-4">
                                                <div class="col-md-12 text-center">
                                                    <!-- @if (getSegment(2) != 'create')
                                                        <a href="{{ lurl('posts/' . $post->id . '/edit') }}" class="btn btn-default btn-default-dif">{{ t('Previous') }}</a>
                                                    @endif -->
                                                    <a id="nextStepAction" href="{{ url($nextStepUrl) }}" class="btn btn-default btn-lg btn-default-dif">{{ t('Skip') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- N.M. -->
                            <div class="col-md-4 page-content">
                                <div class="help-block">
                                    <h3 class="title-3 py-3">{{ t('Help links') }}</h3>
                                    <div class="text-content text-left from-wysiwyg">                                        
                                        <h4><a href="{{ lurl(trans('routes.v-page',['slug'=>trans('routes.terms-of-use')])) }}">{{ t('Terms of Use') }}</a></h4>
                                        <h4><a href="{{ lurl(trans('routes.v-page',['slug'=>trans('routes.privacy-policy')])) }}">{{ t('Privacy Policy') }}</a></h4>
                                        <h4><a href="{{ lurl(trans('routes.v-page',['slug'=>trans('routes.posting-rules')])) }}">{{ t('Posting Rules') }}</a></h4>
                                        <h4><a href="{{ lurl(trans('routes.v-page',['slug'=>trans('routes.tips')])) }}">{{ t('Tips for Users') }}</a></h4>
                                        <h4><a href="{{ lurl(trans('routes.v-page',['slug'=>trans('routes.faq')])) }}">{{ t('FAQ') }}</a></h4>
                                        <h4><a href="{{ lurl(trans('routes.sitemap')) }}">{{ t('Sitemap') }}</a></h4> 
                                        <h4><a href="{{ lurl(trans('routes.contact-us'))}}">{{ t('Contact Us') }}</a></h4> 
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-md-4">
                                <div class="help-block" style="margin-top:35px;">
                                    <div class="text-content text-left from-wysiwyg">
                                        <h4>{{ t('Register text') }}</h4>
                                    </div>
                                </div>
                                <div class="help-block">
                                    <h3 class="text-center">{{ t('Help links') }}</h3>
                                    <div class="text-content text-left from-wysiwyg">
                                        <h4><a href="{{ lurl('page/about')}}" >{{ t('About Mercado.gratis') }}</a></h4>
                                        <h4><a href="{{ lurl('page/acсount')}}" >{{ t('Managing Account & Ads') }}</a></h4>
                                        <h4><a href="{{ lurl('page/safety')}}" >{{ t('Safety Tips') }}</a></h4>
                                        <h4><a href="{{ lurl('page/fastsell')}}" >{{ t('How to sell fast') }}</a></h4>
                                        <h4><a href="{{ lurl('page/report')}}" >{{ t('Report a suspicious user or add') }}</a></h4>
                                        <h4><a href="{{ lurl('page/fraudvictim')}}" >{{ t('If you become a victim of fraud') }}</a></h4>
                                        <h4><a href="{{ lurl('page/terms-conditions')}}" >{{ t('Terms and Conditions') }}</a></h4>
                                        <h4><a href="{{ lurl('page/feedback')}}" >{{ t('Contact Us') }}</a></h4>
                                    </div>
                                </div>
                            </div> -->
                            
                        </div>
                    </div>
                </div>
                <!-- /.page-content -->
            </div>
        </div>
    </div>
@endsection

@section('after_styles')
    <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
	@if (config('lang.direction') == 'rtl')
		<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
	@endif
    <style>
        .krajee-default.file-preview-frame:hover:not(.file-preview-error) {
            box-shadow: 0 0 5px 0 #666666;
        }
		.file-loading:before {
			content: " {{ t('Loading') }}...";
		}
    </style>
@endsection

@section('after_scripts')
    <script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
    @if (file_exists(public_path() . '/assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js'))
        <script src="{{ url('assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js') }}" type="text/javascript"></script>
    @endif
    <script>
        /* Initialize with defaults (pictures) */
        @if (isset($post, $picturesLimit) and is_numeric($picturesLimit) and $picturesLimit > 0)
        <?php
            // Get Upload Url
            if (getSegment(2) == 'create') {
                $uploadUrl = lurl('posts/create/' . $post->tmp_token . '/photos/');
            } else {
                // $uploadUrl = lurl('posts/' . $post->id . '/photos/');
                $uploadUrl = lurl(trans('routes.v-posts-photos', ['id'=>$post->id]),$post->id);

            }

        ?>
            $('#pictureField').fileinput(
            {
				theme: "fa",
                language: '{{ config('app.locale') }}',
				@if (config('lang.direction') == 'rtl')
					rtl: true,
				@endif
                overwriteInitial: false,
                showCaption: false,
                showPreview: true,
                allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
				uploadUrl: '{{ $uploadUrl }}',
                uploadAsync: false,
				showBrowse: true,
				showCancel: true,
				showUpload: false,
                showZoom: false,
				showRemove: false,
				minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
                maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
                browseOnZoneClick: true,
                minFileCount: 0,
                maxFileCount: {{ (int)$picturesLimit }},
                validateInitialCount: true,
                fileActionSettings: {
                    showDrag: true,
                    showZoom: false,
                    removeIcon: '<i class="far fa-trash-alt" style="color: black;"></i>',
                    indicatorNew: '<i class="fas fa-check-circle" style="color: #09c509;font-size: 20px;margin-top: -15px;display: block;"></i>'
                },
                @if (isset($post->pictures))
                /* Retrieve current images */
                /* Setup initial preview with data keys */
                initialPreview: [
                @for($i = 0; $i <= $picturesLimit-1; $i++)
                    @continue(!$post->pictures->has($i) or !isset($post->pictures->get($i)->filename))
                    '{{ imgUrl($post->pictures->get($i)->filename) }}',
                @endfor
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                /* Initial preview configuration */
                initialPreviewConfig: [
                @for($i = 0; $i <= $picturesLimit-1; $i++)
                    @continue(!$post->pictures->has($i) or !isset($post->pictures->get($i)->filename))
                    <?php
                        // Get the file path
                        $filePath = $post->pictures->get($i)->filename;

                        // Get the file's deletion URL
                        if (getSegment(2) == 'create') {
                            $initialPreviewConfigUrl = lurl('posts/create/' . $post->tmp_token . '/photos/' . $post->pictures->get($i)->id . '/delete');
                        } else {
                            $initialPreviewConfigUrl = lurl('posts/' . $post->id . '/photos/' . $post->pictures->get($i)->id . '/delete');
                        }

                        // Get the file size
                        try {
                            $fileSize = (isset($disk) && $disk->exists($filePath)) ? (int)$disk->size($filePath) : 0;
                        } catch (\Exception $e) {
                            $fileSize = 0;
                        }
                    ?>
                    {
                        caption: '{{ last(explode(DIRECTORY_SEPARATOR, $filePath))}}',
                        size: {{ $fileSize }},
                        url: '{{ $initialPreviewConfigUrl }}',
						key: {{ (int)$post->pictures->get($i)->id }}
                    },
                @endfor
                ],
                @endif
                
                /* elErrorContainer: '#uploadError', */
				/* msgErrorClass: 'file-error-message', */ /* @todo: depreciated. */

				uploadClass: 'btn btn-success'
            });
        @endif

		/* Auto-upload added file */
		$('#pictureField').on('filebatchselected', function(event, data, id, index) {
			if (typeof data === 'object') {
				{{--
					Display the exact error (If it exists (Before making AJAX call))
					NOTE: The index '0' is available when the first file size is smaller than the maximum size allowed.
					      This index does not exist in the opposite case.
				--}}
				if (data.hasOwnProperty('0')) {
                    $(this).fileinput('upload');
					return true;
				}
			}

			return false;
		});

		/* Show upload status message */
        $('#pictureField').on('filebatchpreupload', function(event, data, id, index) {
            $('#uploadSuccess').html('<ul></ul>').hide();
        });

		/* Show success upload message */
        $('#pictureField').on('filebatchuploadsuccess', function(event, data, previewId, index) {
            /* Show uploads success messages */
            var out = '';
            $.each(data.files, function(key, file) {
                if (typeof file !== 'undefined') {
                    var fname = file.name;
                    out = out + "{!! t('File uploaded successfully') !!}";
                }
            });
            $('#uploadSuccess ul').append(out);
            $('#uploadSuccess').fadeIn('slow');

            /* Change button label */
            {{--$('#nextStepAction').html('{{ $nextStepLabel }}').removeClass('btn-default').addClass('btn-primary');--}}

            // location.reload();

            /* Check redirect */
            var maxFiles = {{ (isset($picturesLimit)) ? (int)$picturesLimit : 1 }};
            var oldFiles = {{ (isset($post) and isset($post->pictures)) ? $post->pictures->count() : 0 }};
            var newFiles = Object.keys(data.files).length;
            var countFiles = oldFiles + newFiles;
            if (countFiles >= maxFiles) {
                var nextStepUrl = '{{ url($nextStepUrl) }}';
                redirect(nextStepUrl);
            }
        });

        var paramsR ;

		/* Reorder (Sort) files */
		$('#pictureField').on('filesorted', function(event, params) {
            paramsR = params;
            picturesReorder(params);
		});

		/* Delete picture */
        $('#pictureField').on('filepredelete', function(jqXHR) {
            var abort = false;
            {{--if (confirm("{{ t('Are you sure you want to delete this picture?') }}")) {--}}
            {{--    abort = false;--}}
            {{--}--}}
            return abort;
        });

        
		// R.S
        if($(".kv-file-content .file-preview-image.kv-preview-data").length > 0){
            var nextBtn = "{!! t('Finish') !!}";
            $("#nextStepAction").html(nextBtn);
            $("#nextStepAction").attr("class","btn btn-default btn-default-dif next-green");
        }


		var modalDeletePhoto = false;
        var url;

        //  open modal window

        $(".kv-file-remove").on("click", function(){
            // location.reload();
            url = $(this).attr("data-url");
            // console.log("click del");
            deletePostPhoto()
            // $(".user-info-modal").attr("style","display:block;");
            // $('.menu-overly-mask').addClass('is-visible');
            // modalDeletePhoto = true;
            // var text = "  {{ t('Are you sure you want to delete this picture?') }}";
            // $( ".modal-text" ).text("");
            // $( ".modal-text" ).prepend( "<div style='margin-bottom: 15px !important;'>"+  text +
            //         "<span class='modalClose'>x</span>"+
            //     "</div>"+
            //     "<div class='modal-chose'>" +
            //             "<button onclick='deletePostPhoto()' type='submit' class='kv-file-remove btn btn-sm btn-kv btn-default btn-outline-secondary'>{{ ('Delete') }}</button>"+
            //     "</div>" +
            //     "<div class='modal-cancel'>"+
            //         "<button class='kv-file-remove btn btn-sm btn-kv btn-default btn-outline-secondary' id='cancelDelPhoto'>{{ t('Cancel') }}</button>"+
            //     "</div>"
            // );

            // //hide modal
            // $(".user-modal-content").on("click",function(){
            //         modalDeletePhoto = false;
            // });

            // $(".user-info-modal").on("click", function(){

            //     if(modalDeletePhoto === true){
            //         $(".user-info-modal").attr("style","display:none;");
            //         modalDeletePhoto = false;
            //         $('.menu-overly-mask').removeClass('is-visible');
            //     }
            // });
            
            // $(".modalClose").on("click", function(){
            //     $(".user-info-modal").attr("style","display:none;");
            //     $('.menu-overly-mask').removeClass('is-visible');
            //     modalDeletePhoto = false;
            // });

            // $("#cancelDelPhoto").on("click", function(){
            //     $(".user-info-modal").attr("style","display:none;");
            //     $('.menu-overly-mask').removeClass('is-visible');
            //     modalDeletePhoto = false;
            // });
        });

        var successText = "{{ t('Your photo or avatar has been deleted.') }}";

        // on delete
        function deletePostPhoto( ){
            console.log("In delete post photo");
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    'params': paramsR,
                    '_token': $('input[name=_token]').val()
                }
            }).done(function(data) {
                
                $( "#deletedPhoto" ).prepend( "<div class='col-xl-12'><div class='row'><div class='col-xl-12'><div class='alert alert-success' role='alert'>" +
                                                    successText +
                                                "</div></div></div></div>"
                                            );      
                setTimeout(() => {
                    location.reload();
                },400);
             }) ;
        }

        // R.S
        var modalChangePos = false;

		/**
		 * Reorder (Sort) pictures
		 * @param params
		 * @returns {boolean}
		 */
		function picturesReorder(params)
		{
			if (typeof params.stack === 'undefined') {
				return false;
			}

            // waitingDialog.show('{{ t('Processing') }}...');

			$.ajax({
				method: 'POST',
				url: siteUrl + '/ajax/post/pictures/reorder',
				data: {
					'params': params,
					'_token': $('input[name=_token]').val()
				}
			}).done(function(data) {

                // waitingDialog.hide();

				if (typeof data.status === 'undefined') {
					return false;
				}

				return false;
            }).error(function(data) {
                $('.modal-text').text("");
                $('.modal-text').append('{{ t('Something wrong') }}');
                    
                    
                setTimeout(() => {
                    $(".user-info-modal").attr("style","display:none;");
                    modalChangePos = false;
                    $('.menu-overly-mask').removeClass('is-visible');
                    $('.modal-text').text("13");
                }, 400);
            });
            
			return false;
		}
    </script>

@endsection
