<?php

use App\Models\User;
use App\Models\Customer;

if (isset($_POST['DANGKY'])) {
   $user = new User();
   if ($user == NULL) {
      header("location:index.php?option=customer&register=true");
   }
   //lấy từ form
   if (($_POST['name']) == NULL) {
      header("location:index.php?option=customer&register=true");
   } else {
      $user->name = $_POST['name'];
      $user->username = $_POST['username'];
      $user->email = $_POST['email'];
      $user->password = $_POST['password'];
      $user->gender = $_POST['gender'];
      $user->phone = $_POST['phone'];
      $user->address = $_POST['address'];

      $user->created_at = date('Y-m-d H:i:s');
      $user->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
      var_dump($user);
      //lưu vào CSDL
      $user->save();
   }

   $customer = new Customer();

   $customer->name = $_POST['name'];
   $customer->customername = $_POST['username'];
   $customer->email = $_POST['email'];
   $customer->password = $_POST['password'];
   $customer->gender = $_POST['gender'];
   $customer->phone = $_POST['phone'];
   $customer->address = $_POST['address'];

   //tự sinh ra
   $customer->created_at = date('Y-m-d H:i:s');
   $customer->created_by = (isset($_SESSION['customer_id'])) ? $_SESSION['user_id'] : 1;
   var_dump($customer);
   //lưu vào CSDL
   $customer->save();

   $_SESSION['iscustom'] = $username;
   $_SESSION['user_id'] = $customer->id;
   $_SESSION['name'] = $customer->name;

   //huyển hướng về index
   header("location:index.php");
}
?>



<?php require 'views/frontend/header.php'; ?>
<section class="bg-light">
   <div class="container">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
         <ol class="breadcrumb py-2 my-0">
            <li class="breadcrumb-item">
               <a class="text-main" href="index.html">Trang chủ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
               Đăng ký tài khoản
            </li>
         </ol>
      </nav>
   </div>
</section>
<section class="hdl-maincontent py-2">
   <form action="index.php?option=customer&register" method="post" name="registercustomer">
      <div class="container">
         <h1 class="fs-2 text-main text-center">ĐĂNG KÝ TÀI KHOẢN</h1>
         <div class="row">
            <div class="col-md-6">
               <div class="mb-3">
                  <label for="name" class="text-main">Họ tên(*)</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="nhập họ tên" required>
               </div>
               <div class="mb-3">
                  <label for="phone" class="text-main">Điện thoại(*)</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập điện thoại" required>
               </div>
               <div class="mb-3">
                  <div class="card">
                     <div class="card-header text-main">
                        Địa chỉ
                     </div>
                     <div class="card-body">
                        <div class="mb-3">
                           <label for="address">Địa chỉ</label>
                           <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                        <!-- <div class="row">
                           <div class="col-4">
                              <select name="tinhtp" id="tinhtp" class="form-control">
                                 <option value="">Chọn Tỉnh/TP</option>
                              </select>
                           </div>
                           <div class="col-4">
                              <select name="quanhuyen" id="quanhuyen" class="form-control">
                                 <option value="">Chọn Quận/Huyện</option>
                              </select>
                           </div>
                           <div class="col-4">
                              <select name="phuongxa" id="phuongxa" class="form-control">
                                 <option value="">Chọn Phường/Xã</option>
                              </select>
                           </div>
                        </div> -->
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <label>Giới tính</label>
                  <select name="gender" class="form-control">
                     <option value="1">Nam </option>
                     <option value="2">Nữ</option>
                  </select>
               </div>
               <!-- <div class="mb-3">
                  <label class="text-main">Giới tính</label>
                  <div class="form-check form-switch">
                     <input name="gennder" class="form-check-input" type="checkbox" role="switch" id="gennder" checked onchange="changeGender()">
                     <label class="form-check-label" id="gennder" for="gennder">Nam</label>
                  </div>
               </div>
               <script>
                  function changeGender() {
                     const elementGender = document.querySelector("#gennder").checked;
                     if (elementGender == true) {
                        document.querySelector("#gennder").innerHTML = "Nam";
                     } else {
                        document.querySelector("#gennder").innerHTML = "Nữ";
                     }
                  }
               </script>-->
            </div>
            <div class="col-md-6">
               <div class="mb-3">
                  <label for="username" class="text-main">Tên tài khoản(*)</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tài khoản đăng nhập" required>
               </div>
               <div class="mb-3">
                  <label for="email" class="text-main">Email(*)</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="text-main">Mật khẩu(*)</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required>
               </div>
               <div class="mb-3">
                  <label for="password_re" class="text-main">Xác nhận Mật khẩu(*)</label>
                  <input type="password" name="password_re" id="password_re" class="form-control" placeholder="Xác nhận mật khẩu" required>
               </div>
               <div class="mb-3">
                  <button class="btn btn-main" type="submit" name="DANGKY">Đăng ký</button>
               </div>
            </div>
         </div>
      </div>
   </form>
</section>
<?php require 'views/frontend/footer.php'; ?>