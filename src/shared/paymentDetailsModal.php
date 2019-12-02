<div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form target="event-page.php" action="https://www.paypal.com/cgi-bin/webscr" method="post">
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
                    </div>
                    <div class="form-group">
                        <label for="cardHolderName">Card Holder Name</label>
                        <input type="text" class="form-control" name="cardHolderName" id="cardHolderName"
                            placeholder="Enter Card Holder's Name" required>
                    </div>
                    <div class="form-group">
                        <label for="securityCode">Security Code</label>
                        <input type="text" class="form-control" name="securityCode" id="securityCode"
                            placeholder="Enter the 3 digits security code" required>
                    </div>
                    <div class="form-group">
                        <label for="billingAddress">Billing Address</label>
                        <input type="text" class="form-control" name="billingAddress" id="billingAddress"
                            placeholder="Enter billing address" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="Check out with PayPal" >
                </div>
            </form>
        </div>
    </div>
</div>
