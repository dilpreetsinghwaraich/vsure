<div class="form-group col-md-12">
  <h2>Document Section</h2>                    
  <div class="form-group col-md-12">
    <label for="document_title">Title</label>
    <input type="text" class="form-control" id="document_title" name="service_documents[title]" value="<?php echo (isset($service_documents['title'])?$service_documents['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="document_ids">Documents</label>
    <select name="service_documents[document_ids][]" id="document_ids" multiple="" class="form-control select2-multiple">
      <option value="">Select Documents</option>
      <?php 
      $document_ids = (isset($service_documents['document_ids']) && !empty($service_documents['document_ids'])?$service_documents['document_ids']:[]);
      $documents = DB::table('documents')->whereIn('document_id', $document_ids)->get()->toArray();
      if (!empty($documents)) {
        foreach ($documents as $document) {
          echo '<option value="'.$document->document_id.'" selected>'.$document->document_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>