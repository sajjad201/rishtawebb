<div class="container-fluid">
    <div class="row">
        <div class="foot-main">
            <div class="foot-main-one">
                <div class="container-fluid foot-main-one-fluid">
                    <div class="foot-five-box">
                        <div>
                            <div class="foot-five-box-he">
                                <a href="<?php echo $base_url?>singlecategory/caste" class="foot-five-box-he-a foot-five-box-he-tog">
                                    Rishta by Caste
                                </a>
                                <span href="#" class="foot-five-box-he-a foot-toggle-one">
                                    Rishta by Caste
                                    <i class="fas fa-caret-right foot-caret-icon"></i>
                                    <i class="fas fa-sort-down foot-caret-icon-down"></i>
                                </span>
                                <div class="foot-five-box-he-li">
                                    <?php
                                        $result=mysqli_query($conn, "select * from caste limit 10");
                                        if(mysqli_num_rows($result) > 0){
                                            while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                                <div><a href="<?php echo $base_url?>find/caste/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                            <?php }
                                        }
                                        ?>
                                    <div><a href="<?php echo $base_url?>singlecategory/caste" class="foot-five-box-he-sub-a ft-fi-v-all">View All</a></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="foot-five-box-he">
                                <a href="<?php echo $base_url?>singlecategory/city" class="foot-five-box-he-a foot-five-box-he-tog">
                                    Rishta by City
                                </a>
                                <span href="#" class="foot-five-box-he-a foot-toggle-two">
                                    Rishta by City
                                    <i class="fas fa-caret-right foot-caret-icon"></i>
                                    <i class="fas fa-sort-down foot-caret-icon-down"></i>
                                </span>
                                <div class="foot-five-box-he-li">
                                    <?php
                                        $result=mysqli_query($conn, "select * from city order by id desc limit 10");
                                        if(mysqli_num_rows($result) > 0){
                                            while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                                <div><a href="<?php echo $base_url?>find/city/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                            <?php }
                                        }
                                        ?>
                                    <div><a href="<?php echo $base_url?>singlecategory/city" class="foot-five-box-he-sub-a ft-fi-v-all">View All</a></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="foot-five-box-he">
                                <a href="<?php echo $base_url?>singlecategory/profession" class="foot-five-box-he-a foot-five-box-he-tog">
                                    Rishta by Profession
                                </a>
                                <span class="foot-five-box-he-a foot-toggle-three">
                                    Rishta by Profession
                                    <i class="fas fa-caret-right foot-caret-icon"></i>
                                    <i class="fas fa-sort-down foot-caret-icon-down"></i>
                                </span>
                                <div class="foot-five-box-he-li">
                                    <?php
                                        $result=mysqli_query($conn, "select * from profession limit 10");
                                        if(mysqli_num_rows($result) > 0){
                                            while($r=mysqli_fetch_array($result)){ 
                                                $url=str_replace('-', ' ', $r['url']); 
                                                $url=str_replace('find rishta in ', '', $url); 
                                                if($url != 'not working yet pakistan'){
                                                ?>
                                                <div>
                                                    <a href="<?php echo $base_url?>find/profession/<?php echo $r['url']?>" class="foot-five-box-he-sub-a">
                                                        <?php echo $url." rishta"?>
                                                    </a>
                                                </div>
                                            <?php }}
                                        }
                                        ?>
                                    <div><a href="<?php echo $base_url?>singlecategory/profession" class="foot-five-box-he-sub-a ft-fi-v-all">View All</a></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="foot-five-box-he">
                                <a href="<?php echo $base_url?>singlecategory/familytype" class="foot-five-box-he-a foot-five-box-he-tog">
                                    Rishta by Family Type
                                </a>
                                <span class="foot-five-box-he-a foot-toggle-four">
                                    Rishta by Family Type
                                    <i class="fas fa-caret-right foot-caret-icon"></i>
                                    <i class="fas fa-sort-down foot-caret-icon-down"></i>
                                </span>
                                <div class="foot-five-box-he-li">
                                    <?php
                                    $result=mysqli_query($conn, "select * from familytype limit 10");
                                    if(mysqli_num_rows($result) > 0){
                                        while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                            <div><a href="<?php echo $base_url?>find/familytype/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                        <?php }
                                    }
                                    ?>
                                    <?php
                                    $result=mysqli_query($conn, "select * from familyvalues limit 10");
                                    if(mysqli_num_rows($result) > 0){
                                        while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                            <div><a href="<?php echo $base_url?>find/familyvalues/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                        <?php }
                                    }
                                    ?>
                                    <?php
                                    $result=mysqli_query($conn, "select * from familyaffluence limit 10");
                                    if(mysqli_num_rows($result) > 0){
                                        while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                            <div><a href="<?php echo $base_url?>find/familyaffluence/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                        <?php }
                                    }
                                    ?>
                                    <div><a href="<?php echo $base_url?>singlecategory/familyaffluence" class="foot-five-box-he-sub-a ft-fi-v-all">View All</a></div>

                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="foot-five-box-he">
                                <a href="<?php echo $base_url?>singlecategory/religion" class="foot-five-box-he-a foot-five-box-he-tog">
                                    Rishta by Religion
                                </a>
                                <span href="<?php echo $base_url?>p/caste/jat-rishta-in-pakistan.php" class="foot-five-box-he-a foot-toggle-five">
                                    Rishta by Religion
                                    <i class="fas fa-caret-right foot-caret-icon"></i>
                                    <i class="fas fa-sort-down foot-caret-icon-down"></i>
                                </span>
                                <div class="foot-five-box-he-li">
                                    <?php
                                        $result=mysqli_query($conn, "select * from religion limit 10");
                                        if(mysqli_num_rows($result) > 0){
                                            while($r=mysqli_fetch_array($result)){ $url=str_replace('-', ' ', $r['url']); ?>
                                                <div><a href="<?php echo $base_url?>find/religion/<?php echo $r['url']?>" class="foot-five-box-he-sub-a"><?php echo $url?></a></div>
                                            <?php }
                                        }
                                        ?>
                                    <div><a href="<?php echo $base_url?>singlecategory/religion" class="foot-five-box-he-sub-a ft-fi-v-all">View All</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ft-border-flex">
                <div></div>
                </div>
                

                <div class="foot-main-one-bot">
                    <div><a rel="canonical" href="<?php echo $base_url?>contact.php">Contact Us</a></div>
                    <div><a href="<?php echo $base_url?>about.php">About Us</a></div>
                    <div><a href="<?php echo $base_url?>privacyPolicy.php">Privary Policy</a></div>
                    <div><a href="<?php echo $base_url?>terms.php">Terms & Conditions</a> </div>
                </div>
                <div class="foot-main-one-top">
                    While using this site, you agree to have read and accepted our Terms of Use & Privacy Policy.
                </div>
            </div>
            <div class="foot-main-two">
                RISHTAWEB.COM © 2019. All Rights Reserved
            </div>
        </div>
    </div>
