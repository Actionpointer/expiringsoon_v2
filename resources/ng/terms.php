<?php
include("dbconnect.php");
if(isset($_COOKIE['email'])){
$query = "SELECT * FROM users WHERE email='".$_COOKIE['email']."'";
$result = mysqli_query($con, $query);
$uqr = mysqli_fetch_assoc($result);
}

session_start();
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
$orderid = $_SESSION['orderid'];
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shopery.netlify.app/main/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Terms of Use | Expiring Soon</title>
    <link
      rel="icon"
      type="image/png"
      href="src/images/favicon/favicon-16x16.png"
    />
    <link rel="stylesheet" href="src/lib/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="src/lib/css/bvselect.css" />
    <link rel="stylesheet" href="src/lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="src/css/style.css" />
  </head>

  <body>

    <div class="loader">
      <div class="loader-icon">
        <img src="src/images/loader.gif" alt="loader" />
      </div>
    </div>
    <!-- Header start  -->
    <?php include("header.php"); ?>
    <!-- Header End  -->

    <!-- breedcrumb section start  -->
    <div class="section breedcrumb">
      <div class="breedcrumb__img-wrapper">
        <img src="src/images/banner/breedcrumb.jpg" alt="breedcrumb" />
        <div class="container">
          <ul class="breedcrumb__content">
            <li>
              <a href="index.php">
                <svg
                  width="18"
                  height="19"
                  viewBox="0 0 18 19"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                    stroke="#808080"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <span> > </span>
              </a>
            </li>
            <li class="active"><a href="#">Terms of Use</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- breedcrumb section end   -->

    <!-- Shopping Cart Section Start   -->
    <section class="shoping-cart section section--xl">
      <div class="container">
        <div class="section__head justify-content-center">
          <h2 class="section--title-four font-title--sm" style="font-size:20px">Terms of Use</h2>
        </div>
        <div class="row">
          <div class="col-lg-9" style="margin:auto">
    <div style="text-align:center;">
        <table cellpadding="0" cellspacing="2" style="border-spacing:1.5pt;">
            <tbody>
                <tr>
                    <td style="padding:0.75pt; vertical-align:top;">
                        <p style="font-size:8.5pt;"><span style="">State of Delaware | Rev. 1343F05</span></p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <p style="margin-top:0pt; margin-bottom:0pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">TERMS OF USE AGREEMENT</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:left; font-size:10pt;"><span style="">Version Date: <span style="font-weight:500">February 20, 2022</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">This Terms of Use Agreement (“Agreement”), along with our Company Privacy Policy (__________), constitutes a legally binding agreement made between you, whether personally or on behalf of an entity (“user” or “you”) and Expiringsoon International Inc. and its affiliated companies, Websites, applications and tools (collectively, Expiringsoon International Inc., “Company” or “we” or “us” or “our”), concerning your access to and use of the expiringsoon.com.ng Website(s) as well as any other media form, media channel, mobile website or mobile application related or connected thereto (collectively, the “Sites”). The Sites provide the following service: Online shopping and ecommerce (“Company Services”). Supplemental terms and conditions or documents that may be posted on the Sites from time to time, are hereby expressly incorporated into this Agreement by reference.</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Company makes no representation that the Sites is appropriate or available in other locations other than where it is operated by Company. The information provided on the Sites is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject Company to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Sites from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">All users who are minors in the jurisdiction in which they reside (generally under the age of 18) are not permitted to register for the Sites or use the Company Services.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">YOU ACCEPT AND AGREE TO BE BOUND BY THIS AGREEMENT BY ACKNOWLEDGING SUCH ACCEPTANCE DURING THE REGISTRATION PROCESS (IF APPLICABLE) AND ALSO BY CONTINUING TO USE THE SITES. IF YOU DO NOT AGREE TO ABIDE BY THIS AGREEMENT, OR TO MODIFICATIONS THAT COMPANY MAY MAKE TO THIS AGREEMENT IN THE FUTURE, DO NOT USE OR ACCESS OR CONTINUE TO USE OR ACCESS THE COMPANY SERVICES OR THE SITES.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:11.5pt;"><span style=" font-size:11.5pt;">PURCHASES; PAYMENT</span></h2>
    <p style="margin-top:0pt; margin-bottom:0pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Expiringsoon International Inc. may offer free trial or sample of our products or services. The duration of the free trial period and all other details of the offer will be posted on our Sites If you wish to try our free options please read through them carefully first. Expiringsoon International Inc. will bill you through an invoice for our Services. By using our paid options you agree to pay Expiringsoon International Inc. all charges at the prices then in effect for the products or services you or other persons using your billing account may purchase, and you authorize Expiringsoon International Inc. to charge your chosen payment provider for any such purchases. You agree to make payment using that selected payment method. If you
