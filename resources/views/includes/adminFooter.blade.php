	</div>
  </div>
</main>
<footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
  <span>Vsure Consulting</span>
    </footer>
  </div>
</div>

<script src="<?php echo asset('/public'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/vendor.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/bundle.js"></script>
<script src="<?php echo asset('/public/vendor');?>/select2/js/select2.min.js" type="text/javascript"></script>
<script src="<?php echo asset('/public/vendor');?>/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo asset('/'); ?>/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="<?php echo asset('/'); ?>/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/admin-script.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/admin-script-form.js"></script>
<script>
    $('.textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".multiSelect").select2();
	});
</script>
</body>

</html>