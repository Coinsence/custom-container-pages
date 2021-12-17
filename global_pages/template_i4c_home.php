<?php
/**
 * This file is a custom made php template for I4C platform
 * this will be used in association with the humhub custom page module
 *
 * @author Mortadha Ghanmi <mortadha.ghanmi56@gmail.com>
 */

use humhub\modules\space\models\Space;
use yii\helpers\Url;
use humhub\modules\space\widgets\Image as SpaceImage;

?>

<style>
    .landing {
        margin-top: -16px;
    }
    h2 {
        font-weight: bold;
        font-size: 24px;
        line-height: 33px;
        letter-spacing: -0.02em;
        margin: 23px 0;
    }
    h4 {
        font-weight: bold;
        font-size: 14px;
        line-height: 19px;
        letter-spacing: -0.02em;
    }
    p {
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        letter-spacing: -0.02em;
    }
    h4, p { margin: 0 }
    h2, h4, p { color: #242424 }
    .cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 32px;
    }
    .card {
        position: relative;
        display: flex;
        align-items: center;
        padding: 28px;
        border: 1px solid #E7E7E7;
        border-radius: 4px;
        background: #FFFFFF;
        transition: transform 0.3s ease-in-out;
    }
    .card::after {
        content: '';
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        box-shadow: 0 0 40px #c5c5c5;
        -webkit-box-shadow: 0 0 40px #c5c5c5;
        -moz-box-shadow: 0 0 40px #c5c5c5;
        border-radius: 4px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .card:hover {
        transform: translate(0, -5px);
    }
    .card:hover::after {
        opacity: 1;
    }
    .card img,
    .card .img { margin-right: 13px }

    @media screen and (max-width: 980px) {
        .cards { grid-template-columns: 1fr }
        .card { padding: 20px }
    }
</style>

<?php

$user = Yii::$app->user->getIdentity();

if (!$user) {
    $link_profile = $link_account = $link_campaigns = $link_marketplace = $link_search = $link_network = '#';
} else {
    $link_profile = $user->createUrl('/user/profile/home');
    $link_account = $user->createUrl('/xcoin/overview');
    $link_campaigns = Url::to('/xcoin/funding-overview');
    $link_marketplace = Url::to('/marketplace');
    $link_search = Url::to('/search');
    $link_network = Url::to('/xcoin/network');
}

$link_people = Url::to('/directory/members');
$link_spaces = Url::to('/directory/spaces');
$link_stream = Url::to('/dashboard');

$active_spaces_names = ['Impact Beyond Borders', 'Helma'];
$active_spaces = Space::findAll(['name' => $active_spaces_names]);

?>

<div class="landing">
    <div class="container">
        <?php if (!empty($active_spaces)): ?>
        <h2><?= Yii::t('global_pages', 'Active spaces') ?></h2>
        <div class="cards">
            <?php foreach ($active_spaces as $space): ?>
                <a class="card" href="<?= $space->getUrl() ?>">
                    <div class="img">
                        <?= SpaceImage::widget([
                            'space' => $space,
                            'width' => 48
                        ]); ?>
                    </div>
                    <div class="text">
                        <h4><?= $space->name ?></h4>
                        <p><?= $space->description ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <h2><?= Yii::t('global_pages', 'Shortcuts') ?></h2>
        <div class="cards">
            <a class="card" href="<?= $link_profile ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Profile') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Profile') ?></h4>
                    <p><?= Yii::t('global_pages', 'Check and update your personal profile.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_account ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Accounts') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Accounts') ?></h4>
                    <p><?= Yii::t('global_pages', 'See all your accounts, balances and transactions.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_people ?>">
                <img alt="<?= Yii::t('global_pages', 'People') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAiCAYAAADVhWD8AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAANfSURBVHgB7ZhNTxNRFIbPvTPUGjWUpYph+guk7sAY250LFOpGjQvKThsTWk3clu5VyoKPHbAyMTEFoom76gLYUfkFDoJxJ60JAm1njudOW+y0d6Yfbrrom0zmdu7XM/eeec9MGXSoZ9v7QQSWQBOGgYGPAXw1GaQWRwZXoUMx6EDRzf0ZYCwhrURYWbg5OAUdiEObim4eRBxBhBhEops/EtCB2oZhHCabt8IYdKCGbVrOzvouAE4ioI+q9QeB57YYiG4dILQysJdr8zeu7FV//94Ym2AMrotyqaSuDoTXdFeYt9nXEQ5stgxy1kSnQA09CsT1dmAQlODi6OUvh+kJTeVmGhkO2+oRk/3jH2Zqr/F/ILMakS3bQaxudB2Xa+GgBZ07PdkVZ0UxEvUg1igUd4fpsaAUhoPpEgsYfL/zaqg8CqxAM9ETlQr5c7Qq4sYiTs0UhY1LYWjtNXCRAdyqXxi5mhSe4tJUNwvFZKXsA3f5pDAc0G0COGJst1qeHx0MEFCqoRGtiOe0GFgK+fXKlRwtZc5l2JwUpg8U8dToDp1SU4G4rSMBxWniAVSVoDhEWZid2J5qG3picvQEpWQDIoJuGMU5KUyYJkMohCRAqYeBF3HZgAVPn8aKhl8cJVUdjmW/NWzLpbsbYstS9SCmaYQHwp/02uvSdPBu581tcT5i+d2pQNK2ImLCwh+VTI1Ni5zU0JkC3IRicmnEb5voMH1HU5W+oZKh5GnFpCEhdWCDne6Jox7kyfZPrXDsyVrpgDkEJ0KEY1/m6db3CXuFN6cayp63Lk7s91GRcF4vmDEyvekar9Fpi/xVEI5mRvgOtCjTwNDSrWufRTm/fi/Lqn6D5FWIawYqc7VObK2MMLzzgFkiS9SaHv1eOWvYJojVh7N0LFOOI85r/InROBxiCjczwqFtMOSw0olKYKyLs5Wp2wQpTwq+gsczbY1V4uuN9aiVgYJlYJGPnCZ6HHhZDrQ6p2wPCCPiVN4OiecQkKpetIA5A+aUBvSzkoFB6FxadavopqXBi8giFozIO9BMrKmtu6rYf66/SROtAtMdOv54f6hrYIR6ME7qwTipB+OkHoyTugpGpXeWGVkFOiS1/xF9uNG7sCnNcyeFX/mW/hJp9ZPWEaLuu9tJXbVNfwHqpUjDNhNXiQAAAABJRU5ErkJggg==">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'People') ?></h4>
                    <p><?= Yii::t('global_pages', 'Find other members within the network.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_spaces ?>">
                <img alt="<?= Yii::t('global_pages', 'Spaces') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Spaces') ?></h4>
                    <p><?= Yii::t('global_pages', 'Find projects, organizations and communities.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_marketplace ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Marketplace') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAlCAYAAAAA7LqSAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQVSURBVHgB7ZhLbBtFGMf/s49kdx0ntmM7pEkaU2jTJjycFgl6wDRKFdKHkLggxA0p94YDuSHSCxLi0iKVA4XUiANwgFaiFCSImoBU8VAqAy3QRALThBTahKRp4uc+2DG15fUsaRycdkH+SSN7//529vt/s54ZDcFNzr4Y9kDGMIFxKK957u5D6+4hFPP55Ef4YuqMRXt06wFEtu23aN9+OIjrV2IWzbMpjAcOHrFopyfewbnJzyzaQO8QtgQ7CteXL57B+U9eKg6JwzCGB16dfCsvcDkTL4cHiWL8cisTi4l5xgTlwbZHsF46W3cy2vtfjiCVTRSuN3ftR+SZ1+NibV1eCoGQ6BuHtp04MRjyUIGPv917UqkVB92KJLldEmjzbupEe98rEGtFCDUCeEGAIAr4dOpdqFwaiksptK0tXdjZHgEn8JaWuDwKLvsnZLMP2kRTq3U3o2l7PwhHCs1XH8DF2QmoRiaXoa7rORMCL5qjsr1gRnYHPE2hh/HbpVHoWuamSsIGhKcP7vaNC74GJVxaEbE1DKlBYSoVbAmgxlei1bWhIdjAxO64twmat9mi8Y0tUJp9TGwk8hiuLc9YtEBdPRrb/BaNXjeu7EXqj++K5ZCuGycFlEFGSzOaq6beNtbIrmAjEAUOnMSmzWGDMFTWCCcHbWOzNgUqF2okhDvMvx9pI247IkSxr1wis8RoIl+L24ndSFPKerXskuYIvwgHQI2MlYoT1wUmuZWstjiT8DGxo9PC4YSqMbHXklq8NPZnzR+z63c26R8r1S/MJaOl2lwygznNFS/VDQNj/NBTW8Y5jqdTcChJJJwW9uFUZpcEA+jwuQodHD0/LU0t+UNJTYZAVNxQ3fjxRhemE97+b64soc0tYz6ZRezqEl6LTUsx7PDcr/9gbhZSuT6+5nfheLr3ruJ+aQHe++l36aurdUy/U8ut4XnzuZvdEhSRz+VwLDaDc+l2S7+mjTFdX36OFDsb+Pj7PQbHnc1fK+ZUJ5sL2Xwqi/XiNRbMR8qgRcrjl8xF0kyOJppQ9Vv2QfMojjNrMXxMfSFKv8sHPviVfq66jtCb1/Kg1VggXkabo4Upozh2OeQN5NmwdeR2UzXiNKpGnMb/xkhZ2/jVeOKeAPa2N+bm/LVwaWEFIxdmc4toJajIiFATtK3VBKXD68LzD4VQKSpipDtYj/Xgl0Vza1OZ3XNFjJQzEuy9PCpBddZyGlUjTqNqxGlUjTgNixEVQhz/UawjIqUWQeCIc6rV4Dgwx0oWI9GebtMEicHBmCcocXU5M16qM/8RTUs/6+RRIQY5En2ym8mPMRLd120eCBs91DkcBj3PerO/86jdb7az1vG++2K6nukxjyKj5s139FUz/n47TumE7Bl5vOvwP8X9BUolZYICDVNnAAAAAElFTkSuQmCC">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Marketplace') ?></h4>
                    <p><?= Yii::t('global_pages', 'Find products, services and ressources.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_stream ?>">
                <img alt="<?= Yii::t('global_pages', 'Activity Stream') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACUAAAAgCAYAAACVU7GwAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHDSURBVHgB7Zc/TgJBFMa/MTYg/xoSTTTxCNLRCS0GtTDRjr0BGg7AegBkbyCdmtio2AqlVngDCxsLEpAoNITnGwSJhjgrMy4U/JJhH5vZ2W/f2327n4ALzmoFewEiS6AIJkRANPn40kEsd6Seq+C8duIAlIUh+IT2fix3/NucBSgXoQwM0gMOVXOUogiYuGTjEC7Wc5EpNGEQcrGeUhTjwCB8kSUXc9Rc1ApF3lg6pRxk3FHd5HMmgogSPCo8GuQ9FR6Zn4Jsmg1sqUdwYPH2VP65fW6h8vKGTpfgFb5FgXh0CXvr4eGupBRV4SBx+dRkQe+YFlurQaTWQjKsyj6VkNF9vY1pcjdKyMZX8/SyZOPodHvDMOKmo3vOXJRbpKj+W1s+mtPEtzjKj4weZZBcDmCaxKP+YViVfSrBgexVkL3qod5Be/Qk/Dt+zlByJYAU96kBVv+XheVpNsh/U8w7LPp8MXpNY3DeTcz5I676wOvVti0E2PuRhrMRTfSoFNq90TejLMgRwqAZFWQH02VNMypg1IwSCX0zqleyseib0f69YBZ9M8rlM2pGqWfIjLau00X+BLSEhhnt23UiJ7xTVprRD/Gnjp3Lum/jAAAAAElFTkSuQmCC">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Activity Stream') ?></h4>
                    <p><?= Yii::t('global_pages', 'See what the members are posting.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_search ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Search') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Search') ?></h4>
                    <p><?= Yii::t('global_pages', 'Search for people, spaces or content using keywords.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_network ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Network') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Network') ?></h4>
                    <p><?= Yii::t('global_pages', 'Search for people, spaces or content using keywords.') ?></p>
                </div>
            </a>
        </div>
    </div>
</div>
