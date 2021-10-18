Feature: Add Tasks into the To-do list
  As User
  I want to add tasks to a todo list
  So that I can manage the things I have to do

  Scenario: Empty to-do list
    Given I have no tasks in my list
    When I get my tasks
    Then I see an empty list

  Scenario: Adding task to empty to-do list
    Given I have no tasks in my list
    Given I add a task with description "Write a test that fails"
    When I get my tasks
    Then I see a list containing:
      | id | Description | Done |
      |  1 | Write a test that fails | no |

  Scenario: Adding task to non empty to-do list
    Given I have tasks in my list
    Given I add a task with description "Write code to make test pass"
    When I get my tasks
    Then I see a list containing:
      | id | Description | Done |
      |  1 | Write a test that fails | no |
      |  2 | Write code to make test pass | no |
