<?php

namespace Drupal\social_follow_taxonomy;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorableConfigBase;
use Drupal\Core\Config\StorageInterface;

/**
 * Class SocialFollowTaxonomyConfigOverride.
 *
 * Configuration override for Social Follow Taxonomy module.
 *
 * @package Drupal\social_follow_taxonomy
 */
class SocialFollowTaxonomyConfigOverride implements ConfigFactoryOverrideInterface {

  /**
   * Load overrides.
   */
  public function loadOverrides($names): array {
    $overrides = [];

    // Set "Follow by tag" views filter to "People" page.
    $config_name = 'views.view.user_admin_people';

    if (in_array($config_name, $names)) {
      $overrides[$config_name]['display']['default']['display_options']['filters']['social_follow_taxonomy_follow_filter'] = [
        'id' => 'social_follow_taxonomy_follow_filter',
        'table' => 'users_field_data',
        'field' => 'social_follow_taxonomy_follow_filter',
        'relationship' => 'none',
        'group_type' => 'group',
        'admin_label' => '',
        'operator' => 'or',
        'value' => [],
        'group' => 1,
        'exposed' => TRUE,
        'expose' => [
          'operator_id' => 'social_follow_taxonomy_follow_filter_op',
          'label' => 'Following by tags',
          'description' => 'Tags that user is following by.',
          'use_operator' => FALSE,
          'operator' => 'social_follow_taxonomy_follow_filter_op',
          'operator_limit_selection' => FALSE,
          'operator_list' => [],
          'identifier' => 'social_follow_taxonomy_follow_filter',
          'required' => FALSE,
          'remember' => FALSE,
          'multiple' => TRUE,
          'remember_roles' => [
            'authenticated' => 'authenticated',
          ],
          'reduce' => FALSE,
        ],
        'is_grouped' => FALSE,
        'group_info' => [
          'label' => '',
          'description' => '',
          'identifier' => '',
          'optional' => TRUE,
          'widget' => 'select',
          'multiple' => FALSE,
          'remember' => FALSE,
          'default_group' => 'All',
          'default_group_multiple' => [],
          'group_items' => [],
        ],
        'reduce_duplicates' => 0,
        'type' => 'textfield',
        'limit' => TRUE,
        'vid' => [
          'social_tagging' => 'social_tagging',
        ],
        'hierarchy' => 0,
        'error_message' => 1,
        'entity_type' => 'user',
        'plugin_id' => 'social_follow_taxonomy_follow_filter',
      ];
    }

    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix(): string {
    return __CLASS__;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name): CacheableMetadata {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION): ?StorableConfigBase {
    return NULL;
  }

}
