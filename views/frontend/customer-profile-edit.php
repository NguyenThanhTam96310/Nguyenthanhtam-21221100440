<?php

use App\Libraries\MyClass;
use App\Models\User;

if (isset($_POST['CHANGEADDRES'])) {

   $id = $_POST['id'];
   $user = User::find($id);
   if ($user == NULL) {
      /// MyClass::set_flash('message', ['msg' => 'Lỗi trang 404', 'type' => 'danger']);
      header("location:index.php?option=user");
   }
   //lấy từ form
   if ($_POST['name'] == NULL) {
      //MyClass::set_flash('message', ['msg' => 'Cập nhật thất bại', 'type' => 'danger']);
      header("location:index.php?option=category");
   } else {
      $user->name = $_POST['name'];
      $user->username = $_POST['username'];
      $user->email = $_POST['email'];
      $user->gender = $_POST['gender'];
      $user->phone = $_POST['phone'];
      $user->roles = $_POST['roles'];
      $user->address = $_POST['address'];
      $user->status = $_POST['status'];
      //xử lí upload file hình ảnh
      if (strlen($_FILES['image']['name']) > 0) {
         $target_dir = "../public/images/user/";
         unlink($target_dir . $data['image']);
         $target_file = $target_dir . basename($_FILES["image"]["name"]);
         $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         if (in_array($extension, ['jpg', 'jpeg', 'png' . 'gif', 'webp'])) {
            $filename = $user->slug . '.' . $extension;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $filename);
            $user->image = $filename;
         }
      }
      //tự sinh ra
      $user->updated_at = date('Y-m-d H:i:s');
      $user->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
      var_dump($user);
      $user->save();
      //chuyển hướng về index
      MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
      header("location:index.php?option=customer&profile=true");
   }
}

?>


<?php require 'views/frontend/header.php'; ?>
<form action="index.php?option=customer&profile-edit" method="post">
   <section class="bg-light">
      <div class="container">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-2 my-0">
               <li class="breadcrumb-item">
                  <a class="text-main" href="index.html">Trang chủ</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
            </ol>
         </nav>
      </div>
   </section>
   <section class="hdl-maincontent py-2">
      <div class="container">
         <div class="row">
            <div class="call-login--register border-bottom">
               <ul class="nav nav-fills py-0 my-0">
                  <?php if (isset($_SESSION['name'])) : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="index.php?option=customer&profile=true">
                           Tên khách hàng: <?php echo $_SESSION['name']; ?>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="index.php?option=customer&logout=true">Đăng xuất</a>
                     </li>
                  <?php endif; ?>
               </ul>
            </div>
            <div class="col-md-9 order-1 order-md-2">
               <h1 class="fs-2 text-main">Thông tin tài khoản</h1>
               <table class="table table-borderless">
                  <td>Địa chỉ</td>
                  <td>
                     <input type="address" name="address" class="form-control" />
                  </td>
                  </tr>
                  <tr>
                     <td>
                        <button class="btn btn-main " type="submit" name="CHANGEADDRESS">
                           Đổi địa chỉ
                        </button>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </section>
</form>
<?php require 'views/frontend/footer.php'; ?>