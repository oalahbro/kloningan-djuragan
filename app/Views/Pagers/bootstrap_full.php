<?php 
$pager->setSurroundCount(2);
if (count($pager->links()) > 1) {
?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                <span aria-hidden="true">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-alt-to-left" class="svg-inline--fa fa-arrow-alt-to-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M304 400v-51.6h96c26.5 0 48-21.5 48-48v-88.6c0-26.5-21.5-48-48-48h-96v-51.6c0-42.6-51.7-64.2-81.9-33.9l-144 143.9c-18.7 18.7-18.7 49.1 0 67.9l144 144C252.2 464 304 442.7 304 400zM112 256l144-144v99.7h144v88.6H256V400L112 256zM36 448H12c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h24c6.6 0 12 5.4 12 12v360c0 6.6-5.4 12-12 12z"></path></svg>
                </span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                <span aria-hidden="true">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-alt-left" class="svg-inline--fa fa-arrow-alt-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M272 431.952v-73.798h128c26.51 0 48-21.49 48-48V201.846c0-26.51-21.49-48-48-48H272V80.057c0-42.638-51.731-64.15-81.941-33.941l-176 175.943c-18.745 18.745-18.746 49.137 0 67.882l176 175.952C220.208 496.042 272 474.675 272 431.952zM48 256L224 80v121.846h176v108.308H224V432L48 256z"></path></svg>
                </span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <?php if ($link['active']) { ?>
        <li class="page-item active" aria-current="page">
            <span class="page-link">
            <?= $link['title'] ?>
            <span class="sr-only">(current)</span>
            </span>
        </li>
        <?php } else { ?>
        <li class="page-item">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
        <?php } ?>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Previous">
                <span aria-hidden="true">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-alt-right" class="svg-inline--fa fa-arrow-alt-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M176 80.048v73.798H48c-26.51 0-48 21.49-48 48v108.308c0 26.51 21.49 48 48 48h128v73.789c0 42.638 51.731 64.151 81.941 33.941l176-175.943c18.745-18.745 18.746-49.137 0-67.882l-176-175.952C227.792 15.958 176 37.325 176 80.048zM400 256L224 432V310.154H48V201.846h176V80l176 176z"></path></svg>
                </span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                <span aria-hidden="true">
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-to-right" class="svg-inline--fa fa-arrow-alt-to-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M144 112v51.6H48c-26.5 0-48 21.5-48 48v88.6c0 26.5 21.5 48 48 48h96v51.6c0 42.6 51.7 64.2 81.9 33.9l144-143.9c18.7-18.7 18.7-49.1 0-67.9l-144-144C195.8 48 144 69.3 144 112zm192 144L192 400v-99.7H48v-88.6h144V112l144 144zm76-192h24c6.6 0 12 5.4 12 12v360c0 6.6-5.4 12-12 12h-24c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12z"></path></svg>
                </span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>
<?php } ?>