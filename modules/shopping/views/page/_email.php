<?php 
$contact_info=ContactInfo::model()->find();
$colorTemplate=strtr(r('email')->colorTemplate,array('#'=>''));
$colorFontTemplate=strtr(r('email')->colorFontTemplate,array('#'=>''));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title><?=r()->name?></title>
      <style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthmob] {width: 420px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:157px!important;}
         img[class=col2img] {width: 440px!important;height:330px!important;}
         table[class="cols3inner"] {width: 100px!important;}
         table[class="col3img"] {width: 131px!important;}
         img[class="col3img"] {width: 131px!important;height: 82px!important;}
         table[class='removeMobile']{width:10px!important;}
         img[class="blog"] {width: 420px!important;height: 162px!important;}
         }

         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthmob] {width: 260px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:100px!important;}
         img[class=col2img] {width: 280px!important;height:210px!important;}
         table[class="cols3inner"] {width: 260px!important;}
         img[class="col3img"] {width: 280px!important;height: 175px!important;}
         table[class="col3img"] {width: 280px!important;}
         img[class="blog"] {width: 260px!important;height: 100px!important;}
         td[class="padding-top-right15"]{padding:15px 15px 0 0 !important;}
         td[class="padding-right15"]{padding-right:15px !important;}
         }
      </style>
   </head>
   <body>
<!-- Start of preheader -->
<table width="100%" bgcolor="#dbdbdb" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" >
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #<?=$colorFontTemplate?>;text-align:center;" st-content="viewonline"></td>
                                 <!-- Spacing -->
                              </tr>
                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of preheader -->      
<!-- Start of header -->
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#FFF" width="560" cellpadding="0" cellspacing="0" border="0" align="center" style="border-top-left-radius:5px;border-top-right-radius:5px;" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="194" align="left" border="0" cellpadding="0" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td width="20"></td>
                                             <td width="174" align="left">
                                                <div class="imgpop">
                                                   <a target="_blank" href="<?php echo $this->createAbsoluteUrl('/')?>">
                                                   <img src="<?php echo r()->request->getBaseUrl(true)?>/img/logo.png" alt="" border="0" style="display:block; border:none; outline:none; text-decoration:none;">
                                                   </a>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of logo -->

                                    <table border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                       <tbody>
                                          <tr>
                                            <td class="center" style="font-size: 13px; color: #272727; font-weight: light; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 15px 0px;">
                                                <a href="<?php echo $this->createAbsoluteUrl('/')?>" style="text-decoration: none; color: #3b3b3b;">Ver mas</a>
                                                &nbsp; &nbsp;
                                                <!-- <a href="<?php echo $this->createAbsoluteUrl('/shopping/header/admin')?>" style="text-decoration: none; color: #3b3b3b;">Ver compras</a>
                                                &nbsp; &nbsp; -->
                                                
                                             </td>
                                             <td width="20"></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of Header -->
