<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<?php if (isset($dashboardLink)): ?>
    <a href='<?= $dashboardLink ?>'>
        <?= t('Click here for navigating to the dashboard.') ?>
    </a>
<?php else: ?>
    <form action='<?= $view->action('submit') ?>' method='post'>
        <?= $this->controller->token->output('submit') ?>

        <fieldset>
            <legend><?= t('Filters') ?></legend>

            <div class='form-group'>
                <?= $form->label('filter_group', t('Limit to Group')) ?>
                <?= $form->select('filter_group', $groups, $group, ['class' => 'form-control']) ?>
            </div>
        </fieldset>

        <div class='form-group'>
            <?= $form->label('text', t('Text')) ?>
            <?= $form->textarea('text', ['maxlength' => 10000, 'required' => 'required', 'rows' => 5]) ?>
            <p class='help-block'><?= t('Maximum 10000 characters.') ?></p>
        </div>

        <div class='ccm-dashboard-form-actions-wrapper'>
            <div class='ccm-dashboard-form-actions'>
                <button class='btn btn-primary pull-right'>
                    <?= t('Send') ?>
                </button>
            </div>
        </div>
    </form>
<?php endif; ?>