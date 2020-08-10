<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.general_settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#main" data-toggle="tab"> <?php echo e(trans('admin.general')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#withdraw" data-toggle="tab"> <?php echo e(trans('admin.financial')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#factor" data-toggle="tab"> <?php echo e(trans('admin.invoice')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#gateway" data-toggle="tab"> <?php echo e(trans('admin.payment')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#popup" data-toggle="tab"> <?php echo e(trans('admin.popup')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#videoAds" data-toggle="tab"> <?php echo e(trans('admin.video_ads')); ?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#mainSlide" data-toggle="tab"> <?php echo e(trans('admin.home_hero')); ?> </a></li>
            </ul>
            <div class="tab-content">
                <div id="main" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.site_name')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="site_title" value="<?php echo e($_setting['site_title'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.site_description')); ?></label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="site_description"><?php echo e($_setting['site_description'] ?? ''); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.site_email')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="site_email" value="<?php echo e($_setting['site_email'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('admin.site_language'); ?></label>
                            <div class="col-md-6">
                                <select name="site_language" class="form-control">
                                    <option value="ab" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ab'): ?> selected <?php endif; ?>>Abkhazian</option>
                                    <option value="aa" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'aa'): ?> selected <?php endif; ?>>Afar</option>
                                    <option value="AF" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'af'): ?> selected <?php endif; ?>>Afrikanns</option>
                                    <option value="SQ" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sq'): ?> selected <?php endif; ?>>Albanian</option>
                                    <option value="AM" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'am'): ?> selected <?php endif; ?>>Amharic</option>
                                    <option value="AR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ar'): ?> selected <?php endif; ?>>Arabic</option>
                                    <option value="HY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'hy'): ?> selected <?php endif; ?>>Armenian</option>
                                    <option value="AS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'as'): ?> selected <?php endif; ?>>Assamese</option>
                                    <option value="AY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ay'): ?> selected <?php endif; ?>>Aymara</option>
                                    <option value="AZ" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'az'): ?> selected <?php endif; ?>>Azerbaijani</option>
                                    <option value="BA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ba'): ?> selected <?php endif; ?>>Bashkir</option>
                                    <option value="EU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'eu'): ?> selected <?php endif; ?>>Basque</option>
                                    <option value="BN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'bn'): ?> selected <?php endif; ?>>Bengali, Bangla</option>
                                    <option value="DZ" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'dz'): ?> selected <?php endif; ?>>Bhutani</option>
                                    <option value="BH" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'bh'): ?> selected <?php endif; ?>>Bihari</option>
                                    <option value="BI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'bi'): ?> selected <?php endif; ?>>Bislama</option>
                                    <option value="BR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'br'): ?> selected <?php endif; ?>>Breton</option>
                                    <option value="BG" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'bg'): ?> selected <?php endif; ?>>Bulgarian</option>
                                    <option value="MY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'my'): ?> selected <?php endif; ?>>Burmese</option>
                                    <option value="BE" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'be'): ?> selected <?php endif; ?>>Byelorussian</option>
                                    <option value="KM" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'km'): ?> selected <?php endif; ?>>Cambodian</option>
                                    <option value="CA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ca'): ?> selected <?php endif; ?>>Catalan</option>
                                    <option value="ZH" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'zh'): ?> selected <?php endif; ?>>Chinese (Mandarin)</option>
                                    <option value="CO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'co'): ?> selected <?php endif; ?>>Corsican</option>
                                    <option value="HR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'hr'): ?> selected <?php endif; ?>>Croation</option>
                                    <option value="CS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'cs'): ?> selected <?php endif; ?>>Czech</option>
                                    <option value="DA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'da'): ?> selected <?php endif; ?>>Danish</option>
                                    <option value="NL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'nl'): ?> selected <?php endif; ?>>Dutch</option>
                                    <option value="EN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'en'): ?> selected <?php endif; ?>>English, American</option>
                                    <option value="EO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'eo'): ?> selected <?php endif; ?>>Esperanto</option>
                                    <option value="ET" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'et'): ?> selected <?php endif; ?>>Estonian</option>
                                    <option value="FO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fo'): ?> selected <?php endif; ?>>Faeroese</option>
                                    <option value="FJ" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fj'): ?> selected <?php endif; ?>>Fiji</option>
                                    <option value="FI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fi'): ?> selected <?php endif; ?>>Finnish</option>
                                    <option value="FR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fr'): ?> selected <?php endif; ?>>French</option>
                                    <option value="FY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fy'): ?> selected <?php endif; ?>>Frisian</option>
                                    <option value="GD" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'gd'): ?> selected <?php endif; ?>>Gaelic (Scots Gaelic)</option>
                                    <option value="GL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'gl'): ?> selected <?php endif; ?>>Galician</option>
                                    <option value="KA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ka'): ?> selected <?php endif; ?>>Georgian</option>
                                    <option value="DE" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'de'): ?> selected <?php endif; ?>>German</option>
                                    <option value="EL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'el'): ?> selected <?php endif; ?>>Greek</option>
                                    <option value="KL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'kl'): ?> selected <?php endif; ?>>Greenlandic</option>
                                    <option value="GN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'gn'): ?> selected <?php endif; ?>>Guarani</option>
                                    <option value="GU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'gu'): ?> selected <?php endif; ?>>Gujarati</option>
                                    <option value="HA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ha'): ?> selected <?php endif; ?>>Hausa</option>
                                    <option value="IW" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'iw'): ?> selected <?php endif; ?>>Hebrew</option>
                                    <option value="HI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'hi'): ?> selected <?php endif; ?>>Hindi</option>
                                    <option value="HU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'hu'): ?> selected <?php endif; ?>>Hungarian</option>
                                    <option value="IS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'is'): ?> selected <?php endif; ?>>Icelandic</option>
                                    <option value="IN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'in'): ?> selected <?php endif; ?>>Indonesian</option>
                                    <option value="IA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ia'): ?> selected <?php endif; ?>>Interlingua</option>
                                    <option value="IE" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ie'): ?> selected <?php endif; ?>>Interlingue</option>
                                    <option value="IK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ik'): ?> selected <?php endif; ?>>Inupiak</option>
                                    <option value="GA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ga'): ?> selected <?php endif; ?>>Irish</option>
                                    <option value="IT" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'it'): ?> selected <?php endif; ?>>Italian</option>
                                    <option value="JA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ja'): ?> selected <?php endif; ?>>Japanese</option>
                                    <option value="JW" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'jw'): ?> selected <?php endif; ?>>Javanese</option>
                                    <option value="KN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'kn'): ?> selected <?php endif; ?>>Kannada</option>
                                    <option value="KS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ks'): ?> selected <?php endif; ?>>Kashmiri</option>
                                    <option value="KK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'kk'): ?> selected <?php endif; ?>>Kazakh</option>
                                    <option value="RW" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'rw'): ?> selected <?php endif; ?>>Kinyarwanda</option>
                                    <option value="KY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ky'): ?> selected <?php endif; ?>>Kirghiz</option>
                                    <option value="RN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'rn'): ?> selected <?php endif; ?>>Kirundi</option>
                                    <option value="KO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ko'): ?> selected <?php endif; ?>>Korean</option>
                                    <option value="KU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ku'): ?> selected <?php endif; ?>>Kurdish</option>
                                    <option value="LO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'lo'): ?> selected <?php endif; ?>>Laothian</option>
                                    <option value="LA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'la'): ?> selected <?php endif; ?>>Latin</option>
                                    <option value="LV" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'lv'): ?> selected <?php endif; ?>>Latvian, Lettish</option>
                                    <option value="LN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ln'): ?> selected <?php endif; ?>>Lingala</option>
                                    <option value="LT" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'lt'): ?> selected <?php endif; ?>>Lithuanian</option>
                                    <option value="MK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mk'): ?> selected <?php endif; ?>>Macedonian</option>
                                    <option value="MG" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mg'): ?> selected <?php endif; ?>>Malagasy</option>
                                    <option value="MS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ms'): ?> selected <?php endif; ?>>Malay</option>
                                    <option value="ML" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ml'): ?> selected <?php endif; ?>>Malayalam</option>
                                    <option value="MT" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mt'): ?> selected <?php endif; ?>>Maltese</option>
                                    <option value="MI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mi'): ?> selected <?php endif; ?>>Maori</option>
                                    <option value="MR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mr'): ?> selected <?php endif; ?>>Marathi</option>
                                    <option value="MO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mo'): ?> selected <?php endif; ?>>Moldavian</option>
                                    <option value="MN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'mn'): ?> selected <?php endif; ?>>Mongolian</option>
                                    <option value="NA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'na'): ?> selected <?php endif; ?>>Nauru</option>
                                    <option value="NE" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ne'): ?> selected <?php endif; ?>>Nepali</option>
                                    <option value="NO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'no'): ?> selected <?php endif; ?>>Norwegian</option>
                                    <option value="OC" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'oc'): ?> selected <?php endif; ?>>Occitan</option>
                                    <option value="OR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'or'): ?> selected <?php endif; ?>>Oriya</option>
                                    <option value="OM" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'om'): ?> selected <?php endif; ?>>Oromo, Afan</option>
                                    <option value="PS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ps'): ?> selected <?php endif; ?>>Pashto, Pushto</option>
                                    <option value="FA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'fa'): ?> selected <?php endif; ?>>Persian</option>
                                    <option value="PL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'pl'): ?> selected <?php endif; ?>>Polish</option>
                                    <option value="PT" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'pt'): ?> selected <?php endif; ?>>Portuguese</option>
                                    <option value="PA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'pa'): ?> selected <?php endif; ?>>Punjabi</option>
                                    <option value="QU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'qu'): ?> selected <?php endif; ?>>Quechua</option>
                                    <option value="RM" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'rm'): ?> selected <?php endif; ?>>Rhaeto-Romance</option>
                                    <option value="RO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ro'): ?> selected <?php endif; ?>>Romanian</option>
                                    <option value="RU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ru'): ?> selected <?php endif; ?>>Russian</option>
                                    <option value="SM" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sm'): ?> selected <?php endif; ?>>Samoan</option>
                                    <option value="SG" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sg'): ?> selected <?php endif; ?>>Sangro</option>
                                    <option value="SA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sa'): ?> selected <?php endif; ?>>Sanskrit</option>
                                    <option value="SR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sr'): ?> selected <?php endif; ?>>Serbian</option>
                                    <option value="SH" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sh'): ?> selected <?php endif; ?>>Serbo-Croatian</option>
                                    <option value="ST" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'st'): ?> selected <?php endif; ?>>Sesotho</option>
                                    <option value="TN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tn'): ?> selected <?php endif; ?>>Setswana</option>
                                    <option value="SN" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sn'): ?> selected <?php endif; ?>>Shona</option>
                                    <option value="SD" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sd'): ?> selected <?php endif; ?>>Sindhi</option>
                                    <option value="SI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'si'): ?> selected <?php endif; ?>>Singhalese</option>
                                    <option value="SS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ss'): ?> selected <?php endif; ?>>Siswati</option>
                                    <option value="SK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sk'): ?> selected <?php endif; ?>>Slovak</option>
                                    <option value="SL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sl'): ?> selected <?php endif; ?>>Slovenian</option>
                                    <option value="SO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'so'): ?> selected <?php endif; ?>>Somali</option>
                                    <option value="ES" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'es'): ?> selected <?php endif; ?>>Spanish</option>
                                    <option value="SU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'su'): ?> selected <?php endif; ?>>Sudanese</option>
                                    <option value="SW" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sw'): ?> selected <?php endif; ?>>Swahili</option>
                                    <option value="SV" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'sv'): ?> selected <?php endif; ?>>Swedish</option>
                                    <option value="TL" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tl'): ?> selected <?php endif; ?>>Tagalog</option>
                                    <option value="TG" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tg'): ?> selected <?php endif; ?>>Tajik</option>
                                    <option value="TA" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ta'): ?> selected <?php endif; ?>>Tamil</option>
                                    <option value="TT" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tt'): ?> selected <?php endif; ?>>Tatar</option>
                                    <option value="TE" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'te'): ?> selected <?php endif; ?>>Telugu</option>
                                    <option value="TH" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'th'): ?> selected <?php endif; ?>>Thai</option>
                                    <option value="BO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'bo'): ?> selected <?php endif; ?>>Tibetan</option>
                                    <option value="TI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ti'): ?> selected <?php endif; ?>>Tigrinya</option>
                                    <option value="TO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'to'): ?> selected <?php endif; ?>>Tonga</option>
                                    <option value="TS" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ts'): ?> selected <?php endif; ?>>Tsonga</option>
                                    <option value="TR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tr'): ?> selected <?php endif; ?>>Turkish</option>
                                    <option value="TK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tk'): ?> selected <?php endif; ?>>Turkmen</option>
                                    <option value="TW" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'tw'): ?> selected <?php endif; ?>>Twi</option>
                                    <option value="UK" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'uk'): ?> selected <?php endif; ?>>Ukranian</option>
                                    <option value="UR" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ur'): ?> selected <?php endif; ?>>Urdu</option>
                                    <option value="UZ" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'uz'): ?> selected <?php endif; ?>>Uzbek</option>
                                    <option value="VI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'vi'): ?> selected <?php endif; ?>>Vietnamese</option>
                                    <option value="VO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'vo'): ?> selected <?php endif; ?>>Volapuk</option>
                                    <option value="CY" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'cy'): ?> selected <?php endif; ?>>Welsh</option>
                                    <option value="WO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'wo'): ?> selected <?php endif; ?>>Wolof</option>
                                    <option value="XH" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'xh'): ?> selected <?php endif; ?>>Xhosa</option>
                                    <option value="JI" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'ji'): ?> selected <?php endif; ?>>Yiddish</option>
                                    <option value="YO" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'yo'): ?> selected <?php endif; ?>>Yoruba</option>
                                    <option value="ZU" <?php if(isset($_setting['site_language']) and $_setting['site_language'] == 'zu'): ?> selected <?php endif; ?>>Zulu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.logo')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_site_logo" data-input="site_logo" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="site_logo" class="form-control" dir="ltr" type="text" name="site_logo" value="<?php echo e($_setting['site_logo'] ?? ''); ?>" placeholder="Displays on header (55*55px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="site_logo">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.logotype')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_site_logo_type" data-input="site_logo_type" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="site_logo_type" class="form-control" dir="ltr" type="text" name="site_logo_type" dir="ltr" value="<?php echo e($_setting['site_logo_type'] ?? ''); ?>" placeholder="Displays on header ,Hides when scrolling. (200*55px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="site_logo_type">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.videos_watermark')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_video_watermark" data-input="video_watermark" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="video_watermark" class="form-control" dir="ltr" type="text" name="video_watermark" value="<?php echo e($_setting['video_watermark'] ?? ''); ?>">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="video_watermark">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.requests_icon')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_request_page_icon" data-input="request_page_icon" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="request_page_icon" class="form-control" dir="ltr" type="text" name="request_page_icon" value="<?php echo e($_setting['request_page_icon'] ?? ''); ?>" placeholder="Displays on requests page header (80*80px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="request_page_icon">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.upload_bg')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_upload_page_background" data-input="upload_page_background" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="upload_page_background" class="form-control" dir="ltr" type="text" name="upload_page_background" value="<?php echo e($_setting['upload_page_background'] ?? ''); ?>" placeholder="Displays as upload page bacground (1920*1080px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_page_background">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.login_bg')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_login_page_background" data-input="login_page_background" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="login_page_background" class="form-control" dir="ltr" type="text" name="login_page_background" value="<?php echo e($_setting['login_page_background'] ?? ''); ?>" placeholder="Displays as login page bacground (1920*1080px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="login_page_background">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.days_graph')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group w-150">
                                    <input type="number" class="spinner-input form-control" name="chart_day_count" value="<?php echo e($_setting['chart_day_count'] ?? 0); ?>" maxlength="3">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="site_disable" value="0">
                                        <input type="checkbox" name="site_disable" value="1" class="custom-switch-input" <?php if(!empty($_setting['site_disable']) and $_setting['site_disable']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.disable_website')); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="site_rtl" value="0">
                                        <input type="checkbox" name="site_rtl" value="1" class="custom-switch-input" <?php if(!empty($_setting['site_rtl']) and $_setting['site_rtl']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">RTL Layout</label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="site_preloader" value="0">
                                        <input type="checkbox" name="site_preloader" value="1" class="custom-switch-input" <?php if(!empty($_setting['site_preloader']) and $_setting['site_preloader']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo trans('admin.preloader'); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="become_vendor" value="0">
                                        <input type="checkbox" name="become_vendor" value="1" class="custom-switch-input" <?php if(!empty($_setting['become_vendor']) and $_setting['become_vendor']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo trans('admin.become_vendor'); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="duplicate_login" value="0">
                                        <input type="checkbox" name="duplicate_login" value="1" class="custom-switch-input" <?php if(!empty($_setting['duplicate_login']) and $_setting['duplicate_login']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo trans('admin.avoid_double_login'); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="factor" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.approver')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" placeholder="Displays at the footer of financial balances" dir="ltr" name="factor_seconder" value="<?php echo e($_setting['factor_seconder'] ?? ''); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.financial_manager_name')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" dir="ltr" name="factor_approver" placeholder="Displays at the footer of financial balances" value="<?php echo e($_setting['factor_approver'] ?? ''); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.invoice_logo')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_factor_watermark" data-input="factor_watermark" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="factor_watermark" class="form-control" dir="ltr" type="text" name="factor_watermark" dir="ltr" value="<?php echo e($_setting['factor_watermark'] ?? ''); ?>" placeholder="Displays on invoce and balance header">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="factor_watermark">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="gateway" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inputDefault">Currency</label>
                            <div class="col-md-8">
                                <select name="currency" class="form-control">
                                    <option value="USD" <?php if(get_option('currency', 'USD') == 'USD'): ?> selected <?php endif; ?>>United States Dollar</option>
                                    <option value="EUR" <?php if(get_option('currency', 'USD') == 'EUR'): ?> selected <?php endif; ?>>Euro Member Countries</option>
                                    <option value="AUD" <?php if(get_option('currency', 'USD') == 'AUD'): ?> selected <?php endif; ?>>Australia Dollar</option>
                                    <option value="AED" <?php if(get_option('currency', 'USD') == 'AED'): ?> selected <?php endif; ?>>United Arab Emirates dirham</option>
                                    <option value="KAD" <?php if(get_option('currency', 'USD') == 'KAD'): ?> selected <?php endif; ?>>KAD</option>
                                    <option value="JPY" <?php if(get_option('currency', 'USD') == 'JPY'): ?> selected <?php endif; ?>>Japan Yen</option>
                                    <option value="CNY" <?php if(get_option('currency', 'USD') == 'CNY'): ?> selected <?php endif; ?>>China Yuan Renminbi</option>
                                    <option value="SAR" <?php if(get_option('currency', 'USD') == 'SAR'): ?> selected <?php endif; ?>>Saudi Arabia Riyal</option>
                                    <option value="KRW" <?php if(get_option('currency', 'USD') == 'KRW'): ?> selected <?php endif; ?>>Korea (South) Won</option>
                                    <option value="INR" <?php if(get_option('currency', 'USD') == 'INR'): ?> selected <?php endif; ?>>India Rupee</option>
                                    <option value="RUB" <?php if(get_option('currency', 'USD') == 'RUB'): ?> selected <?php endif; ?>>Russia Ruble</option>
                                    --------
                                    <option value="Lek" <?php if(get_option('currency', 'USD') == 'Lek'): ?> selected <?php endif; ?>>Albania Lek</option>
                                    <option value="AFN" <?php if(get_option('currency', 'USD') == 'AFN'): ?> selected <?php endif; ?>>Afghanistan Afghani</option>
                                    <option value="ARS" <?php if(get_option('currency', 'USD') == 'ARS'): ?> selected <?php endif; ?>>Argentina Peso</option>
                                    <option value="AWG" <?php if(get_option('currency', 'USD') == 'AWG'): ?> selected <?php endif; ?>>Aruba Guilder</option>
                                    <option value="AUD" <?php if(get_option('currency', 'USD') == 'AUD'): ?> selected <?php endif; ?>>Australia Dollar</option>
                                    <option value="AZN" <?php if(get_option('currency', 'USD') == 'AZN'): ?> selected <?php endif; ?>>Azerbaijan Manat</option>
                                    <option value="BSD" <?php if(get_option('currency', 'USD') == 'BSD'): ?> selected <?php endif; ?>>Bahamas Dollar</option>
                                    <option value="BBD" <?php if(get_option('currency', 'USD') == 'BBD'): ?> selected <?php endif; ?>>Barbados Dollar</option>
                                    <option value="BYN" <?php if(get_option('currency', 'USD') == 'BYN'): ?> selected <?php endif; ?>>Belarus Ruble</option>
                                    <option value="BZD" <?php if(get_option('currency', 'USD') == 'BZD'): ?> selected <?php endif; ?>>Belize Dollar</option>
                                    <option value="BMD" <?php if(get_option('currency', 'USD') == 'BMD'): ?> selected <?php endif; ?>>Bermuda Dollar</option>
                                    <option value="BOB" <?php if(get_option('currency', 'USD') == 'BOB'): ?> selected <?php endif; ?>>Bolivia Bolíviano</option>
                                    <option value="BAM" <?php if(get_option('currency', 'USD') == 'BAM'): ?> selected <?php endif; ?>>Bosnia and Herzegovina Convertible Mark</option>
                                    <option value="BWP" <?php if(get_option('currency', 'USD') == 'BWP'): ?> selected <?php endif; ?>>Botswana Pula</option>
                                    <option value="BGN" <?php if(get_option('currency', 'USD') == 'BGN'): ?> selected <?php endif; ?>>Bulgaria Lev</option>
                                    <option value="BRL" <?php if(get_option('currency', 'USD') == 'BRL'): ?> selected <?php endif; ?>>Brazil Real</option>
                                    <option value="BND" <?php if(get_option('currency', 'USD') == 'BND'): ?> selected <?php endif; ?>>Brunei Darussalam Dollar</option>
                                    <option value="KHR" <?php if(get_option('currency', 'USD') == 'KHR'): ?> selected <?php endif; ?>>Cambodia Riel</option>
                                    <option value="CAD" <?php if(get_option('currency', 'USD') == 'CAD'): ?> selected <?php endif; ?>>Canada Dollar</option>
                                    <option value="KYD" <?php if(get_option('currency', 'USD') == 'KYD'): ?> selected <?php endif; ?>>Cayman Islands Dollar</option>
                                    <option value="CLP" <?php if(get_option('currency', 'USD') == 'CLP'): ?> selected <?php endif; ?>>Chile Peso</option>
                                    <option value="COP" <?php if(get_option('currency', 'USD') == 'COP'): ?> selected <?php endif; ?>>Colombia Peso</option>
                                    <option value="CRC" <?php if(get_option('currency', 'USD') == 'CRC'): ?> selected <?php endif; ?>>Costa Rica Colon</option>
                                    <option value="HRK" <?php if(get_option('currency', 'USD') == 'HRK'): ?> selected <?php endif; ?>>Croatia Kuna</option>
                                    <option value="CUP" <?php if(get_option('currency', 'USD') == 'CUP'): ?> selected <?php endif; ?>>Cuba Peso</option>
                                    <option value="CZK" <?php if(get_option('currency', 'USD') == 'CZK'): ?> selected <?php endif; ?>>Czech Republic Koruna</option>
                                    <option value="DKK" <?php if(get_option('currency', 'USD') == 'DKK'): ?> selected <?php endif; ?>>Denmark Krone</option>
                                    <option value="DOP" <?php if(get_option('currency', 'USD') == 'DOP'): ?> selected <?php endif; ?>>Dominican Republic Peso</option>
                                    <option value="XCD" <?php if(get_option('currency', 'USD') == 'XCD'): ?> selected <?php endif; ?>>East Caribbean Dollar</option>
                                    <option value="EGP" <?php if(get_option('currency', 'USD') == 'EGP'): ?> selected <?php endif; ?>>Egypt Pound</option>
                                    <option value="GTQ" <?php if(get_option('currency', 'USD') == 'GTQ'): ?> selected <?php endif; ?>>Guatemala Quetzal</option>
                                    <option value="HKD" <?php if(get_option('currency', 'USD') == 'HKD'): ?> selected <?php endif; ?>>Hong Kong Dollar</option>
                                    <option value="HUF" <?php if(get_option('currency', 'USD') == 'HUF'): ?> selected <?php endif; ?>>Hungary Forint</option>
                                    <option value="IDR" <?php if(get_option('currency', 'USD') == 'IDR'): ?> selected <?php endif; ?>>Indonesia Rupiah</option>
                                    <option value="IRR" <?php if(get_option('currency', 'USD') == 'IRR'): ?> selected <?php endif; ?>>Iran Rial</option>
                                    <option value="ILS" <?php if(get_option('currency', 'USD') == 'ILS'): ?> selected <?php endif; ?>>Israel Shekel</option>
                                    <option value="LBP" <?php if(get_option('currency', 'USD') == 'LBP'): ?> selected <?php endif; ?>>Lebanon Pound</option>
                                    <option value="MYR" <?php if(get_option('currency', 'USD') == 'MYR'): ?> selected <?php endif; ?>>Malaysia Ringgit</option>
                                    <option value="NGN" <?php if(get_option('currency', 'USD') == 'NGN'): ?> selected <?php endif; ?>>Nigeria Naira</option>
                                    <option value="NOK" <?php if(get_option('currency', 'USD') == 'NOK'): ?> selected <?php endif; ?>>Norway Krone</option>
                                    <option value="OMR" <?php if(get_option('currency', 'USD') == 'OMR'): ?> selected <?php endif; ?>>Oman Rial</option>
                                    <option value="PKR" <?php if(get_option('currency', 'USD') == 'PKR'): ?> selected <?php endif; ?>>Pakistan Rupee</option>
                                    <option value="PHP" <?php if(get_option('currency', 'USD') == 'PHP'): ?> selected <?php endif; ?>>Philippines Peso</option>
                                    <option value="PLN" <?php if(get_option('currency', 'USD') == 'PLN'): ?> selected <?php endif; ?>>Poland Zloty</option>
                                    <option value="RON" <?php if(get_option('currency', 'USD') == 'RON'): ?> selected <?php endif; ?>>Romania Leu</option>
                                    <option value="ZAR" <?php if(get_option('currency', 'USD') == 'ZAR'): ?> selected <?php endif; ?>>South Africa Rand</option>
                                    <option value="LKR" <?php if(get_option('currency', 'USD') == 'LKR'): ?> selected <?php endif; ?>>Sri Lanka Rupee</option>
                                    <option value="SEK" <?php if(get_option('currency', 'USD') == 'SEK'): ?> selected <?php endif; ?>>Sweden Krona</option>
                                    <option value="CHF" <?php if(get_option('currency', 'USD') == 'CHF'): ?> selected <?php endif; ?>>Switzerland Franc</option>
                                    <option value="THB" <?php if(get_option('currency', 'USD') == 'THB'): ?> selected <?php endif; ?>>Thailand Baht</option>
                                    <option value="TRY" <?php if(get_option('currency', 'USD') == 'TRY'): ?> selected <?php endif; ?>>Turkey Lira</option>
                                    <option value="UAH" <?php if(get_option('currency', 'USD') == 'UAH'): ?> selected <?php endif; ?>>Ukraine Hryvnia</option>
                                    <option value="GBP" <?php if(get_option('currency', 'USD') == 'GBP'): ?> selected <?php endif; ?>>United Kingdom Pound</option>
                                    <option value="TWD" <?php if(get_option('currency', 'USD') == 'TWD'): ?> selected <?php endif; ?>>Taiwan New Dollar</option>
                                    <option value="VND" <?php if(get_option('currency', 'USD') == 'VND'): ?> selected <?php endif; ?>>Viet Nam Dong</option>
                                    <option value="UZS" <?php if(get_option('currency', 'USD') == 'UZS'): ?> selected <?php endif; ?>>Uzbekistan Som</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="gateway_paypal" value="0">
                                        <input type="checkbox" name="gateway_paypal" value="1" class="custom-switch-input" <?php if(!empty($_setting['gateway_paypal']) and $_setting['gateway_paypal']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">Paypal</label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="gateway_paystack" value="0">
                                        <input type="checkbox" name="gateway_paystack" value="1" class="custom-switch-input" <?php if(!empty($_setting['gateway_paystack']) and $_setting['gateway_paystack']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">Paystack</label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="gateway_paytm" value="0">
                                        <input type="checkbox" name="gateway_paytm" value="1" class="custom-switch-input" <?php if(!empty($_setting['gateway_paytm']) and $_setting['gateway_paytm']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">Paytm</label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="gateway_payu" value="0">
                                        <input type="checkbox" name="gateway_payu" value="1" class="custom-switch-input" <?php if(!empty($_setting['gateway_payu']) and $_setting['gateway_payu']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">Payu</label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="gateway_razorpay" value="0">
                                        <input type="checkbox" name="gateway_razorpay" value="1" class="custom-switch-input" <?php if(!empty($_setting['gateway_razorpay']) and $_setting['gateway_razorpay']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault">Razorpay</label>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="withdraw" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.open_courses_comm')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="site_income" value="<?php echo e($_setting['site_income'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.exclusive_courses_comm')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="site_income_private" value="<?php echo e($_setting['site_income_private'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.min_withdrawal_amount')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="site_withdraw_price" value="<?php echo get_option('site_withdraw_price',0); ?>" class="form-control text-center numtostr">
                                    <span class="input-group-append click-for-upload cu-p">
                              <span class="input-group-text"><?php echo currencySign(); ?></span>
                           </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="popup" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="site_popup" value="0">
                                        <input type="checkbox" name="site_popup" value="1" class="custom-switch-input" <?php if(!empty($_setting['site_popup']) and $_setting['site_popup']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.popup')); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.popup_image')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_popup_image" data-input="popup_image" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="popup_image" class="form-control" dir="ltr" type="text" name="popup_image" dir="ltr" value="<?php echo e($_setting['popup_image'] ?? ''); ?>" >
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="popup_image">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.popup_link')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" dir="ltr" name="popup_url" value="<?php echo e($_setting['popup_url'] ?? ''); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="videoAds" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="site_videoads" value="0">
                                        <input type="checkbox" name="site_videoads" value="1" class="custom-switch-input" <?php if(!empty($_setting['site_videoads']) and $_setting['site_videoads']==1): ?> checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.enable')); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Xml <?php echo e(trans('admin.video_file')); ?> Url</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" placeholder="https://" name="site_videoads_source" dir="ltr" value="<?php echo e($_setting['site_videoads_source'] ?? ''); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('admin.text'); ?></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="site_videoads_title" dir="ltr" value="<?php echo e($_setting['site_videoads_title'] ?? ''); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Roll Type</label>
                            <div class="col-md-6">
                                <select name="site_videoads_roll_type" class="form-control">
                                    <option value="preRoll" <?php if(get_option('site_videoads_roll_type','') == 'preRoll'): ?> selected <?php endif; ?>>PreRoll</option>
                                    <option value="midRoll" <?php if(get_option('site_videoads_roll_type','') == 'midRoll'): ?> selected <?php endif; ?>>MidRoll</option>
                                    <option value="postRoll" <?php if(get_option('site_videoads_roll_type','') == 'postRoll'): ?> selected <?php endif; ?>>PostRoll</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.minimum_time_to_skip')); ?></label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" class="spinner-input form-control text-center" name="site_videoads_time" value="<?php echo e($_setting['site_videoads_time'] ?? 0); ?>" maxlength="3">
                                    <span class="input-group-append"><label class="input-group-text">Seconds</label></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="mainSlide" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.hero_bg')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" id="lfm_main_page_slide" data-input="main_page_slide" data-preview="holder" class="btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="main_page_slide" class="form-control" dir="ltr" type="text" name="main_page_slide" dir="ltr" value="<?php echo e($_setting['main_page_slide'] ?? ''); ?>" placeholder="Displays as homepage header background (1920*500px)">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="main_page_slide">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" name="main_page_slide_title" value="<?php echo e($_setting['main_page_slide_title'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.description')); ?></label>
                            <div class="col-md-6">
                                <textarea rows="5" class="form-control text-center" name="main_page_slide_text"><?php echo e($_setting['main_page_slide_text'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.first_button')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" name="main_page_slide_btn_1_text" value="<?php echo e($_setting['main_page_slide_btn_1_text'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.second_button')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" name="main_page_slide_btn_2_text" value="<?php echo e($_setting['main_page_slide_btn_2_text'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.first_button_link')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" name="main_page_slide_btn_1_url" value="<?php echo e($_setting['main_page_slide_btn_1_url'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.secound_button_link')); ?></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center" name="main_page_slide_btn_2_url" value="<?php echo e($_setting['main_page_slide_btn_2_url'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm_site_logo,#lfm_site_logo_type,#lfm_video_watermark,#lfm_request_page_icon,#lfm_upload_page_background,#lfm_login_page_background,#lfm_factor_watermark,#lfm_popup_image,#lfm_main_page_slide').filemanager('image');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','General']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\proacademy\resources\views/admin/setting/main.blade.php ENDPATH**/ ?>