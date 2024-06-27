@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}" />

@endpush
@section('title') Upload Products | Expiring Soon @endsection
@section('main')
<!-- breedcrumb section start  -->
<div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
        <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
        <div class="container">
            <ul class="breedcrumb__content">
                <li>
                    <a href="{{route('index')}}">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span> > </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('home')}}">
                        Account
                        <span> > </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('vendor.shop.show',$shop)}}">
                        {{$shop->name}}
                        <span> > </span>
                    </a>
                </li>
                <li class="active"><a href="#">Upload Products</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- breedcrumb section end   -->
@include('layouts.session')
<div class="dashboard section">
    <div class="container">
        <div class="row dashboard__content">
            @include('layouts.shop_navigation')
            <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
                <div class="dashboard__order-history">
                    <div class="dashboard__order-history-title">
                        <h2 class="font-body--xl-500">Upload Products</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="mb-2">Instructions</h6>
                            <p>
                                Limit each upload to a maximum of 100 rows if you have a large quantity of rows you intend to import, for excellent upload experience. Laboriosam rem at ut tenetur amet quas, dolores quo ullam qui sunt impedit vero commodi odit animi nemo sequi dolorem velit accusantium.
                            </p>
                            <table class="table">
                                <tr>
                                    <th>Field</th>
                                    <th>Description</th>
                                    <th>Constraint</th>
                                </tr>
                                <tr>
                                    <td>name</td>
                                    <td>The title of the product</td>
                                    <td>Required. Product will not be uploaded if absent</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>Suitable description cupiditate voluptas ab placeat exercitationem consequuntur dolorum numquam? Quas quam excepturi quia odit facilis.</td>
                                    <td>Required. Product will not be uploaded if absent</td>
                                </tr>
                                <tr>
                                    <td>price</td>
                                    <td>any whole number. decimals are supported. e.g 56.3</td>
                                    <td>Required. Product will not be uploaded if absent</td>
                                </tr>
                                <tr>
                                    <td>stock</td>
                                    <td>Available quantity.</td>
                                    <td>Required. Product will not be uploaded if absent</td>
                                </tr>
                                <tr>
                                    <td>published</td>
                                    <td>1 or 0. <i class="small">(1 means published, 0 means draft)</i></td>
                                    <td>Optional. Defaults to 0 (draft) when absent.</td>
                                </tr>
                                <tr>
                                    <td>expire_at</td>
                                    <td>Tempore nobis officia quos porro itaque dolore accusamus</td>
                                    <td>Optional. Product will be uploaded but cannot be published without expiry date</td>
                                </tr>
                                <tr>
                                    <td>tags</td>
                                    <td>Comma seperated list of tags.</td>
                                    <td>Optional. Product will be uploaded but cannot be published without tags</td>
                                </tr>
                                <tr>
                                    <td>photo</td>
                                    <td>Image url ending with .jpg or .jpeg or .png. <br>For example: <i class="small">https://toothpasteimageurl.jpg</i></td>
                                    <td>Optional. Product will be uploaded but cannot be published without photo</td>
                                </tr>
                                <tr>
                                    <td>length</td>
                                    <td>Length of the product in centimeter (cm) or inches (i). If unit is not specified, cm will be used as default. To specify unit, separate the value from the unit with a single space. e.g 5 cm</td>
                                    <td>Optional. Product will be uploaded but cannot be published without length dimension</td>
                                </tr>
                                <tr>
                                    <td>width</td>
                                    <td>Width of the product in centimeter (cm) or inches (i). <br>If unit is not specified, cm will be used as default. <br>To specify unit, separate the value from the unit with a single space. e.g 15 in</td>
                                    <td>Optional. Product will be uploaded but cannot be published without width dimension</td>
                                </tr>
                                <tr>
                                    <td>height</td>
                                    <td>Height of the product in centimeter (cm) or inches (i).<br> If unit is not specified, cm will be used as default.<br> To specify unit, separate the value from the unit with a single space. e.g 21 cm</td>
                                    <td>Optional. Product will be uploaded but cannot be published without height dimension. </td>
                                </tr>
                                <tr>
                                    <td>weight</td>
                                    <td>Weight of the product in gram (g), kilogram (kg), Ounces (oz) or Pounds (lb). <br>If unit is not specified, g will be used as default.<br> To specify unit, separate the value from the unit with a single space. e.g 50 g</td>
                                    <td>Optional. Product will be uploaded but cannot be published without weight</td>
                                </tr>
                                <tr>
                                    <td>discount30</td>
                                    <td>Cumque ipsa veritatis? Laboriosam fuga culpa nisi amet quos voluptates.</td>
                                    <td>Optional. Product will be uploaded but cannot be published without discount30</td>
                                </tr>
                                <tr>
                                    <td>discount60</td>
                                    <td>Cumque ipsa veritatis? Laboriosam fuga culpa nisi amet quos voluptates</td>
                                    <td>Optional. Product will be uploaded but cannot be published without discount60</td>
                                </tr>
                                <tr>
                                    <td>discount90</td>
                                    <td>Cumque ipsa veritatis? Laboriosam fuga culpa nisi amet quos voluptates</td>
                                    <td>Optional. Product will be uploaded but cannot be published without discount90</td>
                                </tr>
                                <tr>
                                    <td>discount120</td>
                                    <td>nderit aliquid porro dolorem non sequi illo, officiis officia error ex.</td>
                                    <td>Optional. Product will be uploaded but cannot be published without discount120</td>
                                </tr>


                            </table>
                        </div>

                        <div class="mb-3">
                            <h6 class="">Download Sample: <a href="{{route('vendor.shop.product.template',$shop)}}">click here to download product upload template.xls</a></h6>
                            <small>This template is specifically crafted for {{$shop->name}} shop</small>
                        </div>
                        <div class="mb-3">
                            <form action="{{route('vendor.shop.product.upload_file',$shop)}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="d-flex">
                                    <h6 class="mb-2">Upload File: <input type="file" name="products" id="" accept=".xls, .xlsx, .csv"></h6>
                                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>

</script>
@endpush