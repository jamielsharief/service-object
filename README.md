# Service Object

`Service Objects` help keep your models and controllers skinny, whilst keeping your code clean and testable. The `Service Object` also helps you
seperate your application business logic from the framework and also makes it easy to test in isolation. They are also super DI-able.

With `Service Objects` have all dependencies added to the `__constructor` method and do not carry state, remember the `The Dependency Rule`, this means that code dependencies can only point inwards.

The `Service Object` is based upon the command pattern and follows the [single responsibility principle](https://en.wikipedia.org/wiki/Single-responsibility_principle), with a the method `execute` where the logic goes and it must always return a `Result` object.


This package provides:

- `AbstractServiceObject` which also is a `callable`, so it can be executed now or later.
- The `Result` value object
- `Params` an immutable object for passing context parameters to the `ServiceObject`

## Usage

```php
class CreateUserService implements ServiceObjectInterface
{
    private Result $result;
    private Model $user; 
    private LoggerInterface $logger

    public function __construct(Result $result, Model $user, LoggerInterface $logger) 
    {
        $this->user = $user;
        $this->logger = $logger;
    } 

    public function execute() : Result
    {
 
        $user = $this->user->create($this->params->toArray());

        if(!$user){
            return $this->result->withSuccess(false);
        }

        // do stuff here
        $this->logNewUser($user);

        return $this->result->withData(
            'user' => $user
        ]);
    }
}
```
The create the object and run it.

```php
$service = new CreateUserService(new Result(),$model,$logger);
$params = new Params(['name'=>'fred', 'email'=>'fred@example.com']); //  See below
$service->withParams($params)->execute();
```




## Result Object

Depending what the service layer is doing sometimes you will need to just return a simple true or false and other times you will need more information.

To create a  `Result` object

```php
$result = new Result(false);
$result = new Result(true, ['message' => 'ok']);
```

Methods available on `Result` object

```php
// check status
$result->isSuccess();
$result->isError();

// work with data
$result->hasData();
$result->getData();
$result->getData('message');
$string = (string) $result;
```

## Do nots

- Do not use an object that did not come from the constructor

- Do not call other Service Objects from within a Service Object, if you need to, then perhaps look at refactoring, such as moving the logic to a single class, which can be passed as a dependency instead. Some people from large projects say this leads to complication and harder to find problems. If you must then make sure its a dependency in the constructor.

- Do nots put all business logic in service objects, Service objects are more functional in nature and call and use your domain model objects which is where the business logic should be. See [anemic domain model](https://martinfowler.com/bliki/AnemicDomainModel.html) on putting all your business logic in services.

## Resources

- [clean architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)

