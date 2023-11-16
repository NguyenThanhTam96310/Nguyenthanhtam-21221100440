<?php
use App\Libraries\MyClass;
use App\Models\User;

if (isset($_POST['CHANEGPASSWORD'])) {

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
      $user->slug = (strlen($_POST['slug']) > 0) ? $_POST['slug'] : MyClass::str_slug($_POST['name']);
      $user->description = $_POST['description'];
      $user->status = $_POST['status'];
      var_dump($user);

      $user->save();
      //chuyển hướng về index
      MyClass::set_flash('message', ['msg' => 'Cập nhật thành công', 'type' => 'success']);
      header("location:index.php?option=user");
   }
}

?>


<?php require 'views/frontend/header.php'; ?>
<form action="index.php?option=customer&register=true" method="post">
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
                  <tr>
                     <td style="width:20%;">Mật khẩu cũ</td>
                     <td>
                        <input type="password" name="password_old" class="form-control" />
                     </td>
                  </tr>
                  <tr>
                     <td>Mật khẩu</td>
                     <td>
                        <input type="password" name="password" class="form-control" />
                     </td>
                  </tr>
                  <tr>
                     <td>Xác nhận mật khẩu</td>
                     <td>
                        <input type="password" name="password_re" class="form-control" />
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <button class="btn btn-main " type="submit" name="CHANEGPASSWORD">
                           Đổi mật khẩu
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