have ordered a product or service that is subject to recurring charges then you agree to us charging your
payment method on a recurring basis, without requiring your prior approval from you for each recurring
charge until such time as you cancel the applicable product or service. Expiringsoon International
Inc. reserves the right to correct any errors or mistakes in pricing that it makes even if it has already
requested or received payment. Sales tax will be added to the sales price of purchases as deemed
required by Company. Company may change prices at any time. All payments shall be in U.S. dollars.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:11.5pt;"><span style=" font-size:11.5pt;">REFUND AND RETURN</span></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">All sales are final and no refunds shall be issued.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">USER REPRESENTATIONS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">Regarding Your Registration</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">By using the Expiringsoon International Inc.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">Services,   and warrant that:</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">A. all registration information you submit is truthful and accurate;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">B. you will maintain the accuracy of such information;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">C. you will keep your password confidential and will be responsible for all use of your password and
account;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">D. you are not a minor in the jurisdiction in which you reside, or if a minor, you have received parental
permission to use our Sites; and</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">E. your use of the Company Services does not violate any applicable law or regulation.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">You also agree to: (a) provide true, accurate, current and complete information about yourself as
prompted by the Sites' registration form and (b) maintain and promptly update registration data to keep it
true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current
or incomplete, or Company has reasonable grounds to suspect that such information is untrue,
inaccurate, not current or incomplete, Company has the right to suspend or terminate your account and
refuse any and all current or future use of the Sites (or any portion thereof).</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">We reserve the right to remove or reclaim or change a user name you select if we determine appropriate
in our discretion, such as when the user name is obscene or otherwise objectionable or when a
trademark owner complains about a username that does not closely relate to a user's actual name.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">Regarding Content You Provide</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">We may invite you to chat or participate in blogs, message boards, online forums and other functionality
and may provide you with the opportunity to create, submit, post, display, transmit, perform, publish,
distribute or broadcast content and materials to our Sites and/or to or via the Sites' forms, emails, chat
agents, popups, including, without limitation, text, writings, video, audio, photographs, graphics,
comments, suggestions or personally identifiable information or other material (collectively "Contributions"). Any Contributions you transmit to Expiringsoon International Inc. will be treated as nonconfidential
and non-proprietary. When you create or make available a Contribution, you thereby
represent and warrant that:</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">A.  the creation, distribution, transmission, public display and performance, accessing, downloading
and copying of your Contribution does not and will not infringe the proprietary rights, including but not
limited to the copyright, patent, trademark, trade secret or moral rights of any third party;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">B. you are the creator and owner of or have the necessary licenses, rights, consents, releases and
permissions to use and to authorize Expiringsoon International Inc. and the Sites' users to use your
Contributions as necessary to exercise the licenses granted by you under this Agreement;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">C. you have the written consent, release, and/or permission of each and every identifiable individual
person in the Contribution to use the name or likeness of each and every such identifiable individual
person to enable inclusion and use of the Contribution in the manner contemplated by our Sites;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">D. your Contribution is not obscene, lewd, lascivious, filthy, violent, harassing or otherwise
objectionable (as determined by Expiringsoon International Inc.), libelous or slanderous, does not
ridicule, mock, disparage, intimidate or abuse anyone, does not advocate the violent overthrow of any
government, does not incite, encourage or threaten physical harm against another, does not violate
any applicable law, regulation, or rule, and does not violate the privacy or publicity rights of any third
party;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">E. your Contribution does not contain material that solicits personal information from anyone under 18
or exploit people under the age of 18 in a sexual or violent manner, and does not violate any federal or
state law concerning child pornography or otherwise intended to protect the health or well-being of
minors;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">F. your Contribution does not include any offensive comments that are connected to race, national
origin, gender, sexual preference or physical handicap;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">G. your Contribution does not otherwise violate, or link to material that violates, any provision of this
Agreement or any applicable law or regulation.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">CONTRIBUTION LICENSE</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">By posting Contributions to any part of the Sites, or making them accessible to the Sites by linking your
account to any of your social network accounts, you automatically grant, and you represent and warrant
that you have the right to grant, to Expiringsoon International Inc. an unrestricted, unconditional,
unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right and
license to host, use, copy, reproduce, disclose, sell, resell, publish, broadcast, retitle, archive, store,
cache, publicly perform, publicly display, reformat, translate, transmit, excerpt (in whole or in part) and
distribute such Contributions (including, without limitation, your image and voice) for any purpose,
commercial, advertising, or otherwise, to prepare derivative works of, or incorporate into other works,
such Contributions, and to grant and authorize sublicenses of the foregoing. The use and distribution may
occur in any media formats and through any media channels. Such use and distribution license will apply
to any form, media, or technology now known or hereafter developed, and includes our use of your name,
company name, and franchise name, as applicable, and any of the trademarks, service marks, trade
names and logos, personal and commercial images you provide. Company does not assert any
ownership over your Contributions; rather, as between us and you, subject to the rights granted to us in
this Agreement, you retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We will not use your contribution in a way that
infringes on your rights and always process your personal information lawfully and with your consent.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Company has the right, in our sole and absolute discretion, to (i) edit, redact or otherwise change any
Contributions, (ii) re-categorize any Contributions to place them in more appropriate locations or (iii) prescreen
or delete any Contributions that are determined to be inappropriate or otherwise in violation of this
Agreement.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">By uploading your Contributions to the Sites, you hereby authorize Company to grant to each end user a
personal, limited, no-transferable, perpetual, non-exclusive, royalty-free, fully-paid license to access,
download, print and otherwise use your Contributions for their internal purposes and not for distribution,
transfer, sale or commercial exploitation of any kind.</span></p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:8.1pt;"><em><span style="font-size:7pt;">&nbsp;</span></em></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">GUIDELINES FOR REVIEWS</span></strong><br>&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Expiringsoon International Inc. may accept, reject or remove reviews in its sole discretion. Expiringsoon
International Inc. has absolutely no obligation to screen reviews or to delete reviews, even if anyone
considers reviews objectionable or inaccurate. Those persons posting reviews should comply with the
following criteria: (1) reviewers should have firsthand experience with the person/entity being reviewed;
(2) reviews should not contain: offensive language, profanity, or abusive, racist, or hate language;
discriminatory references based on religion, race, gender, national origin, age, marital status, sexual
orientation or disability; or references to illegal activity; (3) reviewers should not be affiliated with
competitors if posting negative reviews; (4) reviewers should not make any conclusions as to the legality
of conduct; and (5) reviewers may not post any false statements or organize a campaign encouraging
others to post reviews, whether positive or negative. Reviews are not endorsed by Expiringsoon
International Inc., and do not represent the views of Expiringsoon International Inc. or of any affiliate or
partner of Company. Expiringsoon International Inc. does not assume liability for any review or for any
claims, liabilities or losses resulting from any review. By posting a review, the reviewer hereby grants to
Expiringsoon International Inc. a perpetual, non-exclusive, worldwide, royalty-free, fully-paid, assignable
and sublicensable license to Expiringsoon International Inc. to reproduce, modify, translate, transmit by
any means, display, perform and/or distribute all content relating to reviews.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">MOBILE APPLICATION LICENSE</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">Use License</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">If you are accessing the Expiringsoon International Inc. Services via a mobile application, then
Expiringsoon International Inc. grants you a revocable, non-exclusive, non-transferable, limited right to
install and use the application on wireless handsets owned and controlled by you, and to access and use
the application on such devices strictly in accordance with the terms and conditions of this license. You
shall use the application strictly in accordance with the terms of this license and shall not: (a) decompile,
reverse engineer, disassemble, attempt to derive the source code of, or decrypt the application; (b) make
any modification, adaptation, improvement, enhancement, translation or derivative work from the
application; (c) violate any applicable laws, rules or regulations in connection with your access or use of the application; (d) remove, alter or obscure any proprietary notice (including any notice of copyright or
trademark) of Company or its affiliates, partners, suppliers or the licensors of the application; (e) use the
application for any revenue generating endeavor, commercial enterprise, or other purpose for which it is
not designed or intended; (f) make the application available over a network or other environment
permitting access or use by multiple devices or users at the same time; (g) use the application for creating
a product, service or software that is, directly or indirectly, competitive with or in any way a substitute for
the application; (h) use the application to send automated queries to any Sites or to send any unsolicited
commercial e-mail; or (i) use any proprietary information or interfaces of Expiringsoon International Inc. or
other intellectual property of Expiringsoon International Inc. in the design, development, manufacture,
licensing or distribution of any applications, accessories or devices for use with the application.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">Terms Applicable to Apple and Android Devices</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">The following terms apply when you use a mobile application obtained from either the Apple Store or
Google Play to access the Expiringsoon International Inc. Services. You acknowledge that this
Agreement is concluded between you and Expiringsoon International Inc. only, and not with Apple Inc. or
Google, Inc. (each an “App Distributor”), and Expiringsoon International Inc., not an App Distributor, is
solely responsible for the Expiringsoon International Inc. application and the content thereof. (1) SCOPE
OF LICENSE: The license granted to you for the Expiringsoon International Inc. application is limited to a
non-transferable license to use the Expiringsoon International Inc. application on a device that utilizes the
Apple iOS or Android operating system, as applicable, and in accordance with the usage rules set forth in
the applicable App Distributor terms of service. (2) MAINTENANCE AND SUPPORT: Expiringsoon
International Inc. is solely responsible for providing any maintenance and support services with respect to
the Expiringsoon International Inc. application, as specified in this Agreement, or as required under
applicable law. You acknowledge that each App Distributor has no obligation whatsoever to furnish any
maintenance and support services with respect to the Expiringsoon International Inc. application. (3)
WARRANTY: Expiringsoon International Inc. is solely responsible for any product warranties, whether
express or implied by law, to the extent not effectively disclaimed. In the event of any failure of the
Expiringsoon International Inc. application to conform to any applicable warranty, you may notify an App
Distributor, and the App Distributor, in accordance with its terms and policies, may refund the purchase
price, if any, paid for the Expiringsoon International Inc. application, and to the maximum extent permitted
by applicable law, an App Distributor will have no other warranty obligation whatsoever with respect to the
Expiringsoon International Inc. application, and any other claims, losses, liabilities, damages, costs or
expenses attributable to any failure to conform to any warranty will be Expiringsoon International Inc.
sole responsibility. (4) PRODUCT CLAIMS: You acknowledge that Expiringsoon International Inc., not an
App Distributor, is responsible for addressing any claims of yours or any third party relating to the
Expiringsoon International Inc. application or your possession and/or use of the Expiringsoon
International Inc. application, including, but not limited to: (i) product liability claims; (ii) any claim that the
Expiringsoon International Inc. application fails to conform to any applicable legal or regulatory
requirement; and (iii) claims arising under consumer protection or similar legislation. (5) INTELLECTUAL
PROPERTY RIGHTS: You acknowledge that, in the event of any third party claim that the Expiringsoon
International Inc. application or your possession and use of the Expiringsoon International Inc. application
infringes a third party’s intellectual property rights, the App Distributor will not be responsible for the
investigation, defense, settlement and discharge of any such intellectual property infringement claim. (6)
LEGAL COMPLIANCE: You represent and warrant that (i) you are not located in a country that is subject to a U.S. government embargo, or that has been designated by the U.S. government as a “terrorist
supporting” country; and (ii) you are not listed on any U.S. government list of prohibited or restricted
parties. (7) THIRD PARTY TERMS OF AGREEMENT: You must comply with applicable third party terms
of agreement when using the Expiringsoon International Inc. application, e.g., if you have a VoIP
application, then you must not be in violation of their wireless data service agreement when using the
Expiringsoon International Inc. application. (8) THIRD PARTY BENEFICIARY: Expiringsoon International
Inc. and you acknowledge and agree that the App Distributors, and their subsidiaries, are third party
beneficiaries of this Agreement, and that, upon your acceptance of the terms and conditions of this
Agreement, each App Distributor will have the right (and will be deemed to have accepted the right) to
enforce this Agreement against you as a third party beneficiary thereof.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:11.5pt;"><span style=" font-size:11.5pt;">SOCIAL MEDIA</span><span style=" font-size:11.5pt;">&nbsp;</span></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">As part of the functionality of the Sites, you may link your account with online accounts you may have with
third party service providers (each such account, a “Third Party Account”) by either: (i) providing your
Third Party Account login information through the Sites; or (ii) allowing Expiringsoon International Inc. to
access your Third Party Account, as is permitted under the applicable terms and conditions that govern
your use of each Third Party Account. You represent that you are entitled to disclose your Third Party
Account login information to Expiringsoon International Inc. and/or grant Expiringsoon International Inc.
access to your Third Party Account (including, but not limited to, for use for the purposes described
herein), without breach by you of any of the terms and conditions that govern your use of the applicable
Third Party Account and without obligating Expiringsoon International Inc. to pay any fees or making
Expiringsoon International Inc. subject to any usage limitations imposed by such third party service
providers. By granting Expiringsoon International Inc. access to any Third Party Accounts, you
understand that (i) Expiringsoon International Inc. may access, make available and store (if applicable)
any content that you have provided to and stored in your Third Party Account (the “Social Network
Content”) so that it is available on and through the Sites via your account, including without limitation any
friend lists, and (ii) Expiringsoon International Inc. may submit and receive additional information to your
Third Party Account to the extent you are notified when you link your account with the Third Party
Account. Depending on the Third Party Accounts you choose and subject to the privacy settings that you
have set in such Third Party Accounts, personally identifiable information that you post to your Third Party
Accounts may be available on and through your account on the Sites. Please note that if a Third Party
Account or associated service becomes unavailable or Expiringsoon International Inc. access to such
Third Party Account is terminated by the third party service provider, then Social Network Content may no
longer be available on and through the Sites. You will have the ability to disable the connection between
your account on the Sites and your Third Party Accounts at any time. PLEASE NOTE THAT YOUR
RELATIONSHIP WITH THE THIRD PARTY SERVICE PROVIDERS ASSOCIATED WITH YOUR THIRD
PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD PARTY
SERVICE PROVIDERS. Expiringsoon International Inc. makes no effort to review any Social Network
Content for any purpose, including but not limited to, for accuracy, legality or non-infringement, and
Expiringsoon International Inc. is not responsible for any Social Network Content. You acknowledge and
agree that Expiringsoon International Inc. may access your e-mail address book associated with a Third
Party Account and your contacts list stored on your mobile device or tablet computer solely for the
purposes of identifying and informing you of those contacts who have also registered to use the Sites. At your request made via email to our email address listed below, or through your account settings (if
applicable), Expiringsoon International Inc. will deactivate the connection between the Sites and your
Third Party Account and delete any information stored on Expiringsoon International Inc. servers that was
obtained through such Third Party Account, except the username and profile picture that become
associated with your account.</span></p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:8.1pt;"><em><span style="font-size:7pt;">&nbsp;</span></em></h2>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:11.5pt;"><span style=" font-size:11.5pt;">SUBMISSIONS</span></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">You acknowledge and agree that any questions, comments, suggestions, ideas, feedback or other
information about the Sites or the Expiringsoon International Inc. Services ("Submissions") provided by
you to Expiringsoon International Inc. are non-confidential and Expiringsoon International Inc. (as well as
any designee of Company) shall be entitled to the unrestricted use and dissemination of these
Submissions for any purpose, commercial or otherwise, without acknowledgment or compensation to you.</span></p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:8.1pt;"><em><span style="font-size:7pt;">&nbsp;</span></em></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">PROHIBITED ACTIVITIES</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">You may not access or use the Sites for any other purpose other than that for which Expiringsoon
International Inc. makes it available. The Sites may not be used in connection with any commercial
endeavors except those that are specifically endorsed or approved by Expiringsoon International Inc. Prohibited activity includes, but is not limited to:</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">A. attempting to bypass any measures of the Sites designed to prevent or restrict access ** the Sites, or any portion of the Sites</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">B. * to impersonate another user or person or using  username ** another user</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">C. ** or tortious activity</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">D. deciphering, decompiling, disassembling or reverse engineering any ** the software comprising ** in  way making up a part of the Sites</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">E. ** the copyright or other proprietary rights notice from  Sites&apos; content</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">F. engaging in any automated  ** the system, such as using any * mining,  or similar data gathering and extraction tools</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">G. except as may be the result of standard search  or Internet browser usage, using or launching, developing or  any automated system, including, without limitation,  spider, robot (or &quot;bot&quot;), ** utility, * or offline reader that accesses the Sites, or using or launching any unauthorized script or other software</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">H. harassing, annoying, intimidating or threatening any Company employees or agents engaged in providing any portion of the Company Services to you</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">I. interfering with, disrupting, or creating an ** burden ** the Sites or  networks or services connected to  Sites</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">J. making any  use of the Company Services, including collecting usernames and/or email addresses ** users by * or other ** for the purpose of sending unsolicited email, or creating user accounts ** automated means or under false pretenses</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">K. * or otherwise transferring your profile</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">L. systematic retrieval of data or other content * the Sites to create or compile, directly or indirectly, a collection, compilation, database or directory without written permission * Company</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">M. tricking, defrauding or misleading * and other users, especially in any attempt to **  account information * as passwords</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">N. using any information obtained from  Sites in ** to harass, abuse, ** harm another person</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">O. ** the Company Services as part of any effort to * with * ** to provide services as a service bureau</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">P. using the Sites in a manner inconsistent with  and  applicable laws and regulations</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Q. Advertising or Selling of Counterfeit and/or imitation products **  kind</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">R. ** of obscene or prohibited contents or products of all kinds</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;"> PROPERTY RIGHTS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">The content on  Sites (&ldquo;Expiringsoon International Inc. Content&rdquo;) and the trademarks, * marks and logos contained therein (&ldquo;Marks&rdquo;) are owned by or licensed to Expiringsoon International Inc., and are * to copyright and other intellectual property rights under United States and foreign laws and international conventions. Expiringsoon International Inc. Content, includes, without limitation, all source code, databases, functionality, software, Sites&apos; designs, audio, video, text, ** and graphics. All Expiringsoon * Inc. graphics, logos, designs, page headers, button icons, * and service **  registered trademarks,  law trademarks or trade dress of Expiringsoon International Inc. in the United States and/or other countries.  International Inc. trademarks and trade ** may not be used, including as part of trademarks and/** as part of domain names, in connection * any product or service in any manner * is likely to cause  and may not ** copied, imitated, or used, in whole or ** part, without the prior written * ** the Expiringsoon International Inc..</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Expiringsoon International Inc.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">Content on the Sites is provided to you &ldquo;AS IS&rdquo; for your information and ** use only  may not be used, copied, reproduced, aggregated, distributed, transmitted, broadcast, displayed, sold, licensed, or otherwise exploited   other purposes whatsoever without the prior written consent of the respective owners. ** * you are eligible to use  Sites, you are granted a limited license to  and use the Sites  the Expiringsoon International Inc. *  to download ** print a * of any portion of the Expiringsoon * Inc. Content ** which you * properly gained access solely for your personal, non-commercial use. Expiringsoon * Inc. reserves all   expressly * to you in and ** the Sites and Expiringsoon International Inc. *  Marks.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <h2 style="margin-top:5.6pt; margin-bottom:5.6pt; text-align:justify; line-height:11.5pt;"><span style=" font-size:11.5pt;">THIRD PARTY WEBSITES  CONTENT</span></h2>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;"> ** contains (or you may be sent through the Sites or the Expiringsoon International Inc. Services) links to ** websites (&quot;Third Party Websites&quot;) as well as articles, photographs, text, graphics, pictures, designs, music, sound, video, information, applications, software and ** content or items belonging to or originating from third parties (the &quot;** Party Content&quot;). Such Third Party Websites and Third Party *  not investigated, monitored or * for accuracy, appropriateness, or  by us, and we are not responsible for any Third ** accessed through the Sites or any Third ** Content posted on, available through ** installed from the Sites, including the content, accuracy, offensiveness, opinions, reliability, privacy practices or other policies ** or contained in the ** Party Websites or the Third Party Content. Inclusion of, linking to or permitting  use or installation of any Third Party Websites or any Third ** * does  imply ** or endorsement thereof by us. If you  to leave the ** and access the Third ** Websites or to use or install any Third Party Content, you ** so at your own risk and  should be aware that our terms and policies no longer govern.  should review the applicable terms  policies,  privacy and data  practices, of any ** to which you navigate from the ** or relating to any applications you  or install from the Sites. Any purchases you make through Third Party Websites will ** through other websites and from other companies, and Expiringsoon * Inc.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">takes no responsibility whatsoever in ** to such purchases which are exclusively *   the applicable third party.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">SITE MANAGEMENT</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Expiringsoon International Inc.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">reserves the right but does not have  * to:</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">A. monitor the Sites for violations of this Agreement;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">B. take appropriate legal action against anyone who, in Expiringsoon International Inc. sole discretion, violates * Agreement, including without limitation, reporting such user ** law enforcement authorities;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">C. in Expiringsoon International Inc. sole discretion and without limitation, refuse, restrict access to or availability of, or disable (to the extent technologically feasible) any user&rsquo;s contribution or any portion thereof * may violate this Agreement or any Expiringsoon International Inc. policy;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">D. in Company&rsquo;s sole * and without limitation, notice or liability to remove from the ** or otherwise disable all files and content that are excessive ** size or are in any way burdensome to Expiringsoon * Inc.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">&apos;s systems;</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">E. otherwise manage the Sites in a manner designed to * the rights and property of Expiringsoon International Inc.  others and ** facilitate  proper functioning of  Sites.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">* AND TERMINATION</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">This Agreement shall remain in full force and effect while you  the Sites or are otherwise a user ** member of  Sites, as applicable. You may terminate your use or participation at any time, for any reason, by   instructions for terminating user ** in your account settings, ** available, or by contacting us ** the contact information below.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">WITHOUT LIMITING ANY OTHER PROVISION OF * AGREEMENT, COMPANY ** THE ** TO, IN COMPANY&rsquo;S * DISCRETION AND WITHOUT  ** LIABILITY, DENY ACCESS TO AND USE ** THE ** AND THE * SERVICES, TO ANY PERSON FOR ANY REASON OR FOR NO REASON AT ALL, INCLUDING WITHOUT LIMITATION  BREACH OF ANY REPRESENTATION, WARRANTY OR COVENANT CONTAINED IN * AGREEMENT, OR OF ANY APPLICABLE LAW OR REGULATION,  COMPANY MAY  YOUR USE OR PARTICIPATION IN THE **  THE COMPANY SERVICES, DELETE YOUR PROFILE AND ANY CONTENT OR INFORMATION THAT YOU HAVE POSTED AT ANY TIME, WITHOUT WARNING, IN COMPANY&rsquo;S SOLE DISCRETION.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">** order to protect the integrity of the Sites and Company Services, Company reserves the right at any time in its sole discretion to block certain IP addresses * accessing the Sites  Company Services.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Any provisions of *  that, in ** to * the purposes of such provisions, need to survive the termination or expiration ** this Agreement, shall **  to survive for as long as necessary to fulfill such purposes.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">YOU * * CERTAIN STATES ALLOW YOU TO CANCEL THIS AGREEMENT, WITHOUT ANY PENALTY OR OBLIGATION, AT  TIME PRIOR TO ** OF COMPANY&rsquo;S THIRD BUSINESS DAY FOLLOWING THE DATE OF THIS AGREEMENT, EXCLUDING SUNDAYS AND HOLIDAYS. TO CANCEL, CALL A COMPANY ** CARE REPRESENTATIVE DURING NORMAL BUSINESS HOURS ** THE CONTACT INFORMATION LISTING BELOW IN THIS AGREEMENT OR BY ACCESSING * ACCOUNT SETTINGS. THIS * * ONLY TO INDIVIDUALS RESIDING IN STATES * SUCH LAWS.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">If Company terminates or suspends your account for any reason, you are prohibited from ** and ** a new account under your name, a fake or borrowed name, or the name of any third party, * if you  be acting on behalf of the ** party. In ** ** terminating or suspending * account, Company reserves the ** ** * appropriate legal action, including without limitation ** civil, criminal, and injunctive redress.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">MODIFICATIONS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">To Agreement</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Company may modify this Agreement from time to time. Any and all changes to this Agreement will be posted on the Sites and revisions * be  by date. You agree ** be bound to any changes to this Agreement when you use the Company Services after any such modification becomes effective. Company may also, in its discretion, choose to alert  users with whom it maintains email ** of * modifications by means of an email to their * recently provided email address. It is   that you   this  and keep your contact information current in your * settings to ensure you are informed of changes. You agree that you will periodically check the Sites for updates ** this Agreement and you * read the ** we send you ** inform you of any changes. Modifications ** this Agreement shall **  after posting.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">** Services</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Company ** the right at  time to  or discontinue, temporarily or permanently, the Company Services (or any part thereof) with or without notice.  ** that Company shall not be liable to you or to any third party for any modification, suspension or discontinuance of the Company Services.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">DISPUTES</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">Between Users</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">If there is a dispute between users of the Sites, or between users and any third party, you understand and ** that Company is under no * to become involved. In the event that you have a dispute with one or more other users, you  release Company,  officers, employees, agents and successors in rights from claims, demands  * (actual and consequential) of every kind ** nature, known or unknown, suspected and unsuspected, disclosed  undisclosed, arising out of or in any way related to such ** and/or the Company Services.&nbsp;</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><em><span style=" font-size:10pt;">With Company</span></em></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:10pt;">A. Governing Law; Jurisdiction.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><span style=" font-size:10pt;">This Agreement and all aspects of the Sites and Company ** shall be governed by and construed ** accordance with the internal laws of the State of Delaware, without regard to conflict of law provisions. With respect to any disputes or claims not subject to informal dispute resolution or arbitration (as  forth below),  agree not ** commence or prosecute any action in connection  other * in the state and * courts located in Houston County, State of Delaware, and you  * to,  waive all defenses ** lack of personal jurisdiction and forum non conveniens with respect to, venue and jurisdiction ** such state and federal courts. Application of the United Nations * on Contracts for the * Sale of Goods is excluded from this Agreement. Additionally, application of the * Computer Information **  (UCITA) ** excluded from this Agreement.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">In no event shall any claim, action or proceeding by you related ** any way to the Sites or * Services be * more than two (2) years after the cause of action arose.</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:10pt;">B.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><strong><span style=" font-size:10pt;">Informal Resolution.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><span style=" font-size:10pt;">** expedite resolution and control the cost of any dispute, controversy or claim related to this Agreement (&quot;Dispute&quot;), you and Company agree to first * to negotiate any * (except those Disputes expressly provided below) * for at least thirty (30)</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">days before initiating any arbitration ** court proceeding. Such informal negotiations ** upon written notice from  person to  other.</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:10pt;">C. * Arbitration.</span></strong><span style=" font-size:10pt;">&nbsp;If you and Company are unable to resolve a Dispute through ** negotiations, either you or Company  elect to have the Dispute (except those ** expressly excluded below) finally and exclusively ** by binding arbitration. Any ** to arbitrate by one party shall be final and binding on the other. YOU UNDERSTAND THAT  * PROVISION, YOU WOULD HAVE THE ** TO SUE IN COURT AND HAVE A JURY TRIAL. The ** shall be  and conducted under  Commercial Arbitration Rules of the American Arbitration Association (&quot;AAA&quot;) and, ** appropriate, the AAA&rsquo;s * Procedures for Consumer Related Disputes (&quot;AAA Consumer Rules&quot;), * of which are available at  AAA website www.adr.org.  determination of whether a Dispute is * to arbitration shall be governed ** the Federal ** Act  determined by a court rather than an arbitrator. Your ** fees and your share of arbitrator compensation shall ** governed by  AAA Consumer Rules and, where appropriate, limited by the  Consumer Rules. If such costs are determined by  arbitrator to be excessive, Company will pay all ** fees and expenses.  arbitration may be conducted in person, * the submission of documents, by phone or online. The arbitrator will make a ** in writing, but need not provide a statement of * unless requested by a party. The * must follow applicable law, and any award may be challenged if the arbitrator fails to do so. Except where otherwise required by the applicable AAA rules or applicable law, the arbitration will take place in Houston County, State ** Delaware. Except as  provided in this Agreement, you and Company may litigate in court to compel arbitration, stay ** pending arbitration, or to confirm, modify, vacate or ** ** on  award entered by the arbitrator.</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:10pt;">D.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><strong><span style=" font-size:10pt;">Restrictions.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><span style=" font-size:10pt;"> and Company agree that any arbitration shall be * to the Dispute between Company  you individually. To the full  permitted by law, (1) no arbitration shall be  with any other; (2) ** is no right or authority for any Dispute to be arbitrated on a class-action basis ** to utilize class action procedures; and (3) there is no right or authority  any * to be brought ** a purported representative capacity on behalf of the general public or  other persons.</span></p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-left:15pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:10pt;">E.</span></strong><strong><span style=" font-size:10pt;">&nbsp;</span></strong><strong><span style=" font-size:10pt;">Exceptions to Informal Negotiations and Arbitration.</span></strong><span style=" font-size:10pt;">&nbsp;You and Company agree that the following Disputes are not subject ** the ** provisions concerning informal negotiations and binding arbitration: (1) any ** seeking to * or protect, or concerning the validity ** any of your ** Company&rsquo;s intellectual property rights; (2) any Dispute related to, ** * from, ** of theft, piracy, ** ** privacy or  use; and (3) any claim for injunctive relief. ** this Section is ** to be illegal or unenforceable then neither you nor Company will ** ** arbitrate  Dispute falling within that * of this * found to be illegal or unenforceable and * Dispute shall be decided ** a court of competent jurisdiction within the courts listed for jurisdiction above, and you and Company agree to submit to the personal jurisdiction of * court.&nbsp;</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">CORRECTIONS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Occasionally **  be information on the Sites * contains * errors, inaccuracies or omissions that may relate to service descriptions, pricing, availability, and various other information. Company reserves the right to correct any errors, inaccuracies or omissions and to change or update the information at any time, without prior notice.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">DISCLAIMERS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Company cannot *  nature of all of the content available ** the Sites. By operating the Sites, * does not represent or imply that Company **  blogs, contributions or other content  on or linked to by the Sites,  without limitation content hosted on third party websites or ** by third party applications, or that * believes contributions, blogs ** other content to be accurate, useful ** non-harmful. We do not control and are not responsible for unlawful or  objectionable content you may encounter on the Sites or in connection with any contributions. The Company is not ** for the conduct, whether online ** offline, of any user of  Sites or * Services.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">YOU AGREE THAT YOUR USE OF THE SITES  COMPANY SERVICES * BE AT YOUR SOLE RISK. ** THE * EXTENT PERMITTED BY LAW, COMPANY, ITS OFFICERS, DIRECTORS, EMPLOYEES, AND AGENTS ** ALL WARRANTIES, EXPRESS OR IMPLIED, IN * WITH THE SITES AND THE COMPANY ** AND YOUR USE THEREOF, INCLUDING, * LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS  A PARTICULAR PURPOSE AND NON-INFRINGEMENT. COMPANY MAKES NO * OR REPRESENTATIONS ** THE ACCURACY OR COMPLETENESS OF  SITES * OR THE CONTENT OF ANY WEBSITES LINKED TO OUR SITES AND ASSUMES NO LIABILITY OR RESPONSIBILITY FOR ANY (A) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT  MATERIALS, (B) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY  WHATSOEVER,  FROM YOUR  TO AND USE ** OUR SITES, (C) ANY UNAUTHORIZED ACCESS TO ** USE OF   SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION  THEREIN, (D)  INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM  ** ** COMPANY SERVICES, (E) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR * OUR SITES BY  THIRD PARTY, AND/OR (F) ANY ERRORS ** OMISSIONS IN ANY CONTENT AND  ** FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF  USE OF  CONTENT POSTED, TRANSMITTED, **  *  VIA THE SITES. * DOES NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR  * OR SERVICE ADVERTISED OR OFFERED ** A THIRD PARTY THROUGH THE SITES OR ANY HYPERLINKED SITES OR FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND COMPANY WILL NOT BE A PARTY TO OR IN  WAY BE ** FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT ** SERVICE THROUGH ANY  OR IN ANY ENVIRONMENT,   USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">LIMITATIONS OF LIABILITY</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">IN NO EVENT SHALL COMPANY OR  DIRECTORS, EMPLOYEES, OR AGENTS BE  ** YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF * OR OTHER DAMAGES * * YOUR  OF  SITES OR COMPANY SERVICES, EVEN IF COMPANY HAS BEEN ADVISED OF THE POSSIBILITY ** SUCH DAMAGES. NOTWITHSTANDING ** TO THE CONTRARY  HEREIN, COMPANY&rsquo;S LIABILITY ** YOU FOR ANY ** WHATSOEVER AND REGARDLESS OF  FORM OF THE ACTION, WILL AT ALL TIMES BE LIMITED ** THE AMOUNT PAID, IF ANY, BY YOU TO COMPANY FOR  COMPANY ** DURING THE PERIOD OF THREE MONTHS PRIOR TO ANY CAUSE OF ACTION ARISING.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">CERTAIN STATE LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR  EXCLUSION ** LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, SOME OR ALL ** THE ** ** OR **  NOT ** TO YOU, AND YOU  HAVE ADDITIONAL RIGHTS.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">IF YOU ARE A CALIFORNIA RESIDENT, YOU WAIVE CALIFORNIA CIVIL CODE SECTION 1542, WHICH SAYS: &quot;A GENERAL * * NOT EXTEND TO CLAIMS WHICH THE ** DOES  KNOW OR * TO EXIST ** HIS ** AT THE TIME OF EXECUTING THE RELEASE, WHICH, IF KNOWN BY HIM MUST HAVE MATERIALLY AFFECTED HIS SETTLEMENT *  DEBTOR.&quot;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">INDEMNITY</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;"> agree to defend, indemnify  hold Company,  subsidiaries, and affiliates, and their respective officers, agents, partners and employees, harmless from  against, any loss, damage, liability, claim, or demand,  reasonable attorneys&rsquo; fees and expenses, made by any third party due to ** arising out of your contributed content,  of the Company Services, and/** arising from a breach of this Agreement and/or any breach ** your representations and warranties  forth above.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">  foregoing, Company reserves the right, at your expense, to assume   defense and control of any matter for which you are required **  Company, and you agree to cooperate, at your expense, with Company&rsquo;s * of such claims.</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">Company will use reasonable efforts ** notify  of any such claim, action, or proceeding ** is subject to this indemnification upon becoming aware of it.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">NOTICES</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;"> ** explicitly stated otherwise,  notices given to Company shall be given by email ** the address listed in  contact information below. Any notices given to you shall be given to  email address you provided  the registration process, ** * other * as each party may specify. Notice shall be  to be given twenty-* (24) hours after the ** is sent, unless the sending party is notified that the email address is invalid. We may also choose to send notices by regular mail.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">USER DATA</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Our Sites will ** certain data that you transfer to the Sites for the * of the performance of the Company Services, as well as * relating to your use of the Company Services. Although ** perform regular routine backups of data, you are  responsible for all data that you have ** or * relates to any activity  have undertaken ** the Company Services. You agree that Company shall have no liability to you for any loss ** corruption of  such data, and you hereby waive any right ** action against Company * from any such loss or corruption of such data.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">ELECTRONIC CONTRACTING</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Your use of the Company Services includes the * to enter * agreements and/** to * transactions electronically. YOU ACKNOWLEDGE * * ELECTRONIC SUBMISSIONS CONSTITUTE * AGREEMENT  INTENT TO BE BOUND BY AND TO PAY FOR SUCH AGREEMENTS  TRANSACTIONS. YOUR AGREEMENT AND INTENT TO BE BOUND BY ELECTRONIC SUBMISSIONS APPLIES TO ALL RECORDS RELATING ** ALL TRANSACTIONS YOU ENTER INTO RELATING TO THE COMPANY SERVICES, INCLUDING NOTICES OF CANCELLATION, POLICIES, CONTRACTS, AND APPLICATIONS. In ** to access and retain your electronic records, you may be required ** have certain hardware  software, which are your sole responsibility.&nbsp;</span><span style=" font-size:10pt;">&nbsp;</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">ELECTRONIC SIGNATURES</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Users are allowed on expiringsoon to transmit and receive valid electronic * in the  States under  * Signatures in Global and National Commerce Act (E-Sign Act) of 2000 and the Uniform Electronic Transactions Act (UETA) of 1999 as adopted by individual states. Users&rsquo; signatures and identities  not authenticated on expiringsoon.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style=" font-size:11.5pt;">MISCELLANEOUS</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">This Agreement constitutes the entire agreement between  and Company  the use of the Company Services. The failure of * to exercise ** enforce any right or provision of this Agreement shall not operate as a  of * ** ** provision. The section titles in this Agreement are for convenience only and have no legal or contractual effect. This Agreement operates to the fullest extent ** by law. *  and your account may not be ** by you without our express written consent. Company  assign any or all of its rights  obligations to others at any time. Company ** not be responsible or liable for any loss, damage, delay or failure to act caused by any cause beyond Company&apos;s reasonable control. If any provision or part of a provision of this Agreement ** unlawful, * or unenforceable, that  or part of  provision is deemed severable * this Agreement and does not   ** and enforceability of any remaining provisions. There is ** joint venture, partnership, * or  relationship * between you and Company as a result of this Agreement or use of the Sites  Company Services. Upon Company&rsquo;s request, you will furnish Company any documentation, ** or ** necessary to verify your compliance with this Agreement. You ** * this Agreement will  be construed against Company by virtue of having drafted them. You hereby waive  and all defenses you may have ** on the * form of this  and the lack of * ** the parties hereto to * this Agreement.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><strong><span style="">CONTACT US</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">In order to * a complaint regarding the Company Services or to receive further information regarding use of the Company Services, please * Company **  forth ** or, if any complaint with us is not satisfactorily resolved, and you are a California resident,  can contact the Complaint Assistance Unit of the Division of Consumer Services of the * of Consumer * in writing at 400 &quot;R&quot; Street, Sacramento, California 95814 ** by telephone at 1-916-445-1254.</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Expiringsoon International Inc.</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">13099 Westheimer Rd</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Houston, TX 77077</span><span style=" font-size:10pt;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Email: info@expiringsoon.shop</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:14.4pt;"><span style=" font-size:10pt;">Phone: +1 305 434 7149&nbsp;</span></p>
</div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End    -->

    <!-- Footer Start -->
    <?php include("footer.php"); ?>
    <!-- Footer Area End -->

    <script src="src/lib/js/jquery.min.js"></script>
    <script src="src/lib/js/swiper-bundle.min.js"></script>
    <script src="src/lib/js/bvselect.js"></script>
    <script src="src/lib/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/main.js"></script>
    <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61f6f04e9bd1f31184da1815/1fqm9ldm5';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
  </body>

<!-- Mirrored from shopery.netlify.app/main/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Dec 2021 14:28:45 GMT -->
</html>
