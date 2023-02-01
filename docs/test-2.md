# Slot Machine

## Description

You love playing slot machines, but what are your chances of winning?

## Reels

The format is as follows:

15 symbols (5 reels, 3 rows)<br>
a `-----` separator<br>

__Example:__

```bash
grape,grape,clover,clover,cherry
watermelon,diamond,horseshoe,diamond,horseshoe
diamond,watermelon,watermelon,seven,seven
-----
horseshoe,diamond,grape,clover,cherry
clover,watermelon,bell,diamond,horseshoe
seven,cherry,seven,seven,seven
-----
```

## Symbols

* cherry
* grape
* watermelon
* diamond
* lemon
* horseshoe
* seven
* clover
* bell

## Paytable

A table that will show how much you can win on a payline:

```javascript
const paytable = {
    "seven": {
        "5": 500,
        "4": 300,
        "3": 100,
        "2": 4
    },
    "diamond": {
        "5": 400,
        "4": 200,
        "3": 40,
        "2": 2
    },
    "horseshoe": {
        "5": 300,
        "4": 150,
        "3": 30
    },
    "clover": {
        "5": 250,
        "4": 100,
        "3": 20
    },
    "bell": {
        "5": 200,
        "4": 75,
        "3": 20
    },
    "watermelon": {
        "5": 160,
        "4": 50,
        "3": 10
    },
    "grape": {
        "5": 140,
        "4": 40,
        "3": 10
    },
    "lemon": {
        "5": 120,
        '4' : 30,
        "3": 5
    },
    "cherry": {
        "5": 100,
        "4": 20,
        "3": 5
    }
]);
```

## Paylines

A payline, also known as betting line or winning line, is a combination of symbols that results in a win, on a slot machine. Original slot machines only had one payline, and that would be won if three matching symbols created a horizontal line. When it comes to paylines, you can see how much your payline will win by looking at a paytable. Nowadays, paylines aren't just horizontal, and can be in a huge number of shapes, from zigzag to trapezium.

### Payline 1

| 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|
| . | . | . | . | . |
| x | x | x | x | x |
| . | . | . | . | . |

### Payline 2

| 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|
| x | x | x | x | x |
| . | . | . | . | . |
| . | . | . | . | . |

### Payline 3

| 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|
| . | . | . | . | . |
| . | . | . | . | . |
| x | x | x | x | x |

### Payline 4

| 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|
| x | . | . | . | x |
| . | x | . | x | . |
| . | . | x | . | . |

### Payline 5

| 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|
| . | . | x | . | . |
| . | x | . | x | . |
| x | . | . | . | x |

## Questions

### Question 1

How often does a winning grid appear on paylines 4 and 5 for a minimum of 3 "seven" symbols (each payline)?

### Question 2

Which grid earns the most credits (if the bet is made on all lines, 1 to 5)?