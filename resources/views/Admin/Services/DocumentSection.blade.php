<div class="form-group col-md-12">
  <h2>Document Section</h2>                    
  <div class="form-group col-md-12">
    <label for="document_title">Title</label>
    <input type="text" class="form-control" id="document_title" name="service_documents[title]" value="<?php echo (isset($service_documents['title'])?$service_documents['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="document_terms">Terms</label>
    <select name="service_documents[terms][]" id="document_terms" multiple="" class="form-control select2-multiple multiSelect">
      <option value="">Select Term</option>
      <?php
        foreach ($documentTerms as $documentTerm) {
          echo "<option value='".$documentTerm->term_id."' ".(isset($service_documents['terms']) && is_array($service_documents['terms']) && in_array($documentTerm->term_id, $service_documents['terms'])?"selected":"").">".$documentTerm->term_title."</option>";
        }
      ?>
    </select>
  </div>
</div>