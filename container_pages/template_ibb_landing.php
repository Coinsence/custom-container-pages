<?php
/**
 * This file is a custom made php template for Impact Beyond Borders
 * this will be used in association with the humhub custom page module
 *
 * @author Mortadha Ghanmi <mortadha.ghanmi56@gmail.com>
 */

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;700;800&display=swap');
    :root {
        --ibb-primary: #F2DB9D;
        --ibb-primary-hover: #FAD97F;
        --ibb-secondary: #49B2AC;
        --ibb-secondary-hover: #49B2AC;
    }
    .landing * {
        font-family: 'Montserrat' !important;
    }
    .landing .panel {
        padding: 40px;
    }
    .landing a.primary,
    .landing a.secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        height: 60px;
        width: 200px;
        border-radius: 100px;
        color: white;
    }
    .landing a.primary {
        background-color: var(--ibb-primary);
    }
    .landing a.primary:hover {
        background-color: var(--ibb-primary-hover);
        box-shadow: 2px 2px 14px var(--ibb-primary-hover);
    }
    .landing a.secondary {
        background-color: var(--ibb-secondary);
    }
    .landing a.secondary:hover {
        background-color: var(--ibb-secondary-hover);
        box-shadow: 2px 2px 14px var(--ibb-secondary-hover);
    }
    .landing h1,
    .landing h2,
    .landing a.primary,
    .landing a.secondary {
        text-transform: uppercase;
    }
    .landing p {
        color: #1e1e1e;
    }
    .landing p a {
        color: #28aa69;
    }
    .landing p a:hover {
        color: #1e8150;
    }
    .landing .main-logo {
        margin-top: 16px;
        margin-bottom: 16px;
    }

    .landing .non-logged-in {
        max-width: 720px;
        margin: 0 auto;
        text-align: center;
    }
    .landing .non-logged-in h1 {
        font-size: 32px;
        font-weight: bold;
    }
    .landing .non-logged-in p {
        font-size: 14px;
        text-align: left;
        margin-top: 24px;
    }
    .landing .non-logged-in a.primary {
        margin: 0 auto;
    }
    .landing .non-logged-in .copyright {
        text-align: center;
    }
    .landing .non-logged-in .copyright strong {
        display: block;
        margin-bottom: 8px;
    }
    .landing .non-logged-in .copyright img {
        width: 180px;
    }

    .landing .logged-in .hero {
        max-width: 1092px;
        margin-right: auto;
    }
    .landing .logged-in h1 {
        font-size: 48px;
        font-weight: bold;
    }
    .landing .logged-in h1 span {
        font-size: 36px;
        font-weight: 200;
    }
    .landing .logged-in p {
        font-size: 17px;
    }
    .landing .logged-in a.primary {
        margin-top: 24px;
    }
    .landing .logged-in .sections {
        margin-top: 36px;
        display: flex;
    }
    .landing .logged-in .section {
        padding: 0 16px;
        text-align: center;
    }
    .landing .logged-in .section h2 {
        font-size: 36px;
        font-weight: 800;
    }
    .landing .logged-in .section a.secondary {
        display: inline-flex;
        margin-top: 16px;
    }

    @media screen and (max-width: 1024px) {
        .landing .non-logged-in h1 {
            font-size: 28px;
        }
        .landing .logged-in h1 {
            font-size: 36px;
        }
        .landing .logged-in h1 span {
            font-size: 28px;
        }
        .landing .logged-in a.primary {
            margin: 24px auto 0;
        }
        .landing .logged-in .section h2 {
            font-size: 28px;
        }
        .landing .logged-in .sections {
            flex-direction: column;
        }
        .landing .logged-in .section {
            margin-bottom: 36px;
        }
    }
</style>

<?php
$add_project_url = '/p/ibb-add-project';
$fund_project_url = '/p/ibb-fund-project';
$sell_product_url = '/p/ibb-sell-product';

$is_logged_in = !!Yii::$app->user->identity;
if (!$is_logged_in) {
    Yii::$app->user->returnUrl = '/p/ibb-login-redirect';
}
$space = $this->context->contentContainer;
$membership = $space->getMembership();

?>
<div class="landing">
    <div class="panel">
        <?php if (!$is_logged_in): ?>
            <div class="non-logged-in">
                <h1><?= Yii::t('container_pages', 'Welcome to our community') ?></h1>
                <img class="main-logo" src="https://welcome.beyondborders.network/wp-content/uploads/2021/12/logo-site_2.png" alt="Impact Beyond Borders Logo">
                <a class="primary" href="/user/auth/login" data-target="#globalModal"><?= Yii::t('container_pages', 'Join us') ?></a>
                <p><?= Yii::t(
                    'container_pages',
                    'As a collaboration and value exchange platform we are using Coinsence.org platform. By clicking the button above, you agree to Coinsence {0}Terms of services{1} and have read and acknowledge Coinsence {2}Privacy Policy{3}',
                    [
                        '<a href="/legal/page/view?pageKey=terms">',
                        '</a>',
                        '<a href="/legal/page/view?pageKey=privacy">',
                        '</a>'
                    ]) ?></p>
                <p class="copyright">
                    <strong><?= Yii::t('container_pages', 'Powered By:') ?> </strong>
                    <img src="https://welcome.beyondborders.network/wp-content/uploads/2021/10/2_Coinsence.png" alt="Coinsence Logo">
                    <img src="https://welcome.beyondborders.network/wp-content/uploads/2021/10/2_GIZ.png" alt="GIZ Logo">
                </p>
            </div>
        <?php else: ?>
            <div class="logged-in">
                <div class="hero">
                    <h1>
                        <?= Yii::t(
                            'container_pages',
                            '{0} We are {1} a global network of {2} Innovators & {3} social entrepreneurs.',
                            [
                                '<span>',
                                '<br>',
                                '</span><br>',
                                '<br>',
                            ]
                        ) ?>
                    </h1>
                    <p>
                        <?= Yii::t('container_pages', 'Initiated by Tunisian diaspora and local change-makers with the vision to build an open collaboration network that supports impact projects and enables value sharing across all borders.') ?>
                    </p>
                    <?php if (!$membership || !$membership->status): ?>
                        <a class="primary" href="/space/beyond-borders/space/membership/request-membership-form" data-target="#globalModal">Join in</a>
                    <?php endif; ?>
                </div>
                <div class="sections">
                    <div class="section">
                        <h2><?= Yii::t('container_pages', 'Create') ?></h2>
                        <p>
                            <?= Yii::t('container_pages', 'Add your project and receive funding in IBB COINs to reward your donors and supporters.') ?>
                        </p>
                        <a class="secondary" href="<?= $add_project_url ?>"><?= Yii::t('container_pages', 'Add your project') ?></a>
                    </div>
                    <div class="section">
                        <h2><?= Yii::t('container_pages', 'Fund') ?></h2>
                        <p>
                            <?= Yii::t('container_pages', 'Support your selected projects with some funding and get rewarded trough IBB COINs.') ?>
                        </p>
                        <a class="secondary" href="<?= $fund_project_url ?>"><?= Yii::t('container_pages', 'Check the projects') ?></a>
                    </div>
                    <div class="section">
                        <h2><?= Yii::t('container_pages', 'Support') ?></h2>
                        <p>
                            <?= Yii::t('container_pages', 'Offer your expertise, products, services or discounts and receive IBB COINs as compensation.') ?>
                        </p>
                        <a class="secondary" href="<?= $sell_product_url ?>"><?= Yii::t('container_pages', 'Check the marketplace') ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
