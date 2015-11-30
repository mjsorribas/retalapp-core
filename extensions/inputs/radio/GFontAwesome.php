<?php
/**
 * GInput class file.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * GInput displays a star rating control that can collect user rating input.
 *
 * GInput is based on {@link http://www.fyneworks.com/jquery/star-rating/ jQuery Star Rating Plugin}.
 * It displays a list of stars indicating the rating values. Users can toggle these stars
 * to indicate their rating input. On the server side, when the rating input is submitted,
 * the value can be retrieved in the same way as working with a normal HTML input.
 * For example, using
 * <pre>
 * $this->widget('pat.to.location.GInput',array('name'=>'rating'));
 * </pre>
 * we can retrieve the rating value via <code>$_POST['rating']</code>.
 *
 * GInput allows customization of its appearance. It also supports empty rating as well as read-only rating.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @package system.web.widgets
 * @since 1.0
 */
class GFontAwesome extends CInputWidget
{
	// @TODO AT ALL
	public $listData=array(
		'fa-adjust'=>'<i class="fa fa-adjust"></i><br><small style="font-size:8px">fa-adjust</small>',
		'fa-anchor'=>'<i class="fa fa-anchor"></i><br><small style="font-size:8px">fa-anchor</small>',
		'fa-archive'=>'<i class="fa fa-archive"></i><br><small style="font-size:8px">fa-archive</small>',
		'fa-area-chart'=>'<i class="fa fa-area-chart"></i><br><small style="font-size:8px">fa-area-chart</small>',
		'fa-arrows'=>'<i class="fa fa-arrows"></i><br><small style="font-size:8px">fa-arrows</small>',
		'fa-arrows-h'=>'<i class="fa fa-arrows-h"></i><br><small style="font-size:8px">fa-arrows-h</small>',
		'fa-arrows-v'=>'<i class="fa fa-arrows-v"></i><br><small style="font-size:8px">fa-arrows-v</small>',
		'fa-asterisk'=>'<i class="fa fa-asterisk"></i><br><small style="font-size:8px">fa-asterisk</small>',
		'fa-automobile'=>'<i class="fa fa-automobile"></i><br><small style="font-size:8px">fa-automobile</small>',
		'fa-ban'=>'<i class="fa fa-ban"></i><br><small style="font-size:8px">fa-ban</small>',
		'fa-bank'=>'<i class="fa fa-bank"></i><br><small style="font-size:8px">fa-bank</small>',
		'fa-bar-chart'=>'<i class="fa fa-bar-chart"></i><br><small style="font-size:8px">fa-bar-chart</small>',
		'fa-bar-chart-o'=>'<i class="fa fa-bar-chart-o"></i><br><small style="font-size:8px">fa-bar-chart-o</small>',
		'fa-barcode'=>'<i class="fa fa-barcode"></i><br><small style="font-size:8px">fa-barcode</small>',
		'fa-bars'=>'<i class="fa fa-bars"></i><br><small style="font-size:8px">fa-bars</small>',
		'fa-beer'=>'<i class="fa fa-beer"></i><br><small style="font-size:8px">fa-beer</small>',
		'fa-bell'=>'<i class="fa fa-bell"></i><br><small style="font-size:8px">fa-bell</small>',
		'fa-bell-o'=>'<i class="fa fa-bell-o"></i><br><small style="font-size:8px">fa-bell-o</small>',
		'fa-bell-slash'=>'<i class="fa fa-bell-slash"></i><br><small style="font-size:8px">fa-bell-slash</small>',
		'fa-bell-slash-o'=>'<i class="fa fa-bell-slash-o"></i><br><small style="font-size:8px">fa-bell-slash-o</small>',
		'fa-bicycle'=>'<i class="fa fa-bicycle"></i><br><small style="font-size:8px">fa-bicycle</small>',
		'fa-binoculars'=>'<i class="fa fa-binoculars"></i><br><small style="font-size:8px">fa-binoculars</small>',
		'fa-birthday-cake'=>'<i class="fa fa-birthday-cake"></i><br><small style="font-size:8px">fa-birthday-cake</small>',
		'fa-bolt'=>'<i class="fa fa-bolt"></i><br><small style="font-size:8px">fa-bolt</small>',
		'fa-bomb'=>'<i class="fa fa-bomb"></i><br><small style="font-size:8px">fa-bomb</small>',
		'fa-book'=>'<i class="fa fa-book"></i><br><small style="font-size:8px">fa-book</small>',
		'fa-bookmark'=>'<i class="fa fa-bookmark"></i><br><small style="font-size:8px">fa-bookmark</small>',
		'fa-bookmark-o'=>'<i class="fa fa-bookmark-o"></i><br><small style="font-size:8px">fa-bookmark-o</small>',
		'fa-briefcase'=>'<i class="fa fa-briefcase"></i><br><small style="font-size:8px">fa-briefcase</small>',
		'fa-bug'=>'<i class="fa fa-bug"></i><br><small style="font-size:8px">fa-bug</small>',
		'fa-building'=>'<i class="fa fa-building"></i><br><small style="font-size:8px">fa-building</small>',
		'fa-building-o'=>'<i class="fa fa-building-o"></i><br><small style="font-size:8px">fa-building-o</small>',
		'fa-bullhorn'=>'<i class="fa fa-bullhorn"></i><br><small style="font-size:8px">fa-bullhorn</small>',
		'fa-bullseye'=>'<i class="fa fa-bullseye"></i><br><small style="font-size:8px">fa-bullseye</small>',
		'fa-bus'=>'<i class="fa fa-bus"></i><br><small style="font-size:8px">fa-bus</small>',
		'fa-cab'=>'<i class="fa fa-cab"></i><br><small style="font-size:8px">fa-cab</small>',
		'fa-calculator'=>'<i class="fa fa-calculator"></i><br><small style="font-size:8px">fa-calculator</small>',
		'fa-calendar'=>'<i class="fa fa-calendar"></i><br><small style="font-size:8px">fa-calendar</small>',
		'fa-calendar-o'=>'<i class="fa fa-calendar-o"></i><br><small style="font-size:8px">fa-calendar-o</small>',
		'fa-camera'=>'<i class="fa fa-camera"></i><br><small style="font-size:8px">fa-camera</small>',
		'fa-camera-retro'=>'<i class="fa fa-camera-retro"></i><br><small style="font-size:8px">fa-camera-retro</small>',
		'fa-car'=>'<i class="fa fa-car"></i><br><small style="font-size:8px">fa-car</small>',
		'fa-caret-square-o-down'=>'<i class="fa fa-caret-square-o-down"></i><br><small style="font-size:8px">fa-caret-square-o-down</small>',
		'fa-caret-square-o-left'=>'<i class="fa fa-caret-square-o-left"></i><br><small style="font-size:8px">fa-caret-square-o-left</small>',
		'fa-caret-square-o-right'=>'<i class="fa fa-caret-square-o-right"></i><br><small style="font-size:8px">fa-caret-square-o-right</small>',
		'fa-caret-square-o-up'=>'<i class="fa fa-caret-square-o-up"></i><br><small style="font-size:8px">fa-caret-square-o-up</small>',
		'fa-cc'=>'<i class="fa fa-cc"></i><br><small style="font-size:8px">fa-cc</small>',
		'fa-certificate'=>'<i class="fa fa-certificate"></i><br><small style="font-size:8px">fa-certificate</small>',
		'fa-check'=>'<i class="fa fa-check"></i><br><small style="font-size:8px">fa-check</small>',
		'fa-check-circle'=>'<i class="fa fa-check-circle"></i><br><small style="font-size:8px">fa-check-circle</small>',
		'fa-check-circle-o'=>'<i class="fa fa-check-circle-o"></i><br><small style="font-size:8px">fa-check-circle-o</small>',
		'fa-check-square'=>'<i class="fa fa-check-square"></i><br><small style="font-size:8px">fa-check-square</small>',
		'fa-check-square-o'=>'<i class="fa fa-check-square-o"></i><br><small style="font-size:8px">fa-check-square-o</small>',
		'fa-child'=>'<i class="fa fa-child"></i><br><small style="font-size:8px">fa-child</small>',
		'fa-circle'=>'<i class="fa fa-circle"></i><br><small style="font-size:8px">fa-circle</small>',
		'fa-circle-o'=>'<i class="fa fa-circle-o"></i><br><small style="font-size:8px">fa-circle-o</small>',
		'fa-circle-o-notch'=>'<i class="fa fa-circle-o-notch"></i><br><small style="font-size:8px">fa-circle-o-notch</small>',
		'fa-circle-thin'=>'<i class="fa fa-circle-thin"></i><br><small style="font-size:8px">fa-circle-thin</small>',
		'fa-clock-o'=>'<i class="fa fa-clock-o"></i><br><small style="font-size:8px">fa-clock-o</small>',
		'fa-close'=>'<i class="fa fa-close"></i><br><small style="font-size:8px">fa-close</small>',
		'fa-cloud'=>'<i class="fa fa-cloud"></i><br><small style="font-size:8px">fa-cloud</small>',
		'fa-cloud-download'=>'<i class="fa fa-cloud-download"></i><br><small style="font-size:8px">fa-cloud-download</small>',
		'fa-cloud-upload'=>'<i class="fa fa-cloud-upload"></i><br><small style="font-size:8px">fa-cloud-upload</small>',
		'fa-code'=>'<i class="fa fa-code"></i><br><small style="font-size:8px">fa-code</small>',
		'fa-code-fork'=>'<i class="fa fa-code-fork"></i><br><small style="font-size:8px">fa-code-fork</small>',
		'fa-coffee'=>'<i class="fa fa-coffee"></i><br><small style="font-size:8px">fa-coffee</small>',
		'fa-cog'=>'<i class="fa fa-cog"></i><br><small style="font-size:8px">fa-cog</small>',
		'fa-cogs'=>'<i class="fa fa-cogs"></i><br><small style="font-size:8px">fa-cogs</small>',
		'fa-comment'=>'<i class="fa fa-comment"></i><br><small style="font-size:8px">fa-comment</small>',
		'fa-comment-o'=>'<i class="fa fa-comment-o"></i><br><small style="font-size:8px">fa-comment-o</small>',
		'fa-comments'=>'<i class="fa fa-comments"></i><br><small style="font-size:8px">fa-comments</small>',
		'fa-comments-o'=>'<i class="fa fa-comments-o"></i><br><small style="font-size:8px">fa-comments-o</small>',
		'fa-compass'=>'<i class="fa fa-compass"></i><br><small style="font-size:8px">fa-compass</small>',
		'fa-copyright'=>'<i class="fa fa-copyright"></i><br><small style="font-size:8px">fa-copyright</small>',
		'fa-credit-card'=>'<i class="fa fa-credit-card"></i><br><small style="font-size:8px">fa-credit-card</small>',
		'fa-crop'=>'<i class="fa fa-crop"></i><br><small style="font-size:8px">fa-crop</small>',
		'fa-crosshairs'=>'<i class="fa fa-crosshairs"></i><br><small style="font-size:8px">fa-crosshairs</small>',
		'fa-cube'=>'<i class="fa fa-cube"></i><br><small style="font-size:8px">fa-cube</small>',
		'fa-cubes'=>'<i class="fa fa-cubes"></i><br><small style="font-size:8px">fa-cubes</small>',
		'fa-cutlery'=>'<i class="fa fa-cutlery"></i><br><small style="font-size:8px">fa-cutlery</small>',
		'fa-dashboard'=>'<i class="fa fa-dashboard"></i><br><small style="font-size:8px">fa-dashboard</small>',
		'fa-database'=>'<i class="fa fa-database"></i><br><small style="font-size:8px">fa-database</small>',
		'fa-desktop'=>'<i class="fa fa-desktop"></i><br><small style="font-size:8px">fa-desktop</small>',
		'fa-dot-circle-o'=>'<i class="fa fa-dot-circle-o"></i><br><small style="font-size:8px">fa-dot-circle-o</small>',
		'fa-download'=>'<i class="fa fa-download"></i><br><small style="font-size:8px">fa-download</small>',
		'fa-edit'=>'<i class="fa fa-edit"></i><br><small style="font-size:8px">fa-edit</small>',
		'fa-ellipsis-h'=>'<i class="fa fa-ellipsis-h"></i><br><small style="font-size:8px">fa-ellipsis-h</small>',
		'fa-ellipsis-v'=>'<i class="fa fa-ellipsis-v"></i><br><small style="font-size:8px">fa-ellipsis-v</small>',
		'fa-envelope'=>'<i class="fa fa-envelope"></i><br><small style="font-size:8px">fa-envelope</small>',
		'fa-envelope-o'=>'<i class="fa fa-envelope-o"></i><br><small style="font-size:8px">fa-envelope-o</small>',
		'fa-envelope-square'=>'<i class="fa fa-envelope-square"></i><br><small style="font-size:8px">fa-envelope-square</small>',
		'fa-eraser'=>'<i class="fa fa-eraser"></i><br><small style="font-size:8px">fa-eraser</small>',
		'fa-exchange'=>'<i class="fa fa-exchange"></i><br><small style="font-size:8px">fa-exchange</small>',
		'fa-exclamation'=>'<i class="fa fa-exclamation"></i><br><small style="font-size:8px">fa-exclamation</small>',
		'fa-exclamation-circle'=>'<i class="fa fa-exclamation-circle"></i><br><small style="font-size:8px">fa-exclamation-circle</small>',
		'fa-exclamation-triangle'=>'<i class="fa fa-exclamation-triangle"></i><br><small style="font-size:8px">fa-exclamation-triangle</small>',
		'fa-external-link'=>'<i class="fa fa-external-link"></i><br><small style="font-size:8px">fa-external-link</small>',
		'fa-external-link-square'=>'<i class="fa fa-external-link-square"></i><br><small style="font-size:8px">fa-external-link-square</small>',
		'fa-eye'=>'<i class="fa fa-eye"></i><br><small style="font-size:8px">fa-eye</small>',
		'fa-eye-slash'=>'<i class="fa fa-eye-slash"></i><br><small style="font-size:8px">fa-eye-slash</small>',
		'fa-eyedropper'=>'<i class="fa fa-eyedropper"></i><br><small style="font-size:8px">fa-eyedropper</small>',
		'fa-fax'=>'<i class="fa fa-fax"></i><br><small style="font-size:8px">fa-fax</small>',
		'fa-female'=>'<i class="fa fa-female"></i><br><small style="font-size:8px">fa-female</small>',
		'fa-fighter-jet'=>'<i class="fa fa-fighter-jet"></i><br><small style="font-size:8px">fa-fighter-jet</small>',
		'fa-file-archive-o'=>'<i class="fa fa-file-archive-o"></i><br><small style="font-size:8px">fa-file-archive-o</small>',
		'fa-file-audio-o'=>'<i class="fa fa-file-audio-o"></i><br><small style="font-size:8px">fa-file-audio-o</small>',
		'fa-file-code-o'=>'<i class="fa fa-file-code-o"></i><br><small style="font-size:8px">fa-file-code-o</small>',
		'fa-file-excel-o'=>'<i class="fa fa-file-excel-o"></i><br><small style="font-size:8px">fa-file-excel-o</small>',
		'fa-file-image-o'=>'<i class="fa fa-file-image-o"></i><br><small style="font-size:8px">fa-file-image-o</small>',
		'fa-file-movie-o'=>'<i class="fa fa-file-movie-o"></i><br><small style="font-size:8px">fa-file-movie-o</small>',
		'fa-file-pdf-o'=>'<i class="fa fa-file-pdf-o"></i><br><small style="font-size:8px">fa-file-pdf-o</small>',
		'fa-file-photo-o'=>'<i class="fa fa-file-photo-o"></i><br><small style="font-size:8px">fa-file-photo-o</small>',
		'fa-file-picture-o'=>'<i class="fa fa-file-picture-o"></i><br><small style="font-size:8px">fa-file-picture-o</small>',
		'fa-file-powerpoint-o'=>'<i class="fa fa-file-powerpoint-o"></i><br><small style="font-size:8px">fa-file-powerpoint-o</small>',
		'fa-file-sound-o'=>'<i class="fa fa-file-sound-o"></i><br><small style="font-size:8px">fa-file-sound-o</small>',
		'fa-file-video-o'=>'<i class="fa fa-file-video-o"></i><br><small style="font-size:8px">fa-file-video-o</small>',
		'fa-file-word-o'=>'<i class="fa fa-file-word-o"></i><br><small style="font-size:8px">fa-file-word-o</small>',
		'fa-file-zip-o'=>'<i class="fa fa-file-zip-o"></i><br><small style="font-size:8px">fa-file-zip-o</small>',
		'fa-film'=>'<i class="fa fa-film"></i><br><small style="font-size:8px">fa-film</small>',
		'fa-filter'=>'<i class="fa fa-filter"></i><br><small style="font-size:8px">fa-filter</small>',
		'fa-fire'=>'<i class="fa fa-fire"></i><br><small style="font-size:8px">fa-fire</small>',
		'fa-fire-extinguisher'=>'<i class="fa fa-fire-extinguisher"></i><br><small style="font-size:8px">fa-fire-extinguisher</small>',
		'fa-flag'=>'<i class="fa fa-flag"></i><br><small style="font-size:8px">fa-flag</small>',
		'fa-flag-checkered'=>'<i class="fa fa-flag-checkered"></i><br><small style="font-size:8px">fa-flag-checkered</small>',
		'fa-flag-o'=>'<i class="fa fa-flag-o"></i><br><small style="font-size:8px">fa-flag-o</small>',
		'fa-flash'=>'<i class="fa fa-flash"></i><br><small style="font-size:8px">fa-flash</small>',
		'fa-flask'=>'<i class="fa fa-flask"></i><br><small style="font-size:8px">fa-flask</small>',
		'fa-folder'=>'<i class="fa fa-folder"></i><br><small style="font-size:8px">fa-folder</small>',
		'fa-folder-o'=>'<i class="fa fa-folder-o"></i><br><small style="font-size:8px">fa-folder-o</small>',
		'fa-folder-open'=>'<i class="fa fa-folder-open"></i><br><small style="font-size:8px">fa-folder-open</small>',
		'fa-folder-open-o'=>'<i class="fa fa-folder-open-o"></i><br><small style="font-size:8px">fa-folder-open-o</small>',
		'fa-frown-o'=>'<i class="fa fa-frown-o"></i><br><small style="font-size:8px">fa-frown-o</small>',
		'fa-futbol-o'=>'<i class="fa fa-futbol-o"></i><br><small style="font-size:8px">fa-futbol-o</small>',
		'fa-gamepad'=>'<i class="fa fa-gamepad"></i><br><small style="font-size:8px">fa-gamepad</small>',
		'fa-gavel'=>'<i class="fa fa-gavel"></i><br><small style="font-size:8px">fa-gavel</small>',
		'fa-gear'=>'<i class="fa fa-gear"></i><br><small style="font-size:8px">fa-gear</small>',
		'fa-gears'=>'<i class="fa fa-gears"></i><br><small style="font-size:8px">fa-gears</small>',
		'fa-gift'=>'<i class="fa fa-gift"></i><br><small style="font-size:8px">fa-gift</small>',
		'fa-glass'=>'<i class="fa fa-glass"></i><br><small style="font-size:8px">fa-glass</small>',
		'fa-globe'=>'<i class="fa fa-globe"></i><br><small style="font-size:8px">fa-globe</small>',
		'fa-graduation-cap'=>'<i class="fa fa-graduation-cap"></i><br><small style="font-size:8px">fa-graduation-cap</small>',
		'fa-group'=>'<i class="fa fa-group"></i><br><small style="font-size:8px">fa-group</small>',
		'fa-hdd-o'=>'<i class="fa fa-hdd-o"></i><br><small style="font-size:8px">fa-hdd-o</small>',
		'fa-headphones'=>'<i class="fa fa-headphones"></i><br><small style="font-size:8px">fa-headphones</small>',
		'fa-heart'=>'<i class="fa fa-heart"></i><br><small style="font-size:8px">fa-heart</small>',
		'fa-heart-o'=>'<i class="fa fa-heart-o"></i><br><small style="font-size:8px">fa-heart-o</small>',
		'fa-history'=>'<i class="fa fa-history"></i><br><small style="font-size:8px">fa-history</small>',
		'fa-home'=>'<i class="fa fa-home"></i><br><small style="font-size:8px">fa-home</small>',
		'fa-image'=>'<i class="fa fa-image"></i><br><small style="font-size:8px">fa-image</small>',
		'fa-inbox'=>'<i class="fa fa-inbox"></i><br><small style="font-size:8px">fa-inbox</small>',
		'fa-info'=>'<i class="fa fa-info"></i><br><small style="font-size:8px">fa-info</small>',
		'fa-info-circle'=>'<i class="fa fa-info-circle"></i><br><small style="font-size:8px">fa-info-circle</small>',
		'fa-institution'=>'<i class="fa fa-institution"></i><br><small style="font-size:8px">fa-institution</small>',
		'fa-key'=>'<i class="fa fa-key"></i><br><small style="font-size:8px">fa-key</small>',
		'fa-keyboard-o'=>'<i class="fa fa-keyboard-o"></i><br><small style="font-size:8px">fa-keyboard-o</small>',
		'fa-language'=>'<i class="fa fa-language"></i><br><small style="font-size:8px">fa-language</small>',
		'fa-laptop'=>'<i class="fa fa-laptop"></i><br><small style="font-size:8px">fa-laptop</small>',
		'fa-leaf'=>'<i class="fa fa-leaf"></i><br><small style="font-size:8px">fa-leaf</small>',
		'fa-legal'=>'<i class="fa fa-legal"></i><br><small style="font-size:8px">fa-legal</small>',
		'fa-lemon-o'=>'<i class="fa fa-lemon-o"></i><br><small style="font-size:8px">fa-lemon-o</small>',
		'fa-level-down'=>'<i class="fa fa-level-down"></i><br><small style="font-size:8px">fa-level-down</small>',
		'fa-level-up'=>'<i class="fa fa-level-up"></i><br><small style="font-size:8px">fa-level-up</small>',
		'fa-life-bouy'=>'<i class="fa fa-life-bouy"></i><br><small style="font-size:8px">fa-life-bouy</small>',
		'fa-life-buoy'=>'<i class="fa fa-life-buoy"></i><br><small style="font-size:8px">fa-life-buoy</small>',
		'fa-life-ring'=>'<i class="fa fa-life-ring"></i><br><small style="font-size:8px">fa-life-ring</small>',
		'fa-life-saver'=>'<i class="fa fa-life-saver"></i><br><small style="font-size:8px">fa-life-saver</small>',
		'fa-lightbulb-o'=>'<i class="fa fa-lightbulb-o"></i><br><small style="font-size:8px">fa-lightbulb-o</small>',
		'fa-line-chart'=>'<i class="fa fa-line-chart"></i><br><small style="font-size:8px">fa-line-chart</small>',
		'fa-location-arrow'=>'<i class="fa fa-location-arrow"></i><br><small style="font-size:8px">fa-location-arrow</small>',
		'fa-lock'=>'<i class="fa fa-lock"></i><br><small style="font-size:8px">fa-lock</small>',
		'fa-magic'=>'<i class="fa fa-magic"></i><br><small style="font-size:8px">fa-magic</small>',
		'fa-magnet'=>'<i class="fa fa-magnet"></i><br><small style="font-size:8px">fa-magnet</small>',
		'fa-mail-forward'=>'<i class="fa fa-mail-forward"></i><br><small style="font-size:8px">fa-mail-forward</small>',
		'fa-mail-reply'=>'<i class="fa fa-mail-reply"></i><br><small style="font-size:8px">fa-mail-reply</small>',
		'fa-mail-reply-all'=>'<i class="fa fa-mail-reply-all"></i><br><small style="font-size:8px">fa-mail-reply-all</small>',
		'fa-male'=>'<i class="fa fa-male"></i><br><small style="font-size:8px">fa-male</small>',
		'fa-map-marker'=>'<i class="fa fa-map-marker"></i><br><small style="font-size:8px">fa-map-marker</small>',
		'fa-meh-o'=>'<i class="fa fa-meh-o"></i><br><small style="font-size:8px">fa-meh-o</small>',
		'fa-microphone'=>'<i class="fa fa-microphone"></i><br><small style="font-size:8px">fa-microphone</small>',
		'fa-microphone-slash'=>'<i class="fa fa-microphone-slash"></i><br><small style="font-size:8px">fa-microphone-slash</small>',
		'fa-minus'=>'<i class="fa fa-minus"></i><br><small style="font-size:8px">fa-minus</small>',
		'fa-minus-circle'=>'<i class="fa fa-minus-circle"></i><br><small style="font-size:8px">fa-minus-circle</small>',
		'fa-minus-square'=>'<i class="fa fa-minus-square"></i><br><small style="font-size:8px">fa-minus-square</small>',
		'fa-minus-square-o'=>'<i class="fa fa-minus-square-o"></i><br><small style="font-size:8px">fa-minus-square-o</small>',
		'fa-mobile'=>'<i class="fa fa-mobile"></i><br><small style="font-size:8px">fa-mobile</small>',
		'fa-mobile-phone'=>'<i class="fa fa-mobile-phone"></i><br><small style="font-size:8px">fa-mobile-phone</small>',
		'fa-money'=>'<i class="fa fa-money"></i><br><small style="font-size:8px">fa-money</small>',
		'fa-moon-o'=>'<i class="fa fa-moon-o"></i><br><small style="font-size:8px">fa-moon-o</small>',
		'fa-mortar-board'=>'<i class="fa fa-mortar-board"></i><br><small style="font-size:8px">fa-mortar-board</small>',
		'fa-music'=>'<i class="fa fa-music"></i><br><small style="font-size:8px">fa-music</small>',
		'fa-navicon'=>'<i class="fa fa-navicon"></i><br><small style="font-size:8px">fa-navicon</small>',
		'fa-newspaper-o'=>'<i class="fa fa-newspaper-o"></i><br><small style="font-size:8px">fa-newspaper-o</small>',
		'fa-paint-brush'=>'<i class="fa fa-paint-brush"></i><br><small style="font-size:8px">fa-paint-brush</small>',
		'fa-paper-plane'=>'<i class="fa fa-paper-plane"></i><br><small style="font-size:8px">fa-paper-plane</small>',
		'fa-paper-plane-o'=>'<i class="fa fa-paper-plane-o"></i><br><small style="font-size:8px">fa-paper-plane-o</small>',
		'fa-paw'=>'<i class="fa fa-paw"></i><br><small style="font-size:8px">fa-paw</small>',
		'fa-pencil'=>'<i class="fa fa-pencil"></i><br><small style="font-size:8px">fa-pencil</small>',
		'fa-pencil-square'=>'<i class="fa fa-pencil-square"></i><br><small style="font-size:8px">fa-pencil-square</small>',
		'fa-pencil-square-o'=>'<i class="fa fa-pencil-square-o"></i><br><small style="font-size:8px">fa-pencil-square-o</small>',
		'fa-phone'=>'<i class="fa fa-phone"></i><br><small style="font-size:8px">fa-phone</small>',
		'fa-phone-square'=>'<i class="fa fa-phone-square"></i><br><small style="font-size:8px">fa-phone-square</small>',
		'fa-photo'=>'<i class="fa fa-photo"></i><br><small style="font-size:8px">fa-photo</small>',
		'fa-picture-o'=>'<i class="fa fa-picture-o"></i><br><small style="font-size:8px">fa-picture-o</small>',
		'fa-pie-chart'=>'<i class="fa fa-pie-chart"></i><br><small style="font-size:8px">fa-pie-chart</small>',
		'fa-plane'=>'<i class="fa fa-plane"></i><br><small style="font-size:8px">fa-plane</small>',
		'fa-plug'=>'<i class="fa fa-plug"></i><br><small style="font-size:8px">fa-plug</small>',
		'fa-plus'=>'<i class="fa fa-plus"></i><br><small style="font-size:8px">fa-plus</small>',
		'fa-plus-circle'=>'<i class="fa fa-plus-circle"></i><br><small style="font-size:8px">fa-plus-circle</small>',
		'fa-plus-square'=>'<i class="fa fa-plus-square"></i><br><small style="font-size:8px">fa-plus-square</small>',
		'fa-plus-square-o'=>'<i class="fa fa-plus-square-o"></i><br><small style="font-size:8px">fa-plus-square-o</small>',
		'fa-power-off'=>'<i class="fa fa-power-off"></i><br><small style="font-size:8px">fa-power-off</small>',
		'fa-print'=>'<i class="fa fa-print"></i><br><small style="font-size:8px">fa-print</small>',
		'fa-puzzle-piece'=>'<i class="fa fa-puzzle-piece"></i><br><small style="font-size:8px">fa-puzzle-piece</small>',
		'fa-qrcode'=>'<i class="fa fa-qrcode"></i><br><small style="font-size:8px">fa-qrcode</small>',
		'fa-question'=>'<i class="fa fa-question"></i><br><small style="font-size:8px">fa-question</small>',
		'fa-question-circle'=>'<i class="fa fa-question-circle"></i><br><small style="font-size:8px">fa-question-circle</small>',
		'fa-quote-left'=>'<i class="fa fa-quote-left"></i><br><small style="font-size:8px">fa-quote-left</small>',
		'fa-quote-right'=>'<i class="fa fa-quote-right"></i><br><small style="font-size:8px">fa-quote-right</small>',
		'fa-random'=>'<i class="fa fa-random"></i><br><small style="font-size:8px">fa-random</small>',
		'fa-recycle'=>'<i class="fa fa-recycle"></i><br><small style="font-size:8px">fa-recycle</small>',
		'fa-refresh'=>'<i class="fa fa-refresh"></i><br><small style="font-size:8px">fa-refresh</small>',
		'fa-remove'=>'<i class="fa fa-remove"></i><br><small style="font-size:8px">fa-remove</small>',
		'fa-reorder'=>'<i class="fa fa-reorder"></i><br><small style="font-size:8px">fa-reorder</small>',
		'fa-reply'=>'<i class="fa fa-reply"></i><br><small style="font-size:8px">fa-reply</small>',
		'fa-reply-all'=>'<i class="fa fa-reply-all"></i><br><small style="font-size:8px">fa-reply-all</small>',
		'fa-retweet'=>'<i class="fa fa-retweet"></i><br><small style="font-size:8px">fa-retweet</small>',
		'fa-road'=>'<i class="fa fa-road"></i><br><small style="font-size:8px">fa-road</small>',
		'fa-rocket'=>'<i class="fa fa-rocket"></i><br><small style="font-size:8px">fa-rocket</small>',
		'fa-rss'=>'<i class="fa fa-rss"></i><br><small style="font-size:8px">fa-rss</small>',
		'fa-rss-square'=>'<i class="fa fa-rss-square"></i><br><small style="font-size:8px">fa-rss-square</small>',
		'fa-search'=>'<i class="fa fa-search"></i><br><small style="font-size:8px">fa-search</small>',
		'fa-search-minus'=>'<i class="fa fa-search-minus"></i><br><small style="font-size:8px">fa-search-minus</small>',
		'fa-search-plus'=>'<i class="fa fa-search-plus"></i><br><small style="font-size:8px">fa-search-plus</small>',
		'fa-send'=>'<i class="fa fa-send"></i><br><small style="font-size:8px">fa-send</small>',
		'fa-send-o'=>'<i class="fa fa-send-o"></i><br><small style="font-size:8px">fa-send-o</small>',
		'fa-share'=>'<i class="fa fa-share"></i><br><small style="font-size:8px">fa-share</small>',
		'fa-share-alt'=>'<i class="fa fa-share-alt"></i><br><small style="font-size:8px">fa-share-alt</small>',
		'fa-share-alt-square'=>'<i class="fa fa-share-alt-square"></i><br><small style="font-size:8px">fa-share-alt-square</small>',
		'fa-share-square'=>'<i class="fa fa-share-square"></i><br><small style="font-size:8px">fa-share-square</small>',
		'fa-share-square-o'=>'<i class="fa fa-share-square-o"></i><br><small style="font-size:8px">fa-share-square-o</small>',
		'fa-shield'=>'<i class="fa fa-shield"></i><br><small style="font-size:8px">fa-shield</small>',
		'fa-shopping-cart'=>'<i class="fa fa-shopping-cart"></i><br><small style="font-size:8px">fa-shopping-cart</small>',
		'fa-sign-in'=>'<i class="fa fa-sign-in"></i><br><small style="font-size:8px">fa-sign-in</small>',
		'fa-sign-out'=>'<i class="fa fa-sign-out"></i><br><small style="font-size:8px">fa-sign-out</small>',
		'fa-signal'=>'<i class="fa fa-signal"></i><br><small style="font-size:8px">fa-signal</small>',
		'fa-sitemap'=>'<i class="fa fa-sitemap"></i><br><small style="font-size:8px">fa-sitemap</small>',
		'fa-sliders'=>'<i class="fa fa-sliders"></i><br><small style="font-size:8px">fa-sliders</small>',
		'fa-smile-o'=>'<i class="fa fa-smile-o"></i><br><small style="font-size:8px">fa-smile-o</small>',
		'fa-soccer-ball-o'=>'<i class="fa fa-soccer-ball-o"></i><br><small style="font-size:8px">fa-soccer-ball-o</small>',
		'fa-sort'=>'<i class="fa fa-sort"></i><br><small style="font-size:8px">fa-sort</small>',
		'fa-sort-alpha-asc'=>'<i class="fa fa-sort-alpha-asc"></i><br><small style="font-size:8px">fa-sort-alpha-asc</small>',
		'fa-sort-alpha-desc'=>'<i class="fa fa-sort-alpha-desc"></i><br><small style="font-size:8px">fa-sort-alpha-desc</small>',
		'fa-sort-amount-asc'=>'<i class="fa fa-sort-amount-asc"></i><br><small style="font-size:8px">fa-sort-amount-asc</small>',
		'fa-sort-amount-desc'=>'<i class="fa fa-sort-amount-desc"></i><br><small style="font-size:8px">fa-sort-amount-desc</small>',
		'fa-sort-asc'=>'<i class="fa fa-sort-asc"></i><br><small style="font-size:8px">fa-sort-asc</small>',
		'fa-sort-desc'=>'<i class="fa fa-sort-desc"></i><br><small style="font-size:8px">fa-sort-desc</small>',
		'fa-sort-down'=>'<i class="fa fa-sort-down"></i><br><small style="font-size:8px">fa-sort-down</small>',
		'fa-sort-numeric-asc'=>'<i class="fa fa-sort-numeric-asc"></i><br><small style="font-size:8px">fa-sort-numeric-asc</small>',
		'fa-sort-numeric-desc'=>'<i class="fa fa-sort-numeric-desc"></i><br><small style="font-size:8px">fa-sort-numeric-desc</small>',
		'fa-sort-up'=>'<i class="fa fa-sort-up"></i><br><small style="font-size:8px">fa-sort-up</small>',
		'fa-space-shuttle'=>'<i class="fa fa-space-shuttle"></i><br><small style="font-size:8px">fa-space-shuttle</small>',
		'fa-spinner'=>'<i class="fa fa-spinner"></i><br><small style="font-size:8px">fa-spinner</small>',
		'fa-spoon'=>'<i class="fa fa-spoon"></i><br><small style="font-size:8px">fa-spoon</small>',
		'fa-square'=>'<i class="fa fa-square"></i><br><small style="font-size:8px">fa-square</small>',
		'fa-square-o'=>'<i class="fa fa-square-o"></i><br><small style="font-size:8px">fa-square-o</small>',
		'fa-star'=>'<i class="fa fa-star"></i><br><small style="font-size:8px">fa-star</small>',
		'fa-star-half'=>'<i class="fa fa-star-half"></i><br><small style="font-size:8px">fa-star-half</small>',
		'fa-star-half-empty'=>'<i class="fa fa-star-half-empty"></i><br><small style="font-size:8px">fa-star-half-empty</small>',
		'fa-star-half-full'=>'<i class="fa fa-star-half-full"></i><br><small style="font-size:8px">fa-star-half-full</small>',
		'fa-star-half-o'=>'<i class="fa fa-star-half-o"></i><br><small style="font-size:8px">fa-star-half-o</small>',
		'fa-star-o'=>'<i class="fa fa-star-o"></i><br><small style="font-size:8px">fa-star-o</small>',
		'fa-suitcase'=>'<i class="fa fa-suitcase"></i><br><small style="font-size:8px">fa-suitcase</small>',
		'fa-sun-o'=>'<i class="fa fa-sun-o"></i><br><small style="font-size:8px">fa-sun-o</small>',
		'fa-support'=>'<i class="fa fa-support"></i><br><small style="font-size:8px">fa-support</small>',
		'fa-tablet'=>'<i class="fa fa-tablet"></i><br><small style="font-size:8px">fa-tablet</small>',
		'fa-tachometer'=>'<i class="fa fa-tachometer"></i><br><small style="font-size:8px">fa-tachometer</small>',
		'fa-tag'=>'<i class="fa fa-tag"></i><br><small style="font-size:8px">fa-tag</small>',
		'fa-tags'=>'<i class="fa fa-tags"></i><br><small style="font-size:8px">fa-tags</small>',
		'fa-tasks'=>'<i class="fa fa-tasks"></i><br><small style="font-size:8px">fa-tasks</small>',
		'fa-taxi'=>'<i class="fa fa-taxi"></i><br><small style="font-size:8px">fa-taxi</small>',
		'fa-terminal'=>'<i class="fa fa-terminal"></i><br><small style="font-size:8px">fa-terminal</small>',
		'fa-thumb-tack'=>'<i class="fa fa-thumb-tack"></i><br><small style="font-size:8px">fa-thumb-tack</small>',
		'fa-thumbs-down'=>'<i class="fa fa-thumbs-down"></i><br><small style="font-size:8px">fa-thumbs-down</small>',
		'fa-thumbs-o-down'=>'<i class="fa fa-thumbs-o-down"></i><br><small style="font-size:8px">fa-thumbs-o-down</small>',
		'fa-thumbs-o-up'=>'<i class="fa fa-thumbs-o-up"></i><br><small style="font-size:8px">fa-thumbs-o-up</small>',
		'fa-thumbs-up'=>'<i class="fa fa-thumbs-up"></i><br><small style="font-size:8px">fa-thumbs-up</small>',
		'fa-ticket'=>'<i class="fa fa-ticket"></i><br><small style="font-size:8px">fa-ticket</small>',
		'fa-times'=>'<i class="fa fa-times"></i><br><small style="font-size:8px">fa-times</small>',
		'fa-times-circle'=>'<i class="fa fa-times-circle"></i><br><small style="font-size:8px">fa-times-circle</small>',
		'fa-times-circle-o'=>'<i class="fa fa-times-circle-o"></i><br><small style="font-size:8px">fa-times-circle-o</small>',
		'fa-tint'=>'<i class="fa fa-tint"></i><br><small style="font-size:8px">fa-tint</small>',
		'fa-toggle-down'=>'<i class="fa fa-toggle-down"></i><br><small style="font-size:8px">fa-toggle-down</small>',
		'fa-toggle-left'=>'<i class="fa fa-toggle-left"></i><br><small style="font-size:8px">fa-toggle-left</small>',
		'fa-toggle-off'=>'<i class="fa fa-toggle-off"></i><br><small style="font-size:8px">fa-toggle-off</small>',
		'fa-toggle-on'=>'<i class="fa fa-toggle-on"></i><br><small style="font-size:8px">fa-toggle-on</small>',
		'fa-toggle-right'=>'<i class="fa fa-toggle-right"></i><br><small style="font-size:8px">fa-toggle-right</small>',
		'fa-toggle-up'=>'<i class="fa fa-toggle-up"></i><br><small style="font-size:8px">fa-toggle-up</small>',
		'fa-trash'=>'<i class="fa fa-trash"></i><br><small style="font-size:8px">fa-trash</small>',
		'fa-trash-o'=>'<i class="fa fa-trash-o"></i><br><small style="font-size:8px">fa-trash-o</small>',
		'fa-tree'=>'<i class="fa fa-tree"></i><br><small style="font-size:8px">fa-tree</small>',
		'fa-trophy'=>'<i class="fa fa-trophy"></i><br><small style="font-size:8px">fa-trophy</small>',
		'fa-truck'=>'<i class="fa fa-truck"></i><br><small style="font-size:8px">fa-truck</small>',
		'fa-tty'=>'<i class="fa fa-tty"></i><br><small style="font-size:8px">fa-tty</small>',
		'fa-umbrella'=>'<i class="fa fa-umbrella"></i><br><small style="font-size:8px">fa-umbrella</small>',
		'fa-university'=>'<i class="fa fa-university"></i><br><small style="font-size:8px">fa-university</small>',
		'fa-unlock'=>'<i class="fa fa-unlock"></i><br><small style="font-size:8px">fa-unlock</small>',
		'fa-unlock-alt'=>'<i class="fa fa-unlock-alt"></i><br><small style="font-size:8px">fa-unlock-alt</small>',
		'fa-unsorted'=>'<i class="fa fa-unsorted"></i><br><small style="font-size:8px">fa-unsorted</small>',
		'fa-upload'=>'<i class="fa fa-upload"></i><br><small style="font-size:8px">fa-upload</small>',
		'fa-user'=>'<i class="fa fa-user"></i><br><small style="font-size:8px">fa-user</small>',
		'fa-users'=>'<i class="fa fa-users"></i><br><small style="font-size:8px">fa-users</small>',
		'fa-video-camera'=>'<i class="fa fa-video-camera"></i><br><small style="font-size:8px">fa-video-camera</small>',
		'fa-volume-down'=>'<i class="fa fa-volume-down"></i><br><small style="font-size:8px">fa-volume-down</small>',
		'fa-volume-off'=>'<i class="fa fa-volume-off"></i><br><small style="font-size:8px">fa-volume-off</small>',
		'fa-volume-up'=>'<i class="fa fa-volume-up"></i><br><small style="font-size:8px">fa-volume-up</small>',
		'fa-warning'=>'<i class="fa fa-warning"></i><br><small style="font-size:8px">fa-warning</small>',
		'fa-wheelchair'=>'<i class="fa fa-wheelchair"></i><br><small style="font-size:8px">fa-wheelchair</small>',
		'fa-wifi'=>'<i class="fa fa-wifi"></i><br><small style="font-size:8px">fa-wifi</small>',
		'fa-wrench'=>'<i class="fa fa-wrench"></i><br><small style="font-size:8px">fa-wrench</small>',
		'fa-facebook'=>'<i class="fa fa-facebook"></i><br><small style="font-size:8px">fa-facebook</small>',
		'fa-twitter'=>'<i class="fa fa-twitter"></i><br><small style="font-size:8px">fa-twitter</small>',
		'fa-instagram'=>'<i class="fa fa-instagram"></i><br><small style="font-size:8px">fa-instagram</small>',
		'fa-skype'=>'<i class="fa fa-skype"></i><br><small style="font-size:8px">fa-skype</small>',
	);

