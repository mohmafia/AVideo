# language: en
@smoke @emr @client @elasticmapreduce
Feature: Amazon EMR

  Scenario: Making a request
    When I call the "ListClusters" API
    Then the value at "Clusters" should be a list

  Scenario: Handling errors
    When I attempt to call the "DescribeCluster" API with:
    | ClusterId | fake_cluster |
    Then I expect the response error code to be "InvalidRequestException"
