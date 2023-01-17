# Test 1 - Friendly Relationship



## Description

The program takes a friendship list and a question as input.

The format is as follows:
X friendship link lines `<name1> is friends with <name2>` __or__ `I am friends with <name2>` or `<name1> is friends with me`<br>
a `---` separator<br>
A question `Is <name> my friend?`

```
Benjamin is friends with Paul
Sophie is friends with me
I am friends with Benjamin
---
Is Sophie my friend?
```

Axiom: `the friend of my friend is my friend`

The goal is to answer the question with yes or no.

### Notes

* There is a __unicity__ of names
* Friendships are __reciprocal__ and __transitive__

## Examples

```php
is_friend("
Benjamin est ami avec Paul
Sophie est amie avec moi
Je suis ami avec Benjamin
---
Est-ce que Sophie est mon amie ?")  # return true;
```

```php
is_friend("
Benjamin est ami avec Paul
Frank est ami avec Paul
Mathieu est ami avec Aurore
Sophie est amie avec moi
Je suis ami avec Benjamin
---
Est-ce que Mathieu est mon ami ?")  # return false;
```