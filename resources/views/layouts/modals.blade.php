        
<!-- error modal -->
<div class="modal fade show" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" bis_skin_checked="1">
      <div class="modal-content text-center" bis_skin_checked="1">
        <div class="modal-header bg-danger text-white d-flex justify-content-center" bis_skin_checked="1" style="background-image: linear-gradient(to right, #ff6a00, #ee0979);">
          <h5 class="modal-title" id="exampleModalLabel">Error!</h5>
        </div>
        <div class="modal-body" bis_skin_checked="1">
          <h1 style="color:red;font-size: 22px;"><span id="error-text"></span></h1>
        </div>
        <div class="modal-footer d-flex justify-content-center" bis_skin_checked="1">
          <button type="button" style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;" class="btn btn-danger btn-block" onclick="$('#errorModal').fadeOut()">Close</button>
          <!--<button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">-->
          <!--  Yes-->
          <!--</button>-->
        </div>
      </div>
    </div>
</div>

<!-- success modal -->
<div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" bis_skin_checked="1">
      <div class="modal-content text-center" bis_skin_checked="1">
        <div class="modal-header bg-success text-white d-flex justify-content-center" bis_skin_checked="1" style="background-image: linear-gradient(to right, #ff6a00, #ee0979);">
          <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
        </div>
        <div class="modal-body" bis_skin_checked="1">
          <h1 style="color:red;font-size: 22px;"><span id="success-text"></span></h1>
        </div>
        <div class="modal-footer d-flex justify-content-center" bis_skin_checked="1">
          <button type="button" style="background-image: linear-gradient(to right, #ff6a00, #ee0979);color: #fff;" class="btn btn-danger btn-block" onclick="$('#successModal').fadeOut()">Close</button>
          <!--<button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">-->
          <!--  Yes-->
          <!--</button>-->
        </div>
      </div>
    </div>
</div>

<!-- add new bank modal -->
<div class="modal fade" id="newBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <!--<div class="modal-header" style="background: #190C25;">-->
                <!--<h5 class="modal-title" id="exampleModalLabel">{{ __('fund.addnew') }}</h5>-->
            <!--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
            <!--        <span aria-hidden="true">&times;</span>-->
            <!--    </button>-->
            <!--</div>-->
            <div class="modal-body" style="background: #190C25;">
                <div class="form-group">
                    <label for="email">{{ __('fund.bank') }} *</label>
                    <select class="form-control" id="new-bank-name">
                        <option value="Maybank">Maybank</option>
                        <option value="Public Bank Berhad">Public Bank Berhad</option>
                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                        <option value="CIMB Bank">CIMB Bank</option>
                        <option value="RHB Bank">RHB Bank</option>
                        <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                        <option value="Alliance Bank Malaysia Berhad">Alliance Bank Malaysia Berhad</option>
                        <option value="Bank Simpanan Nasional">Bank Simpanan Nasional</option>
                        <option value="HSBC Malaysia">HSBC Malaysia</option>
                        <option value="AmBank">AmBank</option>
                        <option value="United Overseas Bank">United Overseas Bank</option>
                        <option value="Bank Islam Malaysia">Bank Islam Malaysia</option>
                        <option value="Agrobank">Agrobank</option>
                        <option value="Bank Rakyat">Bank Rakyat</option>
                        <option value="OCBC Bank">OCBC Bank</option>
                        <option value="Citibank">Citibank</option>
                        <option value="Bank of China (Malaysia)">Bank of China (Malaysia)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('fund.accno') }} *</label>
                    <input type="number" id="new-bank-accNo" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer" style="background: #190C25;">
                <button type="button" class="header-form-btn grad-gold glow pull-right" data-dismiss="modal">{{ __('profile.close') }}</button>
                <button type="button" class="header-form-btn grad-purple glow pull-right" onclick="addNewBank()" id="add-new-bank-button">{{ __('profile.save') }}</button>
            </div>
        </div>
    </div>
</div>