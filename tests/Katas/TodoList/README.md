# Outside-in TDD

The goal of the exercise is to create a basic to-do list application using an outside-in TDD approach.

## Project

We are going to build a little to-do list application.

Our target is that the resulting application has a pretty clean architecture.

### US 1

* As a User
* I want to add tasks to a to-do list
* So that, I can organize my task

### US 2

* As a User
* I want to see the task in my to-do list
* So that, I can know what I have to do next

### US 3

* As a User
* I want to check a task when it is done
* So that, I can see my progress

### TO-DO List examples for acceptance test

1. Write a test that fails (done)
2. Write Production code that makes the test pass
3. Refactor if there is opportunity

POST /api/todo
[task:Write a test that fails]

POST /api/todo
[task:Write Production code that makes the test pass]

POST /api/todo
[task:Refactor if there is opportunity]

PATCH /api/todo/1
[done:true]

GET /api/todo
1. Write a test that fails (true)
2. Write Production code that makes the test pass (false)
3. Refactor if there is opportunity (false)

## Technicalities

Endpoints:

* `POST /api/todo` (201/404 if not implemented)
* `GET /api/todo` (200/404 if not implemented/500 if something gone wrong)
* `PATCH /api/todo/{taskId}` (200/404 if not implemented)

We will use 404 as "not implemented" for our endpoints.

## The process

Outside-in TDD is about doing some up-front design in the red stage. In Classicist TDD, design comes with the refactoring phase, so you are designing in the green stage. This is because, outside-in puts the focus on the communication between units instead of its state.

The Outside-in approach uses two loops:

* Acceptance test
* Unit test

First, we will create an acceptance test using the data in the example, performing the calls to the endpoints as needed.

When POSTing and PATCHing we will not have a direct outcome. We can only test trough the GET /api/todo endpoint. We can use the Location header.

Our test should fail because of the right reason, so our first target should be to make the acceptance test fail because the GET /api/todo doesn't return the task list as we expected (It returns an empty list, for example).

This means that we will have to develop/configure all things needed to have live API endpoints:

* Controllers
* Routing
* Services configuration
