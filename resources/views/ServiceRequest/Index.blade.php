<section id="feature" class="vsure-company-details-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
  <div class="text-center">
    <div class="logedin-notifications-page">
      <div class="row">
        <div class="col-lg-3 col-xs-12 sidebar office-details-sidebar"> 
          <a class="active serviceRequestLeftSidebarNavTab" href="#company_name">Company Name</a> 
          <a class="serviceRequestLeftSidebarNavTab" href="#company_details">Company Details</a> 
          <a class="serviceRequestLeftSidebarNavTab" href="#company_office_address">Office address</a> 
          <a class="serviceRequestLeftSidebarNavTab" href="#company_key_people">Key people</a> 
          <a class="serviceRequestLeftSidebarNavTab" href="#company_submit_document">Submit Documents</a> 
          <a class="serviceRequestLeftSidebarNavTab" href="#company_deliverables">Deliveriables</a> 
        </div>
        <div class="col-lg-9 col-xs-12 content office-details-content">          
          <form class="vsure-company-page-forms-main form-horizontal">
            <?php echo view('ServiceRequest.companyName'); ?>
            <?php echo view('ServiceRequest.companyDetails'); ?>
            <?php echo view('ServiceRequest.companyOfficeAddress'); ?>
            <?php echo view('ServiceRequest.companyKeyPeople'); ?>
            <?php echo view('ServiceRequest.companySubmitDocument'); ?>
            <?php echo view('ServiceRequest.companyDeliveriables'); ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>