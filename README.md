## Purpose 
Following challenge verifies basic knowledge of kubernetes components, ability to dockerize services
and basic understanding and troubleshoot php(symfony) based applications in containers environment

## Task
Following codebase is a simple symfony application saves(to redis) and serves number of requests made to /count endpoint.
The task is to create Dockerfile and simple kubernetes yaml configuration(see .kubernetes) required to run this application in the cluster

Focus on:
- making service up and running
- simplicity
- best practices for Dockerfile and configuration


## Hints

- use predefined redis yaml for launching redis in cluster
- install redis extension

---
Please provide short description of decision made and implementation.
