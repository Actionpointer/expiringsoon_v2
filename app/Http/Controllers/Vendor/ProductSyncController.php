<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use App\Http\Traits\OptimizationTrait;

class ProductSyncController extends Controller
{
  use OptimizationTrait;

    public function index(Shop $shop){
        return view('vendor.shop.product.sync',compact('shop'));
    }
    public function wordpress(Shop $shop,Request $request){

        $url = rtrim($request->url,"/");
        $key = trim($request->key);
        $secret = trim($request->secret);
        $path = $url.'/wp-json/wc/v3/products?consumer_key='.$key.'&consumer_secret='.$secret;
        // $responses = Curl::to("https://soonexpiring.com/wp-json/wc/v3/products?consumer_key=ck_08b146939a5af5a7b77bd781c6bbb2653f24c074&consumer_secret=cs_3069964cd932e40979d11a52984f21ef4e821e00")
        $responses = Curl::to($path)
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        // dd($responses);
        foreach($responses as $response){
            //dd(empty($response->sale_price));
            $product = Product::create([
            'name'=> $response->name,'shop_id'=> $shop->id,'expire_at'=> null,
            'description'=> strip_tags($response->description),'stock'=> $response->stock_quantity ?? 0,
            'tags' => array_filter(array_column($response->tags,'name')),
            'photo' => count(array_filter(array_column($response->images,'src'))) ? $this->imageFromUrl(array_filter(array_column($response->images,'src'))[0]) : null,
            'price' => intval($response->price),'discount30' => intval($response->sale_price),'discount60'=> intval($response->sale_price),
            'discount90' => intval($response->sale_price),'discount120'=> intval($response->sale_price),
            'published'=> $response->status == 'publish' ? 1: 0,
            'length'=> intval($response->dimensions->length),'width'=> intval($response->dimensions->width),
            'height'=> intval($response->dimensions->height),'weight'=> intval($response->weight),
            'units'=> ['cm','kg']]);
        }
        return redirect()->route('vendor.shop.product.list',$shop)->with(['result'=>1,'message'=> 'Products Synced Successfully']);

    } 
}
/*
    +"short_description": ""
    +"sku": ""
    +"price": "25"
    +"regular_price": "25"
    +"sale_price": ""
    +"date_on_sale_from": null
    +"date_on_sale_from_gmt": null
    +"date_on_sale_to": null
    +"date_on_sale_to_gmt": null
    +"on_sale": false
    +"purchasable": true
    +"total_sales": 0
    +"virtual": false
    +"downloadable": false
    +"downloads": []
    +"download_limit": -1
    +"download_expiry": -1
    +"external_url": ""
    +"button_text": ""
    +"tax_status": "taxable"
    +"tax_class": ""
    +"manage_stock": false
    +"stock_quantity": null
    +"backorders": "no"
    +"backorders_allowed": false
    +"backordered": false
    +"low_stock_amount": null
    +"sold_individually": false
    +"weight": "3629"
    +"dimensions": {#1739 ▼
      +"length": ""
      +"width": ""
      +"height": ""
    }
    +"shipping_required": true
    +"shipping_taxable": true
    +"shipping_class": ""
    +"shipping_class_id": 0
    +"reviews_allowed": true
    +"average_rating": "0.00"
    +"rating_count": 0
    +"upsell_ids": []
    +"cross_sell_ids": []
    +"parent_id": 0
    +"purchase_note": ""
    +"categories": array:1 [▼
      0 => {#1752 ▼
        +"id": 41
        +"name": "Shirts"
        +"slug": "shirts"
      }
    ]
    +"tags": array:3 [▼
      0 => {#1745 ▼
        +"id": 36
        +"name": "example"
        +"slug": "example"
      }
      1 => {#1750 ▼
        +"id": 34
        +"name": "mens"
        +"slug": "mens"
      }
      2 => {#1722 ▼
        +"id": 35
        +"name": "t-shirt"
        +"slug": "t-shirt"
      }
    ]
    +"images": array:1 [▼
      0 => {#1747 ▼
        +"id": 965
        +"date_created": "2024-06-20T17:16:59"
        +"date_created_gmt": "2024-06-20T17:16:59"
        +"date_modified": "2024-06-20T17:16:59"
        +"date_modified_gmt": "2024-06-20T17:16:59"
        +"src": "https://soonexpiring.com/wp-content/uploads/2024/06/pexels-photo-428340-428340.jpg"
        +"name": "pexels-photo-428340-428340"
        +"alt": "pexels-photo-428340-428340.jpg"
      }
    ]
    +"attributes": array:1 [▼
      0 => {#1755 ▼
        +"id": 0
        +"name": "Title"
        +"slug": "Title"
        +"position": 0
        +"visible": true
        +"variation": false
        +"options": array:1 [▼
          0 => "Lithograph - Height: 9" x Width: 12""
        ]
      }
    ]
    +"default_attributes": []
    +"variations": []
    +"grouped_products": []
    +"menu_order": 0
    +"price_html": "<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#8358;</span>25.00</bdi></span>"
    +"related_ids": array:2 [▼
      0 => 955
      1 => 954
    ]
    +"meta_data": array:13 [▼
      0 => {#1756 ▼
        +"id": 612
        +"key": "_last_editor_used_jetpack"
        +"value": "classic-editor"
      }
      1 => {#1757 ▼
        +"id": 828
        +"key": "_aioseo_keywords"
        +"value": []
      }
      2 => {#1758 ▼
        +"id": 831
        +"key": "_aioseo_og_article_section"
        +"value": ""
      }
      3 => {#1759 ▼
        +"id": 832
        +"key": "_aioseo_og_article_tags"
        +"value": []
      }
      4 => {#1760 ▼
        +"id": 835
        +"key": "_monsterinsights_sitenote_active"
        +"value": "0"
      }
      5 => {#1761 ▼
        +"id": 836
        +"key": "site-sidebar-layout"
        +"value": "default"
      }
      6 => {#1762 ▼
        +"id": 838
        +"key": "ast-site-content-layout"
        +"value": "default"
      }
      7 => {#1763 ▼
        +"id": 839
        +"key": "site-content-style"
        +"value": "default"
      }
      8 => {#1764 ▼
        +"id": 840
        +"key": "site-sidebar-style"
        +"value": "default"
      }
      9 => {#1765 ▼
        +"id": 841
        +"key": "theme-transparent-header-meta"
        +"value": "default"
      }
      10 => {#1766 ▼
        +"id": 842
        +"key": "astra-migrate-meta-layouts"
        +"value": "set"
      }
      11 => {#1767 ▼
        +"id": 900
        +"key": "_uag_page_assets"
        +"value": {#1768 ▼
          +"css": """
            
    .wp-block-uagb-image{display:flex}.wp-block-uagb-image__figure{position:relative;display:flex;flex-direction:column;max-width:100%;height:auto;margin:0}.wp-bloc
    ▶

                
    .uagb-block-99b8d418.wp-block-uagb-image--layout-default figure img{box-shadow: 0px 0px 0 #00000070;}.uagb-block-99b8d418.wp-block-uagb-image .wp-block-uagb-ima
    ▶

                
    .wp-block-uagb-advanced-heading.uagb-block-4fea8c24.wp-block-uagb-advanced-heading {padding-top: 0px;padding-right: 0px;padding-bottom: 10px;padding-left: 0px;}
    ▶

            """
          +"js": ""
          +"current_block_list": array:10 [▼
            0 => "core/search"
            1 => "core/group"
            2 => "core/heading"
            3 => "core/latest-posts"
            4 => "core/latest-comments"
            5 => "core/archives"
            6 => "core/categories"
            7 => "uagb/image"
            8 => "uagb/advanced-heading"
            9 => "surecart/cart-menu-icon"
          ]
          +"uag_flag": true
          +"uag_version": "1718904119"
          +"gfonts": []
          +"gfonts_url": ""
          +"gfonts_files": []
          +"uag_faq_layout": false
        }
      }
      12 => {#1769 ▼
        +"id": 917
        +"key": "_uag_css_file_name"
        +"value": "uag-css-951.css"
      }
    ]
    +"stock_status": "instock"
    +"has_options": false
    +"post_password": ""
    +"aioseo_notices": []
    +"jetpack_sharing_enabled": true
    +"uagb_featured_image_src": []
    +"uagb_author_info": {#1770 ▼
      +"display_name": ""
      +"author_link": "https://soonexpiring.com/author/"
    }
    +"uagb_comment_info": 0
    +"uagb_excerpt": "
Unmatched Comfort Finding the right t-shirt can feel like a never-ending quest. Luckily, our collection of t-shirts for men is designed with your comfort in min
 ▶
"
    +"_links": {#1772 ▼
      +"self": array:1 [▼
        0 => {#1771 ▼
          +"href": "https://soonexpiring.com/wp-json/wc/v3/products/951"
        }
      ]
      +"collection": array:1 [▼
        0 => {#1773 ▼
          +"href": "https://soonexpiring.com/wp-json/wc/v3/products"
        }
      ]
    }
  }

  */

