<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <?php flash('prop_message'); ?>
    <div class="col-md-6 mx-auto mb-4">
        <div class="card bg-light mt-5">
            <div class="card-header card-text text-center">
                <h2 class="card-text">Add Your Property</h2>
                <p class="card-text">Please fill out all the fields to share the property details</p>
            </div>
            <div id="show-notification"></div>
            <div class="card-body">
                <form action="<?php echo URLROOT ;?>/props/store" id="form">
                    <div class="form-group">
                        <label for="name">Amount<sup>*</sup></label>
                        <input type="number" name="amount" id="amount" min="1" class="form-control form-control-lg <?php if(isset($data['amount_err'])) echo (!empty($data['amount_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['amount_err'])) echo $data['amount'] ;?>">
                        <span class="invalid-feedback"><?php if(isset($data['amount_err'])) echo $data['amount_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Buyer Name<sup>*</sup></label>
                        <input type="text" name="buyer_name" id="buyer_name" onkeyup="validate('buyer_name')" class="form-control form-control-lg <?php if(isset($data['buyer_name_err'])) echo (!empty($data['buyer_name_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['buyer_name_err'])) echo $data['buyer_name'] ;?>">
                        <span class="invalid-feedback buyer_name"><?php if(isset($data['buyer_name_err'])) echo $data['buyer_name_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="email">Buyer Email<sup>*</sup></label>
                        <input type="buyer_email" name="buyer_email" id="buyer_email" onkeyup="validate('buyer_email')" class="form-control form-control-lg <?php if(isset($data['buyer_email_err'])) echo (!empty($data['buyer_email_err'])) ? 'is-invalid' : '' ;?>" value="<?php if(isset($data['buyer_email_err'])) echo $data['buyer_email'] ;?>">
                        <span class="invalid-feedback buyer_email"><?php if(isset($data['buyer_email_err'])) echo $data['buyer_email_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Receipt ID<sup>*</sup></label>
                        <input type="text" name="receipt_id" id="receipt_id" onkeyup="validate('receipt_id')" class="form-control form-control-lg <?php if(isset($data['receipt_id_err'])) echo (!empty($data['receipt_id_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['receipt_id_err'])) echo $data['receipt_id'] ;?>">
                        <span class="invalid-feedback receipt_id"><?php if(isset($data['receipt_id_err'])) echo $data['receipt_id_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Items<sup>*</sup></label>
                        <input type="text" name="items" id="items" onkeyup="validate('items')" class="form-control form-control-lg <?php if(isset($data['items_err'])) echo (!empty($data['items_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['items_err'])) echo $data['items'] ;?>">
                        <span class="invalid-feedback items"><?php if(isset($data['items_err'])) echo $data['items_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Note</label>
                        <textarea name="note" id="note" cols="30" rows="5" onkeyup="validate('note')" class="form-control"><?php if(isset($data['note_err'])) echo $data['note'] ?></textarea>
                        <span class="invalid-feedback note"><?php if(isset($data['note_err'])) echo $data['note_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">City<sup>*</sup></label>
                        <input type="text" name="city" id="city" onkeyup="validate('city')" class="form-control form-control-lg <?php if(isset($data['city_err'])) echo (!empty($data['city_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['city_err'])) echo $data['city'] ;?>">
                        <span class="invalid-feedback city"><?php if(isset($data['city_err'])) echo $data['city_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Phone<sup>*</sup></label>
                        <input type="number" name="phone" id="phone" onkeyup="validate('phone')" class="form-control form-control-lg <?php if(isset($data['phone_err'])) echo (!empty($data['phone_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['phone_err'])) echo $data['phone'] ;?>">
                        <span class="invalid-feedback phone"><?php if(isset($data['phone_err'])) echo $data['phone_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">Entry By<sup>*</sup></label>
                        <input type="number" name="entry_by" id="entry_by" min="1" class="form-control form-control-lg <?php if(isset($data['entry_by_err'])) echo (!empty($data['entry_by_err'])) ? 'is-invalid' : '' ;?>" required value="<?php if(isset($data['entry_by_err'])) echo $data['entry_by'] ;?>">
                        <span class="invalid-feedback entry_by"><?php if(isset($data['entry_by_err'])) echo $data['entry_by_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-success btn-block pull-left" id="form_submit"><i class="fas fa-paper-plane"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>