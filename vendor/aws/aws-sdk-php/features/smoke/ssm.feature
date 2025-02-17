# language: en
@smoke @ssm
Feature: Amazon SSM

  Scenario: Making a request
    When I call the "ListDocuments" API
    Then the value at "DocumentIdentifiers" should be a list

  Scenario: Handling errors
    When I attempt to call the "GetDocument" API with:
    | Name | 'fake-name' |
    Then I expect the response error code to be "ValidationException"
