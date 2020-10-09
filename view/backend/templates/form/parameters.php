<?php
/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/* @var $this \CrazyCat\UrlRewrite\Block\Form\Renderer\Parameters */
$field = $this->getField();
$value = $this->getValue() ?: [];
?>
<?php if ($this->withLabel()) : ?>
    <label class="field-name" for="<?= $this->getFieldId(); ?>"><?= $field['label']; ?></label>
<?php endif; ?>
<?php if ($this->withWrapper()) : ?>
<div class="field-content">
    <?php endif; ?>

    <div id="<?= $this->getFieldId() ?>">
        <?php $i = 0;
        foreach ($value as $paramName => $paramValue): ?>
            <div class="row param">
                <input type="text" class="input-text short <?= $this->getClasses() ?>"
                       id="<?= $this->getFieldId() ?>_<?= $i ?>_name"
                       name="<?= $this->getFieldName() ?>[<?= $i ?>][name]"
                       value="<?= htmlEscape($paramName) ?>"
                       placeholder="<?= __('Name') ?>"/>

                <input type="text" class="input-text short <?= $this->getClasses() ?>"
                       id="<?= $this->getFieldId() ?>_<?= $i ?>_value"
                       name="<?= $this->getFieldName() ?>[<?= $i ?>][value]"
                       value="<?= htmlEscape($paramValue) ?>"
                       placeholder="<?= __('Value') ?>"/>

                <button class="button red" type="button"><span>-</span></button>
            </div>
            <?php $i++;
        endforeach; ?>

        <div class="row actions">
            <button class="button" type="button"><span>+</span></button>
        </div>
    </div>

    <?php if ($this->withWrapper()) : ?>
</div>
<?php endif; ?>

<script type="text/javascript">
    // <![CDATA[
    require(['jquery'], function ($) {
        const txtName = '<?= __('Name') ?>';
        const txtValue = '<?= __('Value') ?>';
        const fieldId = '<?= $this->getFieldId() ?>';
        const fieldName = '<?= $this->getFieldName() ?>';
        const paramBox = $('#' + fieldId);
        paramBox.on('click', '.param .button', function () {
            $(this).parent().remove();
        });
        paramBox.on('click', '.actions .button', function () {
            let num = paramBox.find('.param').length;
            let html = '<div class="row param">' +
                '<input type="text" class="input-text short" placeholder="' + txtName + '" id="' + fieldId + '_' + num + '_name" name="' + fieldName + '[' + num + '][name]" />' +
                '<input type="text" class="input-text short" placeholder="' + txtValue + '" id="' + fieldId + '_' + num + '_value" name="' + fieldName + '[' + num + '][value]" />' +
                '<button class="button red" type="button"><span>-</span></button>' +
                '</div>';
            paramBox.find('.actions').before(html);
        });
    });
    // ]]>
</script>