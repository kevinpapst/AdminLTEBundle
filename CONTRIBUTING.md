# Contributing

The AdminLTEBundle is an open source project and contributions made by the community are welcome. 
Send your ideas, code reviews, pull requests and feature requests to help me improve this project.

To make my and your live easier, here are the simple rules for PRs.

## Pull request rules

- Fix your codestyles before pushing with `composer codestyle-fix`
- Fix static code analysis errors, use `composer phpstan`
- Add PHPUnit tests for your changes and execute all tests with `composer tests`
- Travis fails if you do not verify the above points: fix the errors :-)
- Verify everything still works, e.g. using a branch inside the [demo apps](https://github.com/kevinpapst/AdminLTEBundle-Demo) with composer.json pointing to your AdminLTEBundle branch
  - the app is not well tested (old codebase) so you have to do this manually 
- With sending in a PR, you accept that your contributions/code will be published under MIT license (see [LICENSE](LICENSE))

## Code styles

As this project is a fork, the code is written in different flavours and the code base 
is not yet upgraded to be fully consistent. But for all new changes I'd like to stick to the following rules:
- use strict typing wherever possible (function params, returns types ...)
- camelCase variables and function names
