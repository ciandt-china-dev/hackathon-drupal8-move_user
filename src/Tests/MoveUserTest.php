<?php
/**
 * @file
 * Test case for testing the move_user module.
 *
 * This file contains the test cases to check if move user is performing correctly.
 */

namespace Drupal\move_user\Tests;

use \Drupal\simpletest\WebTestBase;

/**
 * Create two users and use one user to create few nodes, 
 * then use the administrator user to delete the nodes created,
 * reassign the nodes to the second user.
 *
 * @group move_user
 */
class MoveUserTest extends \Drupal\node\Tests\NodeTestBase {

  protected $originalAuthor;

  protected $newAuthor;

  protected $createdNode;

  public static $modules = array('move_user', 'user');

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->originalAuthor = $this->drupalCreateUser(array('create page content', 'edit own page content'));
    // Create another admin user for delete the web_user
    $this->newAuthor = $this->drupalCreateUser(array('create page content', 'edit own page content'));

    // create a page node with current user
    $this->createdNode = $this->drupalCreateNode(array('type' => 'page', 'uid' => $this->originalAuthor->id()));

  }

  /**
   * Tests to reassign node to another user.
   */
  public function testCancelUserMoveUser() {
    // Create administrator user and login
    $admin_user = $this->drupalCreateUser(array('administer nodes', 'administer users'));
    $this->drupalLogin($admin_user);

    // Cancel the author page
    $cancel_user_url = 'user/' . $this->originalAuthor->id() . '/cancel';
    $this->drupalGet($cancel_user_url);

    $edit = array();
    $edit['user_cancel_method'] = 'move_user_reassign';
    $edit['reassign_user'] = $this->newAuthor->getUserName() . ' (' . $this->newAuthor->id() . ')';
    $edit['confirm'] = 1; 
    $this->drupalPostForm($cancel_user_url, $edit, t('Cancel account'));

    // check if the node's author is changed to newAuthor
    $node = node_load($this->createdNode->id());
    $this->assertEqual($node->getOwnerId(), $this->newAuthor->id(), 'Ensure that the node is reassigned to the new user correctly.');
  }
}
