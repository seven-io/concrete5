<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<form action='<?= $view->action('submit') ?>' method='post'>
    <?= $this->controller->token->output('submit') ?>

    <fieldset>
        <legend><?= t('General') ?></legend>

        <div class='form-group'>
            <?= $form->label('general:apiKey', t('API Key')) ?>
            <span><?= t('Required for sending. Get one for free at ') ?>
            <a href='https://www.sms77.io'>Sms77</a>
            </span>
            <?= $form->text('general:apiKey', $general['apiKey'], ['maxlength' => '90', 'required' => 'required']) ?>
        </div>
    </fieldset>

    <fieldset>
        <legend><?= t('SMS') ?></legend>

        <div class='form-group'>
            <?= $form->label('sms:from', t('From')) ?>
            <span><?= t('Sender number - a maximum of 11 alphanumeric or 16 numeric characters') ?></span>
            <?= $form->text('sms:from', $sms['from'], ['maxlength' => '16']) ?>
        </div>

        <div class='form-group'>
            <?= $form->label('sms:label', t('Label')) ?>
            <span><?= t('Custom ID. Max. 100 chars, allowed characters:') ?>
                <code>a-z, A-Z, 0-9, .-_@</code></span>
            <?= $form->text('sms:label', $sms['label'], ['maxlength' => '100']) ?>
        </div>

        <div class='form-group'>
            <?= $form->label('sms:foreign_id', t('Foreign ID')) ?>
            <span><?= t('Custom ID returned in DLR callbacks etc. Max. 64 chars, allowed characters:') ?>
                <code>a-z, A-Z, 0-9, .-_@</code></span>
            <?= $form->text('sms:foreign_id', $sms['foreign_id'], ['maxlength' => '64']) ?>
        </div>

        <div class='form-group'>
            <div class="checkbox">
                <label>
                    <?= $form->checkbox('sms:debug', 1, $sms['debug']) ?>
                    <?= t('Debug: No SMS will be sent or calculated ir enabled') ?>
                </label>
            </div>
        </div>

        <div class='form-group'>
            <div class="checkbox">
                <label>
                    <?= $form->checkbox('sms:no_reload', 1, $sms['no_reload']) ?>
                    <?= t('No Reload: Prevent sending duplicate SMS (text, type and recipient alike) within 180 seconds') ?>
                </label>
            </div>
        </div>

        <div class='form-group'>
            <div class="checkbox">
                <label>
                    <?= $form->checkbox('sms:flash', 1, $sms['flash']) ?>
                    <?= t('Flash: Message gets directly displayed in the receiver’s display') ?>
                </label>
            </div>
        </div>

        <div class='form-group'>
            <div class="checkbox">
                <label>
                    <?= $form->checkbox('sms:performance_tracking', 1, $sms['performance_tracking']) ?>
                    <?= t('Performance Tracking:') ?>
                    <a href='https://help.sms77.io/en/performance-tracking-1'>
                        <?= t('more information') ?></a>
                </label>
            </div>
        </div>
    </fieldset>

    <div class='ccm-dashboard-form-actions-wrapper'>
        <div class='ccm-dashboard-form-actions'>
            <button class='btn btn-primary pull-right'>
                <?= t('Save') ?>
            </button>
        </div>
    </div>
</form>
