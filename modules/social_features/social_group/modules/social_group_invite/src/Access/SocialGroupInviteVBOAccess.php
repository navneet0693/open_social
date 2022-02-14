<?php

namespace Drupal\social_group_invite\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\RouteMatch;
use Drupal\Core\Session\AccountInterface;
use Drupal\group\Entity\GroupInterface;
use Drupal\views\Views;
use Drupal\views_bulk_operations\Access\ViewsBulkOperationsAccess;

/**
 * Defines VBO module access rules.
 */
class SocialGroupInviteVBOAccess extends ViewsBulkOperationsAccess {

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, RouteMatch $routeMatch) {
    $parameters = [
      'view_id' => 'social_group_invitations',
      'display_id' => 'page_1',
    ];

    $group = $routeMatch->getParameter('group');

    if ($group instanceof GroupInterface) {
      if ($view = Views::getView($parameters['view_id'])) {
        $view->group = $group;
        if ($view->access($parameters['display_id'], $account)) {
          return AccessResult::allowed();
        }
      }
    }

    $route = $routeMatch->getRouteObject();

    foreach ($parameters as $key => $value) {
      $route->setDefault($key, $value);
    }

    $parameters = $parameters + $routeMatch->getParameters()->all();

    $routeMatch = new RouteMatch($routeMatch->getRouteName(), $route, $parameters, $parameters);

    return parent::access($account, $routeMatch);
  }

}
