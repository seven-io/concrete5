<?php defined('C5_EXECUTE') or die('Access Denied.');

use Seven\Concrete5\AbstractSinglePageDashboardController;

?>

<?php if (isset($dashboardLink)): ?>
    <a href='<?= $dashboardLink ?>'>
        <?= t('Click here for navigating to the dashboard.') ?>
    </a>
<?php else: ?>
    <?php if (isset($apiResponses)): ?>
        <script>
            function sevenToggleRawResponse() {
                document.getElementById('sevenRawResponse').classList.toggle('hidden')
            }
        </script>

        <div class='alert alert-info'>
            <button onclick='sevenToggleRawResponse()' class='btn btn-primary btn-xs'>
                <?= t('Raw') ?></button>
            <button type='button' class='close' data-dismiss='alert'>×</button>

            <pre id='sevenRawResponse' class='hidden'>
                <?= json_encode($apiResponses, JSON_PRETTY_PRINT) ?></pre>

            <?php foreach ($apiResponses as $i => $res): ?>
                <table class='table table-responsive'>
                    <caption><?= t('Response') ?> #<?= $i ?></caption>

                    <tr>
                        <th><?= t('Success') ?></th>
                        <td><?= $res->success ?></td>
                    </tr>
                    <tr>
                        <th><?= t('Total Price') ?></th>
                        <td><?= $res->total_price ?></td>
                    </tr>
                    <tr>
                        <th><?= t('Balance') ?></th>
                        <td><?= $res->balance ?></td>
                    </tr>
                    <tr>
                        <th><?= t('Debug') ?></th>
                        <td><?= $res->debug ?></td>
                    </tr>
                    <tr>
                        <th><?= t('Messages') ?></th>
                        <td>
                            <table class='table table-responsive'>
                                <thead>
                                <tr>
                                    <th><?= t('ID') ?></th>
                                    <th><?= t('Recipient') ?></th>
                                    <th><?= t('Parts') ?></th>
                                    <th><?= t('Price') ?></th>
                                    <th><?= t('Success') ?></th>
                                    <th><?= t('Error') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($res->messages as $msg): ?>
                                    <tr>
                                        <td><?= AbstractSinglePageDashboardController::stringify($msg->id) ?></td>
                                        <td><?= $msg->recipient ?></td>
                                        <td><?= $msg->parts ?></td>
                                        <td><?= $msg->price ?></td>
                                        <td><?= AbstractSinglePageDashboardController::stringify($msg->success) ?></td>
                                        <td>
                                            <?= AbstractSinglePageDashboardController::stringify($msg->error) ?>
                                            <?php if ($msg->error_text): ?>
                                                &nbsp;(<?= $msg->error_text ?>)
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php endforeach ?>
        </div>
    <?php endif ?>

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
            <?= $form->textarea('text', ['maxlength' => 1520, 'required' => 'required', 'rows' => 5]) ?>
            <p class='help-block'><?= t('Maximum 1520 characters.') ?></p>
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
