<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MessBox</title>
    <meta name="author" content="Mateusz Wojno">
    <meta name="description" content="Portal społecznościowy"/>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/profile.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

<nav class="navbar  navbar-expand-xl" id="menu">
    <form class="form-inline" action="search.php" method="post">
        <div class="md-form active-cyan active-cyan-2">
            <input class="form-control mr-3  mr-3" name="search" placeholder="Wyszukaj" aria-label="Search">
        </div>
        <button class="btn btn-outline-light my-2 my-sm-0 mr-5" type="submit" name="sub">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
    </form>
    <button class="navbar-toggler btn btn-danger"
            type="button"
            data-toggle="collapse"
            data-target="#mainmenu"
            aria-controls="mainmenu"
            aria-expanded="false"
            aria-label="Przełącznik nawigacji">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto col-xl-7 bg-f2 d-flex justify-content-between">
            <li class="nav-item bg-mat">
                <a class="nav-link" href="<?= htmlEntities($this->profile->profileUrl()) ?>">
                    <i class="fas fa-user mr-2"></i>
                    Profile
                </a>
            </li>
            <li class="nav-item bg-mat">
                <a class="nav-link" href="<?= htmlEntities($this->profile->photoUrl()) ?>">
                    <i class="far fa-images mr-2"></i>
                    PhotoView
                </a>
            </li>
            <li class="nav-item bg-mat text-mat">
                <a class="nav-link" href="<?= htmlEntities($this->profile->notificationUrl()) ?>">
                    <i class="fas fa-bell mr-2"></i>
                    Notification
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons col-xl-3 bg-f1  d-flex justify-content-end">
            <li class="nav-item dropdown" id="panelMenu">
                <a class="nav-link dropdown-toggle mr-2" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user mr-2"></i>Panel
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                     aria-labelledby="navbarDropdownMenuLink-333">
                    <a class="dropdown-item" href="statistics.php">Statystyki</a>
                    <a class="dropdown-item" href="account.php">Ustawienia konta</a>
                    <a class="dropdown-item" href="settings.php">Ustawienia profilu</a>
                    <a class="dropdown-item" href="logout.php">Wyloguj się</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<header>
    <div class="container-fluid bg-light" id="userBoard">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 order-5 order-12 order-6 order-md-4">
                <div class="row" id="rowBirthDate">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div>Data urodzenia: <?= htmlSpecialChars($this->user->birthDate); ?></div>
                    </div>
                </div>
                <div class="row" id="rowEmail">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div>Email: <?= htmlSpecialChars($this->user->email); ?></div>
                    </div>
                </div>
                <div class="row" id="rowSchool">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div>Szkoła: <?= htmlSpecialChars($this->user->school); ?></div>
                    </div>
                </div>
                <div class="row" id="rowNumberPhone">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div>Telefon: <?= htmlSpecialChars($this->user->numberPhone); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 order-7 order-md-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div id="avatar">
                            <img src="<?= htmlSpecialChars($this->user->avatarUrl()); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        <div id="userName"><span><?= htmlSpecialChars($this->user->firstName); ?></span>
                            <span><?= htmlSpecialChars($this->user->lastName); ?></span></div>
                    </div>
                </div>
                <?php if ($this->friendStatus->isFriend()): ?>
                    <div class="row" style="display: block">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                            <form action="" method="post">
                                <input type="submit" name="addFriend" id="friendStatus"
                                       value="<?= htmlSpecialChars($this->friendStatus->friendStatus()); ?>"
                                       style="background-color: <?= htmlSpecialChars($this->friendStatus->cssColor()); ?>">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-5"
                         id="colFriends">
                        <a href="<?= htmlEntities($this->user->friendsUrl()); ?>" id="friendsButton">
                            Znajomi
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-5"
                         id="colPhotoView">
                        <a href="<?= htmlEntities($this->user->photoUrl()); ?>" id="photoViewButton">
                            PhotoView
                        </a>
                    </div>
                </div>
                <?php if ($this->friendStatus->isFriend()): ?>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-5"
                             id="colConversation">
                            <a href="<?= htmlEntities($this->user->conversationUrl()); ?>"
                               id="conversationButton">
                                Konwersacja
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center mt-5"
                         id="colStatus">
                        <?php if ($this->user->status === "online") : ?>
                            <div style="background-color: green" id="onlineStatus">Online</div>
                        <?php else: ?>
                            <div style="background-color: red" id="offlineStatus">Offline</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 order-8 order-md-4">
                <div class="row" id="rowGender">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        Płeć: <?= $this->user->gender ? "Mężczyzna" : "Kobieta" ?>
                    </div>
                </div>
                <div class="row" id="rowMartialStatus">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        Status związku: <?= htmlSpecialChars($this->user->martialStatus); ?>
                    </div>
                </div>
                <div class="row" id="rowWork">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        Praca: <?= htmlSpecialChars($this->user->work); ?>
                    </div>
                </div>
                <div class="row" id="rowPlaceLiving">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center">
                        Miejsce zamieszkania: <?= htmlSpecialChars($this->user->placeLiving); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container bg-dark" id="postModule">
        <div class="row d-flex justify-content-center">
            <h1>Dodaj TWEET</h1>
        </div>
        <?php if (!$this->friendStatus->isFriend()) : ?>
            <div class="row d-flex justify-content-center" style="display: block">
                <div class="col-xl-7">
                    <form method="post" name="formPostPublish">
                        <textarea class="md-textarea form-control"
                                  rows="5"
                                  placeholder="Co słychać?"
                                  name="post">
                        </textarea>
                        <?php if ($this->message->failed()): ?>
                            <span class="error" style="color: red">
                                <?= htmlSpecialChars($this->message->errorMessage()); ?>
                            </span>
                        <?php endif; ?>
                        <div class="buttonPostPublish">
                            <button class="btn btn-danger mt-2" name="addPost">Publikuj</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php foreach ($this->posts as $post): ?>
            <div class="row  d-flex justify-content-center">
                <div class="col-xl-8" id="post">
                    <div class="row" id="dataPost">
                        <div class="btn-block d-flex justify-content-between">
                            <div class="authorPost">
                                <?= htmlSpecialChars($post->author); ?>
                            </div>
                            <div class="timePostPublish">
                                <?= htmlSpecialChars($post->dateToAdd); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="btn-block d-flex justify-content-between" id="containerPost">
                            <div class="contentPost">
                                <?= htmlSpecialChars($post->comment); ?>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" id="formPostReaction">
                        <div class="row">
                            <div class="col-12 col-xl-12 d-flex justify-content-around" id="colPostReaction">
                                <button class="likeButton"
                                        style="background-color: <?= htmlSpecialChars($post->likeColor) ? 'green' : 'black' ?> "
                                        name="submitLike">
                                    <i class="fas fa-heart"></i>
                                    <input type="hidden" name="like" value=" <?= htmlSpecialChars($post->postId); ?>"/>
                                    <span id="likeFont"><?= htmlSpecialChars($post->likes); ?></span>
                                </button>
                                <button class="dislikeButton"
                                        style="background-color: <?= htmlSpecialChars($post->dislikeColor) ? 'red' : 'black' ?> "
                                        name="submitDislike">
                                    <i class="fas fa-heart-broken"></i>
                                    <input type="hidden" name="dislike"
                                           value="<?= htmlSpecialChars($post->post_id); ?>"/>
                                    <span id="dislikeFont"><?= htmlSpecialChars($post->dislike); ?></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="js./bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
</body>
</html>
