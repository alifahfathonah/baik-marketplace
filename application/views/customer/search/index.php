
<!-- Content Box -->
<div class="relative clearfix full-width">
    <div class="container-web relative">
        <div class="container">
            <div class="row">
                <div class="breadcrumb-web">
                    <ul class="clear-margin">
                        <li class="animate-default title-hover-red"><?=$breadcrumb?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Product -->
    <div class="clearfix box-product full-width top-padding-default bg-gray">
        <div class=" container">
            <?php if (count($product) > 0) { ?>
            <div class="clearfix content-product-box full-width">
            <?php foreach($product as $f){ ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 product-category padding-5">
                    <div class="product-card relative effect-hover-boxshadow animate-default" data-id="<?=$f->id?>">
                        <div class="image-product relative overfollow-hidden">
                            <a href="<?=base_url()?>product/<?=$f->id?>">
                                <div class="center-vertical-image">
                                    <img src="<?=base_url();?>public/img/produk/<?=$f->gambar?>" alt="Product">
                                </div>
                            </a>
                        </div>
                        <h3 class="title-product clearfix full-width title-hover-black">
                            <a href="<?=base_url()?>product/<?=$f->id?>"><?=$f->nama?></a>
                                <?php if($f->terjual > 0){ ?>
                                    <span class="product-sold float-right">(<?=$f->terjual?> Terjual)</span>
                                <?php } ?>
                        </h3>
                        <h3 class="title-merchant clearfix full-width title-hover-black">
                            <i class="fa fa-user icon-merchant"></i> 
                                <a href="<?=base_url()?>merchant_detail/<?=$f->toko_id?>"><?=$f->toko?></a>
                        </h3>
                        <p class="clearfix price-product">
                            <span class="price-old">Rp <?=number_format($f->harga_asli, 0, ",", ".")?></span>
                            <span class="price-new">Rp <?=number_format($f->harga_disc, 0, ",", ".")?></span>
                        </p>
                        <div class="clearfix ranking-product-category ranking-color">
                            <?php 
                                $rate = $f->rating;
                                for($i = 0; $i < 5; $i++){
                                    $star = ($rate - $i >= 1) ? "star" : ($rate - $i >= 0.5 ? "star-half" : "star-o");
                                    echo '<i class="fa fa-'.$star.'" aria-hidden="true"></i>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="row">
                <div class="pagging relative">
                    <ul>
                        <?php for ($i = 1; $i <= $page_max; $i++) { ?>
                            <?php if ($i == 1) { ?>
                                <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> First</a></li>
                            <?php } ?>
                            <?php if ($i == $page - 2) { ?>
                                <li class="dots-pagging">. . .</li>
                            <?php } else if ($i == $page - 1) { ?>
                                <li><a href="#"><?= $i ?></a></li>
                            <?php } else if ($i == $page) { ?>
                                <li class="active-pagging"><a href="#"><?= $i ?></a></li>
                            <?php } else if ($i == $page + 1) { ?>
                                <li><a href="#"><?= $i ?></a></li>
                            <?php } else if ($i == $page + 2) { ?>
                                <li class="dots-pagging">. . .</li>
                            <?php } ?>
                            <?php if ($i == $page_max) { ?>
                                <li><a href="#">Last <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } else { ?>
                <div class="clearfix content-product-box full-width">
                    <div class="col-sm-12 product-category padding-5 text-grey" style="min-height: 400px">
                        <h2>Tidak ada produk di temukan</h2>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- End Content Product -->
</div>
<!-- End Content Box -->