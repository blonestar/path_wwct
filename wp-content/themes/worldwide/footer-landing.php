	<footer class="container-wrapper medium-gray-wrapper ">
		<div class="container">
			<div>
				<div class="col-md-6 noLeftOrRightPadding">
					<span>&copy; Worldwide Clinical Trials 2017</span>
				</div>
				<div class="col-md-6 noLeftOrRightPadding">

				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</footer>

	<?php echo get_field('tracking_codes_footer', 'option'); ?>

	<?php
		
		//conditional tracking codes
		
		//tawk.io
		if(!is_page(4219) && $post->post_parent != 4219 ) {

	?>
	
	<!--Start of Tawk.to Script-->
	
	<script type="text/javascript">
	
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	
	(function(){
	
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	
	s1.async=true;
	
	s1.src='https://embed.tawk.to/57eebdbabb785b3a47d141ae/default';
	
	s1.charset='UTF-8';
	
	s1.setAttribute('crossorigin','*');
	
	s0.parentNode.insertBefore(s1,s0);
	
	})();
	
	</script>
	
	<!--End of Tawk.to Script-->

	<?php		
		}
		//end tawk.io

	?>
	
	<?php wp_footer() ?>

</body>
</html>