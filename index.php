<?php

session_start();

require 'backend/lang.php';
require 'backend/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = htmlspecialchars($_POST['mail']);
    $pass = htmlspecialchars($_POST['pass']);

    $stmt = $conn->prepare("SELECT uid, username, pass, rights FROM users WHERE mail = ?");
    $stmt -> bind_param("s", $mail);
    $stmt -> execute();
    $result = $stmt->get_result();

    if ($user = $result ->fetch_assoc()) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['rights'] = $user['rights'];
            header('Location: dashboard.php');
        } else {
                echo "<p class=floatingmessage>Hibás jelszó!</p>";
        }
    } else {
        echo "<p class=floatingmessage>Nincs ilyen felhasználó!</p>";
    }
}

?>

<!DOCTYPE html>
<head>
<?php

include 'header.php';

?>

</head>
<body>
    <div class="login">
        <div>
            <h2><?= lang('ÜDVÖZÖLÜNK A HOBBIHORGOLÁS WEBOLDALON')?></h2>
        </div>
        <div>
            <form method="post">
                <div class="loginlabel">
                    <label for="mail"><?= lang('E-mail')?></label>
                    <br>
                    <input type="email" name="mail" id="mail" placeholder="<?= lang('E-mail cím')?>">
                </div>
                <div class="loginlabel">
                    <label for="pass"><?= lang('Jelszó')?></label>
                    <br>
                    <input type="password" name="pass" id="pass" placeholder="<?= lang('Jelszó')?>">
                    <br>
                </div>
                <br>
                <div>
                    <button type="submit"><?= lang('Bejelentkezés')?></button>
                </div>
            </form>
        </div>

        <br>

        <div>
            <div>
                <button type="button" onclick="window.location.href='register.php';"><?= lang('Regisztráció')?></button>
            </div>
        </div>
    </div>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quas accusantium natus sint illum eligendi vitae consectetur quae rem accusamus? Laborum ratione, nihil eius accusamus rem nesciunt velit voluptates fugit porro! Autem, repellat fugit. Eum totam quas corporis deserunt eligendi, nemo obcaecati praesentium sed nihil, sit, consectetur doloremque exercitationem eveniet quibusdam. Porro expedita voluptatum provident labore eius delectus deserunt pariatur earum asperiores adipisci tempora doloremque unde, possimus vero eligendi quae fuga dolor explicabo eaque et veniam minima? Sunt voluptatibus doloremque eveniet. Animi officia velit fugit voluptatum ratione corporis odit nisi asperiores nemo facilis distinctio, similique eligendi mollitia optio? Assumenda ex, aliquid expedita asperiores aspernatur libero aliquam voluptates aperiam dolorem atque accusamus fugiat blanditiis praesentium enim molestiae? Dolores voluptate minus sed beatae odit, explicabo velit, id, dolorum repudiandae pariatur a. Magnam aspernatur aliquam dolorum ipsum maxime debitis commodi quo tenetur a distinctio sunt eius molestiae quae dolor doloremque, perferendis totam temporibus, sed impedit excepturi magni numquam? Excepturi obcaecati quam recusandae eveniet repudiandae fugit molestiae qui, incidunt quisquam maiores blanditiis praesentium nihil magnam itaque modi quidem fuga a quas voluptate commodi optio et maxime voluptas. Aut iste pariatur corrupti consequatur? Enim quam eius sapiente. Quis debitis ipsa minus recusandae? Consequuntur molestiae, tempora veritatis sunt atque nihil aliquam necessitatibus placeat commodi esse dolorum voluptas dolor mollitia, magnam quisquam libero inventore possimus quo obcaecati ab asperiores ut! Itaque et, esse in quos molestiae accusantium maiores pariatur dolorum nesciunt velit voluptas dolore reprehenderit officiis suscipit obcaecati tenetur sunt aliquam commodi cupiditate non sit voluptate nostrum eius. Pariatur, iste quasi. Laudantium quae provident eveniet ea nihil, odit, consequuntur corrupti eum itaque error laboriosam sint. Placeat temporibus officia autem omnis aperiam amet tempora doloribus id reprehenderit nobis ipsum voluptate cumque illum ea, dolorum libero, hic velit! Reiciendis earum voluptatum facere consequatur maiores, culpa sequi iusto magni ullam eaque quas quaerat dolore placeat doloribus dignissimos nam molestiae nemo, architecto suscipit similique vero. Inventore nostrum officiis explicabo quisquam cupiditate atque. Autem amet veniam suscipit. Voluptas fuga quod rerum expedita magni magnam, repellat culpa laboriosam dolorum in ducimus, illum, est odio labore facilis officia quasi autem libero sunt earum assumenda sequi. Recusandae fuga id, atque facere ullam incidunt cupiditate vero nam, ex perspiciatis est impedit? Ullam, sunt libero nostrum laboriosam id quas accusamus asperiores voluptatem ad quibusdam corrupti velit natus commodi maiores consectetur accusantium minima recusandae omnis facere earum voluptatum inventore. Laborum asperiores quos ullam, corrupti soluta inventore illo, numquam id praesentium eius sit vel exercitationem ad, fugiat temporibus libero. Dolores, maiores quas facilis animi blanditiis voluptates sit omnis ab sed optio excepturi voluptatibus nostrum amet eveniet voluptas inventore. Praesentium impedit, aliquid enim esse sed pariatur illum. Dolorum porro modi ipsa, sed dolores, repellendus eveniet deserunt quasi autem illum animi ab maxime iste odit nulla expedita illo magni sint dolore perspiciatis, et est nihil reprehenderit at. Id ratione voluptatem ducimus tempore incidunt sequi ullam, earum, architecto eligendi adipisci sint cum. Facilis iure quos voluptatibus quia, aliquam veniam deleniti, fugiat, labore officia culpa sed doloremque totam saepe magnam vel! Veritatis, beatae?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta doloremque fugit est quasi cupiditate eius totam aliquid ducimus laboriosam itaque quam eveniet, amet consequuntur quod perferendis optio nemo tenetur officiis voluptates eum ipsa inventore. Dolor voluptas culpa ex iusto eligendi minima officia laborum porro ipsum? Exercitationem excepturi consequatur et nobis odio enim optio architecto necessitatibus quasi quod in autem, dolor, neque at sunt perferendis nostrum dolorum deleniti aperiam! Laborum incidunt sint quas temporibus quos ullam a, ut vitae hic dolorem accusamus dicta. Expedita voluptate quisquam aliquam? Tempore molestias at sapiente expedita doloremque reiciendis et, aspernatur nisi alias quidem dolorum nemo voluptatum deserunt atque ullam deleniti, praesentium placeat porro consectetur! Ipsa autem saepe numquam vitae eligendi modi suscipit. Nobis vel autem ex nulla dignissimos similique optio. Sequi quaerat ab voluptas harum placeat, praesentium perferendis facere nam cupiditate modi voluptatem doloremque neque veniam itaque suscipit quibusdam molestias quae sed facilis eligendi explicabo tempora laudantium accusamus sint? Excepturi velit, ipsum aperiam minus vitae odit eos incidunt pariatur corrupti alias possimus architecto libero reprehenderit repellendus iste error autem aut fuga dicta quis. Beatae qui, enim suscipit quisquam in debitis ducimus nihil perferendis laborum libero repudiandae hic molestiae eum nobis necessitatibus vitae dolorum porro totam.</p>

<?php

include 'footer.php';

?>

</body>
</html>