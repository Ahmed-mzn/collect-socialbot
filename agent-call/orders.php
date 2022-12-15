<?php
include("header.php");


// get all cart messages from help db
// Setup cURL
$ch = curl_init("http://localhost/khaled/api/cart-messages.php?user_id=".$_SESSION['store_user_id']);
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => TRUE,
));


// Send the request
$response = curl_exec($ch);

// Decode the response
$responseData = json_decode($response, TRUE);

$orders = $responseData;


?>



<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
    <span class="main-content-title mg-b-0 mg-b-lg-1">لوحة القيادة</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">لوحة القيادة</a></li>
            <li class="breadcrumb-item active" aria-current="page">الأساسية</li>
        </ol>
    </div>
</div>
<!-- /breadcrumb -->




<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="pd-10">
                        <div class="btn-group ms-2 mt-2 mb-2">
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-rounded btn-outline-primary" data-bs-toggle="dropdown" id="dropdownMenuButton12" type="button">Menu <i class="fas fa-caret-down ms-1"></i></button>
                                <div  class="dropdown-menu tx-13">
                                    <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pd-10 mg-t-10">
                        <span class="tx-20 text-primary">كمية العربة</span>
                    </div>
                    <div class="pd-10 mg-t-10">
                        <span class="tx-20">كمية العربة</span>
                    </div>
                </div>
                
                <div class="d-flex flex-row justify-content-around">
                    <div class="pd-10 ">
                        <span>كمية العربة</span>
                        <h5 class="text-primary mg-t-20">100.00 $</h5>
                    </div>
                    <div class="pd-10 ">
                        <span>كمية العربة</span>
                        <h5 class="text-primary mg-t-20">100.00 $</h5>
                    </div>
                    <div class="pd-10">
                        <span>كمية العربة</span>
                        <h5 class="text-primary mg-t-20">-</h5>
                    </div>
                    <div class="pd-10">
                        <span>كمية العربة</span>
                        <h5 class="text-primary mg-t-20">-</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="table-responsive  export-table">
                    <table id="file-datatable" class="table table-bordered table-hover text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Created At</th>
                                <th class="border-bottom-0">cart_id</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order){?>
                                <tr>
                                    <td><?= $order['created_at']?></td>
                                    <td><?= $order['cart_id']?></td>
                                    <td><?= $order['reciver_name']?></td>
                                    <td><?= $order['amount']?></td>
                                    <td><?= $order['status']?></td>
                                    <td>
                                        <a onclick="getOrderDetails(<?= $order['id']?>)" class="btn btn-outline-primary btn-rounded" href="#">View Demo</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->



<!-- Large Modal -->
<div class="modal fade" id="modaldemo3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo bg-gray-200">
            <div class="container mg-t-20">
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="card p-2">
                            <span class="tx-20 tx-medium mg-b-10">بيانات العميل</span>
                            <input id="inputCustomerName" class="form-control form-control mg-b-10" placeholder="Input box" type="text">
                            <select class="form-select form-select-sm mg-b-10">
                                <option id="inputCustomerCity" value="1" selected>المدينة المنورة</option>
                                <option value="2">Mekka</option>
                            </select>
                            <input class="form-control form-control mg-b-10" value="النصر" placeholder="Input box" type="text">
                            <input class="form-control form-control mg-b-10" value="شارع عبد الناصر" placeholder="Input sm box" type="text">
                        </div>
                    </div>
                    <div id="itemsPlace" class="col-sm-12 col-md-12 col-lg-4 col-xl-4 bg-gray-200">
                        <div class="card-header pb-0 bg-gray-200">
                            <h5 class="card-title mb-0 pb-0 tx-15">السلة</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="media d-block d-sm-flex mg-r-5 mg-l-5 mg-b-10 mg-t-5" style="padding: 1rem;border: 1px solid #ededf5; border-radius: 7px;">
                                <div class="media-body">
                                    <h6 id="headCustomerName" class="mg-b-5 tx-inverse"></h6>
                                    <span class="text-primary">01:02</span><br>
                                </div>
                                <i class="fa fa-phone text-danger tx-20"></i>
                            </div>

                            <div class="mg-r-5 mg-l-10 mg-b-10 mg-t-5">
                                <span class="tx-15 tx-medium">كمية العربة</span>
                                <br>
                                <s><small class="tx-15 mg-r-10">300 $</small></s>
                                <span id="cartAmount" class="tx-primary tx-15"></span>
                                <div class="form-group mg-t-10">
                                    <select class="form-select form-select-sm">
                                        <option value="1">10%</option>
                                        <option value="2">100%</option>
                                    </select>
                                </div>
                                <span class="tx-15 tx-medium">هل يريد الطلب ؟</span>
                                <div class="custom-controls-stacked mg-t-10">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="example-radios" value="option1" checked="">
                                        <span class="custom-control-label">Option 1</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="example-radios" value="option2">
                                        <span class="custom-control-label">Option 2</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="example-radios" value="option3">
                                        <span class="custom-control-label">Option 3</span>
                                    </label>
                                </div>
                                <span class="tx-15 tx-medium">هل يريد الطلب</span>
                                <textarea class="form-control mg-t-10" placeholder="Textarea" rows="3"></textarea>
                            </div>
                            <div class="row p-2">
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-block">إلغاء</button>
                                </div>
                                <div class="col-8">
                                    <button type="button" class="btn btn-primary btn-sm btn-block">تأكيد</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Large Modal -->

<script>
    function getOrderDetails(id){
        document.getElementById('itemsPlace').innerHTML = `
            <div class="card-header pb-0 bg-gray-200">
                <h5 class="card-title mb-0 pb-0 tx-15">السلة</h5>
            </div>
        `
        console.log(id);

        fetch('http://localhost/khaled/api/get-cart-message.php?cart_id='+id, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let customer = JSON.parse(data.customer);
            document.getElementById('inputCustomerName').value = customer.name;
            document.getElementById('headCustomerName').innerText = customer.name;
            document.getElementById('inputCustomerCity').innerText = customer.city;

            document.getElementById('cartAmount').innerText = data.amount + ' ر.س';

            let items = JSON.parse(data.items);
            for(let i=0; i< items.length;i++){
                fetch('https://api.salla.dev/admin/v2/products/'+items[i].product_id, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer <?= $_SESSION['store_user_access_token'] ?>'
                    },
                })
                .then(response2 => response2.json())
                .then(details => {
                    console.log(details);
                    document.getElementById('itemsPlace').innerHTML += `
                        <div class="card mg-t-10">
                            <div class="media d-block d-sm-flex mg-r-5 mg-l-5 mg-b-10 mg-t-5">
                                <img src="${details.data.images[0].url}" class="avatar br-5 avatar-lg me-3 my-auto" alt="avatar-img">
                                <div class="media-body">
                                    <h6 class="mg-b-5 tx-inverse">${details.data.name}</h6>
                                    <span class="text-primary">${details.data.price.amount} ر.س</span><br>
                                    <div aria-label="Basic example" class="btn-group mg-t-5" role="group">
                                        <button class="btn btn-white btn-icon btn-rounded" type="button"><i class="typcn typcn-plus"></i></button>
                                        <button class="btn btn-white btn-icon" type="button">${items[i].quantity}</button>
                                        <button class="btn btn-white btn-icon btn-rounded" type="button"><i class="typcn typcn-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                })
            }
        })
        $('#modaldemo3').modal('show');
    }
</script>

<?php include("footer.php");?>