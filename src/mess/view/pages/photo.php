<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MessBox</title>
    <meta name="author" content="Mateusz Wojno">
    <meta name="description" content="Portal Społecznościowy "/>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/photo.css" type="text/css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
    <div class="collapse navbar-collapse" id="mainmenu">
        <ul class="navbar-nav mr-auto col-xl-7 bg-f2 d-flex justify-content-between">
            <li class="nav-item bg-mat">
                <a class="nav-link" href="<?= htmlEntities($this->profile->profileUrl()) ?>">
                    <i class="fas fa-user mr-2"></i>Profile
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
                <a class="nav-link dropdown-toggle mr-2"
                   id="navbarDropdownMenuLink-333"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fas fa-user mr-2"></i>
                    Panel
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

<main>
    <div class="container">
        <div class="row">
            <?php foreach ($this->photo as $photo): ?>
                <div class=" col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3" id="photo">
                    <img src="<?= htmlSpecialChars($photo->photoUrl()); ?>" style="border:4px solid white"/>
                    <form action="" method="post">
                        <div class="d-flex justify-content-around">
                            <button class="likePhotoReaction"
                                    style="background-color: <?= htmlSpecialChars($photo->likeColor) ? 'green' : 'black' ?>"
                                    name="submitLike">
                                <i class="fas fa-heart"></i>
                                <input type="hidden" name="like" value=" <?= htmlSpecialChars($photo->id); ?>"/>
                                <span id="likeFont"><?= htmlSpecialChars($photo->likes); ?></span>
                            </button>
                            <button class="dislikePhotoReaction"
                                    style="background-color: <?= htmlSpecialChars($photo->dislikeColor) ? 'red' : 'black' ?>"
                                    name="submitDislike">
                                <i class="fas fa-heart-broken"></i>
                                <input type="hidden" name="dislike" value="<?= htmlSpecialChars($photo->id); ?>"/>
                                <span id="dislikeFont"><?= htmlSpecialChars($photo->dislikes); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
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