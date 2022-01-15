# The Greetings kata

## About Greetings kata

[Source](https://github.com/testdouble/contributing-tests/wiki/Greeting-Kata)

## The exercise

The target is to create a class or function that can greet people.

We will work doing iterations, implementing one User Story at a time. Ideally, we should not read more than the story in which we are working.

The exercise is designed to use the TDD classicist approach.

The goal is to practice TDD in a changing requirements environment, starting with a minimum product and applying incremental changes.

## The User Stories

### US-1

* As Bob
* I want to be greeted with "Hello, Bob."
* So that, I feel good

### US-2

* As anonymous user
* I want to be greeted with "Hello, my friend."
* So that, I feel fine

### US-3

* As JERRY (all caps) 
* I want to be greeted with "HELLO, JERRY!" 
* So that, I feel fine

### US-4

* As Jill and Jane 
* We want to be greeted with "Hello, Jill and Jane." 
* So that, we feel good

### US-5

* As Amy, Brian and Charlotte, 
* We want to be greeted with "Hello Amy, Brian, and Charlotte." 
* So that, we feel good

### US-6

* As Amy, BRIAN and Charlotte", 
* We want to be greeted with "Hello, Amy and Charlotte. AND HELLO BRIAN!" 
* So that, we feel good

### US-7

* As Bob, "Charlie, Dianne", 
* We want to be greeted with "Hello, Bob, Charlie, and Dianne." 
* So that, we feel good

### US-8

* As Bob, \\"Charlie, Dianne\\", 
* We want to be greeted with "Hello, Bob and Charlie, Dianne."
* So that, we feel good

## Notes

We will use outside-in classicist TDD approach. That means that we will extract services during the refactoring phase.