<!-- Start of main-banner -->
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="banner">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="560" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                           <tbody>
                              <tr>
                                 <!-- start of image -->
                                 <td align="center" st-image="banner-image" bgcolor="<?=$colorTemplate?>">
                                    <table class="full" width="540" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"> 
                                       <tbody>
                                          <tr> 
                                             <td width="100%" height="30"> &nbsp;</td> 
                                          </tr> 
                                          <!-- START OF HEADING--> 
                                          <tr> 

                                             <td style="margin: 0; padding: 0 15px 15px 15px; margin:0; font-family: Helvetica, Arial; font-size: 14px; color: #ffffff; line-height: 20px; mso-line-height-rule: exactly;"> 
                                                <span> 
                                                Hola <?php echo $model->buyer_name;?>!
                                                <br />
                                                <?php if(isset($type) and $type==1):?>
                                                   <!-- [Pagar en mi dirección] <br> -->
                                                   <p style="font-size:15px!important">
                                                      
                                                   <small>Nos pondremos en contacto con usted para confirmar e ir a tomar su pago</small><br>

                                                   <br> 
                                                   
                                                   </p>
                                                <?php else:?>
                                                   <!-- [Pagar por consignación o giro] <br> -->
                                                   <p style="font-size:15px!important"><?=$message?></p>                                 
                                                <?php endif;?>
                                           
                                                </span> 
                                             </td> 
                                          </tr> 
                                          <!-- END OF HEADING--> 
                                          <!-- START OF TEXT--> 
                                          <!-- <tr> 
                                             <td class="center" align="center" style="margin: 0; padding:0 30px 0 30px; margin:0; font-size:14px ; color:#ffffff; font-family: Helvetica, Arial, sans-serif; line-height: 20px;mso-line-height-rule: exactly;">
                                                <span>Para entregar: <?php echo $model->send_date;?> </span> 
                                             </td> 
                                          </tr>  -->
                                          <!-- END OF TEXT--> 
                                          <!-- START OF BUTTON-->
                                          <?php if(0):?>
                                          <tr> 
                                             <td align="center" valign="middle" style="padding-top: 20px;"> 
                                                <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="margin: 0;"> 
                                                   <tbody>  <tr>  
                                                      <td align="center" valign="middle" bgcolor="#ffffff" style="padding: 8px 20px; text-transform: uppercase; color:#666666; font-size:18px ; color:#ffffff; font-family: Helvetica, Arial, sans-serif; line-height: 28px; mso-line-height-rule: exactly;"> 
                                                          <a href="<?php echo $this->createAbsoluteUrl("/shopping/header/view",array("id"=>$model->id))?>" style="font-weight: normal; color:#444444; "> Ver detalle de la compra </a> 
                                                      </td> 
                                                   </tr> 
                                                </tbody>
                                             </table> 
                                             </td> 
                                          </tr> 
                                          <?php endif;?>
                                       <!-- START OF BUTTON--> 
                                       <tr> 
                                          <td width="100%" height="30"> &nbsp;</td> 
                                       </tr> 
                                    </tbody>
                                 </table>
                                   
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <!-- end of image -->
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of main-banner -->
<!-- 3-columns -->  

<?php foreach($detailDataProvider->getData() as $data):?>

<?php $productImg='http://placehold.it/200x150';?>
<?php 
if(!empty($data->image))
  $productImg=$data->image_path;
?>
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="left-image">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="520" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                       <tbody>
                                          <tr>
                                             <td>
                                                <!-- Start of left column -->
                                                <table width="200" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                   <tbody>
                                                      <!-- image -->
                                                      <tr>
                                                         <td width="200" align="center" class="devicewidth">
                                                            <img src="<?php echo $productImg?>" alt="" border="0" width="200" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img">
                                                         </td>
                                                      </tr>
                                                      <!-- /image -->
                                                   </tbody>
                                                </table>
                                                <!-- end of left column -->
                                                <!-- spacing for mobile devices-->
                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                   <tbody>
                                                      <tr>
                                                         <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->
                                                <!-- start of right column -->
                                                <table width="300" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidthmob">
                                                   <tbody>
                                                      <tr>
                                                         <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;" class="padding-top-right15">
                                                            <a style="color:#<?=$colorTemplate?>" target="_blank" href="<?php echo $this->createAbsoluteUrl('/shopping/page/items',array("id"=>$data->shopping_items_id,"slug"=>$data->slug))?>"><?php echo CHtml::encode($data->name); ?></a>
                                                         </td>
                                                      </tr>
                                                      <!-- end of title -->
                                                      <!-- Spacing 
                                                      <tr>
                                                         <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                      </tr>
                                                      -->
                                                      <!-- /Spacing -->
                                                      <!-- content -->
                                                      <tr>
                                                         <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 20px;" class="padding-right15">
                                                          <strong><small><?php echo "$".r()->format->money($data->price); ?></small></strong> <?php echo CHtml::encode($data->amount); ?>Unds <strong style=""><?php echo "$".r()->format->money($data->price*$data->amount); ?></strong> <br />
                                                          <?php echo substr(strip_tags($data->description_detail),0,50)."..."; ?>
                                                         </td>
                                                      </tr>
                                                      <!-- end of content -->
                                                   </tbody>
                                                </table>
                                                <!-- end of right column -->
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <!-- Spacing -->
                              <tr>
                                 <table cellspacing="0" cellpadding="0">
                                    <tbody>
                                       <tr>
                                          <td width="90" bgcolor="#<?=$colorTemplate?>"></td>
                                          <td height="2" bgcolor="#EEE" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<?php endforeach;?>
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="footer">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#fff" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="254" align="right" border="0" cellpadding="0" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td width="20"></td>
                                             <td width="224" height="40" align="center" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; text-align:center; line-height: 20px; color:#<?=$colorFontTemplate?>">
                                               <h3> Total $<?php echo r()->format->money($model->getTotalPurchase())?></h3>&nbsp;&nbsp;
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>

