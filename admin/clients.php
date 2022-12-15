<?php 
include("../includes/connection.php");
include("header.php");

$dont_unset = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $valid = 1;

    $user = $_POST['user'];
    $split_user = explode("{--}", $user);

    $user_id = $split_user[0];
    $website = $split_user[1];


    // check if store exist
    $sth = $connect->prepare("SELECT *, COUNT(*) AS check_store FROM CLIENTS WHERE user_id=".$user_id." AND website='$website' GROUP BY id");
    $sth->execute();
    $check_store = $sth->fetch(PDO::FETCH_ASSOC);

    if($check_store){
        $valid = 0;
        $msg_error = "المتجر تمت إضافته من قبل";
    }

    if($valid){
        $query="INSERT INTO CLIENTS(user_id, website) VALUES(:user_id, :website)";
        $sth = $connect->prepare( $query );
            
        $result = $sth->execute(array( 
                ':user_id' => $user_id,
                ':website' => $website
            ));
        if($result){
            $_SESSION['msg'] = "تمت إضافة المتجر بنجاح";
            echo "<script> location.replace('/admin/clients.php');</script>";
            $dont_unset = 1;
        } else {
            $_SESSION['msg_error'] = "حدث خطأ ما. أعد المحاولة من فضلك!";
            echo "<script> location.replace('/admin/clients.php');</script>";
            $dont_unset = 1;
        }
    } else {
        $_SESSION['msg_error'] = $msg_error;
        echo "<script> location.replace('/admin/clients.php');</script>";
        $dont_unset = 1;
    }
}


// delete user
if(isset($_GET['delete_client_id'])){
    $client_id = $_GET['delete_client_id'];

    $sth = $connect->prepare("DELETE FROM CLIENTS WHERE id=".$client_id);
    $result = $sth->execute();

    if($result){
        $_SESSION['msg'] = "تم حذف المتجر بنجاح";
        echo "<script> location.replace('/admin/clients.php');</script>";
        $dont_unset = 1;
    } else {
        $_SESSION['msg_error'] = "حدث خطأ ما. أعد المحاولة من فضلك!";
        echo "<script> location.replace('/admin/clients.php');</script>";
        $dont_unset = 1;
    }
}




// get all clients
$sth = $connect->prepare("SELECT * FROM CLIENTS");
$sth->execute();
$clients = $sth->fetchAll();


// get all users from help db
// Setup cURL
$ch = curl_init("http://localhost/khaled/api/users.php");
curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => TRUE,
));


// Send the request
$response = curl_exec($ch);

// Decode the response
$responseData = json_decode($response, TRUE);

$help_users = $responseData;


$message = '';
if(isset($_SESSION['msg']) && $dont_unset == 0) { 
    $message = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$message_error = '';
if(isset($_SESSION['msg_error']) && $dont_unset == 0) { 
    $message_error = $_SESSION['msg_error'];
    unset($_SESSION['msg_error']);
}
?>

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
    <span class="main-content-title mg-b-0 mg-b-lg-1">المتاجر</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">الدعم</a></li>
            <li class="breadcrumb-item active" aria-current="page">المتاجر</li>
        </ol>
    </div>
</div>
<!-- /breadcrumb -->

<!-- success msg -->
<?php if($message != '') { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>شكرًا!</strong> <?php echo $message; ?>
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
    </div>
<?php } ?>


<!-- error msg -->
<?php if($message_error != '') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>تحذير!</strong> <?php echo $message_error; ?>
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
    </div>
<?php } ?>


<div class="breadcrumb-header justify-content-between">
    <div class="left-content mt-2">
        <a class="btn ripple btn-primary" data-bs-target="#Vertically" data-bs-toggle="modal" href=""><i class="fe fe-plus me-2"></i>إضافة متجر</a>
    </div>
</div>


    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive  deleted-table">
                        <table id="user-datatable" class="table table-bordered text-nowrap border-bottom Userlist">
                            <thead>
                                <tr>
                                    <th class="d-none">#</th>
                                    <th class="wd-2">
                                        #
                                    </th>
                                    <th>معرف المستخدم</th>
                                    <th>موقع الكتروني</th>
                                    <th>أجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($clients as $client){?>
                                    <tr>
                                        <td class="d-none">1</td>
                                        <td class="text-center"><?php echo $client['id'];?></td>
                                        <td><?php echo $client['user_id'];?></td>
                                        <td>
                                            <?php echo $client['website'];?>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-outline-danger mx-2 button-icon" data-bs-target="#Vertically2" data-bs-toggle="modal" onclick="check(<?= $client['id']; ?>)"><i class="fe fe-trash me-2"></i>حذف</button>
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



<!-- New User Modal-->
<div class="modal fade" id="Vertically">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة متجر</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="col-form-label">اختر المستخدم</label>
                            <select name="user" class="form-control form-select">
                                <?php foreach($help_users as $help_user){ ?>
                                    <option value="<?= $help_user['id']?>{--}<?= $help_user['website']?>"><?= $help_user['full_name']?> - <?= $help_user['email']?></option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">حفظ</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">أغلق</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /New User Modal-->



<!--  Approve Modal-->
<div class="modal fade" id="Vertically2">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف المتجر</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4>هل أنت متأكد تريد حذف المتجر ؟</h4>
                <form action="" method="GET">
                    <input type="text" name="delete_client_id" class="d-none" id="client_id">
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">نعم</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">لا</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- / Approve Modal-->


<script>

    function check(id){
        document.getElementById("client_id").value = id;
    }
</script>





<?php include("footer.php");?>