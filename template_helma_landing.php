<?php
/**
 * This file is a custom made php template for Helma Initiative
 * this will be used in association with the humhub custom page module
 *
 * @author Mortadha Ghanmi <mortadha.ghanmi56@gmail.com>
 */

use yii\helpers\Html;
use humhub\modules\xcoin\models\Challenge;
use humhub\modules\xcoin\models\Funding;
use humhub\modules\space\widgets\Image as SpaceImage;

// hardcoded variables
$newProjectchallengeId = 36;
$listProjectsChallengeId = 35;

// set up redirection
$is_logged_in = !!Yii::$app->user->identity;
if (!$is_logged_in) {
    Yii::$app->user->returnUrl = '/p/helma-login-redirect';
}

$space = $this->context->contentContainer;
$membership = $space->getMembership();
// $challenges = Challenge::findAll(['space_id' => $space]);
$challenges = Challenge::findAll(['space_id' => $space, 'id' => $listProjectsChallengeId]);
$fundings = [];
foreach ($challenges as $challenge) {
    $fundings = array_merge($fundings, $challenge->getFundings()->all());
}

$space_title = $space->name;
$space_cover = $space->getProfileBannerImage()->getUrl('_org');

?>

<style>

    /* Elements */
    .landing {
        --color-dark: #353535;
        --color-black: #1E1E1E;
        --color-white: white;
        --color-gray-1: #797979;
        --color-gray-2: #898989;
        --color-gray-9: #F1F1F1;
        --color-blue: #24b6ed;

        padding-bottom: 200px;
    }
    .landing .btn-h,
    .landing .btn.btn-default {
        display: inline-block;
        font-size: 14px;
        line-height: 2.5;
        font-weight: 700;
        padding: 6px 25px;
        margin-bottom: 8px;
        border-radius: 8px;
        background-color: var(--color-gray-9);
        color: var(--color-dark);
    }
    .landing .btn-h-o {
        display: inline-block;
        font-size: 12px;
        line-height: 1.36;
        font-weight: 600;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 4px;
        border: 1px solid var(--color-black);
        color: var(--color-dark);
    }
    .landing .btn-h-a {
        display: inline-block;
        font-size: 12px;
        line-height: 1.36;
        font-weight: 600;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 4px;
        border: 1px solid var(--color-black);
        color: var(--color-white);
        background: var(--color-blue);
    }
    .landing .btn-h-i {
        display: inline-block;
        margin-bottom: 8px;
    }
    .landing .btn-h-g {
        display: inline-block;
        font-size: 14px;
        line-height: 2.5;
        font-weight: 700;
        padding: 4px 25px;
        border-radius: 8px;
        border: 1px solid rgba(53, 53, 53, 0.5);
        background: linear-gradient(360deg, var(--color-gray-9) 0%, transparent 100%);
        color: var(--color-dark);
    }
    .landing .btn-h-d {
        display: inline-block;
        font-size: 14px;
        line-height: 1.8;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
        padding: 10px 30px;
        border-radius: 28px;
        border: 1px solid var(--color-white);
        color: var(--color-white);
    }
    .landing .panel-h {
        padding: 40px 74px;
        border-radius: 8px;
        background-color: var(--color-white);
        margin-top: 20px
    }
    .landing .panel-h .panel-info {
        display: flex;
        align-items: center;
    }
    .landing .panel-h .panel-info h3,
    .landing .panel-h .panel-info h4,
    .landing .panel-h .panel-info h6 {
        margin: 0;
    }
    .landing .panel-h .panel-info img,
    .landing .panel-h .panel-info .space-acronym,
    .landing .panel-h .panel-info h4 {
        margin-right: 28px;
    }
    .landing .panel-h .panel-info .space-acronym,
    .landing .panel-h .panel-info img {
        border-radius: 0 !important;
    }
    .landing .panel-h .panel-info h3 {
        font-size: 36px;
        line-height: 1.36;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--color-dark);
    }
    .landing .panel-h .panel-info h4 {
        font-size: 24px;
        line-height: 1.36;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--color-dark);
    }
    .landing .panel-h .panel-info h6 {
        font-size: 14px;
        line-height: 1.36;
        font-weight: 600;
        color: var(--color-gray-1);
    }
    .landing .panel-h .panel-links .custom-btn {
        margin-top: 12px;
        min-width: 354px;
        text-align: center;
    }
    .landing .panel-h .panel-h-body {
        margin-top: 34px;
    }
    .landing .panel-h .panel-h-body p {
        font-size: 18px;
        line-height: 1.94;
        font-weight: 400;
        color: var(--color-black);
    }
    .landing .card-wrapper {
        display: block;
        margin-bottom: 48px;
    }
    .landing .card .card-heading {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }
    .landing .card .card-heading > img {
        width: 100%;
        height: 340px;
        object-fit: cover;
    }
    .landing .card .card-heading .overlay {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(0deg, rgba(26, 26, 26, 0.5), rgba(26, 26, 26, 0.5));
        opacity: 0;
        transition: opacity 500ms;
    }
    .landing .card:hover .card-heading .overlay {
        opacity: 1;
    }
    .landing .card .card-heading .overlay .btn-h-d {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .landing .card .card-heading .overlay .social-share {
        position: absolute;
        left: 20px;
        top: 18px;
        display: block;
    }
    .landing .card .card-heading .overlay .social-share .btn-h-i-s {
        display: inline-flex;
        width: 36px;
        height: 36px;
        padding: 11px;
        border-radius: 50%;
        margin-right: 6px;
        background-color: var(--color-white);
    }
    .landing .card .card-body p,
    .landing .card .card-body h4,
    .landing .card .card-body h5 {
        margin: 0;
    }
    .landing .card .card-body h4 {
        font-size: 18px;
        line-height: 1.36;
        font-weight: 600;
        margin-top: 18px;
        color: var(--color-dark);
    }
    .landing .card .card-body p {
        font-size: 14px;
        line-height: 1.8;
        font-weight: 400;
        margin-top: 8px;
        color: var(--color-black);
    }
    .landing .card .card-body h5 {
        font-size: 12px;
        line-height: 1;
        font-weight: 600;
        text-transform: uppercase;
        margin-top: 7px;
        display: flex;
        align-items: center;
        color: var(--color-gray-2);
    }
    .landing .card .card-body h5::before {
        content: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAQCAYAAAAvf+5AAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAD4SURBVHgBfZHNEYIwEIWTHDhx0A5owQrUTrQC9QScMCcGLtKBlGAHpgU7oARPHBh+fMtknYjoziybZB/f7iZSWMuy7IhwgAfwSkppuq7TcRxXlJf0yfO8GIbhIL6t6vt+S2KVpunOEVGiQLzZfQDydSSi5B1xQ6K6rlda66dt5YJA7QicL5UVCVALFpF5nqd57fv+WvEGJZ7ij5HQWOLOTTRNc+R127YPScMopa48DLwEPeAfEU0URVuF0UsrGKeEn1061nsuLXAleq4viEq+8FE4obpC7Q7DdvpF+xCGYUivYeZoU+K71yntS4ikIeqUNmtJkizmzl/5UYhlh1nAjwAAAABJRU5ErkJggg==');
        margin-right: 10px;
    }
    .landing .owl-carousel .owl-prev,
    .landing .owl-carousel .owl-next {
        position: absolute;
        top: 150px;
    }
    .landing .owl-carousel .owl-prev {
        left: -20px;
    }
    .landing .owl-carousel .owl-next {
        right: -20px;
    }
    .landing .owl-carousel .owl-prev .fa,
    .landing .owl-carousel .owl-next .fa {
        background-color: #fff;
        height: 40px;
        width: 40px;
        line-height: 40px;
        border-radius: 50%;
        box-shadow: 0px 5.37143px 5.37143px rgba(0, 0, 0, 0.25);
    }
    .landing .owl-carousel .disabled .fa {
        background-color: #cbcbcb;
        cursor: not-allowed;
    }


    /* Hero section */
    .landing .hero {
        position: relative;
        padding: 216px 0 325px;
        background: url('<?= $space_cover ?>');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .landing .hero .container {
        position: relative;
    }
    .landing .hero h1 {
        font-size: 64px;
        line-height: 1.36;
        font-weight: 600;
        letter-spacing: -0.02em;
        text-align: center;
        margin: 0;
        color: var(--color-white);
    }


    /* content section */
    .landing .content {
        position: relative;
        margin-top: -160px;
    }
    .landing .content .right {
        float: right;
        text-align: right;
    }
    .landing .content .right .btn-h-i {
        margin-right: 14px;
    }

    /* media queries */
    @media screen and (max-width: 991px) {
        .landing .panel-h {
            padding: 22px 34px;
        }
        .landing .panel-h .panel-info {
            flex-direction: column;
            text-align: center;
        }
        .landing .panel-h .panel-info img,
        .landing .panel-h .panel-info h4 {
            margin-right: 0;
            margin-bottom: 8px;
        }
        .landing .panel-h .panel-links {
            margin-top: 16px;
        }
        .landing .hero {
            padding: 176px 0 285px;
        }
        .landing .hero h1 {
            font-size: 48px;
        }
        .landing .content {
            margin-top: -240px;
        }
        .landing .content .top,
        .landing .content .left,
        .landing .content .right {
            float: none;
            text-align: center;
        }
    }
    @media screen and (max-width: 768px) {
        .landing .btn-h-d {
            padding: 8px 22px;
        }
        .landing .hero h1 {
            font-size: 36px;
        }
        .landing .panel-h {
            padding: 14px;
        }
        .landing .panel-h .panel-info .title h3 {
            font-size: 24px;
        }
        .landing .panel-h .panel-h-body p {
            font-size: 16px;
        }
    }

</style>
<div class="landing">

    <div class="hero">
        <div class="container"></div>
    </div>
    <main class="content">
        <div class="container">
            <div class="row intro">
                <div class="col-md-12">
                    <div class="panel-h">
                        <div class="row h-header">
                            <div class="col-md-6 panel-info">
                                <?= SpaceImage::widget([
                                    'space' => $space,
                                    'width' => 90
                                ]); ?>
                                <div class="title">
                                    <h3><?= $space_title ?></h3>
                                    <h6>une initiative non-lucratif dediée aux jeunes</h6>
                                </div>
                            </div>
                            <div class="col-md-6 right panel-links">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn-h-i" href="https://www.facebook.com/AssociationTunisiePassion" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAC8SURBVHgB5ZLBDcMgDEVNlAFyhFPoJnSDjtBNmlHSSZpOUo4c0xNHaqRYWFUSAemtX0KAQZ9nYyGlfAGAhmM6Nz8wiepbKNOEwy5rjcPQQYmRcc49aYMluXKjJtNk5CZryiUaIZE8OEkpEZeBCiK7FRNCdCGELssI63LaimGKN5wGitekBkTE97tEy6tRdySxPIZpXbKNIKFPkOo1rF2sTu3PjCwcFP7g3MYGU0r1exe9929aY//o77MZ9QF0vjob/Nz0uAAAAABJRU5ErkJggg==" alt="fb" /></a>
                                        <a class="btn-h-i" href="https://www.instagram.com/tunisie.passion/" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAASCAYAAAC5DOVpAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAFjSURBVHgBnVTBcYMwEDzFftiv4J/9Ex0kHeAO3EHiDtxBcAWJOyAduIOQDpwKoh88lRfwALJnpInGKHjMzmgOHcdq706HIGC5XMYwLzQCQgjdtu0hz/NYgCiC72MEgYYNYAP2lWW5uKMRAMEGSsIsyxbYKvbN5/P7UWT/YUojwMpQHtE0TWBSPfsHa4agE4LfqEslpK5J0heLODkdOP1UVdVaA8b1iYNTc7D0fePWTGEl3Clz0s4hOgNFV0ZpL/6SLEXw1pGtyK/4y5JxPF8RH5kN1saG5Id041z4rkZibG8iUDNp/VB+vHzfa8BsNjvgNj/jMcLHXOx9Xdd6Mpk80F83OcX3q2RKKQ2SNXVdi3iByA1JsbbkgfdqcNeklI9QuMH2yaTF83j0KeqR2YF1FVJXv4QG4E7AFClo1ISdPCLfdCOsiKIofgQ/rFarVzh3NB4x0t8LuwsA/o3QjWBFdlJ+AT90tYq8t1trAAAAAElFTkSuQmCC" alt="ig" /></a>
                                        <a class="btn-h-i" href="https://www.linkedin.com/company/association-tunisie-passion/about/" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADjSURBVHgBtZTfDYJADMZ7h4TwJL7Bk7gJTqBuwCpu4AiOoBPgJtYneBMXAL/GIzFwJvzzl5A2Lfnu2t6dIhCG4R0mppFUVXXQEEmmiAha652mmfglxDRVqK7rS1EUG7hbGkBHSCkVfNu+LCyxJIqiJ3ZmE2JZwJaz9eiW5/mKPqUxylSwUmoqJUsOYqc+Qh0gwDAPc1TI87zjKCFDJl8AmLmk1mR7CWEnceP7vr+0/fP3AzkY2/hjlJLCrmXM4puRN/k9Yq9WjJSZREbTOM/XI8dxSpoB7bou04jb3oBelXjYrm+cJUYGJtCvAwAAAABJRU5ErkJggg==" alt="in" /></i></a>
                                        <a class="btn-h-i" href="https://www.youtube.com/channel/UCewU05F5o59E6YuALW5TFsw" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAQCAYAAAD9L+QYAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAEGSURBVHgBtZRNDoIwEIWnlQUbEpYs8QTiDXTnLYwnkBuoR+AE4km8AjewS5a4Y4fvKSQuDHQS/JJJZ9oyLZ0fIyAGYRjmXdetYKbGmJjzHDH31n+B9QbrTW866piroN/qunYmSZIUxp1OZT5c27brRRRFJxg7mZc4CILW4lcy+QP0a4f3HaN/RxX4JrNjAfu6RY7hAHGiwIpnIBH9ErKEevY8JLWiBAdcMGwh5dRetXOCNGM+P6f2BaJgKDY4PvrEikX0kOl333Av5Cr+xeZ8b16KsoLZCqxnDqeihH2Hea4uEB/o1yJAhSiLwwOHmxcMkvSdcc+S7bOAtqrlUpdP262QqkUDXlJUbuGinnmQAAAAAElFTkSuQmCC" alt="yt" /></a>
                                        <a class="btn-h-o" href="http://tunisiepassion.org" target="_blank">www.tunisiepassion.org</a>
                                    </div>
                                    <div class="col-md-12">
                                        <?php if (!$is_logged_in): ?>
                                            <a class="custom-btn btn-h-o" href="/user/auth/login" data-target="#globalModal">Join us</a>
                                        <?php else: ?>
                                            <?php if (!$membership || !$membership->status): ?>
                                                <a class="custom-btn btn-h-a" href="<?= $space->createUrl('/space/membership/request-membership-form') ?>" data-target="#globalModal">Join in</a>
                                            <?php else: ?>
                                                <a class="custom-btn btn-h-a" href="<?= $space->createUrl('/space/membership/invite') ?>" data-target="#globalModal">Invite</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-h-body">
                            <p>
                                HELMA est une initiative d'aide,  d'orientation et de soutien, et lorsque cela est nécessaire d'aide financière pour les jeunes Tunisiens
                                dans des domaines portant des valeurs communes à notre association.  Helma se reposera, sur une plateforme qui réunit à la fois les compétences
                                tunisiennes à l'etranger ainsi que celles en Tunisie. Helma est une initiative née d'une association apolitique respectant la liberté de
                                croyance. Le projet vise à rassembler la capacité d'agir et de mise en contact de toutes les  compétences tunisiennes à l'étranger ou en
                                Tunisie, ainsi que la mise en œuvre des actions de parrainage et de promotion en faveur de jeunes en Tunisie, notamment ceux en situation
                                difficile ou dont le réseau relationel ne leur donne pas accès à l'information ou aux personnes utiles afin de réaliser leur passion et/ou
                                leur rêve.  Notons que le projet, appuyé par  plusieurs  partenaires, tend également à aider les jeunes tunisiens dans leurs parcours
                                scolaires, universitaires ainsi qu'en termes d'employabilité, loin des tiraillements politiques. Le rêve Tunisien est possible , il suffit
                                de le vouloir dans un univers d'entraide et de solidarité.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-h">
                        <div class="panel-info">
                            <h4>Projets <?= $space_title ?></h4>
                        </div>
                        <div class="panel-h-body">
                            <div class="row">
                                
                                <?php if (count($fundings) == 0): ?>
                                    <div class="col-md-12">
                                        <p class="alert alert-warning col-md-12">
                                            <?= 'Il n\'y a actuellement aucune soumission reçue..' ?>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?php foreach ($fundings as $funding): ?>
                                                <?php if (
                                                    $funding->getRemainingDays() <= 0 ||
                                                    $funding->review_status == Funding::FUNDING_NOT_REVIEWED
                                                ) {
                                                    continue;
                                                } ?>
                                                <?php
                                                $space = $funding->getSpace()->one();
                                                $cover = $funding->getCover();
                                                $fundingUrl = $space->createUrl('/xcoin/funding/overview', ['fundingId' => $funding->id], true);
                                                ?>
                                                <a href="<?= $space->createUrl('/xcoin/funding/details', ['fundingId' => $funding->id]) ?>" data-target="#globalModal" class="card-wrapper col-md-6 col-lg-3">
                                                    
                                                    <div class="card">
                                                        <div class="card-heading">
                                                            <?php if ($cover) : ?>
                                                                <div class="bg"
                                                                    style="background-image: url('<?= $cover->getUrl() ?>')"></div>
                                                                <?= Html::img($cover->getUrl()) ?>
                                                            <?php else : ?>
                                                                <div class="bg"
                                                                    style="background-image: url('<?= Yii::$app->getModule('xcoin')->getAssetsUrl() . '/images/default-funding-cover.png' ?>')"></div>
                                                                <?= Html::img(Yii::$app->getModule('xcoin')->getAssetsUrl() . '/images/default-funding-cover.png') ?>
                                                            <?php endif ?>
                                                            <div class="overlay">
                                                                <span class="btn-h-d">découvrir</span>
                                                                <div class="social-share">
                                                                    <span class="btn-h-i-s" data-sharer="fb" data-link="<?= $fundingUrl ?>"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAANCAYAAACZ3F9/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAACuSURBVHgBtZKxDQMhDEVxdIiWbHAbJAX0lxGySUbIRjdCkoaGhg2SbEBDhYRiS2cpKeBy0p0lhI39ZH9hMMaMAHAU/1vMOZ+6CeoXgEJKedjN1LzwDNhhj8U9+oETTbCUcvXeP7TW5AONybmuBSql7nSnlEbq/J2bG7VqNfBCmpxzbwpQ43nS2B4V9USGyEIIBERrreY3wOApKt/BXbHmJn41Dqtr3BaMSyFc0/gBNpo32+BuSmQAAAAASUVORK5CYII=" alt="fb" /></span>
                                                                    <span class="btn-h-i-s" data-sharer="tw" data-link="<?= $fundingUrl ?>"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAANCAYAAABPeYUaAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAFGSURBVHgBlZI/ToRAFMZnYElMaCgNFaWdGAih073BegLDCfQG4g30BOoN9ASyHQkEsbPb6WgpqPjr9zZIcAPu7pc8ZoY37zdv5j3OINd1jTAMBZuR4zh+13W3mGoYg8Vi4dV1bZAvjuOA27Z9JUnSM2w5BeoB9xNswTn3y7J8l7CB6Ebbth8IuNndOQMgUYyRpmnOTdPUFEXZUKrkAV1goNO/ZFnOm6bZTBHgf8NVrmkuado29mXkNGC0/pwD9Ep/J1JRFCbGO3akcJAYIPS6GAN2pJDleoDQp6oqutsrLD8EQGXGg4o/kF6XrH/cfUKPeOP1FkJlQjZLTMU+ALLwx1kMkB4kVFW9oNL9B8AbPuz+55ZlrdAb5zAD6xWbuBKCc+rOKIqepuBylmXfuq5r2HSG9QnstPcJBKfoykdUwkuSZM1m9ANS1awKjDcpaAAAAABJRU5ErkJggg==" alt="tw" /></span>
                                                                    <span class="btn-h-i-s" data-sharer="in" data-link="<?= $fundingUrl ?>"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAOCAYAAAD0f5bSAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAC9SURBVHgBnZJNCsIwEIXzY4vudFfowniIdluP4BH0JvUE4gk8gzeI6/YOxiO4Tkh8gQgWAjZ5EObNMB8Dj9C2bZ/OOUFmilKqWArg5fcZydAE0lrvcL5Pgsqy7HB+8w9a/DbWWoGyxTUJWKIKzCRjbI/5MXppHMczlu4e8B6ja1EUj2EYTvAqCkV0M8ZcgpdzoXV4E2VFzuu67r9NVVUvznkHK+BXCOCAMJbw7xCG8Hu0aRpHEpX9IxRJk/oAutk+UahQ1wgAAAAASUVORK5CYII=" alt="in" /></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <h4><?= $funding->title ?></h4>
                                                            <p><?= $funding->shortenDescription() ?></p>
                                                            <h5><?= $funding->city ?></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
<script>

    $('.landing').appendTo('#layout-content');
    $('.space-layout-container').hide();
    // $('body').css('padding-top', '87px');
    $('.social-share .btn-h-i-s').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let sharer = $(this).data('sharer');
        let link = $(this).data('link');
        console.log();
        switch (sharer) {
            case 'fb':
                window.open("https://www.facebook.com/sharer.php?u="+link,"","height=368,width=600,left=100,top=100,menubar=0");
                break;
            case 'tw':
                window.open("https://twitter.com/share?url="+link+"&text=Come%20join","","height=260,width=500,left=100,top=100,menubar=0");
                break;
            case 'in':
                window.open("https://www.linkedin.com/sharing/share-offsite/?url="+link,"","height=260,width=500,left=100,top=100,menubar=0");
                break;
        
            default:
                break;
        }
    });

</script>
