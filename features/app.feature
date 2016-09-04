Feature: an example testing use behat

  Scenario: Test assert response is okay
    Given a route named "/will/return/ok"
    When visit "/will/return/ok"
    Then I should see response okay

  Scenario: Test assert response is not okay
    Given a route named "/will/return/error"
    When visit "/will/return/error"
    Then I should not see response okay

  Scenario: Test assert response data
    Given a route named "/will/return/ok"
    When post "/will/return/ok"
    Then I should see response okay
    And I should see response data contain "POST OK"

  Scenario: Test assert response title is "sample"
    Given a route named "/title/return/sample"
    When visit "/title/return/sample"
    Then I should see response title is "sample"
