@extends('layouts.frontend.store.app')

@push('styles')
<style>
    .preview-wrapper {
        max-width: 650px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }
    
    .preview-header {
        background: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }
    
    .preview-content {
        padding: 30px;
    }
    
    .preview-footer {
        background: #f8f9fa;
        padding: 15px;
        border-top: 1px solid #ddd;
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .email-subject {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .email-from {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .newsletter-banner {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    
    .product-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    
    .product-item {
        flex: 0 0 33.333%;
        padding: 10px;
    }
    
    .product-image {
        width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    
    .product-title {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .product-price {
        color: #dc3545;
        margin-bottom: 10px;
    }
    
    .cta-button {
        display: inline-block;
        background: #0d6efd;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 20px;
    }
    
    .social-links {
        margin-top: 20px;
        text-align: center;
    }
    
    .social-links a {
        display: inline-block;
        margin: 0 5px;
        color: #6c757d;
        font-size: 1.2rem;
    }
    
    .unsubscribe {
        text-align: center;
        margin-top: 10px;
        font-size: 0.8rem;
    }
    
    .unsubscribe a {
        color: #6c757d;
    }
    
    .special-offer {
        background: #fff8e1;
        padding: 15px;
        border-radius: 5px;
        border: 1px dashed #ffc107;
        margin: 20px 0;
    }
    
    .offer-title {
        font-weight: bold;
        color: #ff9800;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2>Newsletter Preview</h2>
            <p class="text-muted">This is how your newsletter will appear in recipients' inboxes</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-light me-2">Back</a>
                <a href="{{ route('store.marketing.newsletters.edit', ['store' => 1, 'template' => $template ?? 'default']) }}" class="btn btn-primary">Use This Template</a>
            </div>
            
            <div class="preview-wrapper">
                <!-- Email Header Section -->
                <div class="preview-header">
                    <div class="email-subject">
                        @if($template == 'new-product')
                            Introducing Our Newest Product: You Don't Want to Miss This!
                        @elseif($template == 'flash-sale')
                            Flash Sale! 24 Hours Only - Up to 50% Off
                        @elseif($template == 'welcome')
                            Welcome to Our Store - Your Journey Begins Here
                        @elseif($template == 'holiday-special')
                            Holiday Special: Celebrate With These Amazing Deals
                        @elseif($template == 'announcement')
                            Important Announcement: We Have News to Share
                        @elseif($template == 'product-showcase')
                            Our Top Products You'll Love This Season
                        @elseif($template == 'special-offer')
                            Special Offer Just For You: Limited Time Only!
                        @elseif($template == 'clearance-sale')
                            Clearance Sale: Everything Must Go!
                        @elseif($template == 'summer-collection')
                            Summer Collection Has Arrived - Shop Now!
                        @elseif($template == 'store-news')
                            Store News: The Latest Updates From Us
                        @elseif($template == 'featured-products')
                            Featured Products: Hand-Picked Just For You
                        @elseif($template == 'thank-you')
                            Thank You For Your Support!
                        @else
                            Newsletter: Latest Updates From Our Store
                        @endif
                    </div>
                    <div class="email-from">
                        From: Your Store Name <noreply@yourstore.com>
                    </div>
                </div>
                
                <!-- Email Content Section -->
                <div class="preview-content">
                    @if($template == 'new-product' || $template == 'product-showcase' || $template == 'featured-products')
                        <!-- Product Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=New+Product" alt="New Product" class="newsletter-banner">
                            <h2>Discover Our Newest Addition</h2>
                            <p>We're excited to introduce our latest product to our collection. Designed with you in mind, this product combines quality, style, and functionality.</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>Product Details</h3>
                            <p>Our new product features premium materials, excellent craftsmanship, and innovative design. Perfect for everyday use, this product will enhance your experience and add value to your life.</p>
                            
                            <div class="product-grid">
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$99.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$79.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$129.99</div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="#" class="cta-button">Shop Now</a>
                            </div>
                        </div>
                    @elseif($template == 'flash-sale' || $template == 'clearance-sale' || $template == 'special-offer')
                        <!-- Sale Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=Flash+Sale" alt="Flash Sale" class="newsletter-banner">
                            <h2>Flash Sale - 24 Hours Only!</h2>
                            <p>Don't miss out on our biggest sale of the season. For 24 hours only, enjoy up to 50% off on select items across our store.</p>
                        </div>
                        
                        <div class="special-offer">
                            <div class="offer-title">Limited Time Offer</div>
                            <p>Use code <strong>FLASH50</strong> at checkout to receive an additional 10% off your purchase!</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>Featured Sale Items</h3>
                            
                            <div class="product-grid">
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Sale+Item" alt="Sale Item" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price"><s>$199.99</s> $99.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Sale+Item" alt="Sale Item" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price"><s>$149.99</s> $74.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Sale+Item" alt="Sale Item" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price"><s>$249.99</s> $124.99</div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <p>Sale ends: <strong>June 30, 2023 at 11:59 PM</strong></p>
                                <a href="#" class="cta-button">Shop the Sale</a>
                            </div>
                        </div>
                    @elseif($template == 'announcement' || $template == 'store-news')
                        <!-- Announcement Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=Announcement" alt="Announcement" class="newsletter-banner">
                            <h2>Important Announcement</h2>
                            <p>We have some exciting news to share with our valued customers. Read on to find out what's new at our store.</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>What's New</h3>
                            <p>We're thrilled to announce that we're expanding our product line with new categories coming soon. Based on your feedback, we've been working hard to bring you more options and better services.</p>
                            
                            <h3>Coming Soon</h3>
                            <ul>
                                <li>New product categories</li>
                                <li>Enhanced customer rewards program</li>
                                <li>Improved shipping options</li>
                                <li>Redesigned website experience</li>
                            </ul>
                            
                            <p>We value your continued support and look forward to serving you better with these new changes. Stay tuned for more updates!</p>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="#" class="cta-button">Learn More</a>
                            </div>
                        </div>
                    @elseif($template == 'welcome' || $template == 'thank-you')
                        <!-- Welcome Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=Welcome" alt="Welcome" class="newsletter-banner">
                            <h2>Welcome to Our Store!</h2>
                            <p>Thank you for subscribing to our newsletter. We're excited to have you join our community!</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>What to Expect</h3>
                            <p>As a subscriber, you'll be the first to know about:</p>
                            <ul>
                                <li>New product launches</li>
                                <li>Exclusive promotions and discounts</li>
                                <li>Special events and sales</li>
                                <li>Helpful tips and product guides</li>
                            </ul>
                            
                            <div class="special-offer">
                                <div class="offer-title">Welcome Gift</div>
                                <p>As a thank you for joining, enjoy 15% off your first purchase with code <strong>WELCOME15</strong></p>
                            </div>
                            
                            <h3>Featured Products</h3>
                            <div class="product-grid">
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$99.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$79.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$129.99</div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="#" class="cta-button">Start Shopping</a>
                            </div>
                        </div>
                    @elseif($template == 'holiday-special' || $template == 'summer-collection' || $template == 'seasonal')
                        <!-- Seasonal Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=Holiday+Special" alt="Holiday Special" class="newsletter-banner">
                            <h2>Holiday Season is Here!</h2>
                            <p>Celebrate with us and discover our special holiday collection, curated just for this festive season.</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>Holiday Collection</h3>
                            <p>Our holiday collection features specially selected items perfect for gifting or treating yourself this season. From festive decorations to unique gift ideas, we have everything you need to make this holiday special.</p>
                            
                            <div class="product-grid">
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Holiday+Item" alt="Holiday Item" class="product-image">
                                    <div class="product-title">Holiday Product</div>
                                    <div class="product-price">$49.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Holiday+Item" alt="Holiday Item" class="product-image">
                                    <div class="product-title">Holiday Product</div>
                                    <div class="product-price">$39.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Holiday+Item" alt="Holiday Item" class="product-image">
                                    <div class="product-title">Holiday Product</div>
                                    <div class="product-price">$59.99</div>
                                </div>
                            </div>
                            
                            <div class="special-offer">
                                <div class="offer-title">Holiday Special Offer</div>
                                <p>Enjoy 20% off all holiday items with code <strong>HOLIDAY20</strong></p>
                                <p>Valid until: <strong>December 25, 2023</strong></p>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="#" class="cta-button">Shop Holiday Collection</a>
                            </div>
                        </div>
                    @else
                        <!-- Default Template -->
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://placehold.co/600x300?text=Newsletter" alt="Newsletter" class="newsletter-banner">
                            <h2>Latest News & Updates</h2>
                            <p>Stay informed with our latest products, offers, and store updates.</p>
                        </div>
                        
                        <div style="margin-top: 30px;">
                            <h3>What's New</h3>
                            <p>Check out our latest additions and updates to enhance your shopping experience.</p>
                            
                            <div class="product-grid">
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$99.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$79.99</div>
                                </div>
                                <div class="product-item">
                                    <img src="https://placehold.co/200x200?text=Product" alt="Product" class="product-image">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-price">$129.99</div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="#" class="cta-button">Visit Our Store</a>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Social Links -->
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-pinterest"></i></a>
                    </div>
                    
                    <!-- Unsubscribe Link -->
                    <div class="unsubscribe">
                        <a href="#">Unsubscribe</a> | <a href="#">View in Browser</a>
                    </div>
                </div>
                
                <!-- Email Footer Section -->
                <div class="preview-footer">
                    <div style="text-align: center;">
                        <p>© 2023 Your Store Name. All Rights Reserved.</p>
                        <p>123 Store Street, City, Country</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 