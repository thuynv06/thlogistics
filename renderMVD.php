<!--<div class="row">-->

    <div class="table-responsive">
        <table id="tableShoeIndex">
            <tr>
                <th class="text-center" style="min-width:50px">STT</th>
                <th class="text-center" style="min-width:120px">Mã Vận Đơn</th>
                <th class="text-center" style="min-width:100px">Khách Hàng</th>
                <th class="text-center" style="min-width:60px">Cân nặng</th>
                <th class="text-center" style="min-width:80px">Giá</th>
                <th class="text-center" style="min-width:100px">Thành Tiền</th>
                <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                <th class="text-center" style="min-width:120px">Lộ Trình</th>
                <th class="text-center" style="min-width:150px">Chi tiết</th>

            </tr>
            <?php

            if (!empty($_GET['mvd'])) {
                $ladingCode = $_GET['mvd'];
                $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
            }

            if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                $ladingCode = $_POST['ladingCode'];
                $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
            }
            if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                $statusid = $_POST['status_id'];
                $listMaVanDon = $mvdRepository->findByStatusAndUserId($statusid, $checkCookie['id']);
            }
            //                            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            //                                $user_id = $_POST['user_id'];
            //                                $listMaVanDon = $mvdRepository->findByStatusAndUserId($user_id, $offset, $total_records_per_page);
            //                            }

            $i = 1;
//            function product_price($priceFloat)
//            {
//                $symbol = ' VNĐ';
//                $symbol_thousand = '.';
//                $decimal_place = 0;
//                $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
//                return $price . $symbol;
//            }

            foreach ($listMaVanDon as $mvd) {
                ?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><p style="font-weight: 600"><?php echo $mvd['mvd'] ?></p>
                    <p style="font-weight: 700;color: blue"> <?php
                        switch ($mvd['status']) {
                            case "1":
                                echo "Kho Trung Quốc Nhận";
                                break;
                            case "2":
                                echo "Vận Chuyển";
                                break;
                            case "3":
                                echo "Nhập Kho Việt Nam";
                                break;
                            case "4":
                                echo "Yêu Cầu Giao";
                                break;
                            case "5":
                                echo "Đã Giao";
                                break;
                            default:
                                echo "--";
                        }
                        ?> </p>
                    <p><?php echo $mvd['line'] ?></p>
                </td>
                <td><p style="font-weight: 700">
                        <?php
                        if (isset($mvd['order_id'])) {
                            $orderCode = $orderRepository->getOrderCodeById($mvd['order_id']);
                            if (isset($orderCode['code'])) {
                                echo $orderCode['code'];
                            }
                        } else {
                            echo "- - -";
                        }
                        ?>
                    </p>
                    <?php
                    $listUser = $userRepository->getAll();
                    foreach ($listUser as $user) {
                        if ($user['id'] == $mvd['user_id']) {
                            ?>
                            <?php echo $user['username'] ?>
                            <span> &#45; </span><?php echo $user['code'] ?>
                        <?php }
                    }
                    ?>
                </td>
                <td style="font-weight: 800"><?php echo $mvd['cannang'] ?><span> /Kg</span></td>
                <td><?php echo product_price($mvd['giavc']) ?></td>
                <td style="font-weight: 800;color: blue"><?php echo product_price($mvd['thanhtien']) ?></td>
                <td>
                    <ul style="text-align: left ;">
                        <!-- <li><p class="fix-status">Shop gửi hàng</p></li> -->
                        <li><p class="fix-status">TQ Nhận hàng</p></li>
                        <li><p class="fix-status">Vận chuyển</p></li>
                        <li><p class="fix-status">Nhập kho VN</p></li>
                        <li><p class="fix-status">Yêu Cầu Giao</p></li>
                        <li><p class="fix-status">Đã giao hàng</p></li>
                    </ul>
                </td>
                <td><?php $obj = json_decode($mvd['times']); ?>
                    <?php if (empty($obj)) { ?>
                        <ul style="text-align: left;">
                            <!-- <li><p class="fix-status">............</p></li> -->
                            <li><p class="fix-status">............</p></li>
                            <li><p class="fix-status">............</p></li>
                            <li><p class="fix-status">............</p></li>
                            <li><p class="fix-status">............</p></li>
                            <li><p class="fix-status">............</p></li>
                        </ul><?php
                    } else { ?>
                        <ul style="text-align: left;">
                            <li><p class="fix-status">=> <?php if (!empty($obj->{1})) echo $obj->{1}; ?>
                            </li>
                            <li>
                                <p class="fix-status">
                                    => <?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                            </li>
                            <li>
                                <p class="fix-status">
                                    => <?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                            </li>
                            <li>
                                <p class="fix-status">
                                    => <?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                            </li>
                            <li>
                                <p class="fix-status">
                                    => <?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                            </li>
                        </ul>
                        <?php
                    } ?>
                </td>
                </tr><?php
            }
            ?>
        </table>
    </div>

<!--</div>-->