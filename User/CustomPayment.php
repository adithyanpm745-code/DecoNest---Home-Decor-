<?php
include("../Assets/Connection/Connection.php");
session_start();

$selC= "select * from tbl_customization where customization_id ='". $_GET["cid"]. "'";
$res=$con->query($selC);
$data=$res->fetch_assoc();

if(isset($_POST["btn_payment"]))
{
	$up = "update tbl_customization set customization_status = 3 where customization_id=".$_GET["cid"];
	if($con->query($up))
	{
		?>
		<script>
        window.location="Loader.html";
        </script>
		<?php
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .payment-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 800px;
        width: 100%;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .payment-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .payment-header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .payment-header p {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .payment-body {
        padding: 40px;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .payment-method {
        border: 2px solid #e1e5e9;
        border-radius: 15px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .payment-method:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }

    .payment-method.active {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    }

    .payment-method i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .payment-method.card i { color: #4285f4; }
    .payment-method.upi i { color: #ff6b35; }
    .payment-method.cod i { color: #28a745; }

    .payment-method h3 {
        font-size: 1.2rem;
        margin-bottom: 8px;
        color: #333;
    }

    .payment-method p {
        color: #666;
        font-size: 0.9rem;
    }

    .payment-form {
        display: none;
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-top: 20px;
    }

    .payment-form.active {
        display: block;
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid #e1e5e9;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .total-amount {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        margin: 25px 0;
    }

    .total-amount h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        opacity: 0.9;
    }

    .total-amount .amount {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .payment-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .payment-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .payment-btn:active {
        transform: translateY(0);
    }

    .payment-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e1e5e9;
    }

    .payment-icons i {
        font-size: 2.5rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .payment-icons i:hover {
        opacity: 1;
    }

    .fa-cc-visa { color: #1a1f71; }
    .fa-cc-mastercard { color: #eb001b; }
    .fa-cc-paypal { color: #003087; }

    .upi-info {
        text-align: center;
        padding: 20px;
    }

    .qr-placeholder {
        width: 200px;
        height: 200px;
        background: #f0f0f0;
        border: 2px dashed #ccc;
        border-radius: 15px;
        margin: 20px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .cod-info {
        text-align: center;
        padding: 20px;
    }

    .cod-info i {
        font-size: 4rem;
        color: #28a745;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .payment-container {
            margin: 10px;
        }
        
        .payment-body {
            padding: 20px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .payment-header h1 {
            font-size: 2rem;
        }
    }
</style>

<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1><i class="fas fa-credit-card"></i> Payment Gateway</h1>
            <p>Choose your preferred payment method</p>
        </div>
        
        <div class="payment-body">
            <form action="" method="post" id="paymentForm">
                <!-- Payment Method Selection -->
                <div class="payment-methods">
                    <div class="payment-method card active" onclick="selectPaymentMethod('card')">
                        <i class="fas fa-credit-card"></i>
                        <h3>Card Payment</h3>
                        <p>Pay securely with your debit/credit card</p>
                    </div>
                    
                    <div class="payment-method upi" onclick="selectPaymentMethod('upi')">
                        <i class="fab fa-google-pay"></i>
                        <h3>UPI Payment</h3>
                        <p>Pay instantly using UPI apps</p>
                    </div>
                    
                    <!-- <div class="payment-method cod" onclick="selectPaymentMethod('cod')">
                        <i class="fas fa-truck"></i>
                        <h3>Cash on Delivery</h3>
                        <p>Pay when your order is delivered</p>
                    </div>
                </div> -->

                <!-- Card Payment Form -->
                <div id="cardForm" class="payment-form active">
                    <h4 style="margin-bottom: 20px; color: #333;"><i class="fas fa-credit-card"></i> Card Details</h4>
                    
                    <div class="form-group">
                        <label for="credit-card">Card Number</label>
                        <input type="text" class="form-control" id="credit-card" name="txtacno" 
                               placeholder="1234 5678 9012 3456" maxlength="19" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="card-name">Cardholder Name</label>
                        <input type="text" class="form-control" id="card-name" name="txtname" 
                               placeholder="Enter cardholder name" pattern="[a-zA-z ]{3,50}" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="credit-card-exp">Expiry Date</label>
                            <input type="text" class="form-control" id="credit-card-exp" name="txtexpdate" 
                                   placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="credit-card-ccv">CVV</label>
                            <input type="text" class="form-control" id="credit-card-ccv" name="txtccv" 
                                   placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>

                <!-- UPI Payment Form -->
                <div id="upiForm" class="payment-form">
                    <div class="upi-info">
                        <h4 style="margin-bottom: 20px; color: #333;"><i class="fab fa-google-pay"></i> UPI Payment</h4>
                        <!-- <div class="qr-placeholder">
                            <i class="fas fa-qrcode" style="font-size: 3rem; color: #ccc; margin-bottom: 10px;"></i>
                            <p style="color: #666;">QR Code will appear here</p>
                        </div> -->
                        <!-- <p style="margin: 20px 0; color: #666;">Scan the QR code with any UPI app or enter UPI ID manually</p> -->
                        
                        <div class="form-group" style="max-width: 300px; margin: 0 auto;">
                            <label for="upi-id">Enter UPI ID </label>
                            <input type="text" class="form-control" id="upi-id" name="upi_id" 
                                   placeholder="yourname@upi" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+" required>
                        </div><br>
                        <div class="form-group" style="max-width: 300px; margin: 0 auto;">
                            <label for="upi-id">Enter Your Phone Number </label>
                            <input type="text" class="form-control" id="upi-id" name="upi_id" 
                            title="Phone number with 6-9 and remaining 9 digits with 0-9"
                                   placeholder="+91 9876543210" pattern="[6-9]{1}[0-9]{9}" required>
                                   <!-- //minlength="10" maxlength="15"> -->
                        </div>
                        
                        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                            <i class="fab fa-google-pay" style="font-size: 2rem; color: #4285f4;"></i>
                            <i class="fas fa-mobile-alt" style="font-size: 2rem; color: #ff6b35;"></i>
                            <i class="fab fa-amazon-pay" style="font-size: 2rem; color: #ff9900;"></i>
                        </div>
                    </div>
                </div>
                <!-- <div class="upi-section" id="upiSection">
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fab fa-google-pay"></i>
                            UPI Payment
                        </h3>
                        
                        <div class="form-group">
                            <label for="upiId">UPI ID</label>
                            <input type="text" id="upiId" name="txtupi"
                                   placeholder="yourname@paytm" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+">
                            <div class="error-message" id="upiIdError"></div>
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="txtphone" required
                                   placeholder="+91 9876543210" pattern="[+]?[0-9]{10,15}" 
                                   minlength="10" maxlength="15">
                            <div class="error-message" id="phoneError"></div>
                        </div>

                        <div class="upi-apps">
                            <div class="upi-app phonepe" title="PhonePe">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="upi-app googlepay" title="Google Pay">
                                <i class="fab fa-google-pay"></i>
                            </div>
                            <div class="upi-app paytm" title="Paytm">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Cash on Delivery Form -->
                <!-- <div id="codForm" class="payment-form">
                    <div class="cod-info">
                        <h4 style="margin-bottom: 20px; color: #333;"><i class="fas fa-truck"></i> Cash on Delivery</h4>
                        <i class="fas fa-hand-holding-usd"></i>
                        <h3 style="color: #28a745; margin: 20px 0;">Pay on Delivery</h3>
                        <p style="color: #666; line-height: 1.6;">
                            Your order will be delivered to your doorstep. 
                            You can pay in cash when you receive your order.
                        </p>
                        <div style="background: #d4edda; border: 1px solid #c3e6cb; border-radius: 10px; padding: 15px; margin: 20px 0; color: #155724;">
                            <i class="fas fa-info-circle"></i>
                            <strong>Note:</strong> Please keep the exact amount ready for faster delivery.
                        </div>
                    </div>
                </div> -->

                <!-- Total Amount -->
                <div class="total-amount">
                    <h3>Total Amount</h3>
                    <div class="amount">₹<?php echo number_format($data["customization_amount"], 2); ?></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="payment-btn" name="btn_payment" id="paymentBtn">
                    <i class="fas fa-lock"></i> Complete Payment
                </button>

                <!-- Payment Icons -->
                <div class="payment-icons">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-google-pay"></i>
                    <i class="fas fa-shield-alt" style="color: #28a745;"></i>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        let selectedPaymentMethod = 'card';

        function selectPaymentMethod(method) {
            // Update selected method
            selectedPaymentMethod = method;
            
            // Update active payment method
            document.querySelectorAll('.payment-method').forEach(el => el.classList.remove('active'));
            document.querySelector('.payment-method.' + method).classList.add('active');
            
            // Show corresponding form
            document.querySelectorAll('.payment-form').forEach(form => form.classList.remove('active'));
            document.getElementById(method + 'Form').classList.add('active');
            
            // Update button text
            const btn = document.getElementById('paymentBtn');
            switch(method) {
                case 'card':
                    btn.innerHTML = '<i class="fas fa-credit-card"></i> Pay with Card';
                    // Enable form validation for card
                    setCardFormRequired(true);
                    setCardFormRequired(false, 'upi');
                    break;
                case 'upi':
                    btn.innerHTML = '<i class="fab fa-google-pay"></i> Pay with UPI';
                    // Disable card form validation
                    setCardFormRequired(false);
                    break;
                case 'cod':
                    btn.innerHTML = '<i class="fas fa-truck"></i> Confirm Order (COD)';
                    // Disable card form validation
                    setCardFormRequired(false);
                    break;
            }
        }

        function setCardFormRequired(required) {
            const cardInputs = ['credit-card', 'card-name', 'credit-card-exp', 'credit-card-ccv'];
            cardInputs.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.required = required;
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const creditCardInput = document.getElementById("credit-card");
            const creditCardExp = document.getElementById("credit-card-exp");
            const creditCardCcv = document.getElementById("credit-card-ccv");

            if (creditCardInput) {
                creditCardInput.addEventListener("input", function () {
                    const inputValue = this.value.replace(/\D/g, '');
                    const formattedValue = formatCreditCard(inputValue);
                    this.value = formattedValue;
                });
            }

            if (creditCardExp) {
                creditCardExp.addEventListener("input", function () {
                    const inputValue = this.value.replace(/\D/g, '');
                    const formattedValue = formatExpirationDate(inputValue);
                    this.value = formattedValue;
                });

                creditCardExp.addEventListener("change", function () {
                    const inputValue = this.value.replace(/\D/g, '');
                    validateExpirationDate(inputValue);
                });
            }

            if (creditCardCcv) {
                creditCardCcv.addEventListener("input", function () {
                    const inputValue = this.value.replace(/\D/g, '');
                    const formattedValue = formatCVV(inputValue);
                    this.value = formattedValue;
                });
            }
        });

        function formatCreditCard(value) {
            const groups = value.match(/(\d{1,4})/g) || [];
            return groups.join(' ');
        }

        function formatExpirationDate(value) {
            const groups = value.match(/(\d{1,2})/g) || [];
            return groups.join('/').slice(0, 5);
        }

        function formatCVV(value) {
            return value.slice(0, 3);
        }

        function validateExpirationDate(inputValue) {
            const month = inputValue.slice(0, 2);
            const year = inputValue.slice(2, 4);

            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() % 100;
            const currentMonth = currentDate.getMonth() + 1;

            const isValidMonth = /^\d{2}$/.test(month) && parseInt(month, 10) >= 1 && parseInt(month, 10) <= 12;
            const isValidYear = /^\d{2}$/.test(year) && parseInt(year, 10) >= currentYear;

            let isValidDate = false;

            if (isValidMonth && isValidYear) {
                const expYear = parseInt(year, 10);
                const expMonth = parseInt(month, 10);

                if (expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth)) {
                    isValidDate = true;
                }
            }

            if (!isValidDate) {
                alert('Invalid expiration date');
                document.getElementById("credit-card-exp").value = '';
            }
        }

        // Form submission handling
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            if (selectedPaymentMethod === 'upi') {
                // For UPI, you might want to show a confirmation dialog
                const confirmPayment = confirm('Please confirm that you have completed the UPI payment');
                if (!confirmPayment) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    </script>
</body>

</html>