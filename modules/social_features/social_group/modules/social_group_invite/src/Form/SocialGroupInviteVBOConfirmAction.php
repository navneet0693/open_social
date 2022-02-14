<?php

namespace Drupal\social_group_invite\Form;

use Drupal\views_bulk_operations\Form\ConfirmAction;
use Drupal\Core\Form\FormStateInterface;

/**
 * Default action execution confirmation form.
 */
class SocialGroupInviteVBOConfirmAction extends ConfirmAction {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $view_id = 'social_group_invitations', $display_id = 'page_1') {
    $form = parent::buildForm($form, $form_state, $view_id, $display_id);
    $form_data = $this->getFormData($view_id, $display_id);

    // Show a descriptive message in the confirm action form.
    if (isset($form_data['action_id'])) {
      $form['description'] = [
        '#markup' => $this->formatPlural($form_data['selected_count'],
          'Are you sure you want to "%action" the following member?',
          'Are you sure you want to "%action" the following %count members?',
          [
            '%action' => $form_data['action_label'],
            '%count' => $form_data['selected_count'],
          ]),
        '#weight' => -10,
      ];

      if ($form_data['action_id'] === 'social_group_invite_resend_action') {
        $form['actions']['submit']['#value'] = $this->t('Send');
      }

      if ($form_data['action_id'] === 'social_group_delete_group_content_action') {
        $form['actions']['submit']['#value'] = $this->t('Remove');
      }
    }

    $form['actions']['submit']['#attributes']['class'] = ['button button--primary js-form-submit form-submit btn js-form-submit btn-raised btn-primary waves-effect waves-btn waves-light'];
    $form['actions']['cancel']['#attributes']['class'] = ['button button--danger btn btn-flat waves-effect waves-btn'];

    return $form;
  }

}
