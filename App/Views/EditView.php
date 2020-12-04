<?php include "App/Views/Headers/Header.php" ?>


Edit section:

<?php if ($vars['id1'] != null && $vars['id2'] != null && $vars['id3'] != null): ?>

<form method="post" action="/edit/<?= $vars['id1'] ?>/<?= $vars['id2'] ?>/<?= $vars['id3'] ?>">

    <?php endif; ?>

    <?php if ($vars['id1'] != null && $vars['id2'] != null && $vars['id3'] == null): ?>

    <form method="post" action="/edit/<?= $vars['id1'] ?>/<?= $vars['id2'] ?>">

        <?php endif; ?>


        <?php if ($vars['id1'] != null && $vars['id2'] == null && $vars['id3'] == null): ?>

        <form method="post" action="/edit/<?= $vars['id1'] ?>">

            <?php endif; ?>

            <div>
                <input type="hidden" name="_method" value="EDIT"/>
            </div>

            <div>
                <input type="text" name="name" id="name" value="<?= $section->getName() ?>" required>
                <label for="name">Name</label>
            </div>

            <div>
                <input type="text" name="content" id="content" value="<?= $section->getContent() ?>" required>
                <label for="content">Content</label>
            </div>

            <div>
                <input type="hidden" name="masterId" value="<?= $section->getMasterId() ?>">
            </div>

            <button type="submit">Submit</button>
        </form>