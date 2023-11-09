<div class="oncenter">
    <h2>이 책에 대한 리뷰<br></h2>
    <?php
    if (!$db->query("select * from review where isbn=$isbn limit 1")->fetch()) {
        echo "이 책에 대한 리뷰가 아직 없습니다.<br>";
    } else { ?>
        <table>
            <?php
            $query = $db->query("select * from review r, users u 
        where r.userid=u.userid and r.isbn=$isbn");
            while ($row = $query->fetch()) {
            ?>
                <tr style="height:4rem">
                    <td><?= $row["username"] ?></td>
                    <td style="width:1000px; max-width:1000px;"><?= $row["content"] ?></td>
                    <td><?= $row["score"] ?></td>
                </tr>
        <?php
            }
        }
        ?>
        </table>

        <?php
        if (isset($_SESSION["userid"])) {
            $id = $_SESSION["userid"];
            $yourReview = $db->query("select * from review where userid=$id and isbn=$isbn")->fetch();
            if ($yourReview) {
                $yourReview["content"] = str_replace("<br>", "\n", $yourReview["content"]);
            }
        ?>
            리뷰 쓰기
            <form method="post" action="../review/reviewsubmit.php">
                <input type="hidden" name="isbn" value=<?= $isbn ?>>
                <textarea name="content" class="small"><?= $yourReview["content"] ?? "" ?></textarea>
                <input name="score" type="number" class="onenumber" max=5 value=<?= $yourReview["score"] ?? 5 ?>>
                <?php if (!$yourReview) { ?>
                    <button type="submit" name="mode" value="write">작성</button>
                <?php } else { ?>
                    <button type="submit" name="mode" value="update">수정</button>
                    <button type="submit" name="mode" value="delete">삭제</button>
                <?php } ?>
            </form>
            <!-- 로그인되어있지 않으면 -->
        <?php } else {
            echo "로그인하면 리뷰를 쓸 수 있습니다.";
        } ?>
</div>