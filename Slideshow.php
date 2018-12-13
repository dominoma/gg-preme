<link rel="stylesheet" href="slide/css/base.css">
<link rel="stylesheet" href="slide/css/pure_slide.min.css">
<script src="slide/js/base.min.js"></script>
<script src="slide/js/PureSlider.min.js"></script>
<?php

	function RegisterSlideShow($SlidesID){
		echo "
			
			<script>
			  
			    var ps = new PureSlider(
			            {
			                autoplay: true,
			                showNav: true, showBtn:false,
			                direction: 'forward',
			                laps: 4000,
			                onBeforeStartCb: function (ps) {
			                    //console.log('start');
			                },
			                onBeforeSlideChangeCb: function (ps) {
			                    //console.log('before slide change');
			                },
			                onAfterSlideChangeCb: function (ps) {
			                    //console.log('after slide change');
			                    //console.log(ps.vars.currentSlide);
			                },
			                onBeforeStopCb: function (ps) {
			                    //console.log(ps.vars.interval);
			                },
			                onAfterStopCb: function (ps) {
			                    //console.log(ps.vars.interval);
			                }
			            }
			            );
			    ps.init(document.querySelector('#$SlidesID'));
	   
			</script>
		";
	}
?>