<!-- fulltext -->
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="left-image">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="520" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidthinner">
                                       <tbody>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('buyer_name')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->buyer_name;?>         

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('buyer_email')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->buyer_email;?> 

                                             </span>
                                             </td>
                                          </tr>
                                          <?php if(!r('shopping')->justBuyRegister):?>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('buyer_phone')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->buyer_phone;?>

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('buyer_address')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->buyer_address;?>

                                             </span>
                                             </td>
                                          </tr>

                                             <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('buyer_message')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                
                                                <?php echo Yii::app()->format->toBr($model->buyer_message);?>
          

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('send_name')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->send_name;?>

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('send_phone')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->send_phone;?>

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('send_address')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->send_address;?>

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('send_date')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                
                                                <?php echo Yii::app()->format->formatShort($model->send_date);?>
          

                                             </span>
                                             </td>
                                          </tr>
                                          <?php endif;?>

                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                
                                                <?php echo $model->created_at;?>
          

                                             </span>
                                             </td>
                                          </tr>
                                          <?php if(!isset($client)):?>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('datetime_return_pay')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->datetime_return_pay;?>

                                             </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                             <?php echo CHtml::encode($model->getAttributeLabel('message_return_pay')); ?>:
                                             <span style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #<?=$colorFontTemplate?>; text-align:left; line-height: 24px;">
                                                
                                                <?php echo $model->message_return_pay;?>

                                             </span>
                                             </td>
                                          </tr>
                                             <?php endif;?>
                                       
                                          
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>

                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                           
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- end of fulltext -->

<!-- Start of footer -->
<table width="100%" bgcolor="#d8d8d8" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="footer">
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#<?=$colorTemplate?>" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="194" align="left" border="0" cellpadding="0" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td width="20"></td>
                                             <td width="174" height="40" align="left" style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #FFF; text-align:left; line-height: 24px;">
                                                Síguenos
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of logo -->
                                    <!-- start of social icons -->
                                    <table width="60" height="40" align="right" vaalign="middle"  border="0" cellpadding="0" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td width="22" height="22" align="left">
                                                <div class="imgpop">
                                                    <?php if(!empty($contact_info->facebook)):?>
                                                     <a target="_blank" href="<?php echo $contact_info->facebook?>">
                                                     <img src="<?php echo r()->request->getBaseUrl(true)?>/img/facebook.png" alt="" border="0" width="22" height="22" style="display:block; border:none; outline:none; text-decoration:none;">
                                                     </a>
                                                    <?php endif;?>
              
                                                </div>
                                             </td>
                                             <td align="left" width="10" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                             <td width="22" height="22" align="right">
                                                <div class="imgpop">
                                                  <?php if(!empty($contact_info->twitter)):?>
                                                   <a target="_blank" href="<?php echo $contact_info->twitter?>">
                                                   <img src="<?php echo r()->request->getBaseUrl(true)?>/img/twitter.png" alt="" border="0" width="22" height="22" style="display:block; border:none; outline:none; text-decoration:none;">
                                                   </a>
                                                  <?php endif;?>
     
                                                </div>
                                             </td>
                                             <td align="left" width="20" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of social icons -->
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of footer -->
<!-- Start of postfooter -->
<table width="100%" bgcolor="#dbdbdb" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" >
   <tbody>
      <tr>
         <td>
            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #<?=$colorFontTemplate?>;text-align:center;" st-content="viewonline">
                                    <a href="<?php echo $this->createAbsoluteUrl('/')?>" style="text-decoration: none; color: #<?=$colorFontTemplate?>"><?php echo $this->createAbsoluteUrl('/')?></a> <br>
                                       Email: <a style="color: #<?=$colorFontTemplate?>" href="mailto:<?php echo $contact_info->email?>"><?php echo $contact_info->email?></a> <br>
                                       Teléfono: <a style="color: #<?=$colorFontTemplate?>" href="tel:<?php echo $contact_info->phone?>"><?php echo $contact_info->phone?></a> <br>

                                 </td>
                              </tr>
                                 <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<!-- End of postfooter -->

   </body>
   </html>