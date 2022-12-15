<?php include("header.php");?>



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



<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-9 col-lg-7 col-md-6 col-sm-12">
                                <div class="text-justified align-items-center">
                                    <h3 class="text-dark font-weight-semibold mb-2 mt-0"> مرحبًا بعودتك <span class="text-primary"><?=$_SESSION['full_name']?> !</span></h3>
                                    <p class="text-dark tx-14 mb-3 lh-3"> لقد قمت باتمام 50٪ من قائمة المهام الرئيسية. يرجى اتمام جميع المهام الموجودة في قائمة المهام الرئيسية.</p>
                                    <button class="btn btn-primary shadow">تحديث الآن</button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                                <div class="chart-circle float-md-end mt-4 mt-md-0" data-value="0.5" data-thickness="8" data-color=""><canvas width="96" height="96"></canvas><canvas width="100" height="100"></canvas>
                                    <div class="chart-circle-value circle-style"><div class="tx-18 font-weight-semibold">50%</div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("footer.php");?>
