@extends('layouts.app')
@push('styles')
@endpush
@section('title') FAQ | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
    <div class="section breedcrumb">
        <div class="breedcrumb__img-wrapper">
            <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
            <div class="container">
                <ul class="breedcrumb__content">
                    <li>
                        <a href="index.php">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                                    stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span> > </span>
                        </a>
                    </li>
                    <li class="active"><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breedcrumb section end   -->

    <section class="section section--xl faq">
        <div class="container">
            <div class="row faq__contents">
                <div class="offset-md-2 col-lg-6">
                    <div class="faq__accordion">
                        <p class="font-title--xl" style="font-size:20px">Frequesntly Asked Questions</p>
                        <p style="font-size:13px">The Most Common Expiring Soon Shopping FAQs to Make Your Life Easier
                        </p>
                        <p>&nbsp;</p>
                        <div class="accordion" id="faq-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Is it safe to shop online?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        This is a vital question and our priority at Expiringsoon.shop is to ensure the
                                        privacy of our customers and
                                        safety of payment.<br /><br />
                                        First, we highly recommend you have a strong password for your account on any
                                        shopping website.<br /><br />
                                        On Expiringsoon.shop, we offer various ways of payment including Cash on
                                        Delivery (COD), PayPal &amp;
                                        Credit Cards depending on the region. We also protect our website with the
                                        latest security systems to
                                        ensure safety. Our website use SSL (secure sockets layer) encryption installed
                                        which is represented by an
                                        icon of a locked padlock.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed"
                                        style="font-size:14px"style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Any tips on online shopping?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        One general tip when shopping online is to have one credit card for all your
                                        online purchases. This helps
                                        you track your purchases and if something wrong ever happens, you can cancel
                                        that credit card. Another
                                        tip is to use an ‘Internet Credit Card’ offered by some banks that has a capped
                                        amount to limit your risk
                                        and exposure at all times.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Are the products and brands offered authentic?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        On Expiringsoon.shop, we ensure full KYC (Know Your Customer) for all vendors
                                        and vendors are required
                                        to sell only original and authentic products sourced from trust-worthy
                                        suppliers. Our compliance teams
                                        are always on the lookout to ensure strict compliance and any vendor violations
                                        are met with the stiffest
                                        penalties not excluding prosecution in a competent court of law where relevant.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Why should I shop at Expiringsoon?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        The main benefits of shopping online at Expiringsoon.shop is that you are able
                                        to find products at much
                                        lower prices due to escalating discounts offered by vendors on their products
                                        expiring soon. They do this
                                        to get rid of their old or excess stock to free up space for new stock and to
                                        avoid losses if the products are
                                        unsold and allowed to expire, as they will lose 100% the value of those products
                                        and also expend efforts
                                        and funds to destroy and dispose them safely according to local regulations.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Does Expiringsoon Accept Return &amp; Exchange?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        No, unfortunately Expiringsoon.shop does not accept return and exchange as
                                        expiry date of items sold
                                        are generally close and under 3 months, giving no room to 2-way shipment
                                        logistics and enough time to
                                        resell. For more information, read our website’s return and exchange policies
                                        before making a purchase,
                                        report formally within 48 hours of receiving item if the defective or damaged
                                        and talk to our customer
                                        service if you are not satisfied with your purchase.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        How does Expiringsoon handle shipping?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="headingSix" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Expiringsoon.shop handles shipment with shipping agencies and partners in the
                                        local geography. Once an
                                        order (with shipment method and selection) is placed, shipment pickup is done
                                        and the delivery process
                                        commences. Tracking is available for most regions and items are delivered
                                        through the shortest path
                                        where feasible. We try not to do international shipment as items may expire in
                                        transit.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Do you ship packages internationally?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="headingSeven" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        We do not offer international shipment as items may expire in transit due to
                                        unforeseeable international
                                        shipment delays which may defeat the purpose of our customers
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        How do you price your shipment delivery?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    aria-labelledby="headingEight" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Shipment charges are calculated based on vendor and customer location according
                                        to the delivery type
                                        and schedule chosen by the buyer on the shopping cart page.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        How do you process refunds?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse"
                                    aria-labelledby="headingNine" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Refunds are generally routed back to the original source of funds or to the
                                        customer’s wallet.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        What payment methods do you accept?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse"
                                    aria-labelledby="headingTen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        We offer various ways of payment including Cash on Delivery (COD), PayPal &amp;
                                        Credit Cards and Bank
                                        Transfer/deposit depending on the region.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEleven">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEleven"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Can I learn enough about the product I want to buy?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingEleven" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        The amount of information you get on each product varies enormously from vendor
                                        to vendor, but if you
                                        want more complete and detailed information, we would recommend you go to the
                                        vendor’s online or
                                        physical store for their full product descriptions and also speak to their
                                        product experts and support
                                        teams. We do not maintain internal consultants or specialist on specific
                                        products use and detailed
                                        application, use your best discretion under guidance from the vendor’s
                                        interfaces.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwelve">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwelve"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Expiringsoon use encryption, why and what exactly is encryption?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseTwelve" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwelve" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        The purpose of encryption is simply to keep messages private and whole, so they
                                        cannot be read by
                                        outsiders and cannot be tampered with enroute.<br /><br />
                                        Basically, encryption takes your order and turns it into a secret code so that
                                        only the intended recipient
                                        (you or the store) can read it after mutual authentication—that is, confirmation
                                        that the store is who they
                                        say they are, and that you are who you say you are. This way purchases and
                                        transactions can be safely
                                        executed without compromising your information.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirteen">
                                    <button class="accordion-button collapsed" style="font-size:14px"
                                        style="font-size:14px" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThirteen" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        How safe is my debit / credit card information with Expiringsoon?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseThirteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Your credit card information is definitely much safer with Expiringsoon.shop
                                        than at your local gas
                                        station, convenience store, or restaurant as we do NOT store your debit / credit
                                        card information and
                                        ONLY process your order using a very secure server with software that protects
                                        your personal and credit
                                        card information.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFourteen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFourteen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What is shopping cart and checkout?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFourteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingFourteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Our shopping cart (or shopping bag) is the process by which we keep track of
                                        your selected items and
                                        order, as if you were putting items into a cart at the supermarket. The idea is
                                        that you don’t have to
                                        actually pay when you drop items into the cart, and you can remove them, change
                                        quantities, and so on
                                        before you go to checkout.<br /><br />
                                        Checkout is like in a physical store, when you have selected and finally decided
                                        what you want to buy, you
                                        wheel your cart by the checkout counter and make payment.<br /><br />
                                        In this online shop case, you fill in your billing and shipping addresses, pick
                                        a shipping method and
                                        proceed to pay with your personal choice of payment method to complete the order
                                        checkout process.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFifteen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFifteen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What if I get a defective or damaged product?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseFifteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingFifteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        If you have a problem with a product or the item received does not match with
                                        your order, please lodge a formal complaint and contact customer service within
                                        48 hours of receipt of such items. We will take up the issue with the vendor and
                                        do our best to resolve it.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSixteen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSixteen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        How do I check on my order, while I&#39;m waiting for it to arrive?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseSixteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingSixteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        If you registered on Expiringsoon.shop, you may be able to log in with that
                                        email and password, and
                                        check your order tracking status directly otherwise you may check the tracking
                                        information on the order
                                        confirmation notification sent to your email.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeventeen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeventeen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What are Expiringsoon Vendor fees? When should I pay?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseSeventeen" class="accordion-collapse collapse"
                                    aria-labelledby="headingSeventeen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Vendors are not charged fees for posting item on Expiringsoon.shop, commissions
                                        are deducted earnings
                                        received from completed successful sales. Effectively we only earn a commission
                                        when Vendors sell.<br /><br />
                                        Adverts, promotions and item featuring on the shop are entirely at the
                                        discretion of each vendor and are
                                        not mandatory.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEighteen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEighteen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What are your posting rules?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseEighteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingEighteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Vendors are required to follow the following posting rules when posting items on
                                        Expiringsoon.shop:<br /><br />
                                        1. Every product item must have a name and an expiring date.<br />
                                        2. Every advert must contain a brief and clear description.<br />
                                        3. Every product must have an associated image (taken by the vendor and without
                                        any
                                        trademark or copyright violations). Advertised products violating copyrights of
                                        a 3 rd party will
                                        be taken down and may lead to sanctions on the vendor.<br />
                                        4. Every product has to be in an appropriate category.<br />
                                        5. Prices of items posted must correspond and not deviate significantly from the
                                        real retail or
                                        wholesale prices of such or similar products in offline and online shops before
                                        discounts are
                                        applied.<br />
                                        6. All posted products must be located in the location and country of
                                        posting.<br />
                                        7. Posted items must be ready to ship within 1 - 2 hours of receipt of order
                                        confirmation
                                        notification by Vendor.<br />
                                        8. All items and products must be legally permitted and not part of the
                                        Expiringsoon forbidden
                                        list of item.<br />
                                        9. Each item for sale must be posted separately with the quantities available
                                        indicated.<br />
                                        10. Replica products, counterfeit or compromised products are strictly
                                        forbidden, violation may
                                        lead to permanent global ban and closure of violating account and associated
                                        persons.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNineteen">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNineteen"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What are prohibited items and products on Expiringsoon?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseNineteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingNineteen" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Below is a non-exhaustive list of items Prohibited on
                                        Expiringsoon.shop<br /><br />

                                        1. Counterfeit or replica items of any kind<br />
                                        2. Weapons, explosive, bombs and the like<br />
                                        3. Restricted military/police items<br />
                                        4. Human organs<br />
                                        5. Illegal/pirated copies<br />
                                        6. Stolen property<br />
                                        7. Narcotics, steroids, and any drugs or medications that require a prescription
                                        from a licensed
                                        medical specialist<br />
                                        8. Sexually-oriented and offensive items<br />
                                        9. Code grabbing and lock picking devices<br />
                                        10. Electronic equipment prohibited by the law<br />
                                        11. Loans, money transactions, Bitcoin<br />
                                        12. Products prohibited by the law or banned in the respective
                                        jurisdiction<br />
                                        13. Items offensive to culture, religion, faith and environment<br />
                                        14. Trophies and wildlife specimens (including but not limited to ivory
                                        artifacts and pangolin parts) in
                                        relation to which trade is prohibited by applicable legislation.<br />
                                        15. Items and substances considered poisonous and dangerous<br /><br />
                                        If you have noticed any advert violating this prohibition list, please report to
                                        our compliance team at
                                        <span style="font-weight:500">compliance@expiringsoon.shop</span>.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwenty">
                                    <button class="accordion-button collapsed" style="font-size:14px" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwenty"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        How long will my product advert stay on Expiringsoon?
                                        <span class="icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect width="32" height="32" rx="16"
                                                    fill="currentColor" />
                                                <path d="M12.0001 16H20.0001M16.0001 12V20V12Z" stroke="#1A1A1A"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </button>
                                </h2>
                                <div id="collapseTwenty" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwenty" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        Product advert remain on the site for as much as 3 months or less and are
                                        available for purchase on
                                        discount as set by the vendor as their dates count down till they expire and
                                        become unavailable.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 order-lg-0 order-1">
                    <div class="faq__img-wrapper">
                        <img src="{{ asset('images/banner/banner-lg-09.png') }}" alt="banner"
                            class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
