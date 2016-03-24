<?php
/**
 * @file
 * Test case for testing the move_user module.
 *
 * This file contains the test cases to check if move user is performing correctly.
 */

namespace Drupal\move_user\Tests;

use Drupal\Simpletest\WebTestBase;

/**
 * Create two users and use one user to create few nodes, 
 * then use the administrator user to delete the nodes created,
 * reassign the nodes to the second user.
 *
 * @group move_user
 */
class MoveUserTest extends WebTestBase {

  /**
   * Tests the assign the new user when move user.
   */
  public function testMoveUser() {
  }
}
