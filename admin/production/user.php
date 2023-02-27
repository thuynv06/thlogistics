
<?php include "headeradmin.php" ?>
<?php
require_once("../../backend/filterAdmin.php");
$userList = $userRepository->getAll();
?>

    <!-- top navigation -->
    <div class="right_col" role="main">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
            <a class="btn btn-primary" href="addUser.php" role="button">Thêm KH</a>
        </div>
        <table id="tableShoe">
            <tr>
                <th class="text-center" style="min-width:50px">STT</th>
                <th class="text-center" style="min-width:150px">Username</th>
                <th class="text-center" style="min-width:150px">Họ Tên</th>
                <th class="text-center" style="min-width:150px">Mã KH</th>
                <th class="text-center" style="min-width:150px">Ngày Sinh</th>
                <th class="text-center" style="min-width:50px">Email</th>
                <th class="text-center" style="min-width:100px">SDT</th>
                <th class="text-center" style="min-width:100px">Quyền</th>
                <th class="text-center" style="min-width:100px"></th>
                <th class="text-center" style="min-width:100px"></th>
            </tr>
             <?php
            $i = 1;
            foreach ($userList as $user) {?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['fullname'] ?></td>
                <td><?php echo $user['code'] ?></td>
                <td><?php echo $user['dob'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['role'] == 1 ? "ADMIN" : "USER" ?></td>
                <td><a class="btn btn-warning" href="updateUser.php?id=<?php echo $user['id'] ?>"
                        role="button">Sửa</a></td>
                <td><a class="btn btn-danger" href="deleteUser.php?id=<?php echo $user['id'] ?>" role="button"
                        onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
            </tr>
                <?php
            }
             ?>
        </table>
    </div>
<?php include 'footeradmin.php' ?>