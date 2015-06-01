<?php $contactInfo=LandingContactInfo::model()->find()?>
<!-- Footer -->
<footer id="info" class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="test-center footer-col col-md-12">
                    <?php if(!empty($contactInfo->call_to_action)):?>
                        <h3><?=$contactInfo->call_to_action?></h3>
                    <?php endif;?>
                    <?php if(!empty($contactInfo->phone)):?>
                        <p><?=$contactInfo->phone?></p>
                    <?php endif;?>
                    <?php if(!empty($contactInfo->email)):?>
                        <a href="mailto:<?=$contactInfo->email?>"><?=$contactInfo->email?></a>
                    <?php endif;?>
                    <ul class="list-inline">
                        <?php if(!empty($contactInfo->facebook)):?>
                            <li>
                            <a href="<?=$contactInfo->facebook?>" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->google_plus)):?>
                            <li>
                            <a href="<?=$contactInfo->google_plus?>" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->twitter)):?>
                            <li>
                            <a href="<?=$contactInfo->twitter?>" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->linkedin)):?>
                            <li>
                            <a href="<?=$contactInfo->linkedin?>" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->dribbble)):?>
                            <li>
                            <a href="<?=$contactInfo->dribbble?>" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->youtube)):?>
                            <li>
                            <a href="<?=$contactInfo->youtube?>" class="btn-social btn-outline"><i class="fa fa-fw fa-youtube"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->pinterest)):?>
                            <li>
                            <a href="<?=$contactInfo->pinterest?>" class="btn-social btn-outline"><i class="fa fa-fw fa-pinterest"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->skype)):?>
                            <li>
                            <a href="<?=$contactInfo->skype?>" class="btn-social btn-outline"><i class="fa fa-fw fa-skype"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->instagram)):?>
                            <li>
                            <a href="<?=$contactInfo->instagram?>" class="btn-social btn-outline"><i class="fa fa-fw fa-instagram"></i></a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($contactInfo->github)):?>
                            <li>
                            <a href="<?=$contactInfo->github?>" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="footer-col col-md-4"></div>
            </div>
        </div>
    </div>
</footer>