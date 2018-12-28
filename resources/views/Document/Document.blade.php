<h2>My Documents</h2>
	<div class="content-main">
	<div class="upload-btn">
		<a href="javascript:void(0);" id="uploadDocumentButton">+</a>
		<p>Add Document</p>
	</div>
	<div class="col-lg-12">
		@if (Session::has('success'))
          <div class="alert alert-info">{{ Session::get('success') }}</div>
    	<?php Session::forget('success') ?>
        @endif
        @if (Session::has('warning'))
          <div class="alert alert-warning">{{ Session::get('warning') }}</div>
          <style type="text/css">
          	#uploadDocumentModal{
          		display: block !important;
          	}
          </style>
    	<?php Session::forget('warning') ?>
        @endif
        @if (Session::has('error'))
          <div class="alert alert-danger">{{ Session::get('error') }}</div>
          <style type="text/css">
          	#uploadDocumentModal{
          		display: block !important;
          	}
          </style>
    		<?php Session::forget('error') ?>
        @endif
	</div>
	<div class="col-lg-12 col-xs-12" id="uploadDocumentModal" style="display: none;">
		<div class="row">
			<div class="col-md-4">
				<?php echo Form::open(array('url' => 'user/upload/document', 'method' => 'post','files'=>true)) ?>
					<div class="form-group">
						<label>Select Document Type</label>
						<select name="type" id="type" class="form-control" required="">
							<option value="">Select</option>
							<option value="Aadhar Card">Aadhar Card</option>
							<option value="Drivery Licence">Drivery Licence</option>
						</select>
					</div>
					<div class="form-group">
						<label>File</label>
						<input type="file" name="file" id="file" accept="image/*" required="">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-success" value="Upload">
					</div>
					<p>All documents should be self attested</p>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-xs-12">
	   	<div class="row">
	   		<?php 
	   		if (!empty($documents)) {
	   			foreach ($documents as $document) {
	   				?>
   					<div class="documents-page-document-main col-lg-3 col-md-6 col-sm-6 col-xs-12">
   						<img src="<?php echo asset('/'.$document->file); ?>">
   						<p class="document-name"><?php echo $document->type ?></p>
   						<a class="document-date"><?php echo date('M, d Y h:i A', strtotime($document->created_at)); ?></a>
   						<a href="<?php echo url('user/delete/uploaded/document/'.$document->u_document_id) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
   					</div>
	   				<?php
	   			}
	   		}
	   		?>
	   	</div>
	</div>
</div>
