<div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" name="cardNumber" id="cardNumber"
                            placeholder="Enter Card Number" required>

                        <?php if(in_array($cardNumberLength, $errors1)): ?>
                        <div class="text-danger">
                        <?php echo $cardNumberLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="cardHolderName">Card Holder Name</label>
                        <input type="text" class="form-control" name="cardHolderName" id="cardHolderName"
                            placeholder="Enter Card Holder's Name" required>

                        <?php if(in_array($cardHolderNameLength, $errors1)): ?>
                        <div class="text-danger">
                        <?php echo $cardHolderNameLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="securityCode">Security Code</label>
                        <input type="text" class="form-control" name="securityCode" id="securityCode"
                            placeholder="Enter the security code" required>

                        <?php if(in_array($securityCodeLength, $errors1)): ?>
                        <div class="text-danger">
                        <?php echo $securityCodeLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="billingAddress">Billing Address</label>
                        <input type="text" class="form-control" name="billingAddress" id="billingAddress"
                            placeholder="Enter billing address" required>
                        <?php if(in_array($billingAddressLength, $errors1)): ?>
                        <div class="text-danger">
                        <?php echo $billingAddressLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="pay"  class="btn btn-success btn-lg btn-block">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
