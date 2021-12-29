# Elephant Carpaccio

## About Elephant Carpaccio

This exercise was invented by Alistair Cockburn. The target of the exercise is to learn how to vertically slice user
stories into really thin vertical slices.

A vertical slice is a piece of a story with the following characteristics:

* Vertical: it cuts across multiple architectural layers or technical stacks. Usually a vertical slice contains elements
  of user interface, backend, persistence, etc. Or the user can perceive a change in the things that are possible to do
  with the software.
* Testable: you can verify the behavior it with tests. Or better: you can specify it with tests and develop it in TDD
  fashion.
* User valuable: users obtain some value from the delivery of the slice. Value can benefit only part of potential users,
  or satisfy only one specific use case. You need to provide value with each slice and decide where to start.

## The exercise

You can find
the [Facilitation guide](https://docs.google.com/document/d/1TCuuu-8Mm14oxsOnlk8DqfZAA1cvtYu9WGv67Yj_sSk/pub). This
README is an adaptation of the facilitation guide.

1. Organize in small teams (2-3 people) with a computer per team.
2. (20 min) Discussion about user stories.
3. (20-30 min) Slice the product in 10-20 demo-able user stories or slices. They should be doable in less than 8
   minutes. UI mockup, creation of data tables, etc., are not considered slices. A valid slice provides new value to the
   user.
4. Discuss the slices.
5. (40 min) [OPTIONAL, but fun] Develop the application in 40 minutes: 5 iterations (sprints) of 8 minutes each.
6. (15-20 min) Debrief

## The product

Product is a retail calculator that can accept 3 inputs:

* How many items
* Price per item
* 2-letter state code (for taxes)

Output is total price. Discount rate is applied based in total price. Taxes are applied based on state code and
discounted price.

Discounts:

| Order value | Discount rate |
|-------------|---------------|
| $1,000      | 3%            |
| $5,000      | 5%            |
| $7,000      | 7%            |
| $10,000     | 10%           |
| $50,000     | 15%           |

Taxes:

| State | Tax rate |
|-------|----------|
| UT    | 6.85%    |
| NV    | 8.00%    |
| TX    | 6.25%    |
| AL    | 4.00%    |
| CA    | 8.25%    |

## Prioritization

The main problem you have doing this exercise has to do with deciding what should be done first.

Our target is to be able to apply the five discounts and support the five states on taxes. Instead of trying to reach
that target in one shot we should work in tiny steps.

Each step or slice should have UI, input and output and be visibly different from previous.

For example. Taxes are a legal requirement, so we should implement them before discounts, that are optional. Supporting
taxes provides more value.

Input validation or fancy gui details provide the least value, so they should be done _after_ reaching the main target.

### Milestones

**First
slice**: [walking skeleton](https://www.henricodolfing.com/2018/04/start-your-project-with-walking-skeleton.html) to tie
the main elements needed to the application. It can be a simple hello-world that shows that the application is reachable
and provides some output. This kind of approach helps to reduce risks, establish the project, create deploy pipelines,
etc.

**Order value**: accept items and prices and output the product.

**Hardcoded State tax**: hard coded (arbitrary) state tax. Example of how to provide value to a subset of potential
users.

**Input of State tax**: application allows to introduce the tax (not the state)

**Input of State**: only supports two states. Show error message for unsupported ones.

**All states supported**

**Support for discount**

**All discounts supported**
