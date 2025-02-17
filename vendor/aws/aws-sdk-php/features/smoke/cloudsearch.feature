# language: en
@smoke @cloudsearch
Feature: Amazon CloudSearch

  Scenario: Making a request
    When I call the "DescribeDomains" API
    Then the response should contain a "DomainStatusList"

  Scenario: Handling errors 
    When I attempt to call the "DescribeIndexFields" API with:
    | DomainName | fakedomain |
    Then I expect the response error code to be "ResourceNotFound"