</div>

<script>
    
    $('.foot-toggle-one').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-two').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-two').children('.foot-caret-icon').show();
        $('.foot-toggle-two').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-three').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-three').children('.foot-caret-icon').show();
        $('.foot-toggle-three').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-four').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-four').children('.foot-caret-icon').show();
        $('.foot-toggle-four').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-five').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-five').children('.foot-caret-icon').show();
        $('.foot-toggle-five').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-six').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-six').children('.foot-caret-icon').show();
        $('.foot-toggle-six').children('.foot-caret-icon-down').hide();
    });
    $('.foot-toggle-two').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-one').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-one').children('.foot-caret-icon').show();
        $('.foot-toggle-one').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-three').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-three').children('.foot-caret-icon').show();
        $('.foot-toggle-three').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-four').children('.foot-caret-icon').show();
        $('.foot-toggle-four').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-five').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-five').children('.foot-caret-icon').show();
        $('.foot-toggle-five').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-six').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-six').children('.foot-caret-icon').show();
        $('.foot-toggle-six').children('.foot-caret-icon-down').hide();
    });
    $('.foot-toggle-three').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-one').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-one').children('.foot-caret-icon').show();
        $('.foot-toggle-one').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-two').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-two').children('.foot-caret-icon').show();
        $('.foot-toggle-two').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-four').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-four').children('.foot-caret-icon').show();
        $('.foot-toggle-four').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-five').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-five').children('.foot-caret-icon').show();
        $('.foot-toggle-five').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-six').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-six').children('.foot-caret-icon').show();
        $('.foot-toggle-six').children('.foot-caret-icon-down').hide();
    });
    $('.foot-toggle-four').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-one').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-one').children('.foot-caret-icon').show();
        $('.foot-toggle-one').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-two').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-two').children('.foot-caret-icon').show();
        $('.foot-toggle-two').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-three').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-three').children('.foot-caret-icon').show();
        $('.foot-toggle-three').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-five').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-five').children('.foot-caret-icon').show();
        $('.foot-toggle-five').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-six').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-six').children('.foot-caret-icon').show();
        $('.foot-toggle-six').children('.foot-caret-icon-down').hide();
    });
    $('.foot-toggle-five').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-one').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-one').children('.foot-caret-icon').show();
        $('.foot-toggle-one').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-two').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-two').children('.foot-caret-icon').show();
        $('.foot-toggle-two').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-three').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-three').children('.foot-caret-icon').show();
        $('.foot-toggle-three').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-four').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-four').children('.foot-caret-icon').show();
        $('.foot-toggle-four').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-six').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-six').children('.foot-caret-icon').show();
        $('.foot-toggle-six').children('.foot-caret-icon-down').hide();
    });
    $('.foot-toggle-six').click(function(){
        $(this).siblings('.foot-five-box-he-li').toggle();
        $(this).children('.foot-caret-icon').toggle();
        $(this).children('.foot-caret-icon-down').toggle();
        $('.foot-toggle-one').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-one').children('.foot-caret-icon').show();
        $('.foot-toggle-one').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-two').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-two').children('.foot-caret-icon').show();
        $('.foot-toggle-two').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-three').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-three').children('.foot-caret-icon').show();
        $('.foot-toggle-three').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-four').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-four').children('.foot-caret-icon').show();
        $('.foot-toggle-four').children('.foot-caret-icon-down').hide();
        $('.foot-toggle-five').siblings('.foot-five-box-he-li').hide();
        $('.foot-toggle-five').children('.foot-caret-icon').show();
        $('.foot-toggle-five').children('.foot-caret-icon-down').hide();
    });

</script>
<script src="<?php echo $base_url;?>/assets/js/foot.js"></script> 
