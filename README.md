# Pinbar

## A stock trading simulator for InvertirOnline

Pinbar is a small command line utility to simulate operations on InvertirOnline stock broker.

## Install instructions

Having access to this repo, pull or download the code and then run: `composer install`

## Run tests

In order to run tests, install first dev dependencies: `composer install --dev`

and then run: `./bin/phpunit`

## Usage Examples

### Simulate a trade of a given amount with a certain stock price

`./bin/pinbar 3000 22.75`

Prints the simulation for buying $3000 of a certain stock with price $22.75

### Simulate a trade of a given stock quantity with a certain stock price

`./bin/pinbar -q 100 15.5`

Prints the simulation for buying 100 units of a certain stock at $15.5 each.

### Simulate a sell of a given stock quantity with a certain stock price

`./bin/pinbar -s 100 18.2`

Prints the simulation for selling 100 units of a certain stock at $18.2 each.
