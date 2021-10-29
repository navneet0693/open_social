<?php

namespace Drupal\social_user\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SocialUserController.
 *
 * @package Drupal\social_user\Controller
 */
class SocialUserController extends ControllerBase {

  /**
   * OtherUserPage.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   Return Redirect to the user account.
   */
  public function otherUserPage(UserInterface $user) : RedirectResponse {
    return $this->redirect('entity.user.canonical', ['user' => $user->id()]);
  }

  /**
   * The _title_callback for the users profile stream title.
   *
   * @param \Drupal\user\UserInterface|null $user
   *   The user who's profile is being viewed.
   *
   * @return string|null
   *   The display name for the current viewer or NULL if no user is provided.
   */
  public function setUserStreamTitle(UserInterface $user = NULL) : ?string {
    if ($user === NULL) {
      return NULL;
    }
    return $user->getDisplayName();
  }

}
