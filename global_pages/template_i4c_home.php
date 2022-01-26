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
    $link_profile = $link_account = $link_marketplace = $link_search = $link_people = '#';
} else {
    $link_profile = $user->createUrl('/user/profile/home');
    $link_account = $user->createUrl('/xcoin/overview');
    $link_people = Url::to('/xcoin/network');
    $link_marketplace = Url::to('/marketplace');
    $link_search = Url::to('/search');
}

$link_stream = Url::to('/dashboard');
$link_course = 'http://course.menatabadol.org/';
$link_souk = 'https://knowledgesouk.org/';

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
                <img alt="<?= Yii::t('global_pages', 'People') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAiCAYAAADVhWD8AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAMgSURBVHgB7Zgxb9NAGIbfs0OJkKDpP3AGJDbSX0A6Vl0SJECwNJ1QxdAWJiSgVxXBgIBmqjo1XUCoUuOFdkz/QTsyEf+EsKWSfcd3jpPayV0aGyF1yCs5dnLnu8ff+/k7OwwZVeEnZQa5SYcl2gqAPJdA3eVLDWQUQwY95CebEpLrB5SNI760ggyykVIV/rNGux1zD1a6V37Gfp1+O0VKWUgpBrY8QZ81ZNCITZLzAoLbNUjKAwaPbb9qxNur/FhiAkmwossXvf73H+29CoRQ+QVhofG0uOqNhZHvvixDhBYUYj082BcLjL/2UsIsEMzp9/auY/vMZRbuJzpYjD8qPt9K/DQ4mX90CKSRAOmN6sDP78d+8TCRuufqMxeAj4AoCckP27tlLQz8mZpxXMiy5F+dHps8wBWinGm4vNpptvfJanOOyYBV9DBgDsbJ98N2qiNc1ZQxPT0BhOHvolsYN6RlY1YPw8ZOQPHODdqbfGmeIlQf7qIiInEx30/cPPId2nVMQ4oAf/QwttWgkHqG8+qMbyQGpQit08RzKlF728XcEV9cUfb0+1SLKx0hRqGV6C7wAlvuaGHCyWwsaIDq7P3LdWg149D1RVu+VOHNEVue3F3lTKI+DAIrqA7f3trlQL75VA4PyJrhiKgJLeTXyCYFODK5skrlTLzGKKlbPOfDkTnReVx8oU0JfQXO+Z7aRkFOHIabZ9G6pE1OaqvR+tSq8OPEndKl/PFzZA0sYw4NItOrvLNrkLErJsvY9kbxEkS26NDBhOoXPnV8+HvvjMYuRZN6ZJXrW7Iet8rqgVDBC+6ozhzxK5bi4JI6HUh0TnOQRzI4uIQMx1m/IVhL2ZeAQXCzFVbaYQnLVbtopXaQXgQyEya/bzF3uFFBKaB9VRwVjHz7uaYFIbEPG2GiUVgryKj+Kh/Z0dEB3RLdENiCNJRrFl+D2ANkl9O3ihkKoB0BK5vKuFoF/JPyY8+Pcij9w9X/kkrkawOjNIUxaQpj0hTGpCmMSdcKJkcrw5a2RZif6rNKQtQFmHadUk+CE/0lMukrrRki+d5t0rWy6S8wvDfiSTuWWgAAAABJRU5ErkJggg==">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'People') ?></h4>
                    <p><?= Yii::t('global_pages', 'Find other members within the network.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_marketplace ?>" <?= !$user ? 'data-action-click="ui.modal.load" data-action-url="/user/auth/login"' : '' ?>>
                <img alt="<?= Yii::t('global_pages', 'Marketplace') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAlCAYAAAAA7LqSAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAP6SURBVHgB7ZldaBxVGIbfMz/ZcdbuTpJm2ZZIp7RJakxoepOW1mJSQdJaobUXKXihguBNwIoQDIJO9cJaEBS8EYREhIDeZHplsWCzUINtbdnGUqINdEgVY2rrbNxkd7vpjudss8vMzjTNz6adln3gsDvvfvPt954zc85whmCeoY4DCsdxH1iwjhS0yLM70fjGa7Bz/OxJHP/5pEPr3d6F3h1dDu3XY58iMfabQwtvaULru+84tPdiQ/gyHnNoJw71YFf95uLx1JkR/P7VgD3EoHUePfijXhS5/InPH3qLcOTa/UxMTN9ymWAcbm7Hctm3qdWl9ZwaRCKTgr2Wre/3GYIsFySVgPTre17uZwPABP76m31DIVk+sjasSLSBtejTTWjo7YEoieBF3hREQRKqBLxyXscEfwdQ1hTb7oZm9LTsAi/wjpa+GIeQnIUckPJNFARU1dUgsnsnaKcV2walFoPGJUxb2bsl5nKYpiYkXnSMSqC6WqlufQb/nP0FuWy2ILcRQg53b9gSE+rr6tpcXbKtGQgV3SuFL8mm9UC95AjlQ1GEImFXiq2NjYAoO8WN9cC6Glfspr2duD496dDOhWpR+9Rah8aO1720H9nxa3ZZteidIWAJmHO3XZoaeNI7OJ3BaiDS0RYDzs4Emb9HVgUvI0rIM9S8cxsrhRlR8ZBZ8UhbMLxHpNq754xM0qUpfBUeKPe4ZJd0aSmCu+gAx5vwAdQIGS4VRyaSruJmUnNm8E/eFXv1p5tHZzNzrthJM22Uxo6lyCWvvMqkMFyqj47fHCjVbpgpTGaIARdWjNf2dMWQA5uC1VnC4RuuDgMJOi3QmaBFrS0m+GjwvBQcJ2owzSMrWAj/J2DblTDkP7iuM5f/ghoNYYrGnRv7G598d1EayclKu5VEkCZnnObC+PjfYNSedzY9h/4frkjmhZQr7/qrgbYbiVQ+b5CuZ6yGY99ewKkEceSlDEPg3iZ2Xwe07zsIrNOFY5YgKAn5ApdLhC50M4THjO0qjihPzOdNYyadvW8OVoc9jj2eDGF0gH0nWp/BPhdcR9jJi/mjhZgioltbYsd41VAwUGD11pEHTMWI36gY8RuPjZElPcYvRPdzDdi/Q82vD4vhsnELX5wYXdEaZacsI9Ld0UDb5kWbYLSoNfjw1e0oF2Ux0t4UwXJgK/zG6BqUg7IYYY8Qy0Vewbl2KrOW36gY8RsVI36jYsRvlBox8IhSYiTNtoF8sU+1MCReqjiM6NpBZiIOf2MAmeFS0XWPWCCvw8ejQl8hfD7f4Q5cRnRtL32tJXTCh/cL28/StX2fef3mOWvp2gtxOjKd1P3X9PSHfamZdBdRZ/Xo2ovavYL+BxwfSgGxIlChAAAAAElFTkSuQmCC">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Marketplace') ?></h4>
                    <p><?= Yii::t('global_pages', 'Find products, services and ressources.') ?></p>
                </div>
            </a>
            <a class="card" href="<?= $link_stream ?>">
                <img alt="<?= Yii::t('global_pages', 'Activity Stream') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACUAAAAgCAYAAACVU7GwAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGcSURBVHgB7ZexUsJAEIb/YCElj+FQKRVgE+3UxqG0IYwPoHZ2OZ8AfAHBxtKxEcqkEiuxYnwLKLVx3bvIoA7DRnKTpOCbucyS+bn7k+xtsg7iMOz6IDqHgxJWhTAFnB7qrQtJ6kgCPHfbxpAtPukKu6dqmaQAeRIPNik4Z6JEEiR6ZIsR55NNmVywijhfjDtF17AJ4VaSyImuebrp8LGZePfpC6wtT/I1K0FELo+Ax4TSJ+Dh/TXkUz7wtR+HIodd4y4YclKPgPcPpEZxE6iUgQN3dmZPmwo4cDEII0NZsV9lOzUdhQVjSPMyRqbMb8j2vHim+cgWMV+/JFf0DFibios2Fb219dbMkh/ra1OvJqpXkCk75VkU6jrlchCYn/0QGI3TL561SlSnIlrmyMYU5QP1yzCf8Ch6MabN5HtdF2v+SazP4YYa+ATT+yXpbKa8WO9eHYrN6IYkaKh+m4BLDotIhv5/dcs9cd7Cu3CZUKzobMiDRRzYaEaRx2YUOWxGOcGtNqM8n51m9Fg9djgXmki4+/QFPqgjJQm/AMmHgTn36AliAAAAAElFTkSuQmCC">
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
            <a class="card" href="<?= $link_course ?>" target="_blank">
                <img alt="<?= Yii::t('global_pages', 'Sharing Economy Crash Course') ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD4AAAAnCAYAAABXGPsXAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAUfSURBVHgB3ZpPUBtVHMe/mz/8DxOgWDrTknWk2opOw/SgBx1Se3DqTKfBg/XgTIMevDgDN70oy8kjZfRcyMnBgySHTkcPNownuRCc0mpB3UCrUJKQthDakGR9vxc2k4YNdbO7dNLPzA77su9t3vf35+3vbRCwD35p2g3U+VFzCCl2REPSOblij0oX3peujShQJNQwAgTpB+ncqPY1DfzS1QAbNHH+TREf9B9Hc4MDtcS91DauR+9iamYRCjAQkt4LlfexaQ1k1hg6c+ooBt89WXOiiRfcjbjo60Gv2M61aPWxaQ8VvC92uVDrvObpoD+i1rU9wgsLGpinnXie0YjjBiZcgVWkshkE44sIJZd5e6jrVfjbPThoDiyB5cebCK4vIppOwtvUzg+3ow6RB2sYX72JQGcP+luPQKxvwUFgufDIg38xeifKRZJYQmJtFRLqa+3ihpn88xfeHjnaZ7kBLBFO4Ty+uoDQxjJ8ri4Wyt08tEsFq3DB60v8nLxOxhm9M8c/p/alzuOwAlOFR9MJBO8tQc5scsF0TMaXuCH+D6oByNskeiO3gzM3r1mSBqYIjyRuYTzxD9z2Oj65VDqD4dgsqoW8TdFhZRpULVwNZ/LSSON9eFtOs3xeLXrNDMrTgIxgVhroFk6LVZjlK4Wzv83DJxD8ewqRlB1WQgagQ02DVC5jKA10CSdLk2haoSmcAyz8CJ+Oe9BYSony++qZQ3kaRFgUTLz0NvSgSzh9mdjQgmF59qn9/G3drK+LiXTyyXFjPWWRoz68duJbJwHRrQRPHy3DqGlAY6Zffgd60R3qQ129uMBCnHJNa1IUeiScJqXHk1rQo234SC/z8Nweo9F3UI4Ps8qPG0wnVS1u9KUUWjQZelaHF/964prW87oaqMoLJWPcAGRkgsKbVnb6awRDjzOyNHk4YDuLiPMEL0mtgNYEEkuFkFr9GcW0AoY8oHrBLI+rTL9yFmZjg1Gy7PVW9j5qDePCb7NXWvMB1BrGQ71RBJpEzUvufBr+zBy8uWV48gl4s4U9uJiPP9FPth1CytaElNCEefsxRBwnEHUcg2w/BKswLnxlEngYLYS8g7+8gZiLY2LrCnw7v3NRUWc3YrYOhBv7igJLcStpbiRRieNUbgVj29/xe0zWv4WZ5k9hBcaE76QKoonEDHD4Aj+d3vwWYWcfBls+5sKrwZtdwfCjnzC2+jnw+kcwG2PCt+VCmKflwvkuA67PqhasQqEeaPkEfvsGpmE+xoRTeLd6AZe3IH4XVTQ93qigoecwbWqokotuJffcRn07w0tidlDhovZNNZ+EFRgTTqJP7/UHlbW+1sOIZXYnz3ZSYl2hfvfUu3iho1ZiVJJ66pqLfUlweV8rMCZ8dzErp83hxMDtnysOo2qPSl758UMmbKloBC3GPG/ACix550b740DnJg9ZrdBW99aVUEO/cJ8eWIElwkvLV9rIqPlN5zHmZS0orEtz3WoqCt96tAMz4GIc7aZtLsyiYsk6+8caap0bsUTFaxWF35CT/GdW+sm11qA5X/nxFhbkZMU+++b4VGSJHzVOSutD/nbL/1VYgs1R8qEwApO42E+/U3foGrPOPPZN+DeYhKxACRZb+TzbL8Qvc7WKkr9kgyDCAq7P39UtfGGf3KwCsdSReSUvR6RBiQvPZ7PjiiKM2eysKRjfopeyxrz3ZfBXPHMU5vd8Fkouw71f/B+Y8198H2DihwSb4MVzSJ6FPNtcjF/9+sPL1P4PuAI8EPggBdgAAAAASUVORK5CYII=">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Sharing Economy Crash Course') ?></h4>
                </div>
            </a>
            <a class="card" href="<?= $link_souk ?>" target="_blank">
                <img alt="<?= Yii::t('global_pages', 'Knowledge Souk') ?>" src="data:image/png;base64,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">
                <div class="text">
                    <h4><?= Yii::t('global_pages', 'Knowledge Souk') ?></h4>
                </div>
            </a>
        </div>
    </div>
</div>
