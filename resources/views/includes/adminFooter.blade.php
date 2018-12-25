	</div>
  </div>
</main>
<footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
  <span>Vsure Consulting</span>
    </footer>
  </div>
</div>

<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/vendor.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/bundle.js"></script>
<script src="<?php echo asset('/public/vendor');?>/select2/js/select2.min.js" type="text/javascript"></script>
<script src="<?php echo asset('/public/vendor');?>/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo asset('/'); ?>/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="<?php echo asset('/'); ?>/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/admin-script.js"></script>
<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/admin-script-form.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=u5p3cf64j8j7wp09b9a0ljapn7aoinn4n3lqx10cwp9pefmn"></script>
<script>
tinymce.init({
  selector: '.textarea',
  height: 500,
  theme: 'modern',
  plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
</script>
<script>
   // $('.textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".multiSelect").select2();
	});
</script>
</body>

</html>