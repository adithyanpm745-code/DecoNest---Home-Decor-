<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Decor Footer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .footer-custom {
            background-color: #f8f5f0;
            padding-top: 3rem;
            border-top: 1px solid #e5e1d8;
        }
        
        .footer-title {
            font-weight: 500;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #5a4d41;
            position: relative;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: #c0a87d;
        }
        
        .footer-link {
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 0.75rem;
            display: block;
        }
        
        .footer-link:hover {
            color: #c0a87d;
            padding-left: 5px;
        }
        
        .footer-text {
            color: #6c757d;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        
        .footer-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: white;
            border: 1px solid #e5e1d8;
            border-radius: 0.25rem;
            color: #5a4d41;
            margin-bottom: 1rem;
        }
        
        .footer-input:focus {
            outline: none;
            border-color: #c0a87d;
            box-shadow: 0 0 0 0.25rem rgba(192, 168, 125, 0.25);
        }
        
        .footer-btn {
            background-color: #c0a87d;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
            font-weight: 500;
            width: 100%;
        }
        
        .footer-btn:hover {
            background-color: #a8926a;
        }
        
        .footer-copyright {
            background-color: #f1ece2;
            padding: 1.5rem 0;
            margin-top: 3rem;
            border-top: 1px solid #e5e1d8;
        }
        
        .copyright-text {
            color: #6c757d;
            margin: 0;
        }
        
        .copyright-text a {
            color: #c0a87d;
            text-decoration: none;
        }
        
        .social-icon {
            display: flex;
            justify-content: flex-end;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            background: #c0a87d;
            color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            margin-left: 0.75rem;
            text-decoration: none;
        }
        
        .social-link:hover {
            background: #a8926a;
            transform: translateY(-3px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .footer-col {
                margin-bottom: 2.5rem;
            }
            
            .social-icon {
                justify-content: center;
            }
            
            .copyright-text, .social-container {
                text-align: center;
            }
            
            .copyright-text {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Footer Section -->
<footer class="footer-custom">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 col-lg-3 footer-col">
                <h5 class="footer-title">Our Collections</h5>
                <a href="#" class="footer-link">Living Room</a>
                <a href="#" class="footer-link">Bedroom</a>
                <a href="#" class="footer-link">Dining Room</a>
                <a href="#" class="footer-link">Home Office</a>
                <a href="#" class="footer-link">Outdoor</a>
            </div>
            <div class="col-md-6 col-lg-2 footer-col">
                <h5 class="footer-title">Quick Links</h5>
                <a href="#" class="footer-link">About Us</a>
                <a href="#" class="footer-link">Inspiration</a>
                <a href="#" class="footer-link">Room Planner</a>
                <a href="#" class="footer-link">Gift Cards</a>
                <a href="#" class="footer-link">Special Offers</a>
            </div>
            <div class="col-md-6 col-lg-2 footer-col">
                <h5 class="footer-title">Customer Care</h5>
                <a href="#" class="footer-link">Contact Us</a>
                <a href="#" class="footer-link">Shipping & Returns</a>
                <a href="#" class="footer-link">Care Guide</a>
                <a href="#" class="footer-link">FAQ</a>
                <a href="#" class="footer-link">Track Order</a>
            </div>
            <div class="col-md-6 col-lg-2 footer-col">
                <h5 class="footer-title">Information</h5>
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms & Conditions</a>
                <a href="#" class="footer-link">Careers</a>
                <a href="#" class="footer-link">Press Enquiries</a>
                <a href="#" class="footer-link">Sustainability</a>
            </div>
            <div class="col-md-12 col-lg-3 footer-col">
                <h5 class="footer-title">Newsletter</h5>
                <p class="footer-text">Subscribe to receive inspiration, ideas, and news in your inbox.</p>
                <form>
                    <input type="email" class="footer-input" placeholder="Your email address">
                    <button type="submit" class="footer-btn">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="copyright-text">&copy; <script>document.write(new Date().getFullYear());</script> DecoNest Home Decor. Crafted with <i class="fas fa-heart" style="color: #c0a87d;"></i> for beautiful homes.</p>
                </div>
                <div class="col-lg-4">
                    <div class="social-container">
                        <div class="social-icon">
                            <a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-houzz"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>