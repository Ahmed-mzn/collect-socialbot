<?php 
include("../includes/connection.php");
include("header.php");

$dont_unset = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $valid = 1 ;
    
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];
    $permission = $_POST['permission'];

    // check if email exist
    $sth = $connect->prepare("SELECT *, COUNT(*) AS check_user FROM USERS WHERE email='".$email."' GROUP BY id");
    $sth->execute();
    $check_email = $sth->fetch(PDO::FETCH_ASSOC);

    if($check_email){
        $valid = 0;
        $msg_error = "تم استخدام البريد الإلكتروني " . $email;
    }

    if($valid){
        $query="INSERT INTO 
        USERS(email, full_name, password, permission) 
        VALUES(:email, :full_name, :password, :permission)";
        $sth = $connect->prepare( $query );
            
        $result = $sth->execute(array( 
                ':email' => $email,
                ':full_name' => $full_name,
                ':password' => $password,
                ':permission' => $permission
            ));
        if($result){
            $_SESSION['msg'] = "تمت إضافة المستخدم بنجاح";
            echo "<script> location.replace('/admin/users.php');</script>";
            $dont_unset = 1;
        } else {
            $_SESSION['msg_error'] = "حدث خطأ ما. أعد المحاولة من فضلك!";
            echo "<script> location.replace('/admin/users.php');</script>";
            $dont_unset = 1;
        }
    } else {
        $_SESSION['msg_error'] = $msg_error;
        echo "<script> location.replace('/admin/users.php');</script>";
        $dont_unset = 1;
    }
}



// delete user
if(isset($_GET['delete_user_id'])){
    $user_id = $_GET['delete_user_id'];

    $sth = $connect->prepare("DELETE FROM USERS WHERE id=".$user_id);
    $result = $sth->execute();

    if($result){
        $_SESSION['msg'] = "تم حذف المستخدم بنجاح";
        echo "<script> location.replace('/admin/users.php');</script>";
        $dont_unset = 1;
    } else {
        $_SESSION['msg_error'] = "حدث خطأ ما. أعد المحاولة من فضلك!";
        echo "<script> location.replace('/admin/users.php');</script>";
        $dont_unset = 1;
    }
}



// get all users
$sth = $connect->prepare("SELECT * FROM USERS");
$sth->execute();
$users = $sth->fetchAll();


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
    <span class="main-content-title mg-b-0 mg-b-lg-1">المستخدمين</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">الدعم</a></li>
            <li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
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
        <a class="btn ripple btn-primary" data-bs-target="#Vertically" data-bs-toggle="modal" href=""><i class="fe fe-plus me-2"></i>إضافة مستخدم</a>
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
                                    <th>الاسم الكامل</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>نوع المستخدم</th>
                                    <th>أجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user){?>
                                <tr>
                                    <td class="d-none">1</td>
                                    <td class="text-center">
                                        <div class="avatar avatar-md bg-primary text-white rounded-circle">
                                            <?php echo strtoupper($user['email'][0]);?>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="tx-14 font-weight-semibold text-dark mb-1"><?php echo $user['full_name'];?></p>
                                        <p class="tx-13 text-muted mb-0"><?php echo $user['email'];?></p>
                                    </td>
                                    <td>
                                        <span class="text-muted tx-13"><?php echo $user['email'];?></span>
                                    </td>
                                    <td>
                                        <span class="text-muted tx-13"><?php echo $user['permission'];?></span>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-outline-danger mx-2 button-icon" data-bs-target="#Vertically2" data-bs-toggle="modal" onclick="check(<?= $user['id']; ?>)"><i class="fe fe-trash me-2"></i>حذف</button>
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
                <h6 class="modal-title">إضافة مستخدم</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="col-form-label">البريد الإلكتروني:</label>
                            <input type="email" class="form-control" name="email" placeholder="أدخل البريد الإلكتروني" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">الاسم الكامل:</label>
                            <input type="text" class="form-control" name="full_name" placeholder="أدخل الاسم الكامل" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">كلمة المرور:</label>
                            <div class="row">
                                <div class="col-2">
                                    <button type="button" onclick="generatePassword()" class="btn btn-dark button-icon" title='توليد كلمة السر'><i class="fe fe-lock"></i></button>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">نوع المستخدم</label>
                            <select name="permission" class="form-control form-select" data-bs-placeholder="اختر صنف">
                                <option value="admin">Admin</option>
                                <option value="agent-order">Agent Order</option>
                                <option value="agent-call">Agent Call</option>
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
                <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4>هل أنت متأكد تريد حذف المستخدم ؟</h4>
                <form action="" method="GET">
                    <input type="text" name="delete_user_id" class="d-none" id="user_id">
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
    function generatePassword(){
        document.getElementById("password").value = generate();
    }

    function generate(length=20) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWabcdefghijklmnopqrstuvw0123456789@';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function check(id){
        document.getElementById("user_id").value = id;
    }
</script>



<?php include("footer.php");?>