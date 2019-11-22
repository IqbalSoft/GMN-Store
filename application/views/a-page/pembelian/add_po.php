<?= form_open_multipart('pembelian/add'); ?>
<input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
<div class="modal-body">
  <label for="title">Choose file PO : <i class="text-warning">type file docx, pdf, xlsx</i></label>
  <div class="input-group">
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="file" id="inputGroupFile04">
      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Upload <i class="fa fa-upload"></i></button>
</div>
</form>