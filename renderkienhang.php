
    <div class="table-responsive">
        <table id="tableShoeIndex">
            <tr>
                <th class="text-center" style="min-width:50px">STT</th>
                <th class="text-center" style="min-width:110px;">Mã Kiện</th>
                <th class="text-center" style="min-width:100px">Tên Kiện Hàng</th>
                <th class="text-center" style="min-width:150px;">Ảnh</th>
                <th class="text-center" style="min-width:50px">Link SP</th>
                <th class="text-center" style="min-width:150px">Mã Vận Đơn</th>
                <th class="text-center" style="min-width:50px">Size/Color/SL</th>
                <!--                <th class="text-center" style="min-width:100px">Khách Hàng</th>-->
                <th class="text-center" style="min-width:50px">Giá</th>
                <th class="text-center" style="min-width:70px">Tiền Hàng</th>
                <!--                                <th class="text-center" style="min-width:50px">Giảm Giá</th>-->
                <th class="text-center" style="min-width:75px">ShipTQ</th>
                <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                <th class="text-center" style="min-width:130px">Lộ Trình</th>
                <th class="text-center" style="min-width:150px">Chi tiết</th>
                <!--                                <th class="text-center" style="min-width:100px">Ghi Chú</th>-->

            </tr>
            <?php
            //            $order = $orderRepository->getById($_GET['id']);
            //            echo print_r($listOrder, true);
            //            echo(print_r($order, true));
            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
            //                            echo(print_r($arr_unserialize1, true));
            if (!empty($arr_unserialize1)) {
                $i = 1;
                foreach ($arr_unserialize1 as $masp) {
                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                    $tempMaVanDon = null;
                    if (isset($product)) {
                        $link_image = $kienhangRepository->getImage($product['id'])->fetch_assoc();
                        $mvd = $mvdRepository->findByMaVanDon($product['mavandon']);
                        if (isset($mvd) && !empty($mvd) && !empty($product['mavandon']) && isset($product['mavandon'])) {
                            $tempMaVanDon = $mvd->fetch_assoc();
//                        print_r($tempMaVanDon);
                        }
                    }
                    //                    echo(print_r($product, true));?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><p style="font-weight: 700;"><?php echo $product['code'] ?></p>
                            <p style="color: blue"> <?php $status = 0;
                                if (!empty($tempMaVanDon['times'])) {
                                    $status = $tempMaVanDon['status'];
                                }
                                switch ($status) {
                                    case "0":
                                        echo "Đang Cập nhập";
                                        break;
                                    case "1":
                                        echo "Kho TQ Nhận";
                                        break;
                                    case "2":
                                        echo "Vận Chuyển";
                                        break;
                                    case "3":
                                        echo "Nhập Kho VN";
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
                            <!--                                            <p>-->
                            <?php //echo $product['shippingWay'] ?><!--</p>-->
                        </td>
                        <td><p><?php echo $product['name'] ?></p></td>
                        <td><img width="150px" height="150px"
                                 src="<?php if (!empty($link_image['link_image']) && isset($link_image['link_image'])) echo "admin/production/" . $link_image['link_image'];
                                 if (empty($link_image['link_image'])) echo 'admin/production/images/LogoTHzz.png' ?>">
                        </td>
                        <td><a href="<?php echo $product['linksp'] ?>">Link</a></td>
                        <td style="font-weight: bold;"><p
                                    style="color: blue"><?php echo $product['mavandon'] ?> </p>
                            <?php echo $product['cannang'] . " /Kg"; ?>
                        </td>
                        <td><p>Size: <?php echo $product['size'] ?></p>
                            <p>Color: <?php echo $product['color'] ?></p>
                            <p>SL: <?php echo $product['soluong'] ?></p>
                        </td>
                        <td><p style="color:green"><?php echo $product['giasp'] ?><span> &#165;</span>
                            </p>
                        </td>
                        <td><p style="color:blue"><?php echo $product['giasp'] * $product['soluong'] ?>
                                <span> ¥</span></p>
                        </td>
                        <td><p style=""><?php echo "ShipTQ: " . $product['shiptq'] ?> <span> ¥</span></p>
                            <p style=""><?php echo "Giảm giá:" . $product['magiamgia'] ?> <span> ¥</span>
                            </p>
                        </td>
                        <td>
                            <ul style="text-align: left ;">
                                <!--                                                <li><p class="fix-status"><span>&#8658;</span> Shop Gửi Hàng</p></li>-->
                                <li><p class="fix-status"><span>&#8658;</span> TQ Nhận hàng</p></li>
                                <li><p class="fix-status"><span>&#8658;</span> Vận chuyển</p></li>
                                <li><p class="fix-status"><span>&#8658;</span> Nhập kho VN</p></li>
                                <li><p class="fix-status"><span>&#8658;</span> Yêu cầu giao</p></li>
                                <li><p class="fix-status"><span>&#8658;</span> Đã giao hàng</p></li>
                            </ul>
                        </td>
                        <td><?php $obj = null;
                            if (!empty($tempMaVanDon['times'])) {
                                $obj = json_decode($tempMaVanDon['times']);
                            } ?>
                            <ul style="text-align: left;">
                                <li><p class="fix-status"><?php
                                        if (!empty($obj->{1})) {
                                            echo $obj->{1};
                                        } else {
                                            echo "--------------";
                                        }
                                        ?></p></li>
                                <li><p class="fix-status"><?php
                                        if (!empty($obj->{2})) {
                                            echo $obj->{2};
                                        } else {
                                            echo "--------------";
                                        } ?></p></li>
                                <li><p class="fix-status"><?php
                                        if (!empty($obj->{3})) {
                                            echo $obj->{3};
                                        } else {
                                            echo "--------------";
                                        } ?></p></li>
                                <li>
                                    <p class="fix-status"><?php if (!empty($obj->{4})) {
                                            echo $obj->{4};
                                        } else {
                                            echo "--------------";
                                        } ?></p></li>
                                <li><p class="fix-status"><?php
                                        if (!empty($obj->{5})) {
                                            echo $obj->{5};
                                        } else {
                                            echo "--------------";
                                        } ?></p></li>
                            </ul>
                        </td>
                        <!--                                        <td><p>-->
                        <?php //if (!empty($product['note'])) {
                        //                                                    echo $product['note'];
                        //                                                } else echo "---" ?><!--</p></td>-->
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <div>
        </div>
    </div>