	public $colClass = 'col-lg-1';

	private $_assets;

	/**
	 * Executes the widget.
	 * This method registers all needed client scripts and renders
	 * the text field.
	 */
	public function run()
	{
		list($name,$id)=$this->resolveNameID();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];

		#$this->registerClientScript($id);
		#$this->htmlOptions["class"]="form-control";
		$this->htmlOptions=array_merge($this->htmlOptions,array(
			// 'htmlOptions'=>array('container'=>null),
			'labelOptions'=>array('style'=>'width: 100%;height: 100%;cursor:pointer','class'=>'ptm pbm mbn'),
			'template'=>'<div class="'.$this->colClass.' pln"><a href="#" class="thumbnail text-center">{beginLabel}{labelTitle}<div class="text-center">{input}</div>{endLabel}</a></div>',
			'separator'=>'',
		));

		#echo "<small class=\"text-muted\"><em>Here a message for user</em></small>";
		#echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		echo '<div class="clearfix">'.Chtml::activeRadioButtonList($this->model,$this->attribute,
		  $this->listData,$this->htmlOptions).'</div>';
	}

	/**
	 * Registers the necessary javascript and css scripts.
	 * @param string $id the ID of the container
	 */
	public function registerClientScript($id)
	{
		$js="
			$(function() {
		    	console.log('Hello world');
			});
		";
		$assets=$this->getAssets();
		$cs=Yii::app()->getClientScript();
		// $cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=drawing",CClientScript::POS_HEAD);
		// $cs->registerScriptFile($assets."/googleMap.js",CClientScript::POS_HEAD);
		$cs->registerScript('ext.GInput#'.$id,$js,CClientScript::POS_END);
	}

	public function getAssets()
	{
		if($this->_assets===null)
			$this->_assets=Yii::app()->assetManager->publish(dirname(__FILE__)."/assets/");
		return $this->_assets;
	}
}
