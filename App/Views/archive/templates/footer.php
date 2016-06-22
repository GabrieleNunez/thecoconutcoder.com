					<div class="push"></div>
				</div>
				<div class="footer row">
					<div class="medium-12 columns">
						<p>Copyright &copy; <?php echo date('Y',time()); ?> TheCoconutCoder</p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var lqImages = [<?php echo isset($lqImages) ?  '"'.implode('","', $lqImages).'"' : '';  ?>];
			var hqImages = [<?php echo isset($hqImages) ?  '"'.implode('","', $hqImages).'"' : ''; ?>];
		</script>
		<script type="text/javascript" src="/js/vendor/jquery.js"></script>
		<script type="text/javascript" src="/js/foundation.min.js"></script>
		<script type="text/javascript" src="/js/foundation/foundation.topbar.js"></script>
		<script type="text/javascript" src="/js/global.js"></script>
	</body>
</html>
