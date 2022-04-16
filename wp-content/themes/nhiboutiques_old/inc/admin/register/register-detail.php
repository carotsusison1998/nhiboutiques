<!-- Wrap -->
<div class="wrap user-translation">
    <div id="poststuff">
        <!-- metabox-holder -->
        <div class="metabox-holder">
            <!-- meta-box-sortables -->
            <div class="meta-box-sortables">
                <h3>Register ID: <?php echo (!empty($register_detail_data -> id)) ? $register_detail_data -> id : ''?></h3>
                <!-- postbox -->
                <div class="postbox">
                    <!-- inside -->
                    <div class="inside top">
                        <!-- Table order -->
                        <h2 class="hndle"><span>講座申し込みフォーム</span></h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="title">漢字氏名</td>
                                    <td><?php echo (!empty($register_detail_data -> kanji_name1)) ? $register_detail_data -> kanji_name1 ." ". $register_detail_data -> kanji_name2 : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">ローマ字氏名（英字半角）</td>
                                    <td><?php echo (!empty($register_detail_data -> first_name)) ? $register_detail_data -> sir_name ." ". $register_detail_data -> first_name." ". $register_detail_data -> middle_name : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">メールアドレス（携帯以外）</td>
                                    <td><?php echo (!empty($register_detail_data -> email)) ? $register_detail_data -> email : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">電話番号</td>
                                    <td><?php echo (!empty($register_detail_data -> phone)) ? $register_detail_data -> phone : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">所属組織</td>
                                    <td><?php echo (!empty($register_detail_data -> organization)) ? $register_detail_data -> organization : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">業界</td>
                                    <td><?php echo (!empty($register_detail_data -> big_industry)) ? $register_detail_data -> big_industry : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">所属部署</td>
                                    <td><?php echo (!empty($register_detail_data -> department)) ? $register_detail_data -> department : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">役職</td>
                                    <td><?php echo (!empty($register_detail_data -> title)) ? $register_detail_data -> title : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">職種</td>
                                    <td><?php echo (!empty($register_detail_data -> occupation)) ? $register_detail_data -> occupation : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">人事経験年数</td>
                                    <td><?php echo (!empty($register_detail_data -> year_in_hr)) ? $register_detail_data -> year_in_hr : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">教材など送付先住所</td>
                                    <td><?php echo (!empty($register_detail_data -> teaching_materials)) ? $register_detail_data -> teaching_materials ." ". $register_detail_data -> mailing_address : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">HRAI提携パートナー名（紹介者）</td>
                                    <td><?php echo (!empty($register_detail_data -> partner)) ? $register_detail_data -> partner : ''?></td>
                                </tr>
                                <tr>
                                    <td class="title">その他の場合はこちらに記入</td>
                                    <td><?php echo (!empty($register_detail_data -> partner_referral)) ? $register_detail_data -> partner_referral : ''?></td>
                                </tr>
                                <?php if(count($register_detail_data_2) <= 1) {?>
                                    <?php foreach($register_detail_data_2 as $value2){ ?>
                                        <tr>
                                            <td>お申し込みプラン</td>
                                            <td><?php echo (!empty($value2->application_plan)) ? $value2->application_plan : ''?></td>
                                        </tr>
                                        <tr>
                                            <td>講座ご予約日</td>
                                            <td><?php echo (!empty($value2->course_reservation_date)) ? $value2->course_reservation_date : ''?></td>
                                        </tr>
                                        <tr>
                                            <td>Created date</td>
                                            <td><?php echo (!empty($value2->created_date)) ? $value2->created_date : ''?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- End table Order -->
                
                    </div>
                    <!-- End inside -->
                    <?php if(count($register_detail_data_2) > 1) {?>
                        <div class="inside bottom">
                            <h3 class="hndle"><span>お申し込みプランと講座予約日のご指定</span></h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>お申し込みプラン</th>
                                        <th>講座ご予約日</th>
                                        <th>Created date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($register_detail_data_2 as $value){ ?>
                                        <tr>
                                            <td><?php echo $value->application_plan; ?></td>
                                            <td><?php echo $value->course_reservation_date; ?></td>
                                            <td><?php echo $value->created_date; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <!-- End meta-box-sortables -->
        </div>
        <!-- End metabox-holder -->
    </div>
    <a href="<?php echo admin_url('admin.php?page=register')?>" class="button button-primary button-large">Back</a>
</div>
<!-- End wrap -->