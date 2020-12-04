<?php include "App/Views/Headers/Header.php" ?>

<div class="data">
    <h3 style="text-align: center">Section Layer 2</h3><br>
    <a href="/sections"><- Back</a><br><br>

    <div style="font-size: x-large;padding-left: 20px"><b>-> <?= $masterSection1->getName() ?></b><br><br>
    </div>

            <?php foreach ($allSections as $section): ?>
                <div style="text-align: center">
                    <div class="form" style="width: 400px">
                        <b><?php echo $section->getName() ?></b><br><br>
                        <?php echo $section->getContent() ?><br><br>

                        <form style="display: inline-block" method="get" action="/sections/<?= $masterSection1->getId() ?>/<?= $section->getId() ?>">
                            <button type="submit">Show</button>
                        </form>

                        <form style="display: inline-block" method="post" action="/sections/<?= $masterSection1->getId() ?>/<?= $section->getId() ?>">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="id" value="<?= $section->getID() ?>">
                            <button type="submit">Delete</button>
                        </form>

                        <form style="display: inline-block" method="get" action="/edit/<?= $masterSection1->getId() ?>/<?= $section->getId() ?>">
                            <button type="submit">Edit</button>
                        </form>
                    </div>

                </div><br>
            <?php endforeach; ?>

    <div class="formWrap">
        <div class="form">
            Add new section:
            <form method="post" action="/sections/<?= $masterSection1->getId() ?>">

                <div>
                    <input type="text" name="name" id="name" required>
                    <label for="name">Name</label>
                </div>

                <div>
                    <input type="text" name="content" id="content" required>
                    <label for="content">Content</label>
                </div>

                <div>
                    <input type="hidden" name="masterId" value="<?= $masterSection1->getId() ?>">
                </div>
                <br>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</div>


