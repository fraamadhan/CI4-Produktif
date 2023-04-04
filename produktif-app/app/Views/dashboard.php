<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <title>Dashboard</title>
    <script>alert('<?= session()->getFlashdata('msg'); ?>')</script>
</head>

<body>
    <header>
        <h1>Dashboard Produktif</h1>
        <a href="logout"><button id="logout">Logout</button></a>
    </header>
    <main>
        <div class="container">
            <div class="content" id="content">
                <div class="greetings">
                    <h3>Welcome, <?= $profile['nama']; ?>!</h3>
                </div>
                <div class="profiles">
                    <p class="profile">Nama</p>
                    <span>
                        <p><?= $profile['nama'] ?></p>
                    </span>
                    <p class="profile">Alamat</p>
                    <span>
                        <p><?= $profile['alamat'] ?></p>
                    </span>
                    <p class="profile">Email</p>
                    <span>
                        <p><?= $profile['email'] ?></p>
                    </span>
                </div>
                <div class="button">
                    <button id="update">Update Profile</button>
                    <a href="delete/<?= $profile['email'] ?>/<?= $profile['userID']; ?>"><button id="delete" onclick="return confirm('Are you sure want to delete account?')">Delete Account</button></a>
                </div>
            </div>
            <div class="updateSection" id="updateSection" style="display:none">
                <h2>Update Your Profile</h3>
                <form action="/update/<?=$profile['userID'];?>" method="POST">
                    <form action="">
                        <?php csrf_field(); ?>
                        <fieldset>
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" value="<?=$profile["nama"];?>" required>
                        </fieldset>
                        <fieldset>
                            <label>Alamat</label>
                            <textarea name="alamat" id="alamat" cols="40" rows="10"><?=$profile["alamat"];?></textarea>
                        </fieldset>
                        <button type="submit" id="submit">Update</button>
                    </form>
                    <a href="dashboard"><button id="cancel">Cancel</button></a>
                </form>
            </div>
        </div>
    </main>
    <script src="/js/script.js"></script>
</body>

</html>