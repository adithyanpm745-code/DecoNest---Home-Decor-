<?php
include("../Assets/Connection/Connection.php");

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

if(isset($_GET['bid']))
{
    $_SESSION["bid"] = $_GET['bid'];
}

$selC= "select * from tbl_booking where booking_id ='". $_SESSION["bid"]. "'";
$res=$con->query($selC);
$data=$res->fetch_assoc();

if(isset($_POST["btn_payment"]))
{

    $SelQry = "select * from tbl_booking b
                  INNER JOIN tbl_user u ON b.user_id = u.user_id 
                  INNER JOIN tbl_cart c ON b.booking_id = c.booking_id 
                  INNER JOIN tbl_product p ON c.product_id = p.product_id 
                  INNER JOIN tbl_seller s ON p.seller_id = s.seller_id 
                  where b.user_id='" . $_SESSION["uid"] . "' AND b.booking_id = '" . $_SESSION['bid'] . "'";
    $row = $con->query($SelQry);
    $data = $row->fetch_assoc();

    $email = $data["user_email"];
    $name = $data["user_name"];
    $bookingid = $data["booking_id"];
    $amount = $data["booking_amount"];
    $date = $data["booking_date"];
    $stock = $data["cart_quantity"];
    $product = $data["product_name"];
    $baddress = $data["booking_address"];
    $Nshop = $data["seller_name"];
    $Naddress = $data["seller_address"];
    $Nphone = $data["seller_contact"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'deconest001@gmail.com';
    $mail->Password = 'eymx okcu htcc yvtd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('deconest001@gmail.com', 'DecoNest');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = " Payment Completed - DecoNest";

    $mail->Body = "
    <div style='font-family: Arial, sans-serif; color: #b59c9cff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>
         <h2 style='color: #096014ff;'>Payment successfully Completed</h2>
        <h3>Dear $name,</h3>
        <p>Your payment has been successfully processed, and your booking is now confirmed.<br>
        <p>We’re happy to let you know that your payment of <strong> $amount </strong> for <strong> $product </strong> has been successfully completed on $date.</p>
        
        <div style='font-family: Arial, sans-serif; color: #8b0c0cff; padding: 10px; border: 1px solid #ddd; border-radius: 8px;'>
        <p>Booking ID: $bookingid <br> Quantity : $stock</p>
        </div>
        <div style='font-family: Arial, sans-serif; color: #b83535ff; padding: 10px; border: 1px solid #825e5eff; border-radius: 8px;'>
        <p><h4>Shop Details :<h4> <br> $Nshop <br> $Naddress <br>$Nphone </p>
        </div>

         <div style='font-family: Arial, sans-serif; color: #b83535ff; padding: 10px; border: 1px solid #825e5eff; border-radius: 8px;'>
        <p>Delivery Address : $baddress</p>
        </div><br>

         You will receive further updates on website  it is ready for delivery.</p>
        <p>If you have any questions, feel free to reply to this email or contact our support team.</p>
        <p>Thank you for choosing <strong> DecoNest </strong> 💙</p>
        <br>
        <p>Best regards,<br>Team DecoNest</p>
        <a href='mailto:deconest001@gmail.com' style='color: #337ab7;'>deconest001@gmail.com</a>
        </div>
    ";



    if($mail->send())
    {
        echo "<script>alert('Email Sent');</script>";
    }
    else
    {
        echo "<script>alert('Email Failed');</script>";
    }

    $up = "update tbl_booking set booking_status = 2 where booking_id=".$_SESSION["bid"];
    if($con->query($up))
    {
        echo "<script>
            //alert('You have successfully approved this shop request.');
            window.location = 'Loader.html';
        </script>";
    }


	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-container {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 500px;
        width: 100%;
        position: relative;
    }

    .payment-header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .payment-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="20" cy="80" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }

    .payment-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .payment-header .subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }

    .payment-body {
        padding: 40px 30px;
    }

    .payment-methods {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }

    .payment-method {
        flex: 1;
        padding: 15px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .payment-method:hover {
        border-color: #4f46e5;
        background: #f8fafc;
    }

    .payment-method.active {
        border-color: #4f46e5;
        background: #eef2ff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .payment-method i {
        font-size: 1.5rem;
        margin-bottom: 8px;
        display: block;
    }

    .payment-method span {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        font-size: 0.875rem;
    }

    input[type="text"], input[type="tel"] {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    input[type="text"]:focus, input[type="tel"]:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    input[type="text"].error, input[type="tel"].error {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 4px;
        display: none;
    }

    .amount-display {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 30px;
    }

    .amount-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .amount-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
    }

    .payment-button {
        width: 100%;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .payment-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
    }

    .payment-button:active {
        transform: translateY(0);
    }

    .payment-button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .security-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .payment-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .payment-icons i {
        font-size: 2rem;
        color: #6b7280;
        transition: color 0.3s ease;
    }

    .payment-icons i:hover {
        color: #4f46e5;
    }

    .upi-section, .card-section {
        display: none;
    }

    .upi-section.active, .card-section.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .upi-apps {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }

    .upi-app {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
    }

    .upi-app:hover {
        transform: scale(1.1);
        border-color: #4f46e5;
    }

    .phonepe { background: #5f259f; color: white; }
    .googlepay { background: #4285f4; color: white; }
    .paytm { background: #00baf2; color: white; }

    @media (max-width: 640px) {
        .payment-container {
            margin: 10px;
            border-radius: 16px;
        }
        
        .payment-header {
            padding: 20px;
        }
        
        .payment-header h1 {
            font-size: 2rem;
        }
        
        .payment-body {
            padding: 30px 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-row .form-group {
            margin-bottom: 20px;
        }
    }
</style>

<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1><i class="fas fa-shield-alt"></i> Secure Payment</h1>
            <p class="subtitle">Complete your booking payment</p>
        </div>
        
        <div class="payment-body">
            <form action="" method="post" id="paymentForm">
                <!-- Payment Methods -->
                <div class="payment-methods">
                    <div class="payment-method active" data-method="card">
                        <i class="fas fa-credit-card" style="color: #4f46e5;"></i>
                        <span>Card</span>
                    </div>
                    <div class="payment-method" data-method="upi">
                        <i class="fab fa-google-pay" style="color: #4285f4;"></i>
                        <span>UPI</span>
                    </div>
                </div>

                <!-- Amount Display -->
                <div class="amount-display">
                    <div class="amount-label">Total Amount</div>
                    <div class="amount-value">₹<?php echo number_format($data["booking_amount"], 2); ?></div>
                </div>

                <!-- Card Payment Section -->
                <div class="card-section active" id="cardSection">
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-credit-card"></i>
                            Card Details
                        </h3>
                        
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" id="cardNumber" name="txtacno" required
                                   placeholder="1234 5678 9012 3456" maxlength="19" autocomplete="off">
                            <div class="error-message" id="cardNumberError"></div>
                        </div>

                        <div class="form-group">
                            <label for="cardName">Cardholder Name</label>
                            <input type="text" id="cardName" name="txtname" required
                                   placeholder="John Doe" pattern="[a-zA-Z ]{3,50}" 
                                   minlength="3" maxlength="50" autocomplete="off">
                            <div class="error-message" id="cardNameError"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expDate">Expiry Date</label>
                                <input type="text" id="expDate" name="txtexpdate" required
                                       placeholder="MM/YY" pattern="[0-9/]{5,5}" 
                                       minlength="5" maxlength="5" autocomplete="off">
                                <div class="error-message" id="expDateError"></div>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="txtccv" required
                                       placeholder="123" pattern="[0-9]{3,4}" 
                                       minlength="3" maxlength="4" autocomplete="off">
                                <div class="error-message" id="cvvError"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPI Payment Section -->
                <div class="upi-section" id="upiSection">
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
                </div>

                <button type="submit" name="btn_payment" class="payment-button" id="paymentBtn">
                    <i class="fas fa-lock"></i> Complete Payment
                </button>

                <div class="security-info">
                    <i class="fas fa-shield-alt"></i>
                    <span>Your payment information is secure and encrypted</span>
                </div>

                <div class="payment-icons">
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                    <i class="fab fa-google-pay" title="Google Pay"></i>
                    <i class="fas fa-mobile-alt" title="UPI"></i>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Payment method switching
            const paymentMethods = document.querySelectorAll('.payment-method');
            const cardSection = document.getElementById('cardSection');
            const upiSection = document.getElementById('upiSection');

            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    paymentMethods.forEach(m => m.classList.remove('active'));
                    this.classList.add('active');

                    const methodType = this.getAttribute('data-method');
                    if (methodType === 'card') {
                        cardSection.classList.add('active');
                        upiSection.classList.remove('active');
                        setRequiredFields('card');
                    } else {
                        upiSection.classList.add('active');
                        cardSection.classList.remove('active');
                        setRequiredFields('upi');
                    }
                });
            });

            // Set required fields based on payment method
            function setRequiredFields(method) {
                const cardFields = ['cardNumber', 'cardName', 'expDate', 'cvv'];
                const upiFields = ['phoneNumber'];

                if (method === 'card') {
                    cardFields.forEach(id => document.getElementById(id).required = true);
                    upiFields.forEach(id => document.getElementById(id).required = false);
                } else {
                    upiFields.forEach(id => document.getElementById(id).required = true);
                    cardFields.forEach(id => document.getElementById(id).required = false);
                }
            }

            // Card number formatting
            const cardNumberInput = document.getElementById('cardNumber');
            cardNumberInput.addEventListener('input', function() {
                const value = this.value.replace(/\D/g, '');
                const formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                this.value = formattedValue;
                validateCardNumber(value);
            });

            // Expiry date formatting
            const expDateInput = document.getElementById('expDate');
            expDateInput.addEventListener('input', function() {
                const value = this.value.replace(/\D/g, '');
                const formattedValue = value.replace(/(\d{2})(?=\d)/, '$1/');
                this.value = formattedValue.slice(0, 5);
            });

            expDateInput.addEventListener('blur', function() {
                validateExpiryDate(this.value);
            });

            // CVV formatting
            const cvvInput = document.getElementById('cvv');
            cvvInput.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 4);
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phoneNumber');
            phoneInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 0 && !value.startsWith('91')) {
                    value = '91' + value;
                }
                if (value.length > 12) {
                    value = value.slice(0, 12);
                }
                this.value = '+' + value;
                validatePhone(this.value);
            });

            // UPI ID validation
            const upiInput = document.getElementById('upiId');
            upiInput.addEventListener('blur', function() {
                validateUPI(this.value);
            });

            // Card name validation
            const cardNameInput = document.getElementById('cardName');
            cardNameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                validateCardName(this.value);
            });

            // Validation functions
            function validateCardNumber(number) {
                const isValid = number.length >= 13 && number.length <= 19 && /^\d+$/.test(number);
                showError('cardNumberError', !isValid ? 'Please enter a valid card number' : '');
                return isValid;
            }

            function validateExpiryDate(date) {
                if (!/^\d{2}\/\d{2}$/.test(date)) {
                    showError('expDateError', 'Please enter a valid expiry date (MM/YY)');
                    return false;
                }

                const [month, year] = date.split('/');
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100;
                const currentMonth = currentDate.getMonth() + 1;

                const expMonth = parseInt(month);
                const expYear = parseInt(year);

                if (expMonth < 1 || expMonth > 12) {
                    showError('expDateError', 'Invalid month');
                    return false;
                }

                if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                    showError('expDateError', 'Card has expired');
                    return false;
                }

                showError('expDateError', '');
                return true;
            }

            function validateCardName(name) {
                const isValid = name.length >= 3 && /^[a-zA-Z\s]+$/.test(name);
                showError('cardNameError', !isValid ? 'Please enter a valid name (letters only)' : '');
                return isValid;
            }

            function validateUPI(upiId) {
                if (upiId && !/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+$/.test(upiId)) {
                    showError('upiIdError', 'Please enter a valid UPI ID');
                    return false;
                }
                showError('upiIdError', '');
                return true;
            }

            function validatePhone(phone) {
                const cleanPhone = phone.replace(/\D/g, '');
                const isValid = cleanPhone.length >= 12 && cleanPhone.length <= 13;
                showError('phoneError', !isValid ? 'Please enter a valid phone number' : '');
                return isValid;
            }

            function showError(elementId, message) {
                const errorElement = document.getElementById(elementId);
                const inputElement = errorElement.previousElementSibling;
                
                if (message) {
                    errorElement.textContent = message;
                    errorElement.style.display = 'block';
                    inputElement.classList.add('error');
                } else {
                    errorElement.style.display = 'none';
                    inputElement.classList.remove('error');
                }
            }

            // Form validation before submission
            
            document.getElementById('paymentForm').addEventListener('submit', function(e) {
                const activeMethod = document.querySelector('.payment-method.active').getAttribute('data-method');
                let isValid = true;

                if (activeMethod === 'card') {
                    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const cardName = document.getElementById('cardName').value;
                    const expDate = document.getElementById('expDate').value;
                    const cvv = document.getElementById('cvv').value;

                    if (!validateCardNumber(cardNumber)) isValid = false;
                    if (!validateCardName(cardName)) isValid = false;
                    if (!validateExpiryDate(expDate)) isValid = false;
                    if (cvv.length < 3) {
                        showError('cvvError', 'Please enter a valid CVV');
                        isValid = false;
                    }
                } else {
                    const phoneNumber = document.getElementById('phoneNumber').value;
                    const upiId = document.getElementById('upiId').value;

                    if (!validatePhone(phoneNumber)) isValid = false;
                    if (upiId && !validateUPI(upiId)) isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Please correct the errors in the form before submitting.');
                }
            });

            // UPI app clicks
            document.querySelectorAll('.upi-app').forEach(app => {
                app.addEventListener('click', function() {
                    const title = this.getAttribute('title');
                    alert(`Opening ${title}...`);
                });
            });
        });
    </script>
</body>
</html>