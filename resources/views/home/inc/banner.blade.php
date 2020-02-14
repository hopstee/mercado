
@include('home.inc.spacer')

	<!-- banner -->

	@if(isset($bigBanners))
		<div class="container"  id="desktopBanner">
			<div class="banner-home">
				<div class="owl-carousel owl-theme owl-loaded owl-drag">
					<div class="owl-stage-outer">
						<div class="owl-stage">
							@foreach($bigBanners as $banner)
								<div class="owl-item">
									<div class="item">
										<a  href="{{  lurl(trans('routes.posts-create')) }}">
											<?php $url = url('storage') . "/" . $banner ;?>
											<img src="{{  $url }}">
										</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
	
	<!-- mobile -->
	@if(isset($smallBanners))
		<div class="container" id="mobileBanner">
			<div class="banner-home">
				<div class="owl-carousel owl-theme owl-loaded owl-drag">
					<div class="owl-stage-outer">
						<div class="owl-stage">
							@foreach($smallBanners as $banner)
								<div class="owl-item">
									<div class="item">
										<a  href="{{  lurl(trans('routes.posts-create')) }}">
										<?php $urlSmall = url('storage') . "/" . $banner ;?>
											<img src="{{  $urlSmall }}">
										</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

@section('after_scripts')
	@parent

		<script>
			$('.owl-carousel').owlCarousel({
				items:1,
				loop:true,
				margin:0,
				dots: false,
				autoplay:true,
				autoplayTimeout:4000,
				autoplayHoverPause:true
			});
			window.addEventListener('resize', function(event){
				if($(document).width() > 575){
					$("#mobileBanner").attr("style", "display: none;");
					$("#desktopBanner").attr("style", "display: block;");
				}
				else{
					$("#desktopBanner").attr("style", "display: none;");
					$("#mobileBanner").attr("style", "display: block;");
				}
			});
			

		</script>

@endsection
